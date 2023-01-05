<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Payout\PayoutRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;
use App\Models\User as UserModel;
use App\Models\PaymentOrders;
use App\Models\DoctorInformationModel;
use App\Models\UserBankDetails;

//paypal
use App\Models\Bookings;
use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
class PayoutController extends Controller
{    
    public function __construct(UserModel $user,PayoutRepositories $payoutRepositories,PaymentOrders $paymentOrders,Bookings $bookings,DoctorInformationModel $doctorInformationModel,UserBankDetails $UserBankDetails){
        $this->tab                   = 'Appointments';
        $this->PayoutRepositories = $payoutRepositories;
        $this->paymentOrders = $paymentOrders;
        $this->bookings = $bookings;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->userModel = $user;
        $this->UserBankDetails = $UserBankDetails;
         
    }

    public function doctorPayout(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->PayoutRepositories->doctorPayout($request);
        return response()->json($json_arr);
    }

    

    public function exportToDoctorCsv(Request $request)
    {  
        $filename       = "Payoutdoctor".'-'.date('Ymd').'.xlsx';
        $json_arr       =  [];
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $SearchDoctor = $request->get('SearchDoctor');
        $SearchMonthYear = $request->get('SearchMonthYear');
        $drType = $request->get('drType');
        $month = $year = ''; 
        if(!empty($SearchMonthYear)){
            $exploadDate = explode("/",$SearchMonthYear);
            $month =  $exploadDate[0];
            $year =  $exploadDate[1];
        }
        
        $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id as id','booking.status','booking.dr_status','booking.mediator_doctor_id','booking.total_fees','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','po.payment_status','po.paypal_status','booking.doctor_id')->where('booking.dr_status', 'Close')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id')
                             ->join('payment_orders as po', 'booking.id', '=', 'po.bookingID') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id');
                            
        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(drFname LIKE '%".$keyword."%' OR drLname LIKE '%".$keyword."%' OR pFname LIKE '%".$keyword."%' OR pLname LIKE '%".$keyword."%' OR phone_number LIKE '%".$keyword."%' )");
        }


        if (!empty($month))
        {   
            $result = $result->whereMonth('booking.appointment_date', '=', $month);
        }

        if (!empty($year))
        {   
            $result =  $result->whereYear('booking.appointment_date', '=', $year);
        }

        $arrData = $result->orderBy('booking.id','DESC')->get()->toArray();
        $heading = [];
         $format   = "xlsx";
            if($format == "xlsx"){
              $arr_tmp = array();
              $heading = array( 'Order ID','Appontment Date','Appontment Time','Doctor Name','Patient Name','Mediator Doctor','Total Amount','Bank Name','Account No','Account Holder Name','IFSC Code');

              if($arrData){ 
                //$heading = array( 'Order ID','Appontment Date','Appontment Time','Doctor Name','Patient Name','Mediator Doctor','Total Amount','Bank Name','Account No','Account Holder Name','IFSC Code');
                if(!empty($arrData)){
                  foreach($arrData as $key => $value){ 
                    ini_set('max_execution_time', 0);

                    if(!empty($value['id'])){
                      $arr_tmp[$key][]  = $value['id']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['appointment_date'])){
                      $arr_tmp[$key][]  = $value['appointment_date']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['appointment_time'])){
                      $arr_tmp[$key][]  = $value['appointment_time']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }


                    if(!empty($value['drFname'])){
                      $arr_tmp[$key][]  = $value['drFname'].' '.$value['drLname'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }
                    if(!empty($value['pFname'])){
                    $arr_tmp[$key][]  = $value['pFname'].' '.$value['pLname'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['mediator_doctor_id'])){
                    $doctorInfoUserID =  $this->doctorInformationModel->where('id',$value['mediator_doctor_id'])->value('user_id');
                    $firstName =  $this->userModel->where('id',$doctorInfoUserID)->value('first_name');
                    $lastName =  $this->userModel->where('id',$doctorInfoUserID)->value('last_name');

                    $arr_tmp[$key][]  =  $firstName.' '.$lastName; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['total_fees'])){
                    $arr_tmp[$key][]  = $value['total_fees'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['doctor_id'])){

                     $doctorInfoUserID =  $this->doctorInformationModel->where('id',$value['doctor_id'])->value('user_id');
                      $bankDetails =  $this->UserBankDetails->where('user_id',$doctorInfoUserID)->first();
                     if(!empty($bankDetails['bankName'])){
                        $arr_tmp[$key][] = $bankDetails['bankName'];
                         }else{
                          $arr_tmp[$key][] = 'NA';
                        }

                    if(!empty($bankDetails['accountNo'])){
                        $arr_tmp[$key][] = $bankDetails['accountNo'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }


                    if(!empty($bankDetails['accountHolderName'])){
                        $arr_tmp[$key][] = $bankDetails['accountHolderName'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($bankDetails['ifscCode'])){
                        $arr_tmp[$key][] = $bankDetails['ifscCode'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }
                    }

                  }
                }
              }


      // Excel Export

      $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );



       ob_end_clean();
        $jsondata  = Excel::download(new PostExport($arr_tmp,$heading,$headers), $filename.'-'.date('Ymd').'-'.uniqid().'.csv');
            return $jsondata;
        }else{
            $userMsg = 'Error occure while making export due to no data to create csv file';
            return redirect()->back();
        }

    }




      public function exportMidToDoctorCsv(Request $request)
    {  
        $filename       = "PayoutMediator".'-'.date('Ymd').'.xlsx';
        $json_arr       =  [];
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $SearchDoctor = $request->get('SearchDoctor');
        $SearchMonthYear = $request->get('SearchMonthYear');
        $drType = $request->get('drType');
        
         $month = $year = ''; 
        if(!empty($SearchMonthYear)){
            $exploadDate = explode("/",$SearchMonthYear);
            $month =  $exploadDate[0];
            $year =  $exploadDate[1];
        }

        $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id as id','booking.status','booking.dr_status','booking.mediator_doctor_id','booking.total_fees','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','po.payment_status','po.paypal_status','booking.doctor_id')->where('booking.dr_status', 'Close')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id')
                             ->join('payment_orders as po', 'booking.id', '=', 'po.bookingID') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id');
                            
        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(drFname LIKE '%".$keyword."%' OR drLname LIKE '%".$keyword."%' OR pFname LIKE '%".$keyword."%' OR pLname LIKE '%".$keyword."%' OR phone_number LIKE '%".$keyword."%' )");
        }

        if (!empty($month))
        {   
            $result = $result->whereMonth('booking.appointment_date', '=', $month);
        }

        if (!empty($year))
        {   
            $result =  $result->whereYear('booking.appointment_date', '=', $year);
        }


        $arrData = $result->orderBy('booking.id','DESC')->get()->toArray();

         $format   = "xlsx";
            if($format == "xlsx"){
              $arr_tmp = array();
               $heading = array( 'Order ID','Appontment Date','Appontment Time','Doctor Name','Patient Name','Mediator Doctor','Total Amount','Bank Name','Account No','Account Holder Name','IFSC Code');

              if($arrData){ 
                if(!empty($arrData)){
                  foreach($arrData as $key => $value){ 
                    ini_set('max_execution_time', 0);

                    if(!empty($value['id'])){
                      $arr_tmp[$key][]  = $value['id']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['appointment_date'])){
                      $arr_tmp[$key][]  = $value['appointment_date']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['appointment_time'])){
                      $arr_tmp[$key][]  = $value['appointment_time']; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }


                    if(!empty($value['drFname'])){
                      $arr_tmp[$key][]  = $value['drFname'].' '.$value['drLname'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }
                    if(!empty($value['pFname'])){
                    $arr_tmp[$key][]  = $value['pFname'].' '.$value['pLname'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['mediator_doctor_id'])){
                    $doctorInfoUserID =  $this->doctorInformationModel->where('id',$value['mediator_doctor_id'])->value('user_id');
                    $firstName =  $this->userModel->where('id',$doctorInfoUserID)->value('first_name');
                    $lastName =  $this->userModel->where('id',$doctorInfoUserID)->value('last_name');

                    $arr_tmp[$key][]  =  $firstName.' '.$lastName; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['total_fees'])){
                    $arr_tmp[$key][]  = $value['total_fees'] ; 
                    }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($value['mediator_doctor_id'])){

                    $doctorInfoUserID =  $this->doctorInformationModel->where('id',$value['mediator_doctor_id'])->value('user_id');
                      $bankDetails =  $this->UserBankDetails->where('user_id',$doctorInfoUserID)->first();
                     if(!empty($bankDetails['bankName'])){
                        $arr_tmp[$key][] = $bankDetails['bankName'];
                         }else{
                          $arr_tmp[$key][] = 'NA';
                        }

                    if(!empty($bankDetails['accountNo'])){
                        $arr_tmp[$key][] = $bankDetails['accountNo'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }


                    if(!empty($bankDetails['accountHolderName'])){
                        $arr_tmp[$key][] = $bankDetails['accountHolderName'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }

                    if(!empty($bankDetails['ifscCode'])){
                        $arr_tmp[$key][] = $bankDetails['ifscCode'];
                     }else{
                      $arr_tmp[$key][] = 'NA';
                    }
                    }

                  }
                }
              }


        // Excel Export

          $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

       ob_end_clean();
        $jsondata  = Excel::download(new PostExport($arr_tmp,$heading,$headers), $filename.'-'.date('Ymd').'-'.uniqid().'.csv');
            return $jsondata;
        }else{
            $userMsg = 'Error occure while making export due to no data to create csv file';
            return redirect()->back();
        }

    }

    
        public static function getCsv($columnNames, $rows, $fileName = 'file.csv') {
            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=" . $fileName,
                "Pragma" => "no-cache",
               "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
               "Expires" => "0"
            ];

             $callback = function() use ($columnNames, $rows ) {
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $columnNames);
                    foreach ($rows as $row) {
                        fputcsv($file, $row);
                    }
                    fclose($file);
                };

                return response()->stream($callback, 200, $headers);
        }

        public function exportToDoctorCsvBK() {

            $rows = [['a','b','c'],[1,2,3]];//replace this with your own array of arrays
            $columnNames = ['blah', 'yada', 'hmm'];//replace this with your own array of string column headers        
            return self::getCsv($columnNames, $rows);
        }
    
}

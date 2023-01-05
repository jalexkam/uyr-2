<?php
namespace App\Repositories\Payout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Patient;
use App\Models\DoctorSuggestModel;
use App\Models\TypesMaster;
use App\Models\DoctorInformationModel;
use App\Models\DoctorAddressModel;
use App\Models\Bookings;
use App\Models\Consultation;
use File;
use Response;


use App\Exports\PostExport;
use Maatwebsite\Excel\Facades\Excel;
//use Carbon\Carbon;
class PayoutRepositories
{

    public function __construct(UserModel $user, Patient $patient,DoctorSuggestModel $doctor_suggest,TypesMaster $typesMaster,DoctorInformationModel $doctorInformationModel,Bookings $bookings,DoctorAddressModel $doctorAddress,Consultation $consultation)
    {
        $this->userModel = $user;
        $this->per_page = per_page();
        $this->patient = $patient;
        $this->doctorSuggest = $doctor_suggest;
        $this->typesMaster = $typesMaster;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->bookings = $bookings;
        $this->doctorAddress = $doctorAddress;
        $this->consultation = $consultation;
    }

    public function doctorPayout($request)
    {  
     

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

        $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id as id','booking.status','booking.dr_status','booking.mediator_doctor_id','booking.total_fees','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','po.payment_status','po.paypal_status')->where('booking.dr_status', 'Close')
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
        

        $result = $result->orderBy('booking.id', 'DESC')
            ->paginate($this->per_page);

        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {  
                   /*dateTimeFormate()*/
                    $doctorInfoUserID =  $this->doctorInformationModel->where('id',$value['mediator_doctor_id'])->value('user_id');
                    $firstName =  $this->userModel->where('id',$doctorInfoUserID)->value('first_name');
                    $lastName =  $this->userModel->where('id',$doctorInfoUserID)->value('last_name');
                    $data['data'][$key]['mediator_doctor_Name'] = $firstName.' '.$lastName;
                    
                    $data['data'][$key]['id'] = $value['id'];
                    $data['data'][$key]['appointment_date'] = dateFormate($value['appointment_date']);
                    $data['data'][$key]['appointment_time'] = timeFormate($value['appointment_time']);
                    $data['data'][$key]['fees_amount']      = $value['fees_amount'];
                    $data['data'][$key]['doctortype']       = 'doctortype';

                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $data['data'][$key]['doctortype']       = $typesMaster['type_name'];                    
                    $data['data'][$key]['doctorName']       = $value['drFname'].' '.$value['drLname'];
                    $data['data'][$key]['doctor_id']        = $value['doctor_id'];
                    $data['data'][$key]['patientName']      = $value['pFname'].' '.$value['pLname'];
                }
            }
            return $data;
        }
    }


    public function exportToDoctorCsv1111()
        {
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=file.csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $reviews = [];//Reviews::getReviewExport($this->hw->healthwatchID)->get();
            $columns = array('ReviewID', 'Provider', 'Title', 'Review', 'Location', 'Created', 'Anonymous', 'Escalate', 'Rating', 'Name');

            $callback = function() use ($reviews, $columns)
            {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach($reviews as $review) {
                    fputcsv($file, array($review->reviewID, $review->provider, $review->title, $review->review, $review->location, $review->review_created, $review->anon, $review->escalate, $review->rating, $review->name));
                }
                fclose($file);
            };
            return Response::stream($callback, 200, $headers);
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

    public function exportToDoctorCsv() {

        $rows = [['a','b','c'],[1,2,3]];//replace this with your own array of arrays
        $columnNames = ['blah', 'yada', 'hmm'];//replace this with your own array of string column headers        
        return self::getCsv($columnNames, $rows);
    }

   
}
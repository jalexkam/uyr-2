<?php
namespace App\Repositories\Orders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorInformationModel;
use App\Models\DoctorAddressModel;
use App\Models\TypesMaster;
use App\Models\Bookings;
use App\Models\DoctorSuggestModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use File;
class OrdersRepositories
{
    public function __construct(UserModel $user, DoctorInformationModel $doctorInformationModel, DoctorAddressModel $doctorAddress,TypesMaster $typesMaster,Bookings $bookings,DoctorSuggestModel $doctorSuggest)
    {
        $this->userModel = $user;
        $this->per_page = per_page();
        $this->doctorInformationModel = $doctorInformationModel;
        $this->doctorAddress = $doctorAddress;
        $this->typesMaster   = $typesMaster;
        $this->bookings      = $bookings;
        $this->doctorSuggest = $doctorSuggest;

    }

    public function OrdersBooking($request)
    {  
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $drType = $request->get('drType');
        $tabID = $request->get('tabID');
        $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','booking.dr_status','booking.mediator_doctor_id','doctor_information.user_id','p.email as pemail','p.phone_number as patientPhone','patient.date_of_birth as patient_date_of_birth','patient.blood_group as patient_blood_group','booking.patient_id','booking.doctor_suggest_id','dr.email as doctorEmail','dr.phone_number as doctorPhone','po.payment_status','po.paypal_status','dr.id as doctorID')
            
             ->join('payment_orders as po', 'booking.id', '=', 'po.bookingID')         
             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
             ->Join('patient','booking.patient_id','=','patient.id')
             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
             ->join('users as p', 'patient.user_id', '=', 'p.id');

             // if(!empty($tabID)){
             //  $mdr = $this->doctorInformationModel->where('user_id', $authUser->id)->first();
             //  $result =  $result->where('booking.mediator_doctor_id', $mdr->id); 
             // }

              if(!empty($tabID) && $tabID == 1){
              $mdr = $this->doctorInformationModel->where('user_id', $authUser->id)->first();
              $result =  $result->where('booking.mediator_doctor_id', $mdr->id); 
              $result =  $result->where('booking.dr_status','My Open Order'); 
             }

              if(!empty($tabID) && ($tabID == 2 || $tabID == 3)){
              $mdr = $this->doctorInformationModel->where('user_id', $authUser->id)->first();
              $result =  $result->where('booking.mediator_doctor_id', $mdr->id); 
              $result =  $result->where('booking.dr_status','Approved mediator'); 
             }

              if(!empty($tabID) && $tabID == 4){
              $mdr = $this->doctorInformationModel->where('user_id', $authUser->id)->first();
              $result =  $result->where('booking.mediator_doctor_id', $mdr->id); 
              $result =  $result->where('booking.dr_status','Close'); 
             }

            if($tabID == 0){
             $result =  $result->where('booking.dr_status','All'); 
            }

                     // /->groupBy('booking.id');
             //->where('doctor_information.user_id', $authUser->id);
                     //->where('booking.dr_status', 'Accept');



        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(drFname LIKE '%".$keyword."%' OR drLname LIKE '%".$keyword."%' OR pFname LIKE '%".$keyword."%' OR pLname LIKE '%".$keyword."%' OR phone_number LIKE '%".$keyword."%' )");
        }

        $result = $result->orderBy('booking.id', 'ASC')
            ->paginate($this->per_page);

        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {  
                   /*  
                    dateTimeFormate()*/

                    $data['data'][$key]['id'] = $value['id'];
                    $data['data'][$key]['appointment_date'] = dateFormate($value['appointment_date']);
                    $data['data'][$key]['appointment_time'] = timeFormate($value['appointment_time']);
                    $data['data'][$key]['fees_amount']      = $value['fees_amount'];
                    //$data['data'][$key]['doctortype']       = 'doctortype';
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $data['data'][$key]['doctortype']  = $typesMaster['type_name'];
                    
                    $data['data'][$key]['doctorName']      = $value['drFname'].' '.$value['drLname'];
                    $data['data'][$key]['doctorEmail'] = $value['doctorEmail'];
                     $data['data'][$key]['doctorPhone'] = $value['doctorPhone'];


                    $data['data'][$key]['doctor_id']       = $value['doctor_id'];
                    $data['data'][$key]['patientName']     = $value['pFname'].' '.$value['pLname'];
                    $data['data'][$key]['patientEmail']    = $value['pemail'];
                    $data['data'][$key]['patientPhone']    = $value['patientPhone'];
                    $data['data'][$key]['patient_date_of_birth'] = $value['patient_date_of_birth'];
                    $data['data'][$key]['patient_blood_group'] = $value['patient_blood_group'];
                    $data['data'][$key]['dr_status'] = $value['dr_status'];
                  
                    
                    $suggestData  = $this->doctorSuggest->select('*')
                                        ->where('id',$value['doctor_suggest_id'])->first();
                    if(!empty($suggestData) && $suggestData['visit_type'])  
                    $data['data'][$key]['visit_type'] = 'Clinic Visit';
                    else
                     $data['data'][$key]['visit_type'] = 'Home Visit'; 
                    //$data['data'][$key]['visit_type'] = $value['visit_type'];


                }
            }
            return $data;
        }
    }



 public function updateStatus($id, $request)
    {   
        $data = [];
        $authUser = Auth::user();
        $formData = $request->all();
        $action = isset($formData['action']) ? $formData['action'] : '';
        $doctoRresult = $this->doctorInformationModel->where('user_id', $authUser->id)->first();
         $mediator_doctor_id = isset($doctoRresult['id']) ? $doctoRresult['id'] : '';
        if ($doctoRresult)
        { 
           if($action == 'Approved'){
            $action = 'Approved mediator';
             $updateArr = array(
                'mediator_doctor_id' => $mediator_doctor_id,
                'dr_status' => $action,

             );
           }

           elseif($action == 'Cancel'){
              $updateArr = array(
                'mediator_doctor_id' => 0,
                'dr_status' => 'All',
             );
           }

           else{
            $mediator_doctor_id = isset($doctoRresult['id']) ? $doctoRresult['id'] : '';
            $updateArr = array(
                'mediator_doctor_id' => $mediator_doctor_id,
                'dr_status' => $action,

             );
           }
            
            $this->bookings->where('id', $id)->update($updateArr);

            $data['status'] = 'success';
            $data['message'] = 'Order Selected successfully';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Status';
        }
        return $data;
    }


    public function getPatientCondtion($id, $request)
    {   
        $data = [];
        $authUser = Auth::user();
        $formData = $request->all();

          $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','doctor_information.id as doctor_id','booking.dr_status','booking.mediator_doctor_id','doctor_information.user_id','booking.patient_id','booking.doctor_suggest_id','dr.email as doctorEmail','dr.phone_number as doctorPhone','doctor_suggest.reason as patient_condtion')
                     ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                     ->Join('doctor_suggest','booking.doctor_suggest_id','=','doctor_suggest.id')
                     ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                     ->where('booking.id',$id)->first();
        

           $typesMaster = $this->typesMaster->where('id',$result['type'])->first();
           $result['doctortype']  = $typesMaster['type_name'];


        return $result;
    }



     public function getConsultation($id, $request)
    {   
        $data = [];
        $authUser = Auth::user();
        $formData = $request->all();

          $result  = $this->bookings->select('consultation.*')
             ->Join('consultation','booking.id','=','consultation.bookingID')
             ->where('booking.id',$id)->first();
          
        if(!empty($result['medicalHistory'])){
          $result['medicalHistory'] =   explode(",",$result['medicalHistory']);
        }
        if(!empty($result['medication'])){
          $result['medication'] =   explode(",",$result['medication']);
        }

        return $result;
    }







   

}


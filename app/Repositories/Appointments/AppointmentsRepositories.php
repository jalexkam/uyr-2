<?php
namespace App\Repositories\Appointments;
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
//use Carbon\Carbon;
class AppointmentsRepositories
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

    public function requestAppointments($request)
    {  
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $drType = $request->get('drType');
        
        $result = $this->userModel ->select('*','doctor_suggest.id as id')
            ->Join('patient','users.id','=','patient.user_id')
            ->Join('doctor_suggest','patient.id','=','doctor_suggest.patient_id')
            ->where('doctor_suggest.appointments_status','Initiate');
        
        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(users.first_name LIKE '%".$keyword."%' OR users.last_name LIKE '%".$keyword."%' OR users.user_name LIKE '%".$keyword."%' OR users.email LIKE '%".$keyword."%' OR users.phone_number LIKE '%".$keyword."%' )");
        }

        if (!empty($drType))
        {   
            $result =  $result->where('doctor_suggest.type_specialist',$drType);
        }

        $result = $result->orderBy('users.id', 'DESC')
            ->paginate($this->per_page);

        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {   

                    $data['data'][$key]['date_of_suggest']  = $value['date_of_suggest'];
                    $data['data'][$key]['to_time']  = $value['to_time'];
                    $data['data'][$key]['from_time']  = $value['from_time'];
                    $data['data'][$key]['email']  = $value['email'];
                    $data['data'][$key]['phone_number']  = $value['phone_number'];
                    $data['data'][$key]['patient_name']  = $value['first_name'].' '.$value['last_name'];
                    $typesMaster = $this->typesMaster->where('id',$value['type_specialist'])->first();
                    $data['data'][$key]['type_specialist']  = $typesMaster->type_name;
                    $data['data'][$key]['gender']  = isset($value['gender']) ? 'Male' : 'Female';
                    $data['data'][$key]['full_address']  = isset($value['full_address']) ? $value['full_address'] : $value['address'];
                    $data['data'][$key]['visit_type']     = isset($typesMaster->visit_type) ? 'Clinic Visit' : 'Home Visit' ;
                    $data['data'][$key]['medical_recommendation']     = isset($value['medical_recommendation']) ? 'Yes' : 'No' ;
                     $medical_history =  explode(",",$value['medical_history']);
                    $data['data'][$key]['medical_history']     = isset($medical_history) ? $medical_history : '' ;
                     
                }
            }
            return $data;
        }
    }

    public function destroy($id, $request)
    {   
        $data =array();
        if(!empty($id)){
            $this->doctorSuggest->where('id', $id)->delete();
             $data['status'] = 'success';
            $data['message'] = 'Request Appointments successfully Deleted';
        }else{
            $data['status'] = 'error';
            $data['message'] = 'error occured while deleting Request Appointments';
        }
        return $data;
    }

    public function searchDoctor($request)
    {  
        $statusArray = array("Pending", "Rejected", "Approved");
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $drType = $request->get('drType');
        $doctor_suggest_id = $request->get('doctor_suggest_id');

         $doctorSuggestData = $this->doctorSuggest ->select('*','doctor_suggest.id as id','doctor_suggest.medical_history','doctor_suggest.description')
                        ->where('doctor_suggest.id', $doctor_suggest_id)->first();
        
        $result = $this->userModel ->select('users.id as id','users.status as status'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','users.email','users.phone_number','doctor_information.medical_license_number','doctor_information.experience','doctor_information.fees_amount','doctor_information.current_clinic_hospital','doctor_information.availability_time_from','doctor_information.willing_to_serve_as','doctor_information.equipment','doctor_information.brief_summary','doctor_information.terms_and_conditions','doctor_information.registration_no','doctor_information.id as doctor_id')

            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',4)
            ->where('doctor_information.type',$doctorSuggestData->type_specialist);

        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(users.first_name LIKE '%".$keyword."%' OR users.last_name LIKE '%".$keyword."%' OR users.user_name LIKE '%".$keyword."%' OR users.email LIKE '%".$keyword."%' OR users.phone_number LIKE '%".$keyword."%' )");
        }

        $result = $result->orderBy('users.id', 'DESC')
            ->paginate($this->per_page);

        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {  
                    $data['data'][$key]['date_of_registration'] = date("Y-m-d", strtotime($value['date_of_registration']));
                    $data['data'][$key]['status'] =$statusArray[$value['status']];
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $type_specialist = isset($typesMaster->type_name) ? $typesMaster->type_name : '';
                    $data['data'][$key]['type_specialist']    = $type_specialist;
                    $data['data'][$key]['medical_license_number']    = $value['medical_license_number'];
                    $data['data'][$key]['medical_license_number']    = $value['medical_license_number'];
                    $data['data'][$key]['suggest_id']    = $doctor_suggest_id;
                    
                }
            }
            return $data;
        }
    }

    public function sent_suggestToPatient($request)
    {       
       
        $data = array();
        $authUser = Auth::user();
        $mediator_doctor_id = $authUser->id;
        $doctor_id = isset($request->doctor_id) ? $request->doctor_id : '';
        $type = isset($request->type) ? $request->type : 'one';
        $suggest_id = isset($request->suggest_id) ? $request->suggest_id : '';
        $doctor_ids = isset($request->doctor_ids) ? $request->doctor_ids : '';
        $doctorSuggestData      = $this->doctorSuggest->where('id', $suggest_id)->first();

        if($type =="all") {
          $doctor_idsArr =  explode(",",$doctor_ids);
          if(!empty($doctor_idsArr)){
            foreach ($doctor_idsArr as $rowid) {
                $doctorInformationData  = $this->doctorInformationModel->where('id', $rowid)->first();
                 $insertBookingsArr = array(
                    'patient_id' => $doctorSuggestData->patient_id,
                    'doctor_id' => $rowid,
                    'mediator_doctor_id' => $mediator_doctor_id,
                    'appointment_date' => $doctorSuggestData->date_of_suggest,
                    'appointment_time' => $doctorSuggestData->to_time,
                    'total_fees' => $doctorInformationData->fees_amount,
                );
                $bookingsData  = $this->bookings->create($insertBookingsArr);

            }
              
          }
            if(!empty($bookingsData)){
                $this->doctorSuggest->where('id', $suggest_id)->update(['appointments_status' => 'Pending']);
                $data['status'] = 'success';
                $data['message'] = 'Suggest To Patient Successfully sent';  
            }else{
                $data['status'] = 'error';
                $data['message'] = 'error occured while sent Suggest To Patient';
            }

           return $data;
        }else{
            
             $doctorInformationData  = $this->doctorInformationModel->where('id', $doctor_id)->first();
             $insertBookingsArr = array(
                'patient_id' => $doctorSuggestData->patient_id,
                'doctor_id' => $doctor_id,
                'mediator_doctor_id' => $mediator_doctor_id,
                'appointment_date' => $doctorSuggestData->date_of_suggest,
                'appointment_time' => $doctorSuggestData->to_time,
                'total_fees' => $doctorInformationData->fees_amount,
            );
            $bookingsData  = $this->bookings->create($insertBookingsArr);
            if(!empty($bookingsData)){
                $this->doctorSuggest->where('id', $suggest_id)->update(['appointments_status' => 'Pending']);
                $data['status'] = 'success';
                $data['message'] = 'Suggest To Patient Successfully sent';  
            }else{
                    $data['status'] = 'error';
                    $data['message'] = 'error occured while sent Suggest To Patient';
            }
            return $data;
        }
        
    }

    public function create_appointment($request)
    {       
       
        $data = array();
        $authUser = Auth::user();
        $doctor_id          = isset($request->doctor_id) ? $request->doctor_id : '';
        $doctor_suggest_id         = isset($request->doctor_suggest_id) ? $request->doctor_suggest_id : '';
        $appointment_date   = isset($request->appointment_date) ? $request->appointment_date : '';
        $appointment_time   = isset($request->appointment_time) ? $request->appointment_time : '';
        $doctorSuggestData      = $this->doctorSuggest->where('id', $doctor_suggest_id)->first();
        $patient_id      = isset($doctorSuggestData->patient_id) ? $doctorSuggestData->patient_id : '';

       // $appointment_date_replace = str_replace('/', '-', $appointment_date); 
        //dd($appointment_date,$appointment_date_replace);

        if( strpos($appointment_date, ',') !== false ) {
            $appointment_dateNew = date("Y-m-d", strtotime($appointment_date));
        }else{
            $appointment_dateNew = convertDate($appointment_date);
        }
       

        //$appointment_dateNew = date("Y-m-d", strtotime($appointment_date_replace));
           $doctorInformationData  = $this->doctorInformationModel->where('id', $doctor_id)->first();
         $insertBookingsArr = array(
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'mediator_doctor_id' => 0,
            'appointment_date' => $appointment_dateNew,
            'appointment_time' => date("H:i:s", strtotime($appointment_time)),
            'total_fees' => $doctorInformationData->fees_amount,
            'doctor_suggest_id'=>$doctor_suggest_id,
        );
         
            $bookingsData  = $this->bookings->create($insertBookingsArr);

            $patientUsername  = $this->patient->select('p.user_name','patient.id','p.id as pId')
                               ->join('users as p', 'patient.user_id', '=', 'p.id')
                               ->where('patient.id', $patient_id)->first();

            if(!empty($bookingsData)){

                $data['appointment_id'] = $bookingsData->id;
                $data['pId'] = $patientUsername->pId;
                $data['status'] = 'success';
                $data['message'] = 'Your Appointments successfully creted!';  
            }else{
                    $data['status'] = 'error';
                    $data['message'] = 'error occured while sent Suggest To Patient';
            }
            return $data;
    }


    public function patientAppointment($request)
    {  
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $drType = $request->get('drType');

          $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id as id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','po.payment_status','po.paypal_status')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id')
                              ->join('payment_orders as po', 'booking.id', '=', 'po.bookingID') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id');
                            
                             if($authUser->role_type == 3 || $authUser->role_type == 4 || $authUser->role_type == 5 || $authUser->role_type == 6 )
                             {
                                $result = $result->where('p.user_name', $authUser->user_name);
                             }
                             
                            // $result = $result->where('booking.status', 'Accept');
        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(drFname LIKE '%".$keyword."%' OR drLname LIKE '%".$keyword."%' OR pFname LIKE '%".$keyword."%' OR pLname LIKE '%".$keyword."%' OR phone_number LIKE '%".$keyword."%' )");
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
                   /*  
                    dateTimeFormate()*/

                    $data['data'][$key]['id'] = $value['id'];
                    $data['data'][$key]['appointment_date'] = dateFormate($value['appointment_date']);
                    $data['data'][$key]['appointment_time'] = timeFormate($value['appointment_time']);
                    $data['data'][$key]['fees_amount']      = $value['fees_amount'];
                    $data['data'][$key]['doctortype']       = 'doctortype';
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $data['data'][$key]['doctortype']  = $typesMaster['type_name'];
                    
                    $data['data'][$key]['doctorName']       = $value['drFname'].' '.$value['drLname'];
                    $data['data'][$key]['doctor_id']        = $value['doctor_id'];
                    $data['data'][$key]['patientName']       = $value['pFname'].' '.$value['pLname'];


                }
            }
            return $data;
        }
    }

    public function doctorAppointment($request)
    {  
        $statusArray = array("Pending", "Rejected", "Approved");
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $drType = $request->get('drType');
       
      
          $result  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','booking.patient_id','doctor_information.id as doctor_information_id','patient.full_address','po.payment_status','po.paypal_status','booking.dr_status')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id')
                             ->join('payment_orders as po', 'booking.id', '=', 'po.bookingID')
                             ->where('doctor_information.user_id', $authUser->id);
                             //->where('booking.dr_status', 'Approved mediator');

        

        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(dr.drFname LIKE '%".$keyword."%' OR dr.drLname LIKE '%".$keyword."%' OR p.pFname LIKE '%".$keyword."%' OR p.pLname LIKE '%".$keyword."%' OR dr.phone_number LIKE '%".$keyword."%' )");
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
                    $data['data'][$key]['id'] = $value['id'];
                    $data['data'][$key]['appointment_date'] = $value['appointment_date'];
                    $data['data'][$key]['appointment_Date'] = dateFormate($value['appointment_date']);
                    $data['data'][$key]['appointment_Time'] = timeFormate($value['appointment_time']);
                    $data['data'][$key]['appointment_time'] = $value['appointment_time'];
                    $data['data'][$key]['fees_amount']      = $value['fees_amount'];
                    $data['data'][$key]['doctortype']       = 'doctortype';
                    $data['data'][$key]['doctorName']       = $value['drFname'].' '.$value['drLname'];
                    $data['data'][$key]['doctor_id']        = $value['doctor_id'];
                    $data['data'][$key]['patientName']       = $value['pFname'].' '.$value['pLname'];
                    $data['data'][$key]['patient_id']        = $value['patient_id'];
                    $data['data'][$key]['dr_status']        = $value['dr_status'];

                    $patient_cordinates =  $this->patient->where('id',$value['patient_id'])->select('longitude','latitude')->first();
                    $doctor_id_cordinates =  $this->doctorAddress->where('doctor_information_id',$value['doctor_information_id'])->select('longitude','latitude')->first();
                    
                    $patient_cordinates_con = $patient_cordinates->latitude  . ',' . $patient_cordinates->longitude;
                    $doctor_cordinates_con = $doctor_id_cordinates->latitude . ',' . $doctor_id_cordinates->longitude;

$data['data'][$key]['direction_location']    = 'https://www.google.com/maps/dir/?api=1&origin='.$doctor_cordinates_con.'&destination='. $patient_cordinates_con;

                //    $drAddress =  $this->doctorAddress->where('doctor_information_id',$value['doctor_information_id'])->value('address');
                    //  $data['data'][$key]['direction_location']    = 'https://www.google.co.in/maps/dir/'. $drAddress. ' / '.$value['full_address'];

                    // https://www.google.com/maps/dir/?api=1&origin=34.1030032,-118.41046840000001&destination=34.059808,-118.368152

                }
            }
            return $data;
        }
    }

    public function changeAppointmentStatus($request)
    { 
        $authUser = Auth::user();
        $id = (int)$request->get('id');
        $action = $request->get('action');
        $appointment_date = $request->get('appointment_date');
        $appointment_time = $request->get('appointment_time');
        $patient_id = $request->get('patient_id');

        if($action == 'Accept'){
        $bookingsData  = $this->bookings->select('*')->where('patient_id',$patient_id)
                                        ->where('appointment_date',$appointment_date)
                                        ->where('appointment_time',$appointment_time)
                                        ->where('status','!=','Reject')
                                        ->where('id',$id)
                                        ->get();

            //dd($patient_id,$appointment_date,$appointment_time);
            foreach ($bookingsData as $key => $value)
            {
              if($id == $value['id']) 
              {
                 $this->bookings->where('id', $value['id'])->update(['status' => 'Accept']);
               
              }else{
                 $this->bookings->where('id', $value['id'])->update(['status' => 'Reject']);
              } 
            }
            $data['status'] = 'success';
            $data['message'] = 'Accept Appointments To Patient Successfully'; 

        }
        if($action == 'Reject'){
           // $bookingsData  = $this->bookings->select('*')->where('patient_id',$patient_id) ->where('id',$id)->first();
            $this->bookings->where('id', $id)->update(['status' => 'Reject']);
            $data['status'] = 'success';
            $data['message'] = 'Accept Appointments Patient Successfully sent';
        }
        return $data;
    }   

    

    public function getBookingData($appointment_id,$request)
    {
        $data = $jsonArr = [];
        $patientData =$appointmentData = array();

        if (isset($appointment_id) && $appointment_id != '')
        {   
              $bookingsData  = $this->bookings->where('id',$appointment_id)->first();
            
              $bookingsDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id as id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','patient.id as patientID','booking.doctor_suggest_id')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id')
                             ->where('booking.id', $bookingsData->id)
                             //->where('booking.status', 'Accept')
                             ->first();

            //dd($bookingsDetails);
             /* $bookingsDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','users.first_name','users.last_name','doctor_information.id as doctor_id')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('users','doctor_information.user_id','=','users.id')
                             ->where('booking.patient_id', $bookingsData->patient_id)
                             ->where('booking.status','!=', 'Reject')
                             ->first();*/

                $typesMaster = $this->typesMaster->where('id',$bookingsDetails['type'])->first();
                $appointmentData['doctortype']  = $typesMaster['type_name'];
                $appointmentData['patientName']      = $bookingsDetails['pFname'].' '.$bookingsDetails['pLname'];
                $appointmentData['appointment_date'] = dateFormate($bookingsData['appointment_date']);
                $appointmentData['appointment_time'] = timeFormate($bookingsData['appointment_time']);
                $appointmentData['fees_amount']      = $bookingsData['total_fees'];
                $appointmentData['doctorName']       = $bookingsDetails['drFname'].' '.$bookingsDetails['drLname'];
               /**/ /*$appointmentData['doctor_id']        = $bookingsDetails['doctor_id'];
                $appointmentData['status']           = $bookingsDetails['status'];*/
                $appointmentData['id']                      = $bookingsDetails['id'];
                $appointmentData['doctor_informationID']    = $bookingsDetails['doctor_id'];
                $appointmentData['patientID']               = $bookingsDetails['patientID'];
                $appointmentData['doctor_suggest_id']      = $bookingsDetails['doctor_suggest_id'];
                
                
              
             //$jsonArr['bookingsData'] = $bookingsData;
             $jsonArr['appointmentData'] = $appointmentData;
             $jsonArr['status'] = 'success';

        }
        return $jsonArr;
    }

    public function order_payment($request)
    {
            $data = [];
            $formData = $request->all();
            
            $receiver['email'] ='';
            $description = 'testing Payment';
            $receiverData = '';

            $uri = env('PAYPAL_URL').'/v1/oauth2/token';//sandbox
            $clientId = env('PAYPAL_CLIENT_ID');//sandbox
            $secret = env('PAYPAL_SECRETE');//sandbox

            exit;
        
           // $data = $this->makePayPalPayment($receiver,$description,$receiverData);

           
           
            return $data;
       
    }

    public function getMedicalHistory($request)
    {
           
            $data = [];
           $data['medicalhistory'] =medicalhistory();
        return $data;
    }

     public function submitConsultationForm($request)
    {   
        $formData = $request->all();

        $medicalHistory = isset($formData['medicalHistory']) ? $formData['medicalHistory'] :'';
        $noneof = isset($formData['noneof']) ? $formData['noneof'] : '';
        $describeSituation = isset($formData['describeSituation']) ? $formData['describeSituation'] : '';
        $describeAnswers = isset($formData['describeAnswers']) ? $formData['describeAnswers'] : '';
        $pastHistory = isset($formData['pastHistory']) ? $formData['pastHistory'] : '';
        $occupation = isset($formData['occupation']) ? $formData['occupation'] : '';
        $maritalStatus = isset($formData['maritalStatus']) ? $formData['maritalStatus'] : '';
        $alcohol = isset($formData['alcohol']) ? $formData['alcohol'] : '';
        $athleticActivities = isset($formData['athleticActivities']) ? $formData['athleticActivities'] : '';
        $tobacco = isset($formData['tobacco']) ? $formData['tobacco'] : '';
        $additionalInformation = isset($formData['additionalInformation']) ? $formData['additionalInformation'] : '';
         $appointmentID = isset($formData['appointmentID']) ? $formData['appointmentID'] : '';
         $medicalHistory =  implode(",",$medicalHistory);

        // $medicalHistory =  implode(",",$medicalHistory);

         if(!empty($formData['medication'])){

            foreach ($formData['medication'] as $key => $value) {
                // code...
                $medication[] = $value['medication'];
            }

            $medication =  implode(",",$medication);

         }
          
        

        $insertArr = array(
            'medicalHistory' => $medicalHistory,
            'noneof' => $noneof,
            'describeSituation' => $describeSituation,
            'describeAnswers' => $describeAnswers,
            'pastHistory' => $pastHistory,
            'occupation' => $occupation,
            'maritalStatus' => $maritalStatus,
            'alcohol' => $alcohol,
            'athleticActivities' => $athleticActivities,
            'tobacco' => $tobacco,
            'additionalInformation' => $additionalInformation,
            'bookingID'=>$appointmentID,
            'medication'=>isset($medication) ? $medication : ''
        );

        $this->consultation->create($insertArr);
        $this->bookings->where('id', $appointmentID)->update(['status' => 'Completed']);
         $jsonArr['appointmentData'] = "Successfully";
         $jsonArr['status'] = 'success';
         return $jsonArr;
    }


      public function submitConsultationComment($request)
    {   
        $formData = $request->all();
        if(!empty($formData['type']) && $formData['type'] == 'comment'){
         
            $this->bookings->where('id', $formData['bookingID'])->update(['dr_status' => 'Close']);
            $this->consultation->where('bookingID', $formData['bookingID'])->update(['comment' => $formData['comment']]);
             $jsonArr['appointmentData'] = "Successfully";
             $jsonArr['status'] = 'success';
             return $jsonArr;

        }

    }
   
}
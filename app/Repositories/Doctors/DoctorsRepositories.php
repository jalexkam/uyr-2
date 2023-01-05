<?php
namespace App\Repositories\Doctors;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorInformationModel;
use App\Models\DoctorAddressModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use File;
//use Carbon\Carbon;
use App\Models\Bookings;
use App\Models\DoctorSuggestModel;
use App\Models\PatientReportsModel;
use App\Models\Patient;
use App\Models\TypesMaster;
use App\Models\PatientPrescription;
use App\Models\PatientPrescriptionDetails;
use App\Models\EquipmentsMaster;
use App\Models\DoctorBookingTimeslot;
use Config;
use Mail;
use DateTime;
class DoctorsRepositories
{

    public function __construct(UserModel $user, DoctorInformationModel $doctorInformationModel, DoctorAddressModel $doctorAddress,Bookings $bookings,DoctorSuggestModel $doctor_suggest,PatientReportsModel $patientReports, Patient $patient,TypesMaster $typesMaster,PatientPrescription $patientPrescription,PatientPrescriptionDetails $patientPrescriptionDetails,EquipmentsMaster $equipments_master,DoctorBookingTimeslot $doctorBookingTimeslot)
    {
        $this->userModel = $user;
        $this->per_page = 9;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->doctorAddress = $doctorAddress;
        $this->bookings = $bookings;
        $this->doctorSuggest = $doctor_suggest;
        $this->patientReports = $patientReports;
        $this->patient = $patient;
        $this->typesMaster = $typesMaster;
        $this->patientPrescription =$patientPrescription;
        $this->patientPrescriptionDetails = $patientPrescriptionDetails ;
        $this->EquipmentsMasterModel      = $equipments_master;
        $this->doctorBookingTimeslot      = $doctorBookingTimeslot;
        

    }

    public function index($request)
    {   
        $statusArray = array("Pending", "Rejected", "Approved");
        $authUser = Auth::user();
        $keyword = $request->get('keyword');

         $result = $this->userModel ->select('users.id as id','users.status as userStatus'
            ,'users.profile_photo','users.first_name','users.email','users.phone_number','users.last_name','doctor_information.type','doctor_information.date_of_registration','users.age','users.gender','doctor_address.address','doctor_information.id as doctor_id','doctor_information.status')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',4);

        if($authUser->role_type == 3)
        {
            $result = $result->where('users.parent_id',$authUser->id);
        } 

        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(users.first_name LIKE '%".$keyword."%' OR users.last_name LIKE '%".$keyword."%' OR users.user_name LIKE '%".$keyword."%' OR users.email LIKE '%".$keyword."%' OR users.phone_number LIKE '%".$keyword."%' )");
        }

        $result = $result->orderBy('doctor_information.id', 'DESC')
            ->paginate($this->per_page);
        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {   
                     $data['data'][$key]['date_of_registration'] = dateFormate($value['date_of_registration']);
                    //  $data['data'][$key]['status'] =$statusArray[$value['doctor_status']];
                }
            }
            return $data;
        }
    }

    public function getPatientAppointment($appointment_id)
    {
        if (isset($appointment_id) && $appointment_id != '')
        {   
            $medicalReportsData = $patientPrescriptionData = array();
            $bookingsData  = $this->bookings->select('*')->where('id',$appointment_id)->first();

             $patientDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','users.first_name','users.last_name','users.email','users.phone_number','patient.address','patient.id as patient_id')
                             //->Join('doctor_suggest','booking.patient_id','=','doctor_suggest.patient_id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->Join('users','patient.user_id','=','users.id')
                             ->where('booking.patient_id', $bookingsData->patient_id)
                              ->where('booking.status','!=', 'Reject')
                             ->first();

            $patientData['appointment_date'] = dateFormate($patientDetails['appointment_date']);
            $patientData['appointment_time'] = timeFormate($patientDetails['appointment_time']);
            $patientData['email']            = $patientDetails['email'];
            $patientData['phone_number']     = $patientDetails['phone_number'];
            $patientData['address']          = $patientDetails['address'];
            $patientData['patientName']      = $patientDetails['first_name'].' '.$patientDetails['last_name'];
            $patientData['patient_id']          = $patientDetails['patient_id'];
            $patientData['doctor_id']          = $bookingsData->doctor_id;
          
            $medicalDetails  = $this->doctorSuggest->where('patient_id',$bookingsData->patient_id)
                                                    ->where('date_of_suggest',$bookingsData->appointment_date)
                                                    ->where('to_time',$bookingsData->appointment_time)
                                                    ->first();

         
                   if(!empty($medicalDetails->medical_history)){
                     $medical_history =  explode(",",$medicalDetails->medical_history);
                     $medicalData['medical_history'] = isset($medical_history) ? $medical_history : '' ;
                   }else{
                     $medicalData['medical_history'] = [];
                   }
                    $medicalData['description']     = isset($medicalDetails['description']) ? $medicalDetails['description']: '' ;
           

                      $bookingDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','booking.status')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id')
                             ->where('patient.id', $bookingsData->patient_id)
                             ->where('doctor_information.id', $bookingsData->doctor_id)
                             //->where('booking.status', 'Accept')
                             ->get();


                foreach ($bookingDetails  as $key => $value) {
                    $appointmentData[$key]['id'] = $value['id'];
                    $appointmentData[$key]['appointment_date'] = dateFormate($value['appointment_date']);
                    $appointmentData[$key]['appointment_time'] = timeFormate($value['appointment_time']);
                    $appointmentData[$key]['fees_amount']      = $value['fees_amount'];
                    $appointmentData[$key]['doctorName']       = $value['drFname'].' '.$value['drLname'];
                    $appointmentData[$key]['doctor_id']        = $value['doctor_id'];
                    $appointmentData[$key]['status']        = $value['status'];
                }

                 $medicalReportsDetails  = $this->patientReports
                            ->select('dr.first_name as drFname','dr.last_name as drLname','doctor_information.id as doctor_id','patient_reports.created_at','patient_reports.description','patient_reports.attach_report','patient_reports.id as report_id')
                             ->Join('doctor_information','patient_reports.doctor_id','=','doctor_information.id')
                            ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->where('patient_reports.patient_id', $bookingsData->patient_id)
                           ->where('patient_reports.doctor_id', $bookingsData->doctor_id)
                             ->get();

                  foreach ($medicalReportsDetails  as $key => $value) {
                    $medicalReportsData[$key]['report_id']          = $value['report_id'];
                    $medicalReportsData[$key]['date']               = dateFormate($value['created_at']);
                    $medicalReportsData[$key]['description']        = $value['description'];
                    $medicalReportsData[$key]['doctorName']         = $value['drFname'].' '.$value['drLname'];
                    $medicalReportsData[$key]['attach_report']      = $value['attach_report'];
                    $patientRecord =  $this->patient->where('id',$bookingsData->patient_id)->first();
                    $medicalReportsData[$key]['user_id']         = $patientRecord->user_id;
                }

                //

                $patientPrescriptions  = $this->patientPrescription->where('appointment_id',$appointment_id)->get();
                  foreach ($patientPrescriptions  as $key => $value) {
                    $patientPrescriptions[$key]['date']        = dateFormate($value['created_at']);
                    }


                
                // dd($medicalReportsDetails,$bookingsData->doctor_id );

            $jsonArr['medicalReportsData'] = $medicalReportsData;
            $jsonArr['patientPrescriptions'] = $patientPrescriptions;
            $jsonArr['patientData'] = $patientData;
            $jsonArr['medicalData'] = $medicalData;
            $jsonArr['appointmentData'] = $appointmentData;
            return $jsonArr;
        }
    }

     public function getPatientDoctorinfoAppointment($appointment_id)
    {   
        $appointmentData = array();
        $authUser = Auth::user();
        if (isset($appointment_id) && $appointment_id != '')
        {   
            
             $bookingdata   = $this->bookings->select('booking.id','dr.user_id as user_id','booking.doctor_id')
                                    ->where('booking.id', $appointment_id)
                                    ->join('doctor_information as dr', 'booking.doctor_id', '=', 'dr.id') 
                                    ->first();
             

            $appointmentResult  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','p.profile_photo as patient_photo','dr.profile_photo as doctor_photo','dr.id as dr_user_id','p.id as p_user_id','patient.address as patientAddress')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id')
                             ->where('booking.id', $bookingdata['id'])
                             ->where('dr.id', $bookingdata['user_id'])
                             ->orderBy('booking.id', 'DESC')->first();

                

                if(!empty($appointmentResult)){
                   // $appointmentData['id'] = $appointmentResult['appointment_date'];
                    $appointmentData['appointment_date'] = dateFormate($appointmentResult['appointment_date']);
                    $appointmentData['appointment_time'] = timeFormate($appointmentResult['appointment_time']);
                    $appointmentData['fees_amount']      = $appointmentResult['fees_amount'];

                    $doctorAddress = $this->doctorAddress->where('id',$appointmentResult['doctor_id'])->first();
                    $appointmentData['doctorAddress']  = $doctorAddress->address;


                    $typesMasters = $this->typesMaster->where('id',$appointmentResult['type'])->first();
                    $appointmentData['Speciality']  = $typesMasters['type_name'];
                    $appointmentData['doctortype']       = 'doctortype';
                    $appointmentData['doctorName']       = $appointmentResult['drFname'].' '.$appointmentResult['drLname'];
                    $appointmentData['doctor_id']        = $appointmentResult['doctor_id'];
                    $appointmentData['patientName']       = $appointmentResult['pFname'].' '.$appointmentResult['pLname'];
                    $appointmentData['patient_photo']     = $appointmentResult['patient_photo'];
                    $appointmentData['doctor_photo']      = $appointmentResult['doctor_photo'];
                    $appointmentData['dr_user_id']        = $appointmentResult['dr_user_id'];
                    $appointmentData['p_user_id']         = $appointmentResult['p_user_id'];
                    $appointmentData['patientAddress']    = $appointmentResult['patientAddress'];
                    $appointmentData['date']             = dateFormate(date('Y-m-d'));
                    

                }
        }

        $jsonArr['doctorPatientData'] = $appointmentData;
            return $jsonArr;

    }

    public function getPrescriptionData($id)
    {
        $patientPrescriptionDetail = array();
            $patientPrescriptionDetail  = $this->patientPrescription
                                    ->Join('patient_prescription_details','patient_prescription.id','=','patient_prescription_details.prescription_id')
                                        ->where('patient_prescription.id', $id)->get();
                    
                /*foreach ($patientPrescriptionDetail  as $key => $value) {
                    $patientPrescriptionData[$key]['date']        = dateFormate($value['created_at']);
                    $patientPrescriptionData[$key]['title']        = $value['title'];
                    $patientPrescriptionData[$key]['doctorName']   = $value['drFname'].' '.$value['drLname'];
                }*/
         
            $jsonArr['patientPrescriptionData'] = $patientPrescriptionDetail;
            return $jsonArr;

    }
    
    public function show($id)
    {   
        $data = $jsonArr = $slotsarr =  $doctorSlot = $allDaysTimeSlots  = $allDaysTimes = array();
      
        if (isset($id) && $id != '')
        {       
             $result = $this->userModel->select('*','users.id as id','users.status as userStatus'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','master_services.service_name')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->leftJoin('master_services','doctor_information.willing_to_serve_as','=','master_services.id')
            ->where('users.role_type',4)->where('doctor_information.id', $id)->first();

            if(!empty($result['equipment'])){
                $equipArr = explode(',',$result['equipment']);
                $equipArray = [];
                foreach ($equipArr as $key => $value) {                  
                  $equipArray[] = $this->EquipmentsMasterModel->select('id','equipment_name')->where('id', $value)->where('isdeleted', 0)->orderBy('id','ASC')->first();
                }                
                $result['equipmentArr']= $equipArray;                
            }else {
                $result['equipmentArr'] = '';                
            }

            if(!empty($result->date_of_registration))
                $result->date_of_registration = date("Y-m-d", strtotime($result->date_of_registration)); 
                $typesMasters = $this->typesMaster->where('id',$result['type'])->first();
                $result->type = $result['type'];
            if(!empty($typesMasters))
                $result->type_name = $typesMasters->type_name;
            else
                $result->type_name = '';
           
            $jsonArr = $result;
            $jsonArr['showStatus'] = 'success';
            $jsonArr['appointment_date']     = dateFormate(date('Y-m-d'));

        }
        return $jsonArr;
    }

    public function doctor_booking_slot_old($request)
    {
       
        $data = $jsonArr = $doctorSlot =   array();
        $appointmentDate ='';

        $newslot = $this->doctor_booking_slotNew($request);
        return $newslot;
        
      // $current_date     = '2022-01-12';//date('Y-m-d');
        $current_date     = date('Y-m-d');
        $TodayCurrentTime     = date('H:i:s');
        if(!empty($request->appointment_date)){
             $appointmentDate = convertDate($request->appointment_date);
         }
        $appointment_date = !empty($appointmentDate) ? $appointmentDate : $current_date;
        $doctor_id = isset($request->doctor_id) ? $request->doctor_id : '';

        if (isset($doctor_id) && $doctor_id != '')
        {     
              $doctorInformation = $this->doctorInformationModel->where('id', $doctor_id)->first();
              $availability_time_from =   $doctorInformation->availability_time_from;
              $availability_time_from =   explode('-', $availability_time_from);
              $timeArray = timeArray(); // all time 24 hrs[0]
              $fromtime = $availability_time_from[0];
              $totime = $availability_time_from[1];
              $i                              = 0;
              $fromtime    = date("H:i:s", strtotime($fromtime));
              $totime      = date("H:i:s", strtotime($totime));
              
               foreach ($timeArray as $slots)
                {  
                   $doctorSlots =  date("H:i:s", strtotime($slots));
                    if ($fromtime <= $doctorSlots && $totime >= $doctorSlots)
                    {  

                   // if ($TodayCurrentTime <= $doctorSlots) {
                        $bookingsData  = $this->bookings->select('appointment_date','appointment_time')
                                ->where('appointment_date',$appointment_date)
                                ->where('appointment_time',$doctorSlots)->first();
                        if($bookingsData) {
                             $doctorSlot[$i]['time'] = $slots ;
                             $doctorSlot[$i]['status'] = true ;
                        }else{
                            $doctorSlot[$i]['time'] = $slots ;
                            $doctorSlot[$i]['status'] = false ;
                        }
                        $i++;
                        //}
                    }
                }
            $json_arr['bookslot'] = $doctorSlot;
            //$json_arr['status'] = 'success';
        }
        return $json_arr;
    }

    public function doctor_booking_slot($request)
    {   
        $data = $jsonArr = $doctorSlot =  $json_arr =  array();
        $appointmentDate ='';

        $doctor_id = isset($request->doctor_id) ? $request->doctor_id : '';
        $doctorInformation = $this->doctorInformationModel->where('id', $doctor_id)->first();
        $current_date     = date('Y-m-d');
       // dd(date('Y-m-d H:i:s'));
        if(!empty($request->appointment_date))
            $appointmentDate = convertDate($request->appointment_date);

        $appointment_date = !empty($appointmentDate) ? $appointmentDate : $current_date;
        $daysName =  date('l', strtotime($appointment_date));
        $doctorBookingTimeslotData = $this->doctorBookingTimeslot
                ->where('user_id',$doctorInformation->user_id)
                ->where('day',$daysName)
                ->first();
        
                if(!empty($doctorBookingTimeslotData) && isset($doctor_id) && $doctor_id != '')
                {    
                      $timeArray = timeArray(); // all time 24 hrs[0]
                      $fromtime = $doctorBookingTimeslotData->fromTime;
                      $totime   = $doctorBookingTimeslotData->toTime;
                    
                    
                      $i           = 0;
                      $fromtime = $doctorBookingTimeslotData->fromTime;
                      $totime = $doctorBookingTimeslotData->toTime;
                        
                      $fromtime    = date("H:i:s", strtotime($fromtime));
                      $totime      = date("H:i:s", strtotime($totime));
                       foreach ($timeArray as $slots)
                        {  
                           $doctorSlots =  date("H:i:s", strtotime($slots));
                           
                            if ($fromtime !='00:00:00' && $fromtime <= $doctorSlots && $totime >= $doctorSlots)
                            { 


                               
                                
                                 $bookingsData  = $this->bookings
                                        ->select('booking.appointment_date','booking.appointment_time')
                                        ->join('payment_orders as payment_orders', 'booking.id', '=', 'payment_orders.bookingID')
                                        ->where('booking.appointment_date',$appointment_date)
                                        ->where('payment_orders.paypal_status','COMPLETED')
                                        ->where('booking.appointment_time',$doctorSlots)->first();


                                $currantdateTime = date('Y-m-d H:i:s'); 
                                $next12hrsTime   = date('Y-m-d H:i:s', strtotime('+12 hours'));
                                $appointmentDateTime =  $appointment_date.' '.$doctorSlots;
                                //$new_time = date("H:i:s", strtotime('+11 hours')); 
                                //dd($appointmentDateTime, $next12hrsTime);
                                    if($appointmentDateTime >= $next12hrsTime){
                                       if($bookingsData) {
                                         $doctorSlot[$i]['time'] = $slots ;
                                         $doctorSlot[$i]['status'] = true ;
                                        }else{

                                            $doctorSlot[$i]['time'] = $slots ;
                                            $doctorSlot[$i]['status'] = false ;
                                        } 
                                    }
                                    // else{
                                    //     if($bookingsData) {
                                    //      $doctorSlot[$i]['time'] = $slots ;
                                    //      $doctorSlot[$i]['status'] = true ;
                                    //     }else{
                                    //         $doctorSlot[$i]['time'] = $slots ;
                                    //         $doctorSlot[$i]['status'] = false ;
                                    //     }
                                    // }

                               
                                $i++;
                            }
                            
                        }
                    $json_arr['bookslot'] = $doctorSlot;
                }
           return $json_arr;
    }

    public function getDoctorProfile($id)
    {
        $data = $jsonArr = [];
        if (isset($id) && $id != '')
        {   
            
             $result = $this->userModel ->select('*','users.id as id','users.status as userStatus'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','doctor_information.id as doctor_info_id')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',4)
            ->where('doctor_information.user_id',$id)
            ->where('users.id', $id)->first();

            if(!empty($result['equipment'])){
                $equipArr = explode(',',$result['equipment']);
                $equipArray = [];
                foreach ($equipArr as $key => $value) {                  
                  $equipArray[] = $this->EquipmentsMasterModel->select('id','equipment_name')->where('id', $value)->where('isdeleted', 0)->orderBy('id','ASC')->first();
                }                
                $result['equipmentArr']= $equipArray;                
            }else {
                $result['equipmentArr'] = '';                
            }

            $jsonArr = $result;
            $json_arr['showStatus'] = 'success';

        }
        return $jsonArr;
    }

    public function destroy($id, $request)
    {
        if (!empty($id))
        {   
            $result = $this->doctorInformationModel->where('user_id', $id)->first();
            $this->doctorAddress->where('doctor_information_id', $result->id)->delete();
            $this->doctorInformationModel->where('user_id', $id)->delete();
            $this->userModel->where('id', $id)->delete();
            $data['status'] = 'success';
            $data['message'] = 'Doctor successfully Deleted';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while deleting Doctor';
        }
        return $data;
    }

    public function deleteMedicalReport($id)
    {
        if (!empty($id))
        {   
            $this->patientReports->where('id', $id)->delete();
            $data['status'] = 'success';
            $data['message'] = 'Report successfully Deleted';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while deleting Report';
        }
        return $data;
    }

    public function store($request)
    {

        $data = [];
        $authUser = Auth::user();
        $formData = json_decode($request->input('formData'));
        $first_name = isset($formData->first_name) ? $formData->first_name : '';
        $last_name = isset($formData->last_name) ? $formData->last_name : '';
        $user_name = isset($formData->user_name) ? $formData->user_name : '';
        $email = isset($formData->email) ? $formData->email : '';
        $age = isset($formData->age) ? $formData->age : '';
        $gender = isset($formData->gender) ? $formData->gender : '';
        $brief_summary = isset($formData->brief_summary) ? $formData->brief_summary : '';
        $terms_and_conditions = isset($formData->terms_and_conditions) ? $formData->terms_and_conditions : '';
        $current_clinic_hospital = isset($formData->current_clinic_hospital) ? $formData->current_clinic_hospital : '';
        $medical_license_number = isset($formData->medical_license_number) ? $formData->medical_license_number : '';
        $registration_no = isset($formData->registration_no) ? $formData->registration_no : '';
        $experience = isset($formData->experience) ? $formData->experience : '';
        $pass_word = isset($formData->password) ? $formData->password : '';
        $password = Hash::make($formData->password);
        $address = isset($formData->address) ? $formData->address : '';
        $address2 = isset($formData->address2) ? $formData->address2 : '';
        $area = isset($formData->area) ? $formData->area : '';
        $city = isset($formData->city) ? $formData->city : '';
        $country = isset($formData->country) ? $formData->country : '';
        $state = isset($formData->state) ? $formData->state : '';
        $zip_code = isset($formData->zip_code) ? $formData->zip_code : '';
        $full_address = isset($formData->full_address) ? $formData->full_address : '';
        $latitude = isset($formData->latitude) ? $formData->latitude : '';
        $longitude = isset($formData->longitude) ? $formData->longitude : '';
        $phone_number = isset($formData->phone_number) ? $formData->phone_number : '';
        $type = !empty($formData->type) ? $formData->type : 0;
        $dr_type = isset($formData->dr_type) ? $formData->dr_type : 0;
        $availability_time_from = isset($formData->availability_time_from) ? $formData->availability_time_from : '';
        $area_of_coverage = isset($formData->area_of_coverage) ? $formData->area_of_coverage : '';
        $date_of_registration = isset($formData->date_of_registration) ? $formData->date_of_registration : '';
        $willing_to_serve_as = isset($formData->willing_to_serve_as) ? $formData->willing_to_serve_as : '';
        $equipment = isset($formData->equipment) ? $formData->equipment : '';
        $status = isset($formData->status) ? $formData->status : '';
        $fees_amount = !empty($formData->fees_amount) ? $formData->fees_amount : 100;
        $certificate_awarding_university = $speciality_diploma = $copy_of_registration = $profile_photo = '';

        $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson :'';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';

        $w3w_latitude = isset($formData->w3w_latitude) ? $formData->w3w_latitude : '';
        $w3w_longitude = isset($formData->w3w_longitude) ? $formData->w3w_longitude : '';
        $w3w_address = isset($formData->w3w_address) ? $formData->w3w_address : '';

        $insertUserArr = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_name' => $user_name,
            'phone_number' => $phone_number,
            'gender' => $gender,
            'age' => $age,
            'pass_word' => $pass_word,
            'password' => $password,
            'role_type' => 4,
            'parent_id' => $authUser->id,
            'email' => $email,
            'status' => $status,
        );

        $userData = $this->userModel->create($insertUserArr);
        if (!empty($userData))
        {
            if(env('SEND_EMAIL') == true){
            $this->sendRegistorEmail($userData);
            }
            $user_id = $userData->id;
            $roles['user_id'] = $user_id;
            $roles['role_id'] = 4;
            DB::table('role_admin')->insert($roles);

            if (!empty($_FILES['cirtificatefile']) && $_FILES['cirtificatefile']['size'] > 0 && $request->file('cirtificatefile'))
            {
                $cirtificatefileData = $this->cirtificatefile_upload($request, $user_id);
                $certificate_awarding_university = $cirtificatefileData['file_name'];
            }

            if (!empty($_FILES['specialtyfile']) && $_FILES['specialtyfile']['size'] > 0 && $request->file('specialtyfile'))
            {
                $specialtyfileData = $this->specialtyfile_upload($request, $user_id);
                $speciality_diploma = $specialtyfileData['file_name'];
            }

            if (!empty($_FILES['registrationfile']) && $_FILES['registrationfile']['size'] > 0 && $request->file('registrationfile'))
            {
                $registrationfileData = $this->registrationfile_upload($request, $user_id);
                $copy_of_registration = $registrationfileData['file_name'];
            }

            if (!empty($_FILES['profilefile']) && $_FILES['profilefile']['size'] > 0 && $request->file('profilefile'))
            {
                $profilefileData = $this->profilefile_upload($request, $user_id);
                $profile_photo = $profilefileData['file_name'];
            }

            $insertDoctorInformationArr = array(
                'user_id' => $user_id,
                'certificate_awarding_university' => $certificate_awarding_university,
                'speciality_diploma' => $speciality_diploma,
                'copy_of_registration' => $copy_of_registration,
                'medical_license_number' => $medical_license_number,
                'date_of_registration' => $date_of_registration,
                'registration_no' => $registration_no,
                'experience' => $experience,
                'current_clinic_hospital' => $current_clinic_hospital,
                'willing_to_serve_as' => $willing_to_serve_as,
                'brief_summary' => $brief_summary,
                'terms_and_conditions' => $terms_and_conditions,
                'status'=>$status,
                'availability_time_from'=>$availability_time_from,
                'area_of_coverage'=>$area_of_coverage,
                'equipment'=>$equipment,
                'type'=>$type,
                'fees_amount'=>$fees_amount,
            );

            // dd($insertDoctorInformationArr);
             
            $doctorInformationData = $this->doctorInformationModel->create($insertDoctorInformationArr);
            if (!empty($doctorInformationData))
            {
                $insertDoctorAddressArr = array(
                    'full_address' => $full_address,
                    'address' => $address,
                    'address2' => $address2,
                    'area' => $area,
                    'city' => $city,
                    'country' => $country,
                    'state' => $state,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'w3w_address' => $w3w_address,
                    'w3w_latitude' => $w3w_latitude,
                    'w3w_longitude' => $w3w_longitude,
                    'zip_code' => $zip_code,
                    'doctor_information_id' => $doctorInformationData->id,
                    'long_org' => abs($longitude),
                    'what3words'=>$what3words,
                    'what3wordsjson'=> json_encode($what3wordsjson),
                );
                $DoctorAddressData = $this->doctorAddress->create($insertDoctorAddressArr);
            }
            $data['status'] = 'success';
            $data['message'] = 'Doctor successfully Insert';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Doctor';
        }
        return $data;
    }

    public function updateDoctor($id, $request)
    {
        $data = [];
        $drResult = $this->userModel ->select('*','users.id as id','users.status as status'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','doctor_information.id as doctor_information_id')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',4)->where('doctor_information.id', $id)->first();

        // dd($drResult);    
       $user_id =  $drResult->user_id; 
      // $doctor_information_id = $drResult->id;
       $doctor_information_id = $drResult->doctor_information_id;
        
        $authUser = Auth::user();
        $formData = json_decode($request->input('formData'));
        if(!empty($formData)) {
        $first_name = isset($formData->first_name) ? $formData->first_name : '';
        $last_name = isset($formData->last_name) ? $formData->last_name : '';
        $user_name = isset($formData->user_name) ? $formData->user_name : '';
        $email = isset($formData->email) ? $formData->email : '';
        $age = isset($formData->age) ? $formData->age : '';
        $gender = isset($formData->gender) ? $formData->gender : '';
        $brief_summary = isset($formData->brief_summary) ? $formData->brief_summary : '';
        $terms_and_conditions = isset($formData->terms_and_conditions) ? $formData->terms_and_conditions : '';
        $current_clinic_hospital = isset($formData->current_clinic_hospital) ? $formData->current_clinic_hospital : '';
        $medical_license_number = isset($formData->medical_license_number) ? $formData->medical_license_number : '';
        $registration_no = isset($formData->registration_no) ? $formData->registration_no : '';
        $experience = isset($formData->experience) ? $formData->experience : '';
        $address = isset($formData->address) ? $formData->address : '';
        $address2 = isset($formData->address2) ? $formData->address2 : '';
        $area = isset($formData->area) ? $formData->area : '';
        $city = isset($formData->city) ? $formData->city : '';
        $country = isset($formData->country) ? $formData->country : '';
        $state = isset($formData->state) ? $formData->state : '';
        $zip_code = isset($formData->zip_code) ? $formData->zip_code : '';
        $full_address = isset($formData->full_address) ? $formData->full_address : '';
        $latitude = isset($formData->latitude) ? $formData->latitude : '';
        $longitude = isset($formData->longitude) ? $formData->longitude : '';
        $phone_number = isset($formData->phone_number) ? $formData->phone_number : '';
        $availability_time_from = isset($formData->availability_time_from) ? $formData->availability_time_from : '';
        $area_of_coverage = isset($formData->area_of_coverage) ? $formData->area_of_coverage : '';
        $equipment = isset($formData->equipment) ? $formData->equipment : '';
        $dr_type = !empty($formData->dr_type) ? $formData->dr_type : 0;
        $type = !empty($formData->type) ? $formData->type : 0;
        $date_of_registration = isset($formData->date_of_registration) ? $formData->date_of_registration : '';
        $willing_to_serve_as = isset($formData->willing_to_serve_as) ? $formData->willing_to_serve_as : '';

        $w3w_latitude = isset($formData->w3w_latitude) ? $formData->w3w_latitude : '';
        $w3w_longitude = isset($formData->w3w_longitude) ? $formData->w3w_longitude : '';
        $w3w_address = isset($formData->w3w_address) ? $formData->w3w_address : '';

       
        $status = isset($formData->status) ? $formData->status : 0;
        $fees_amount = !empty($formData->fees_amount) ? $formData->fees_amount : 100;

        $certificate_awarding_university = isset($drResult->certificate_awarding_university) ? $drResult->certificate_awarding_university : '';
        $speciality_diploma     = isset($drResult->speciality_diploma) ? $drResult->speciality_diploma : '';
        $copy_of_registration   = isset($drResult->copy_of_registration) ? $drResult->copy_of_registration : '';
        $profile_photo          = isset($drResult->profile_photo) ? $drResult->profile_photo : '';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';
        $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson : '';

        $updateUserArr = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_name' => $user_name,
            'phone_number' => $phone_number,
            'gender' => $gender,
            'age' => $age,
            'email' => $email,
            'status' => $status,
        );

        $userData = $this->userModel->where('id', $user_id)->update($updateUserArr);

            if (!empty($_FILES['cirtificatefile']) && $_FILES['cirtificatefile']['size'] > 0 && $request->file('cirtificatefile'))
            {
                $cirtificatefileData = $this->cirtificatefile_upload($request, $user_id);
                $certificate_awarding_university = $cirtificatefileData['file_name'];
            }

            if (!empty($_FILES['specialtyfile']) && $_FILES['specialtyfile']['size'] > 0 && $request->file('specialtyfile'))
            {
                $specialtyfileData = $this->specialtyfile_upload($request, $user_id);
                $speciality_diploma = $specialtyfileData['file_name'];
            }

            if (!empty($_FILES['registrationfile']) && $_FILES['registrationfile']['size'] > 0 && $request->file('registrationfile'))
            {
                $registrationfileData = $this->registrationfile_upload($request, $user_id);
                $copy_of_registration = $registrationfileData['file_name'];
            }

            if (!empty($_FILES['profilefile']) && $_FILES['profilefile']['size'] > 0 && $request->file('profilefile'))
            {
                $profilefileData = $this->profilefile_upload($request, $user_id);
                $profile_photo = $profilefileData['file_name'];
            }

            $updateDoctorInformationArr = array(
                'user_id' => $user_id,
                'certificate_awarding_university' => $certificate_awarding_university,
                'speciality_diploma' => $speciality_diploma,
                'copy_of_registration' => $copy_of_registration,
                'medical_license_number' => $medical_license_number,
                'date_of_registration' => $date_of_registration,
                'registration_no' => $registration_no,
                'experience' => $experience,
                'current_clinic_hospital' => $current_clinic_hospital,
                'willing_to_serve_as' => $willing_to_serve_as,
                'brief_summary' => $brief_summary,
                'terms_and_conditions' => $terms_and_conditions,
                'status'=>$status,
                'fees_amount'=>$fees_amount,
                'availability_time_from'=>$availability_time_from,
                'area_of_coverage'=>$area_of_coverage,
                'equipment'=>$equipment,
               // 'dr_type'=>$dr_type,
                'type'=>$type,

            );

            $doctorInformationData = $this->doctorInformationModel->where('id', $doctor_information_id)->update($updateDoctorInformationArr);

             $doctorAddressExitsData = $this->doctorAddress->where('doctor_information_id', $doctor_information_id)
             ->first();

             $updateDoctorAddressArr = array(
                    'full_address' => $full_address,
                    'address' => $address,
                    'address2' => $address2,
                    'area' => $area,
                    'city' => $city,
                    'country' => $country,
                    'state' => $state,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'zip_code' => $zip_code,
                    'doctor_information_id' => $doctor_information_id,
                    'long_org' => abs($longitude),
                    'what3words'=>$what3words,
                    'what3wordsjson'=> json_encode($what3wordsjson),

                    'w3w_latitude'=>$w3w_latitude,
                    'w3w_longitude'=>$w3w_longitude,
                    'w3w_address'=>$w3w_address,
                );
                
             
             if(!empty($doctorAddressExitsData)) {
                $DoctorAddressData = $this->doctorAddress->where('doctor_information_id', $doctor_information_id)->update($updateDoctorAddressArr);

             }else{
                 $DoctorAddressData = $this->doctorAddress->create($updateDoctorAddressArr);
             }
                
                $data['status'] = 'success';
                $data['message'] = 'Doctor Update successfully Insert';
            }else{
                 $data['status'] = 'error';
                 $data['message'] = 'error occured while updating Doctor';
            }
            return $data;
    }

    public function patientMedicalReport($appointment_id, $request)
    {
        $authUser = Auth::user();
        $patient_id     =  $request->input('patient_id');
        $description    = $request->input('description');
        $attach_report  = $request->input('attach_report');
        $doctor_id  = $request->input('doctor_id');
        //$doctor_id      = $authUser->id ;
        $attachment_name = '';
         
        $patientData =  $this->patient->where('id',$patient_id)->first();
          $patientinfo = $this->doctorInformationModel->where('id',$patient_id)->first();
         if (!empty($_FILES['attach_report']) && $_FILES['attach_report']['size'] > 0 && $request->file('attach_report'))
            {
                $attach_report = $request->file('attach_report');
                $extension = $attach_report->getClientOriginalExtension();
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf' || $extension == 'docx' )
                {
                    $report_file = 'report_' . time() . '.' . $extension;
                    $destinationPath = public_path('uploads/patient/' . $patientData->user_id.'/report');

                    if (!file_exists($destinationPath) and !is_dir($destinationPath))
                    {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $attach_report->move($destinationPath, $report_file);
                    //$insertReportArr['attach_report'] = $report_file;
                    $attachment_name = $report_file;
                }

            }

            $insertReportArr = array(
            'patient_id' => $patient_id,
            'appointment_id' => $appointment_id,
            'doctor_id' => $doctor_id,
            'description' => $description,
             'attach_report' => $attachment_name,
        );

        $patientReportsData = $this->patientReports->create($insertReportArr);

        if ($patientReportsData)
        {
            $data['status'] = 'success';
            $data['message'] = 'Report successfully Updated';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Report';
        }
        return $data;
    }

    public function change_account_status($id, $request)
    {   
        $data = [];
        $formData = $request->all();
        $status_id = (int)$request->get('status_id');
        $updateArr['status'] = isset($formData['status_id']) ? (int)$formData['status_id'] : '';
        $result = $this->doctorInformationModel->where('id', $id)->update($updateArr);
        if ($result)
        {
            $data['status'] = 'success';
            $data['message'] = 'Status successfully Updated';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Status';
        }
        return $data;
    }

    public function cirtificatefile_upload($request, $user_id)
    {
        if ($request->file('cirtificatefile'))
        {

            $formData = json_decode($request->input('formData'));
            $cirtificatefile = $request->file('cirtificatefile');
            $extension = $cirtificatefile->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf')
            {
                $cirtificate_file = 'cirtificate_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/doctor/' . $user_id);

                if (!file_exists($destinationPath) and !is_dir($destinationPath))
                {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }

                if(!empty($formData->certificate_awarding_university))
                {   
                     $destinationExitPath = public_path('uploads/doctor/' . $user_id.'/'.$formData->certificate_awarding_university);
                    if (file_exists($destinationExitPath)) 
                        unlink($destinationExitPath);
                }

                $cirtificatefile->move($destinationPath, $cirtificate_file);
                $json_arr['file_name'] = $cirtificate_file;
                return $json_arr;

            }
            else
            {
                $json_arr['status'] = 'danger';
                $json_arr['message'] = 'Invalid input file.';
                $json_arr['file_name'] = '';
                return $json_arr;
            }
        }
    }

    public function specialtyfile_upload($request, $user_id)
    {
        if ($request->file('specialtyfile'))
        {   
            $formData = json_decode($request->input('formData'));
            $specialtyfile = $request->file('specialtyfile');
            $extension = $specialtyfile->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf')
            {
                $specialty_file = 'specialtyfile_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/doctor/' . $user_id);
                if (!file_exists($destinationPath) and !is_dir($destinationPath))
                {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }

                if(!empty($formData->speciality_diploma))
                {   
                     $destinationExitPath = public_path('uploads/doctor/' . $user_id.'/'.$formData->speciality_diploma);
                    if (file_exists($destinationExitPath)) 
                        unlink($destinationExitPath);
                }

               // if (file_exists($destinationPath . $specialty_file)) unlink($destinationPath . $specialty_file);

                $specialtyfile->move($destinationPath, $specialty_file);
                $json_arr['file_name'] = $specialty_file;
                return $json_arr;

            }
            else
            {
                $json_arr['status'] = 'danger';
                $json_arr['message'] = 'Invalid input file.';
                $json_arr['file_name'] = '';
                return $json_arr;
            }
        }
    }

    public function registrationfile_upload($request, $user_id)
    {
        if ($request->file('registrationfile'))
        {   
            $formData = json_decode($request->input('formData'));
            $registrationfile = $request->file('registrationfile');
            $extension = $registrationfile->getClientOriginalExtension();
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf')
            {
                $registration_file = 'registrationfile_' . time() . '.' . $extension;
                $destinationPath = public_path('uploads/doctor/' . $user_id);
                if (!file_exists($destinationPath) and !is_dir($destinationPath))
                {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }

                if(!empty($formData->copy_of_registration))
                {   
                     $destinationExitPath = public_path('uploads/doctor/' . $user_id.'/'.$formData->copy_of_registration);
                    if (file_exists($destinationExitPath)) 
                        unlink($destinationExitPath);
                }


                //if (file_exists($destinationPath . $registration_file)) unlink($destinationPath . $registration_file);

                $registrationfile->move($destinationPath, $registration_file);
                $json_arr['file_name'] = $registration_file;
                return $json_arr;
            }
            else
            {
                $json_arr['status'] = 'danger';
                $json_arr['message'] = 'Invalid input file.';
                $json_arr['file_name'] = '';
                return $json_arr;
            }
        }
    }

    public function profilefile_upload($request, $user_id)
    {   
        if ($_FILES['profilefile']['size'] > 0)
        {   
              $formData = json_decode($request->input('formData'));
            if ($request->file('profilefile'))
            {
                $profilefile = $request->file('profilefile');

                $extension = $profilefile->getClientOriginalExtension();
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf')
                {
                    $profile_photo = 'profile' . time() . '.' . $extension;
                    $destinationPath = public_path('uploads/profile/' . $user_id);
                    if (!file_exists($destinationPath) and !is_dir($destinationPath))
                    {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }

                    if(!empty($formData->profile_photo))
                    {   
                         $destinationExitPath = public_path('uploads/profile/' . $user_id.'/'.$formData->profile_photo);
                        if (file_exists($destinationExitPath)) 
                            unlink($destinationExitPath);
                    }

                    $profilefile->move($destinationPath, $profile_photo);
                    $this->userModel->where("id", $user_id) ->update(['profile_photo' => $profile_photo]);
                    $json_arr['file_name'] = $profile_photo;
                    return $json_arr;
                }
                else
                {
                    $json_arr['status'] = 'danger';
                    $json_arr['message'] = 'Invalid input file.';
                    $json_arr['file_name'] = '';
                    return $json_arr;
                }
            }
        }
    }

    public function patientPrescriptionAdd($appointment_id, $request)
    { 
        $formData = json_decode($request->input('formData'));
        $bookingsData  = $this->bookings->select('*')->where('id',$appointment_id)->first();
        $insertPrescriptionArr = array(
            'doctor_id' => $bookingsData->doctor_id,
            'patient_id' => $bookingsData->patient_id,
            'appointment_id' => (int)$appointment_id,
        );
       $patientPrescriptionData  =  $this->patientPrescription->create($insertPrescriptionArr);
        if(!empty($patientPrescriptionData)) {

        foreach ($formData as $key => $value) {
           $morning =  isset($value->morning) ? $value->morning : 0;
           $afternoon = isset($value->afternoon) ? $value->afternoon : 0;
           $evening =  isset($value->evening) ? $value->evening : 0;
           $night = isset($value->night) ? $value->night : 0;

             $insertPrescriptionDetailsArr = array(
            'title' => $value->title,
            'qty' => (int)$value->qty,
            'days' => (int)$value->days,
            'morning' => $morning,
            'afternoon' => $afternoon,
            'evening' => $evening,
            'night' => $night,
            'prescription_id' => $patientPrescriptionData->id,
             );

            if(!empty($value->title) && !empty($value->qty) && !empty($value->days)){
                $this->patientPrescriptionDetails->create($insertPrescriptionDetailsArr);
            }    
        }
            $data['status'] = 'success';
            $data['message'] = 'Prescription added successfully Updated';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Prescription';
        }
        return $data;
    }

    public function sendRegistorEmail($emailData)
    {

        if(env('APP_ENV') == 'local'){
            $loginurl = 'http://127.0.0.1:8000/login';
          }else{
              $loginurl = 'http://67.211.210.169/login';
          }

        $json_arr = [];
        if(!empty($emailData)){
            Config::set('mail',  mailConfig());
            $template_data = [
                'first_name'      => $emailData['first_name'],
                'last_name'       => $emailData['last_name'],
                'email'           => $emailData['email'],
                'phone_number'    => $emailData['phone_number'],
                'password'    => $emailData['pass_word'],
                'loginurl'        => $loginurl
            ];
            if(!empty($template_data)){
                 Mail::send(['html' => 'emails.registrationEmail'], $template_data, function ($message) use ($template_data) {
                     $subject = "UYR-Doctor- New Doctors Registered";
                     $message->subject($subject);
                     if(env('APP_ENV') == 'local'){
                         $message->to(env('EMAIL'));
                     }
                     else{
                         $message->to(env('EMAIL'));
                     }
                 });
                 if (Mail::failures()) {
                     $json_arr['status']   = 'error';
                     $json_arr['message']  = 'Something went wrong! Mail not sent!.';
                 }
            }

        }

    }


}

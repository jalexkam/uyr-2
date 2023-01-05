<?php
namespace App\Repositories\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Patient;
use App\Models\DoctorSuggestModel;
use App\Models\TypesMaster;
use App\Models\DoctorInformationModel;
use App\Models\Bookings;
use File;
//use Carbon\Carbon;
class DashboardRepositories
{

    public function __construct(UserModel $user, Patient $patient,DoctorSuggestModel $doctor_suggest,TypesMaster $typesMaster,DoctorInformationModel $doctorInformationModel,Bookings $bookings)
    {
        $this->userModel = $user;
        $this->per_page = per_page();
        $this->patient = $patient;
        $this->doctorSuggest = $doctor_suggest;
        $this->typesMaster = $typesMaster;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->bookings = $bookings;
    }

    public function getDashboardData($request)
    {  

        $authUser = Auth::user();
        $data =$doctorData = $mediatorDoctorData = $appointmentData = $patientData = array();

        //count 
        $doctorTotal =  $this->doctorInformationModel->select('users.status')
                        ->Join('users','doctor_information.user_id','=','users.id')
                        ->where('doctor_information.dr_type',0)->count();

        $doctorActive =  $this->doctorInformationModel
                        ->Join('users','doctor_information.user_id','=','users.id')
                        ->where('doctor_information.dr_type',0)->where('users.status',0)->count();

        $doctorInactive =  $this->doctorInformationModel
                        ->Join('users','doctor_information.user_id','=','users.id')
                        ->where('doctor_information.dr_type',0)->where('users.status',1)->count();

        $patientTotal=  $this->userModel->Join('patient','users.id','=','patient.user_id')
                          ->where('users.role_type',6)->count();

        $patientActive =  $this->userModel->Join('patient','users.id','=','patient.user_id')
                        ->where('users.status',0)->where('users.role_type',6)->count();

        $patientInactive = $this->userModel->Join('patient','users.id','=','patient.user_id')
                        ->where('users.role_type',6)
                         ->where('users.status',1)->count();

        $adminTotal =  $this->userModel
                          ->where('users.role_type',2)->count();

        $adminActive =  $this->userModel->where('users.status',0)->where('users.role_type',2)->count();

        $adminInactive = $this->userModel->where('users.status',1)->where('users.role_type',2)->count();

        $doctorCount['doctorTotal'] = $doctorTotal;
        $doctorCount['doctorActive'] = $doctorActive;
        $doctorCount['doctorInactive'] = $doctorInactive;
        $patientCount['patientTotal'] = $patientTotal;
        $patientCount['patientActive'] = $patientActive;
        $patientCount['patientInactive'] = $patientInactive;
        $adminCount['adminTotal'] = $adminTotal;
        $adminCount['adminActive'] = $adminActive;
        $adminCount['adminInactive'] = $adminInactive;

        $data['doctorCount'] = $doctorCount;
        $data['patientCount'] = $patientCount;
        $data['adminCount'] = $adminCount;

        $doctorResult = $this->doctorInformationModel->select('users.profile_photo','users.first_name','users.last_name','users.email','users.user_name','doctor_information.type','users.phone_number','doctor_information.id as doctor_id','users.id as user_id')
            ->Join('users','doctor_information.user_id','=','users.id')
            ->where('users.status',0)->where('doctor_information.dr_type',0)->orderBy('doctor_information.id', 'desc')->take(5)->get();

            foreach ($doctorResult as $key => $value)
                {   
                    $doctorData[$key]['profile_photo']  = $value['profile_photo'];
                    $doctorData[$key]['phone_number']  = $value['phone_number'];
                    $doctorData[$key]['email']  = $value['email'];
                    $doctorData[$key]['name']  = $value['first_name'].' '.$value['last_name'];
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    if(!empty($typesMaster) && !empty($typesMaster['type_name']))
                    $doctorData[$key]['Speciality']  = $typesMaster['type_name'];
                    else
                     $doctorData[$key]['Speciality']  = '';   
                    $doctorData[$key]['doctor_id']  = $value['doctor_id'];
                    $doctorData[$key]['user_id']  = $value['user_id'];
                     
                     
                }

         $mediatorDoctorResult = $this->doctorInformationModel->select('users.profile_photo','users.first_name','users.last_name','users.email','users.user_name','doctor_information.type','users.phone_number','users.id as doctor_id','users.id as user_id','users.id as user_id')
            ->Join('users','doctor_information.user_id','=','users.id')
            ->where('users.status',0)->where('doctor_information.dr_type',1)->orderBy('doctor_information.id', 'desc')->take(5)->get();

            foreach ($mediatorDoctorResult as $key => $value)
                {   
                    $mediatorDoctorData[$key]['profile_photo']  = $value['profile_photo'];
                    $mediatorDoctorData[$key]['phone_number']  = $value['phone_number'];
                    $mediatorDoctorData[$key]['email']  = $value['email'];
                    $mediatorDoctorData[$key]['name']  = $value['first_name'].' '.$value['last_name'];
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $mediatorDoctorData[$key]['Speciality']  = $typesMaster['type_name'];
                    $mediatorDoctorData[$key]['doctor_id']  = $value['doctor_id'];
                    $mediatorDoctorData[$key]['user_id']  = $value['user_id'];
                }

             $patientResult = $this->userModel ->select('patient.*','users.status','users.profile_photo','users.first_name','users.last_name','users.email','users.user_name','users.phone_number','users.age','users.id as user_id','users.age')
                        ->Join('patient','users.id','=','patient.user_id')
                        ->where('users.role_type',6)->where('users.parent_id',0)->orderBy('users.id', 'desc')->take(5)->get();

               foreach ($patientResult as $key => $value)
                {   
                    $patientData[$key]['profile_photo']     = $value['profile_photo'];
                    $patientData[$key]['phone_number']      = $value['phone_number'];
                    $patientData[$key]['email']             = $value['email'];
                    $patientData[$key]['name']              = $value['first_name'].' '.$value['last_name'];
                    $patientData[$key]['age']               = $value['age'];
                    $patientData[$key]['user_id']           = $value['user_id'];
                }

                 $appointmentResult  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','dr.first_name as drFname','dr.last_name as drLname','p.first_name as pFname','p.last_name as pLname','doctor_information.id as doctor_id','p.profile_photo as patient_photo','dr.profile_photo as doctor_photo','dr.id as dr_user_id','p.id as p_user_id')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('patient','booking.patient_id','=','patient.id')
                             ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                             ->join('users as p', 'patient.user_id', '=', 'p.id')
                             ->where('booking.status', 'Accept')
                             ->orderBy('booking.id', 'DESC')->take(5)->get();
                

                foreach ($appointmentResult as $key => $value)
                {   
                    $appointmentData[$key]['id'] = $value['id'];
                    $appointmentData[$key]['appointment_date'] = dateFormate($value['appointment_date']);
                    $appointmentData[$key]['appointment_time'] = timeFormate($value['appointment_time']);
                    $appointmentData[$key]['fees_amount']      = $value['fees_amount'];
                    $typesMaster = $this->typesMaster->where('id',$value['type'])->first();
                    $appointmentData[$key]['Speciality']  = $typesMaster['type_name'];
                    $appointmentData[$key]['doctortype']       = 'doctortype';
                    $appointmentData[$key]['doctorName']       = $value['drFname'].' '.$value['drLname'];
                    $appointmentData[$key]['doctor_id']        = $value['doctor_id'];
                    $appointmentData[$key]['patientName']       = $value['pFname'].' '.$value['pLname'];
                    $appointmentData[$key]['patient_photo']     = $value['patient_photo'];
                    $appointmentData[$key]['doctor_photo']      = $value['doctor_photo'];
                    $appointmentData[$key]['dr_user_id']      = $value['dr_user_id'];
                    $appointmentData[$key]['p_user_id']      = $value['p_user_id'];
                    
                }


            $data['doctorData'] = $doctorData;
            $data['mediatorDoctorData'] = $mediatorDoctorData;
            $data['patientData'] = $patientData;
            $data['appointmentData'] = $appointmentData;
            
            return $data;
       
    }


   

    public function getBookingData($appointment_id,$request)
    {
        $data = $jsonArr = [];
        $patientData =$appointmentData = array();

        if (isset($appointment_id) && $appointment_id != '')
        {   
              $bookingsData  = $this->bookings-> select('patient_id')
                                    ->where('id',$appointment_id)->first();
             
              $bookingsDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','users.first_name','users.last_name','doctor_information.id as doctor_id')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('users','doctor_information.user_id','=','users.id')
                             ->where('booking.patient_id', $bookingsData->patient_id)
                             ->where('booking.status','!=', 'Reject')
                             ->first();

              
                $appointmentData['appointment_date'] = dateFormate($bookingsDetails['appointment_date']);
                $appointmentData['appointment_time'] = timeFormate($bookingsDetails['appointment_time']);
                $appointmentData['fees_amount']      = $bookingsDetails['fees_amount'];
                $appointmentData['doctorName']       = $bookingsDetails['first_name'].' '.$bookingsDetails['last_name'];
               /**/ /*$appointmentData['doctor_id']        = $bookingsDetails['doctor_id'];
                $appointmentData['status']           = $bookingsDetails['status'];*/
                $appointmentData['id']               = $bookingsDetails['id'];
              
             //$jsonArr['bookingsData'] = $bookingsData;
             $jsonArr['appointmentData'] = $appointmentData;
             $jsonArr['status'] = 'success';

        }
        return $jsonArr;
    }

}
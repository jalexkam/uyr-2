<?php
namespace App\Repositories\Patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Patient;
use App\Models\TypesMaster;
use App\Models\DoctorSuggestModel;
use App\Models\FavoriteDoctorModel;
use App\Models\Bookings;
use App\Models\PatientReportsModel;
use App\Models\DoctorInformationModel;
use File;
use App\Models\PatientPrescription;
use App\Models\PatientPrescriptionDetails;
//use Carbon\Carbon;
class PatientRepositories
{

    public function __construct(UserModel $user, Patient $patient,DoctorSuggestModel $doctor_suggest,TypesMaster $typesMaster,Bookings $bookings,PatientReportsModel $patientReports,PatientPrescription $patientPrescription,PatientPrescriptionDetails $patientPrescriptionDetails,FavoriteDoctorModel $favorite_doctor_model,DoctorInformationModel $doctor_information_model)
    {
        $this->userModel = $user;
        $this->per_page = per_page();
        $this->patient = $patient;
        $this->doctorSuggest = $doctor_suggest;
        $this->typesMaster   = $typesMaster;
        $this->bookings = $bookings;
        $this->patientReports = $patientReports;
        $this->patientPrescription =$patientPrescription;
        $this->patientPrescriptionDetails = $patientPrescriptionDetails ;
        $this->FavoriteDoctorModel = $favorite_doctor_model ;
        $this->DoctorInformationModel = $doctor_information_model ;

    }
    public function index($request)
    {   
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $result = $this->userModel ->select('*','users.id as id','users.status','patient.id as patient_id')
            ->Join('patient','users.id','=','patient.user_id')
            ->where('users.role_type',6);

        if($authUser->parent_id == 0){
          $result =  $result->where('users.parent_id',$authUser->id);
          $result =  $result->orWhere('users.id', $authUser->id);
        }

         if($authUser->parent_id != 0){
          $result =  $result->where('users.parent_id',$authUser->parent_id);
          $result =  $result->orWhere('users.id', $authUser->parent_id);
        }

        // if($authUser->role_type == 6)
        // {
        //     $result = $result->where('users.user_name',$authUser->user_name);
        //      //->where('users.id', '!=' , $authUser->id);
        // } 


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
                     $data['data'][$key]['pId'] = 'P00'.$value['id'];
                }
            }
            return $data;
        }
    }

    public function show($id)
    {
        $data = $jsonArr = [];
        if (isset($id) && $id != '')
        {   
             $result = $this->userModel ->select('*','patient.id as id','users.status','patient.id as patient_id','patient.longitude', 'patient.w3w_latitude', 'patient.w3w_longitude')
                                        ->Join('patient','users.id','=','patient.user_id')
                                        ->where('users.role_type',6)
                                        ->where('patient.id', $id)
                                        ->first();
            $jsonArr = $result;
            $json_arr['status'] = 'success';

        }
        return $jsonArr;
    }


    public function details($patient_id)
    {
        $data = $jsonArr = [];
        $patientData =$appointmentData = $medicalReportsData = array();

        if (isset($patient_id) && $patient_id != '')
        {   
             $result = $this->userModel ->select('*','users.id as id','users.status','patient.id as patient_id','patient.user_id')
                    ->Join('patient','users.id','=','patient.user_id')
                    ->where('users.role_type',6)
                    ->where('patient.id', $patient_id)->first();

             $patientData['full_name']      = $result->first_name. ' '.$result->last_name;
             $patientData['email']          = $result->email;
             $patientData['phone_number']   = $result->phone_number;
             $patientData['age']            = $result->age;
             $patientData['address']        = $result->address;
             $patientData['patient_id']     = $result->patient_id;

              $bookingsDetails  = $this->bookings->select('booking.appointment_date','booking.appointment_time','booking.id','booking.status','doctor_information.type','doctor_information.fees_amount','users.first_name','users.last_name','doctor_information.id as doctor_id')
                             ->Join('doctor_information','booking.doctor_id','=','doctor_information.id')
                             ->Join('users','doctor_information.user_id','=','users.id')
                             ->where('booking.patient_id', $patient_id)
                             ->where('booking.status','!=', 'Reject')
                             ->orderBy('booking.id', 'desc')->take(5)->get();

              foreach ($bookingsDetails as $key => $value) 
              {
                $appointmentData[$key]['appointment_date'] = dateFormate($value['appointment_date']);
                $appointmentData[$key]['appointment_time'] = timeFormate($value['appointment_time']);
                $appointmentData[$key]['fees_amount']      = $value['fees_amount'];
                $appointmentData[$key]['doctortype']       = 'doctortype';
                $appointmentData[$key]['doctorName']       = $value['first_name'].' '.$value['last_name'];
                $appointmentData[$key]['doctor_id']        = $value['doctor_id'];
                $appointmentData[$key]['status']           = $value['status'];
                $appointmentData[$key]['id']               = $value['id'];
              }

                $medicalReportsDetails  = $this->patientReports
                            ->select('dr.first_name as drFname','dr.last_name as drLname','doctor_information.id as doctor_id','patient_reports.created_at','patient_reports.description','patient_reports.attach_report','patient_reports.id as report_id')
                                 ->Join('doctor_information','patient_reports.doctor_id','=','doctor_information.id')
                                ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                                ->where('patient_reports.patient_id', $patient_id)
                                ->get();

                  foreach ($medicalReportsDetails  as $key => $value) {
                    $medicalReportsData[$key]['report_id']          = $value['report_id'];
                    $medicalReportsData[$key]['date']               = dateFormate($value['created_at']);
                    $medicalReportsData[$key]['description']        = $value['description'];
                    $medicalReportsData[$key]['doctorName']         = $value['drFname'].' '.$value['drLname'];
                    $medicalReportsData[$key]['attach_report']      = $value['attach_report'];
                    $medicalReportsData[$key]['user_id']         = $result->user_id;
                }



            $patientPrescriptions  = $this->patientPrescription->select('dr.first_name as drFname','dr.last_name as drLname','patient_prescription.id','patient_prescription.created_at','patient_prescription.doctor_id','patient_prescription.appointment_id','patient_prescription.patient_id','booking.appointment_date','booking.appointment_time')
                                     ->Join('booking','patient_prescription.appointment_id','=','booking.id')
                                     ->Join('doctor_information','patient_prescription.doctor_id','=','doctor_information.id')
                                     ->join('users as dr', 'doctor_information.user_id', '=', 'dr.id') 
                                     ->where('patient_prescription.patient_id',$patient_id)
                                     ->get();
                                     
              foreach ($patientPrescriptions  as $key => $value) {
                $patientPrescriptions[$key]['date']                    = dateFormate($value['created_at']);
                $patientPrescriptions[$key]['appointment_date']       = dateFormate($value['appointment_date']);
                $patientPrescriptions[$key]['appointment_time']      = timeFormate($value['appointment_time']);
                $patientPrescriptions[$key]['doctorName']         = $value['drFname'].' '.$value['drLname'];
                }

                

             $jsonArr['medicalReportsData'] = $medicalReportsData;
             $jsonArr['patientData'] = $patientData;
             $jsonArr['appointmentData'] = $appointmentData;
             $jsonArr['patientPrescriptions'] = $patientPrescriptions;
             $jsonArr['status'] = 'success';

        }
        return $jsonArr;
    }


    public function getdoctorData($appointment_id)
    {    
        
        $data = $jsonArr = [];
        $patientData =$appointmentData = array();
        $appointmentData  = $this->bookings-> select('booking.id as id','booking.status','booking.patient_id','booking.appointment_date','booking.appointment_time','booking.doctor_id','users.user_name as user_name')
                    ->Join('patient','booking.patient_id','=','patient.id')
                     ->Join('users','patient.user_id','=','users.id')
                    ->where('users.role_type',6)
        ->where('booking.id',$appointment_id)->first();
        if (isset($appointmentData) && $appointmentData != '')
        {   
            $doctorData = $this->userModel ->select('*','users.id as id','users.status as status'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration')
                            ->Join('doctor_information','users.id','=','doctor_information.user_id')
                            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
                            ->where('users.role_type',4)->where('doctor_information.id', $appointmentData->doctor_id)->first();
                            if(!empty($result->date_of_registration))
                            $result->date_of_registration = date("Y-m-d", strtotime($result->date_of_registration));
            $appointmentData->appointment_date = dateFormate($appointmentData['appointment_date']);
            $appointmentData->appointment_time = timeFormate($appointmentData['appointment_time']);

             $jsonArr['doctorData'] = $doctorData;
             $jsonArr['appointmentData'] = $appointmentData;
             $jsonArr['status'] = 'success';

        }
        return $jsonArr;
    }


    public function store($request)
    {
        $data = [];
        $authUser = Auth::user();
        $formData = json_decode($request->input('formData'));
        $first_name = isset($formData->first_name) ? $formData->first_name : '';
        $last_name = isset($formData->last_name) ? $formData->last_name : '';
        $email = isset($formData->email) ? $formData->email : '';
        $age = isset($formData->age) ? $formData->age : 0;
        $gender = isset($formData->gender) ? $formData->gender : '';
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
        $date_of_birth = isset($formData->date_of_birth) ? $formData->date_of_birth : date('Y-m-d');
        $medical_history = isset($formData->medical_history) ? $formData->medical_history : '';
        $symptoms = isset($formData->symptoms) ? $formData->symptoms : '';
        $status = isset($formData->status) ? $formData->status : '';
        $blood_group = isset($formData->blood_group) ? $formData->blood_group : '';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';
        $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson : '';
        $nickname = isset($formData->nickname) ? $formData->nickname : '';
        $w3w_address = isset($formData->w3w_address) ? $formData->w3w_address : '';
        $w3w_latitude = isset($formData->w3w_latitude) ? $formData->w3w_latitude : '';
        $w3w_longitude = isset($formData->w3w_longitude) ? $formData->w3w_longitude : '';


        $profile_photo = '';
        $status = isset($formData->status) ? $formData->status : '';
        $insertUserArr = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_name' => $authUser->user_name,
            'phone_number' => $phone_number,
            'gender' => $gender,
            'age' => (int)$age,
            'pass_word' => $pass_word,
            'password' => $password,
            'role_type' => 6,
            'parent_id' => $authUser->id,
            'email' => $email,
            'status'=>$status,
        );
           
        $userData = $this->userModel->create($insertUserArr);
        if (!empty($userData))
        {
            $user_id = $userData->id;
            $roles['user_id'] = $user_id;
            $roles['role_id'] = 6;
            DB::table('role_admin')->insert($roles);
            if (!empty($_FILES['profilefile']) && $_FILES['profilefile']['size'] > 0 && $request->file('profilefile'))
            {
                $profilefileData = $this->profilefile_upload($request, $user_id);
                $profile_photo = $profilefileData['file_name'];
            }

            $insertPatient = array(
                'user_id' => $user_id,
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
                'symptoms' => $symptoms,
                'medical_history' => $medical_history,
                'date_of_birth' => $date_of_birth,
                'blood_group'=>$blood_group,
                'what3words'=>$what3words,
                'what3wordsjson'=> json_encode($what3wordsjson),
                'long_org' => abs($longitude),
                'nickname'=>$nickname,
                'w3w_address' => $w3w_address,
                'w3w_latitude' => $w3w_latitude,
                'w3w_longitude' => $w3w_longitude
                //'status'=> 0,
            );


           // dd($insertPatient);
             
            $patientData = $this->patient->create($insertPatient);
             $this->userModel->where("id", $user_id) ->update(['profile_photo' => $profile_photo]);
          
            $data['status'] = 'success';
            $data['message'] = 'Patient successfully Insert';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Patient';
        }
        return $data;
    }

    public function update($id, $request)
    {
        $data = [];
        $authUser = Auth::user();
        $formData = json_decode($request->input('formData'));
        $patientResult = $this->userModel->select('*','patient.id as id','users.id as user_id')
                        ->Join('patient','users.id','=','patient.user_id')
                        ->where('patient.id', $id)->first();
        
        $first_name = isset($formData->first_name) ? $formData->first_name : '';
        $last_name = isset($formData->last_name) ? $formData->last_name : '';
        $phone_number = isset($formData->phone_number) ? $formData->phone_number : '';
        $email = isset($formData->email) ? $formData->email : '';
        $age = isset($formData->age) ? $formData->age : '';
        $gender = isset($formData->gender) ? $formData->gender : '';

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
        $w3w_address = isset($formData->w3w_address) ? $formData->w3w_address : '';
        $w3w_longitude = isset($formData->w3w_longitude) ? $formData->w3w_longitude : '';
        $w3w_latitude = isset($formData->w3w_latitude) ? $formData->w3w_latitude : '';

        $date_of_birth = isset($formData->date_of_birth) ? $formData->date_of_birth : '';
        $medical_history = isset($formData->medical_history) ? $formData->medical_history : '';
        $symptoms = isset($formData->symptoms) ? $formData->symptoms : '';
        $status = isset($formData->status) ? $formData->status : '';
        $blood_group = isset($formData->blood_group) ? $formData->blood_group : '';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';
        $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson : '';
        $nickname = isset($formData->nickname) ? $formData->nickname : '';
        

         if (!empty($_FILES['profilefile']) && $_FILES['profilefile']['size'] > 0 && $request->file('profilefile'))
        {
            $profilefileData = $this->profilefile_upload($request, $patientResult->user_id);
            $profile_photo = $profilefileData['file_name'];
        }else{
           $profile_photo = isset($patientResult->profile_photo) ? $patientResult->profile_photo : '';
        }

         $updateUserArr = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => $phone_number,
            'email' => $email,
            'gender' => $gender,
            'age' => $age,
            'profile_photo' => $profile_photo,
            'status'=>$status,
        );

        $userData = $this->userModel->where('id', $patientResult->user_id)->update($updateUserArr);
        $updatePatient = array(
            //'user_id'       => $id,
            'full_address'  => $full_address,
            'address'       => $address,
            'address2'      => $address2,
            'area'          => $area,
            'city'          => $city,
            'country'       => $country,
            'state'         => $state,
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'zip_code'      => $zip_code,
            'symptoms'      => $symptoms,
            'medical_history' => $medical_history,
            'date_of_birth' => $date_of_birth,
            'blood_group'=>$blood_group,
            'what3words'=>$what3words,
            'long_org' => abs($longitude),
            'what3wordsjson'=> json_encode($what3wordsjson),
            'nickname'=>$nickname,
            'w3w_address'=> $w3w_address,
            'w3w_latitude'=> $w3w_latitude,
            'w3w_longitude'=> $w3w_longitude
            
        );
        $patientData = $this->patient->where('id', $id)->update($updatePatient);

        if ($patientData)
        {
            $data['status'] = 'success';
            $data['message'] = 'Patient successfully Updated';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Patient';
        }
        return $data;
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
                    $profile_file = 'profile' . time() . '.' . $extension;
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
                    $profilefile->move($destinationPath, $profile_file);
                    $json_arr['file_name'] = $profile_file;
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


    public function medicalfile_upload($request, $user_id)
    {
                $formData = json_decode($request->input('formData'));
                $profilefile = $request->file('recommendationfile');
                $extension = $profilefile->getClientOriginalExtension();
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'pdf')
                {
                    $profile_file = 'medicalfile' . time() . '.' . $extension;
                    $destinationPath = public_path('uploads/patient/'.$user_id.'/medicalfile');
                    if (!file_exists($destinationPath) and !is_dir($destinationPath))
                    {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    $profilefile->move($destinationPath, $profile_file);
                    $json_arr['file_name'] = $profile_file;
                    return $json_arr;
                }
                else
                {
                    $json_arr['file_name'] = '';
                    return $json_arr;
                }
    }


    public function destroy($id, $request)
    {
        $patientData = $this->patient->where('id', $id)->first();
        if ($patientData)
        {   
            $this->userModel->where('id', $patientData->user_id)->delete();
            $this->patient->where('id', $id)->delete();
            $data['status'] = 'success';
            $data['message'] = 'Patient successfully Deleted';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while deleting Patient';
        }
        return $data;
    }

    public function suggestDoctor($id, $request)
    {

       // $user_id
        $patientData =  $this->patient->where('id', $id)->first();
        $user_id = $patientData->user_id;
        
        $data = [];
        $authUser           = Auth::user();
        $formData           = json_decode($request->input('formData'));
        $type_specialist    = isset($formData->type_specialist) ? $formData->type_specialist : '';
        $date_of_suggest    = isset($formData->date_of_suggest) ? $formData->date_of_suggest : '';
        $to_time            = isset($formData->to_time) ? $formData->to_time : '';
        $from_time          = isset($formData->from_time) ? $formData->from_time : '';
        $health_specialist  = isset($formData->health_specialist) ? $formData->health_specialist : '';
        $visit_type         = isset($formData->visit_type) ? $formData->visit_type : '';
        $reason             = isset($formData->reason) ? $formData->reason : '';
        $medical_history    = isset($formData->medical_history) ? $formData->medical_history : '';
        $patient_id        = isset($formData->patient_id) ? $formData->patient_id : 0;
        $description        = isset($formData->description) ? $formData->description : '';
        $medical_recommendation = isset($formData->medical_recommendation) ? $formData->medical_recommendation : 0;
        $medical_report_attachment ='';
         if (!empty($_FILES['recommendationfile']) && $_FILES['recommendationfile']['size'] > 0 && $request->file('recommendationfile'))
        {
            $medicalfileData = $this->medicalfile_upload($request, $user_id);
            $medical_report_attachment = $medicalfileData['file_name'];
        }



         $orgDate = $date_of_suggest;  
         $date = str_replace('/', '-', $orgDate); 
         $newDate = date("Y-m-d", strtotime($date));  

        $medical_history =  implode(",",$medical_history);
          $insertArr = array(
            'patient_id' => $patient_id,
            'user_id' => $user_id,
            'type_specialist' => $type_specialist,
            'date_of_suggest' => $newDate,
            'to_time' => $to_time,
            'from_time' => $from_time,
            'health_specialist' => $health_specialist,
            'visit_type' => $visit_type,
            'reason' => $reason,
            'medical_history'=>$medical_history,
            'medical_recommendation'=>$medical_recommendation,
            'description'=>$description,
            'medical_report_attachment'=>$medical_report_attachment,
        );

        $suggestData = $this->doctorSuggest->create($insertArr);
        if ($suggestData)
        {
            $data['status'] = 'success';
            $data['message'] = 'Suggest successfully Insert';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Suggest';
        }
        return $data;
    }
   
     public function searchDoctor($request)
    {    
        $statusArray = array("Pending", "Rejected", "Approved");
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
        $doctor_suggest_id = $request->get('doctor_suggest_id');
        $patient_id = $request->get('patient_id');
        $typeSpecialist = (int)$request->get('type_specialist');
        $distance = isset($request->distance) ? $request->distance :50; 
        $radius = 400;
        $suggestData        = $this->doctorSuggest->where('id',$doctor_suggest_id)->first();
       
         if(!empty($typeSpecialist)) 
            $type_specialist    =  $typeSpecialist ;

         else $type_specialist    =  $suggestData['type_specialist'];
 //dd($type_specialist); exit;
         // if($typeSpecialist == 0)
         // {
         //    $type_specialist    =  0 ;

         // }
        $patientData        = $this->patient->where('id',$suggestData->patient_id)->first();
        $result = $this->userModel 
            ->select('doctor_information.id as id','users.status as status'
            ,'users.profile_photo','users.first_name','users.last_name','doctor_information.type','doctor_information.fees_amount','users.id as user_id','doctor_address.latitude','doctor_address.longitude',
                 DB::raw("6371 * acos(cos(radians(" . $patientData->latitude . ")) * cos(radians(doctor_address.latitude)) * cos(radians(doctor_address.long_org) - radians(" . $patientData->long_org . ")) + sin(radians(" .$patientData->latitude. ")) * sin(radians(doctor_address.latitude))) AS distance"))
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',4);

        if ($request->get('keyword'))
        {   
            $result =  $result->whereRaw("(users.first_name LIKE '%".$keyword."%' OR users.last_name LIKE '%".$keyword."%' OR users.user_name LIKE '%".$keyword."%' OR users.email LIKE '%".$keyword."%' OR users.phone_number LIKE '%".$keyword."%' )");
        }
        if (!empty($type_specialist))
        {   
            $result =  $result->where('doctor_information.type',$type_specialist);
        }

        $result = $result
                ->having('distance', '<', $distance)
                ->orderBy("distance",'ASC')->offset(0)->limit(20)->paginate($this->per_page);
       
        if (isset($result) && !empty($result))
        {
            $data = $result->ToArray();
            if (isset($data) && !empty($data))
            {
                foreach ($data['data'] as $key => $value)
                {  
                   $distancekm =   distance($patientData->latitude, $patientData->longitude,$value['latitude'], $value['longitude'], "K");
                   $data['data'][$key]['distance']  = round($distancekm, 2); 

                    $drtype = $this->typesMaster->where('id',$value['type'])->first();
                    if(!empty($drtype))
                    $data['data'][$key]['type_name'] = $drtype->type_name;
                    else
                     $data['data'][$key]['type_name'] = '';
                     $data['data'][$key]['status'] =$statusArray[$value['status']];

                    $getDoctorID = $this->FavoriteDoctorModel
                                    ->where('patient_id',$patient_id)
                                    ->where('doctor_id',$value['id'])->value('doctor_id');

                    //dd($getDoctorID,$value['id']);
                    if(!empty($getDoctorID)){
                        $data['data'][$key]['isFavoriteDoctor'] = 1;
                    }else{
                        $data['data'][$key]['isFavoriteDoctor'] = 0;
                    }
                    //  $data['data'][$key]['isFavoriteDoctor'] = $this->FavoriteDoctorModel
                    //  ->where('patient_id',$patient_id)->value('doctor_id');
                }
            }

            $jsonArr['doctor'] = $data;
            $jsonArr['type_specialist'] = $type_specialist;
            return $data;
        }
    }

    public function getPatientsList($request)
    {   
        $authUser = Auth::user();
        $patientData = $masterType = array();
        $keyword = $request->get('keyword');
        $patientData = $this->userModel ->select('*','users.id as id','users.status','patient.id as patient_id')
            ->Join('patient','users.id','=','patient.user_id')
            ->where('users.role_type',6);
       
        if($authUser->parent_id == 0){
          $patientData =  $patientData->where('users.parent_id',$authUser->id);
          $patientData =  $patientData->orWhere('users.id', $authUser->id);
        }

         if($authUser->parent_id != 0){
          $patientData =  $patientData->where('users.parent_id',$authUser->parent_id);
          $patientData =  $patientData->orWhere('users.id', $authUser->parent_id);
        }

        // if($authUser->role_type == 6)
        // {
        //     $patientData = $patientData->where('users.user_name',$authUser->user_name);
        //                      //->where('users.id', '!=' , $authUser->id);
        // } 
        if ($request->get('keyword'))
        {   
            $patientData =  $patientData->whereRaw("(users.first_name LIKE '%".$keyword."%' OR users.last_name LIKE '%".$keyword."%' OR users.user_name LIKE '%".$keyword."%' OR users.email LIKE '%".$keyword."%' OR users.phone_number LIKE '%".$keyword."%' )");
        }
        $patientData = $patientData->orderBy('users.id', 'DESC')->get();//->paginate($this->per_page);

        if (isset($patientData) && !empty($patientData))
        {
            if (isset($patientData) && !empty($patientData))
            {
                foreach ($patientData as $key => $value)
                {   
                     //$data['data'][$key]['status'] =$statusArray[$value['status']];
                }
            }
           
        }

        $masterType = $this->typesMaster->where('isdeleted',0)->where('isactive',1)->get();
        $jsonArr['patient'] = $patientData;
        $jsonArr['masterType'] = $masterType;
        return $jsonArr;
    }


    public function bookingRequest($request)
    {

        $data = [];
        $authUser           = Auth::user();
        $formData           = json_decode($request->input('formData'));
        $patientData        = $this->patient->where('id', $formData->patient_id)->first();
        $user_id            = $patientData->user_id;

        $type_specialist    = isset($formData->type_specialist) ? $formData->type_specialist : '';
        $date_of_suggest    = isset($formData->date_of_suggest) ? $formData->date_of_suggest : '0000-00-00';
        $to_time            = !empty($formData->to_time) ? $formData->to_time: '00:00:00';

        $from_time          = isset($formData->from_time) ? $formData->from_time : '00:00:00';
        $health_specialist  = isset($formData->health_specialist) ? $formData->health_specialist : '';
        $visit_type         = isset($formData->visit_type) ? $formData->visit_type : '';
        $reason             = isset($formData->reason) ? $formData->reason : '';
        $medical_history    = isset($formData->medical_history) ? $formData->medical_history : '';
        $patient_id         = isset($formData->patient_id) ? $formData->patient_id : 0;
        $description        = isset($formData->description) ? $formData->description : '';
        $booking_type       = isset($formData->booking_type) ? $formData->booking_type : '';


        $medical_recommendation = isset($formData->medical_recommendation) ? $formData->medical_recommendation : 0;
        $medical_report_attachment ='';
         if (!empty($_FILES['recommendationfile']) && $_FILES['recommendationfile']['size'] > 0 && $request->file('recommendationfile'))
        {
            $medicalfileData = $this->medicalfile_upload($request, $user_id);
            $medical_report_attachment = $medicalfileData['file_name'];
        }

         $orgDate = $date_of_suggest;  
         $date = str_replace('/', '-', $orgDate); 
         $newDate = date("Y-m-d", strtotime($date));  

        $medical_history =  implode(",",$medical_history);
          $insertArr = array(
            'patient_id' => $patient_id,
            'user_id' => $user_id,
            'type_specialist' => $type_specialist,
            //'date_of_suggest' => $newDate,
            'to_time' => $to_time,
            'from_time' => $from_time,
            'health_specialist' => $health_specialist,
            'visit_type' => $visit_type,
            'reason' => $reason,
            'medical_history'=>$medical_history,
            'medical_recommendation'=>$medical_recommendation,
            'description'=>$description,
            'medical_report_attachment'=>$medical_report_attachment,
            'booking_type'=>$booking_type,
        );
        $suggestData = $this->doctorSuggest->create($insertArr);
        if ($suggestData)
        {   
            $data['status'] = 'success';
            $data['id'] = $suggestData->id;
            $data['message'] = 'Suggest successfully Insert';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while updating Suggest';
        }
        return $data;
    }

    public function getFavoriteDoctorList($request)
    {
        // $keyword =  $request->get('keyword');
        $authUser = Auth::user();
        $patientData = $this->patient->where('user_id',$authUser['id'])->first();
        // dd($patientData);
        $result = $this->FavoriteDoctorModel->select('favorite_doctor.id','favorite_doctor.doctor_id','favorite_doctor.patient_id','favorite_doctor.user_id','doctor_information.id as doctor_id','doctor_information.fees_amount','doctor_information.type','users.first_name','users.last_name','doctor_address.id as doctor_addr_id','doctor_address.latitude','doctor_address.longitude',
                //  DB::raw("6371 * acos(cos(radians(" . $patientData->latitude . ")) * cos(radians(doctor_address.latitude)) * cos(radians(doctor_address.long_org) - radians(" . $patientData->long_org . ")) + sin(radians(" .$patientData->latitude. ")) * sin(radians(doctor_address.latitude))) AS distance")
                 )
            ->Join('doctor_information','doctor_information.id','=','favorite_doctor.doctor_id')
            ->leftJoin('doctor_address','doctor_address.doctor_information_id','=','favorite_doctor.doctor_id')
            ->leftJoin('users','users.id','=','doctor_information.user_id')
            ->where('favorite_doctor.user_id', $authUser['id']);

            // $result = $this->userModel 
            // ->select('doctor_information.id as id','users.status as status'
            // ,'users.profile_photo','users.first_name','users.last_name','doctor_information.type','doctor_information.fees_amount','users.id as user_id','doctor_address.latitude','doctor_address.longitude',
            //      DB::raw("6371 * acos(cos(radians(" . $patientData->latitude . ")) * cos(radians(doctor_address.latitude)) * cos(radians(doctor_address.long_org) - radians(" . $patientData->long_org . ")) + sin(radians(" .$patientData->latitude. ")) * sin(radians(doctor_address.latitude))) AS distance"))
            // ->Join('doctor_information','users.id','=','doctor_information.user_id')
            // ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            // ->where('users.role_type',4);

        // if ($request->get('keyword')) {
        //      $result =  $result->whereRaw("(service_name LIKE '%".$keyword."%')");
        // }

        $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);
        if (isset($result) && !empty($result)) {
            $data = $result->ToArray();
            if (isset($data) && !empty($data)) {
                foreach ($data['data'] as $key => $value) {
                    $drtype = $this->typesMaster->where('id',$value['type'])->first();
                    if(!empty($drtype)){
                        $data['data'][$key]['type_name'] = $drtype->type_name;
                    }else{
                        $data['data'][$key]['type_name'] = '';
                    }
                    $data['data'][$key]['patientArr'] = $this->patient->select('patient.id','patient.user_id','users.first_name', 'users.last_name')->where('patient.id',$value['patient_id'])
                    ->leftJoin('users','users.id','=','patient.user_id')
                    ->first();
                }
            }
            return  $data;
        }
    }

    public function favoriteStatusChange($request)
    {
        // dd($request->id, $request->action);
        $doctor_id  = $request->doctor_id;
        $user_id    = $request->user_id;
        $patient_id = $request->patient_id;
        $action     = $request->action;
        $authUser = Auth::user();

        if($action == 'Add'){
            $favoriteData = $this->FavoriteDoctorModel->insert(['doctor_id'=>$doctor_id, 'patient_id'=>$patient_id,'user_id'=>$authUser->id]);

            if($favoriteData){   
                $data['status'] = 'success';
                $data['message'] = 'Doctor successfully Added to favorite';
            }else{
                $data['status'] = 'error';
                $data['message'] = 'error occured while deleting Patient';
            }
        }else{
            $favoriteData = $this->FavoriteDoctorModel
                    ->where('patient_id', $patient_id)->where('doctor_id', $doctor_id)->delete();
            if($favoriteData){   
                $data['status'] = 'success';
                $data['message'] = 'Doctor successfully removed from favorite';
            }else{
                $data['status'] = 'error';
                $data['message'] = 'error occured while deleting Patient';
            }
        }
        return $data;
    }

    public function getFavDoctorData($id)
    {            
        $data = $jsonArr = [];
        if (isset($id) && $id != ''){   
            $result = $this->DoctorInformationModel ->select('*')->where('id', $id)->first();
            $jsonArr = $result;
            $json_arr['status'] = 'success';

        }
        return $jsonArr;
    }



    

}


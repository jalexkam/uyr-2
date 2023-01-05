<?php
namespace App\Repositories\Mediator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorInformationModel;
use App\Models\DoctorAddressModel;
use App\Models\User as UserModel;
use App\Models\EquipmentsMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use File;
use Config;
use Mail;
class MediatorDoctorsRepositories
{

    public function __construct(UserModel $user, DoctorInformationModel $doctorInformationModel, DoctorAddressModel $doctorAddress,EquipmentsMaster $equipments_master)
    {
        $this->userModel = $user;
        $this->per_page = 9;
        $this->doctorInformationModel = $doctorInformationModel;
        $this->doctorAddress = $doctorAddress;
        $this->EquipmentsMasterModel = $equipments_master;
    }
    public function index($request)
    {   
        $authUser = Auth::user();
        $keyword = $request->get('keyword');
            $result = $this->userModel ->select('users.id as id','users.status as userStatus'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','doctor_information.status','users.email')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',5);

        if($authUser->role_type == 3)
        {
            $result = $result->where('users.parent_id',$authUser->id);
        } 

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
                    $data['data'][$key]['date_of_registration'] = dateFormate($value['date_of_registration']);
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
            $result = $this->userModel ->select('*','users.id as id','users.status as userStatus'
            ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration')
            ->Join('doctor_information','users.id','=','doctor_information.user_id')
            ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
            ->where('users.role_type',5)->where('users.id', $id)->first();

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
            $json_arr['status'] = 'success';

        }
        return $jsonArr;
    }

    public function getDoctorProfile($id)
    {
        $data = $jsonArr = [];
        if (isset($id) && $id != '')
        {
             $result = $this->userModel ->select('*','users.id as id','users.status as status'
                ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration')
                ->Join('doctor_information','users.id','=','doctor_information.user_id')
                ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
                ->where('users.role_type',5)->where('users.id', $id)->first();

                $result->date_of_registration = date("Y-m-d", strtotime($result->date_of_registration)); 
            $jsonArr = $result;
            $json_arr['status'] = 'success';

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
            $data['message'] = 'Doctor successfully Mediator';
        }
        else
        {
            $data['status'] = 'error';
            $data['message'] = 'error occured while deleting Mediator';
        }
        return $data;
    }

    public function store($request)
    {

        $data = [];
        $role_type = 5;
        $authUser = Auth::user();
        $formData = json_decode($request->input('formData'));
        $first_name     = isset($formData->first_name) ? $formData->first_name : '';
        $last_name      = isset($formData->last_name) ? $formData->last_name : '';
        $user_name      = isset($formData->user_name) ? $formData->user_name : '';
        $email          = isset($formData->email) ? $formData->email : '';
        $age            = isset($formData->age) ? $formData->age : '';
        $gender         = isset($formData->gender) ? $formData->gender : '';
        $brief_summary = isset($formData->brief_summary) ? $formData->brief_summary : '';
        $terms_and_conditions = isset($formData->terms_and_conditions) ? $formData->terms_and_conditions : '';
        $current_clinic_hospital = isset($formData->current_clinic_hospital) ? $formData->current_clinic_hospital : '';
        $medical_license_number = isset($formData->medical_license_number) ? $formData->medical_license_number : '';
        $registration_no = isset($formData->registration_no) ? $formData->registration_no : '';
        $experience     = isset($formData->experience) ? $formData->experience : '';
        $pass_word      = isset($formData->password) ? $formData->password : '';
        $password       = Hash::make($formData->password);
        $address        = isset($formData->address) ? $formData->address : '';
        $address2       = isset($formData->address2) ? $formData->address2 : '';
        $area           = isset($formData->area) ? $formData->area : '';
        $city           = isset($formData->city) ? $formData->city : '';
        $country        = isset($formData->country) ? $formData->country : '';
        $state          = isset($formData->state) ? $formData->state : '';
        $zip_code       = isset($formData->zip_code) ? $formData->zip_code : '';
        $full_address   = isset($formData->full_address) ? $formData->full_address : '';
        $latitude       = isset($formData->latitude) ? $formData->latitude : '';
        $longitude      = isset($formData->longitude) ? $formData->longitude : '';
        $phone_number   = isset($formData->phone_number) ? $formData->phone_number : '';
        $type           = !empty($formData->type) ? $formData->type : 0;
        $dr_type        = isset($formData->dr_type) ? $formData->dr_type : 1;
        $availability_time_from = isset($formData->availability_time_from) ? $formData->availability_time_from : '';
        $date_of_registration = isset($formData->date_of_registration) ? $formData->date_of_registration : '';
        $equipment      = isset($formData->equipment) ? $formData->equipment : '';
         $willing_to_serve_as = isset($formData->willing_to_serve_as) ? $formData->willing_to_serve_as : '';
       
        $status         = isset($formData->status) ? $formData->status : 0;
         $certificate_awarding_university = $speciality_diploma = $copy_of_registration = $profile_photo = '';
         $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson :'';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';
        $insertUserArr = array(
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'user_name'     => $user_name,
            'phone_number'  => $phone_number,
            'gender'        => $gender,
            'age'           => $age,
            'pass_word'     => $pass_word,
            'password'      => $password,
            'role_type'     => $role_type,
            'parent_id'     => $authUser->id,
            'email'         => $email,
            'status' => $status,
        );
        // dd($insertUserArr);
        $userData = $this->userModel->create($insertUserArr);
        if (!empty($userData))
        {   
            if(env('SEND_EMAIL') == true){
                $this->sendRegistorEmail($userData);
                }

            $user_id = $userData->id;
            $roles['user_id'] = $user_id;
            $roles['role_id'] = $role_type;
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
                'equipment'=>$equipment,
                'dr_type'=>$dr_type,
                'type'=>$type,
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
                    'zip_code' => $zip_code,
                    'doctor_information_id' => $doctorInformationData->id,
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


    public function updateMediator($id, $request){

        $data = [];
         $drResult = $this->userModel ->select('*','users.id as id','users.status as status'
                ,'users.profile_photo','users.first_name','users.last_name','users.last_name','users.last_name','doctor_information.type','doctor_information.date_of_registration','doctor_information.id as doctor_information_id')
                ->Join('doctor_information','users.id','=','doctor_information.user_id')
                ->leftJoin('doctor_address','doctor_information.id','=','doctor_address.doctor_information_id')
                ->where('users.role_type',5)->where('users.id', $id)->first();

       $user_id =  $id; 
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
        $equipment = isset($formData->equipment) ? $formData->equipment : '';
        $dr_type = isset($formData->dr_type) ? $formData->dr_type : 1;
        $type = isset($formData->type) ? $formData->type : '';
        $date_of_registration = isset($formData->date_of_registration) ? $formData->date_of_registration : '';
        $willing_to_serve_as = isset($formData->willing_to_serve_as) ? $formData->willing_to_serve_as : '';
        $status = isset($formData->status) ? $formData->status : 0;
        $certificate_awarding_university = $speciality_diploma = $copy_of_registration = $profile_photo = '';
        $certificate_awarding_university = isset($drResult->certificate_awarding_university) ? $drResult->certificate_awarding_university : '';
        $speciality_diploma     = isset($drResult->speciality_diploma) ? $drResult->speciality_diploma : '';
        $copy_of_registration   = isset($drResult->copy_of_registration) ? $drResult->copy_of_registration : '';
        $profile_photo          = isset($drResult->profile_photo) ? $drResult->profile_photo : '';

        $what3wordsjson = isset($formData->what3wordsjson) ? $formData->what3wordsjson :'';
        $what3words = isset($formData->what3words) ? $formData->what3words : '';
        
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
                'availability_time_from'=>$availability_time_from,
                'equipment'=>$equipment,
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
                    'what3words'=>$what3words,
                    'what3wordsjson'=> json_encode($what3wordsjson),
                );
             
             if(!empty($doctorAddressExitsData)) {
                $DoctorAddressData = $this->doctorAddress->where('doctor_information_id', $doctor_information_id)->update($updateDoctorAddressArr);
             }else{
                 $DoctorAddressData = $this->doctorAddress->create($updateDoctorAddressArr);
                 
             }
                
                $data['status'] = 'success';
                $data['message'] = 'Mediator Update successfully';
            }else{
                 $data['status'] = 'error';
                 $data['message'] = 'error occured while updating Mediator';
            }
            return $data;
    }
    public function change_account_status($id, $request)
    {   
        $data = [];
        $formData = $request->all();
        $status_id = $request->get('status_id');
        $updateArr['status'] = isset($formData['status_id']) ? $formData['status_id'] : '';
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
                     $subject = "UYR-Doctor- New Mediator Doctors Registered";
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


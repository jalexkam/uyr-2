<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Career;
use App\Models\User as UserModel;
use App\Models\DoctorInformationModel;
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
class CareersController extends Controller
{    
    public function __construct(Career $career, UserModel $user, DoctorInformationModel $doctorInformationModel){
         $this->career = $career;
         $this->per_page       =   per_page();
         $this->UserModel = $user;
         $this->doctorInformation = $doctorInformationModel;
    }

    public function index(Request $request)
    {  
        $json_arr = [];
        $keyword = $request->get('keyword');
        $result = $this->career->select('*');
        if ($keyword)
        {   
            $result =  $result->whereRaw("(firstName LIKE '%".$keyword."%' OR lastName LIKE '%".$keyword."%' )");
        }
        $result = $result->where('isdeleted',0)->orderBy('id', 'DESC')->paginate($this->per_page);
            if (isset($result) && !empty($result)) {
                $data = $result->ToArray();
                if (isset($data) && !empty($data)) {
                    foreach ($data['data'] as $key => $value) {
                        if(!empty($value['resume'])){
                            $data['data'][$key]['resume'] =  $value['resume'];
                        }else
                        {
                            $data['data'][$key]['resume'] = '';
                        }
                        
                        $data['data'][$key]['created_at'] =  date("Y-m-d", strtotime($value['created_at']));
                    
                    }
                }
                return  $data;
            }
       
        return response()->json($data);
    }

  
    public function show($id)
    {  
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->career->where('id', $id)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']              = $data['id'];
                $jsonArr['firstName']       = $data['firstName'];
                $jsonArr['lastName']        = $data['lastName'];
                $jsonArr['email']           = $data['email'];
                $jsonArr['phone']           = $data['phone'];
                $jsonArr['address']         = $data['address'];
                $jsonArr['gender']          = $data['gender'];
                $jsonArr['resume']          = $data['resume'];
            }
        }
        
        return response()->json($json_arr);
    }
    
     public function destroy($id,Request $request)
    { 
        $result = $this->career->where('id', $id)->update(['isdeleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Careers successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Careers';
        }
        return response()->json($data);
    }

    public function updateStatus($id,Request $request)
    {  
        $careerData = $this->career->where('id', $id)->first();
        if(!empty($careerData)){
            $status = $request->status; 
            if($status == 1){
                $first_name = isset($careerData->firstName) ? $careerData->firstName : '';
                $last_name = isset($careerData->lastName) ? $careerData->lastName : '';
                $email = isset($careerData->email) ? $careerData->email : '';
                $phone_number = isset($careerData->phone) ? $careerData->phone : '';
               //$longitude = isset($careerData->message) ? $careerData->message : '';
                $age = isset($careerData->age) ? $careerData->age : '';
                if($careerData->gender == 'Male') $gender = 0;
                else $gender = 1;
                $gender = $gender;
    
                $insertArr['last_name']        = $last_name;
                $insertArr['first_name']       = $first_name;
                $insertArr['user_name']        = '';
                $insertArr['email']            = $email;
                $insertArr['password']         = Hash::make($careerData->email);
                $insertArr['age']              = $age;
                $insertArr['role_type']        = 4;
                $insertArr['phone_number']     = $phone_number;
                $insertArr['pass_word']        = isset($careerData->email)?$careerData->email:'';
                $result = $this->UserModel->create($insertArr);
                //$id = $result->id;
    
                if ($result) {
                    $insertDoctorInformationArr = array( 'user_id' => $result->id);
                    $doctorInformationData = $this->doctorInformation->create($insertDoctorInformationArr);
                    $roles['user_id'] =$result->id;
                    $roles['role_id'] =4;
                    DB::table('role_admin')->insert($roles);
                    $this->career->where('id', $id)->update(['status'=>$status]);
                    $data['status']   = 'success';
                    $data['message']  = 'Recored successfully update';
    
                }
               else {
                    $data['status']   = 'error';
                    $data['message']  = 'error occured while deleting Careers';
                }    

            }else{
                    $this->career->where('id', $id)->update(['status'=>$status]);
                    $data['status']   = 'success';
                    $data['message']  = 'Recored successfully update';
            }
           
            return response()->json($data);
        }


       
    }

    
    
}

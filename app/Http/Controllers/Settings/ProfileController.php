<?php
namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorInformationModel;
use App\Models\UserBankDetails;
use App\Models\DoctorBookingTimeslot;
use DB;
use Image;
use Storage;
use JWTAuth;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function __construct(
       
    ) {
       
    }
   
   public function get_user(Request $request){   
    $user =  [];
     //$user = Auth::user();
    $users = $request->user();
    $user = User::select('*', 'users.id AS id', 'roles.id AS roleid')
           ->join('roles', 'users.role_type', '=', 'roles.id')
           ->where('users.id', '=', $users->id)->first();
     // dd($user);

    if( $user->role_type == 5 || $user->role_type == 6){
        $user['doctor']  = DoctorInformationModel::where('user_id', '=', $user->id)->first();
    }else{
     $user['doctor']  = [];   
    } 
   
    $user['role']  = $users->role;
     return $user;
    }

     public function save_profile(Request $request)
    {
        $message = $title = "";
        $message = "Account Settings updated successfully";
        $title = "account settings";
        $user = Auth::user();
        $arr_rules = [];
        $arr_rules["email"] = "required|unique:users,email," . $user->id;
        $arr_rules["first_name"] = "required";
        $arr_rules["last_name"] = "required";
        $arr_rules["phone_number"] = "required";
        $arr_rules["user_name"] = "required|unique:users,user_name," . $user->id;

        $customMessages = ["email.string" => "Please add correct Email address",
                           "first_name.string" => "Please Insert First name",
                           "last_name.string" => "Please Insert Last name",
                           "phone_number.string" => "Please Insert phone number ",
                           "user_name.string" => "Please Insert Username name",
         ];

        $this->validate($request, $arr_rules, $customMessages);
        $userData['email'] = isset($request->email) ? $request->email : '';
        $userData['first_name'] = isset($request->first_name) ? $request->first_name : '';
        $userData['last_name'] = isset($request->last_name) ? $request->last_name : '';
        $userData['phone_number'] = isset($request->phone_number) ? $request->phone_number : '';
        $userData['user_name'] = isset($request->user_name) ? $request->user_name : '';
         User::where("id", $user->id)->update($userData);
        //End
        $json_arr["status"] = "success";
        $json_arr["message"] = "Account Settings updated successfully";
        $json_arr["title"] = $title;
        $json_arr["updated_request"] = $request->all();
        return response()->json($json_arr);
    }

    public function save_profile_photo(Request $request)
    {
          if (!empty($_FILES['profilefile']) && $_FILES['profilefile']['size'] > 0 && $request->file('profilefile'))
            {   

            $authUser = Auth::user();
            $user_id = $authUser->id;
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

                if(!empty($authUser->profile_photo))
                {   
                     $destinationExitPath = public_path('uploads/profile/' . $user_id.'/'.$authUser->profile_photo);
                    if (file_exists($destinationExitPath)) 
                        unlink($destinationExitPath);
                }
                $profilefile->move($destinationPath, $profile_file);
                    $json_arr['file_name'] = $profile_file;
                 $userData['profile_photo'] = $profile_file;
                 User::where("id", $authUser->id)->update($userData);
                 $json_arr["status"] = "success";
                $json_arr["message"] = "Profile Photo updated successfully";
                $json_arr["title"] = "Profile";
                return response()->json($json_arr);
            }
                
            }

    }

    public function getBankDetails(Request $request)
    {
        $data = $jsonArr =  [];
        $authUser = Auth::user();
        $data = UserBankDetails::select('id', 'user_id', 'bankName', 'accountNo', 'accountHolderName', 'ifscCode')->where('user_id',$authUser['id'])->first();

        if (isset($data) && !empty($data)) {
            $jsonArr['id']                  = $data['id'];
            $jsonArr['user_id']             = $authUser['id'];
            $jsonArr['bankName']            = $data['bankName'];
            $jsonArr['accountNo']           = $data['accountNo'];
            $jsonArr['accountHolderName']   = $data['accountHolderName'];
            $jsonArr['ifscCode']            = $data['ifscCode'];
        }else{
            $jsonArr['id']                  = '';
            $jsonArr['user_id']             = $authUser['id'];
            $jsonArr['bankName']            = '';
            $jsonArr['accountNo']           = '';
            $jsonArr['accountHolderName']   = '';
            $jsonArr['ifscCode']            = '';
        }
        return $jsonArr;
    }

    public function addBankDetails(Request $request, $id)
    {
        $json_arr = [];
        $formData = $request->All();
        
        $user_id            = isset($formData['user_id']) ? $formData['user_id'] : '';
        $bankName           = isset($formData['bankName']) ? $formData['bankName'] : '';
        $accountNo          = isset($formData['accountNo']) ? $formData['accountNo'] : '';
        $accountHolderName  = isset($formData['accountHolderName']) ? $formData['accountHolderName'] : '';
        $ifscCode           = isset($formData['ifscCode']) ? $formData['ifscCode'] : '';        

        $updateArr = [         
            'user_id'           => $user_id,
            'bankName'          => $bankName,
            'accountNo'         => $accountNo,
            'accountHolderName' => $accountHolderName,
            'ifscCode'          => $ifscCode,            
        ];
   
        $checkData = UserBankDetails::select('id', 'user_id')->where('user_id',$user_id)->first();

        if($checkData){
            $result = UserBankDetails::where('user_id',$user_id)->update($updateArr);
        }else{
            $result = UserBankDetails::create($updateArr);
        }

        if (!empty($result)) {
            $data['status'] = 'success';
            $data['message'] = 'Bank Details Updated Successfully!';
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Something went wrong! Please try again.';
        }

        return response()->json($data);
    }    

    public function getAppointmentSlot(Request $request)
    {
        $data = $jsonArr =  [];
        $authUser = Auth::user();
        $getData = DoctorBookingTimeslot::select('id', 'user_id', 'day', 'fromTime', 'toTime')->where('user_id',$authUser['id'])->get();

        if (isset($getData) && !empty($getData)) {
            foreach ($getData as $key => $value){
                if (isset($value) && !empty($value)) {
                    $data[$key]['id']        = $value['id'];
                    $data[$key]['user_id']   = $authUser['id'];

                    $data[$key][$value['day']]['startTime'] = $value['fromTime'];
                    $data[$key][$value['day']]['endTime']   = $value['toTime'];

                    // $data[$key]['startTime'] = $value['fromTime'];
                    // $data[$key]['endTime']   = $value['toTime'];
                }else{
                    $data[$key]['id']        = '';
                    $data[$key]['user_id']   = $authUser['id'];
                    
                    $data[$key][$value['day']]['startTime'] = '';
                    $data[$key][$value['day']]['endTime']   = '';
                    // $jsonArr['slotArray'][$key]['day']       = '';
                    // $jsonArr['slotArray'][$key]['startTime'] = '';
                    // $jsonArr['slotArray'][$key]['endTime']   = '';
                }
            }
        }
                
        $jsonArr['slotArray'] = $data;

        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        } 

        $jsonArr['weekArray'] =$days;

        return response()->json($jsonArr);
    }

    
    public function submitTimeSlotForm(Request $request)
    {
        $authUser = Auth::user();
        $formData = $request->All();
        // dd($formData);
        $id            = isset($formData['id']) ? $formData['id'] : '';
        $user_id       = isset($formData['user_id']) ? $formData['user_id'] : '';

        $daysArray['Sunday']      = isset($formData['Sunday']) ? $formData['Sunday'] : '';
        $daysArray['Monday']      = isset($formData['Monday']) ? $formData['Monday'] : '';
        $daysArray['Tuesday']     = isset($formData['Tuesday']) ? $formData['Tuesday'] : '';
        $daysArray['Wednesday']   = isset($formData['Wednesday']) ? $formData['Wednesday'] : '';
        $daysArray['Thursday']    = isset($formData['Thursday']) ? $formData['Thursday'] : '';
        $daysArray['Friday']      = isset($formData['Friday']) ? $formData['Friday'] : '';
        $daysArray['Saturday']    = isset($formData['Saturday']) ? $formData['Saturday'] : '';
        
        if(!empty($daysArray)){
            foreach ($daysArray as $key => $value){
                $checkData = DoctorBookingTimeslot::select('id','day')->where('user_id',$authUser['id'])->where('day',$key)->first();

                if($checkData){
                    $updateArr = [         
                        // 'day'       => $key,
                        'fromTime'  => !empty($value['startTime']) ? $value['startTime'] : '00:00',
                        'toTime'    => !empty($value['endTime']) ? $value['endTime'] : '00:00',
                    ];
                // dd($updateArr);
                    $result = DoctorBookingTimeslot::where('day',$key)->where('user_id',$authUser['id'])->update($updateArr);
                }else{
                    $inserArr = [         
                        'user_id'   => $authUser['id'],
                        'day'       => $key,
                        'fromTime'  => !empty($value['startTime']) ? $value['startTime'] : '00:00',
                        'toTime'    => !empty($value['endTime']) ? $value['endTime'] : '00:00',
                    ];
                    // dd($inserArr);
                    $result = DoctorBookingTimeslot::create($inserArr);
                } 
            } 
            // $updateArr = [         
            //     'day'       => $day,
            //     'fromTime'  => $fromTime,
            //     'toTime'    => $toTime,
            // ];
            // $result = DoctorBookingTimeslot::create($updateArr);
        }

        if (!empty($result)) {
            $data['status'] = 'success';
            $data['message'] = 'Time Slot Updated Successfully!';
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Something went wrong! Please try again.';
        }

        return response()->json($data);
    }
    
    
}

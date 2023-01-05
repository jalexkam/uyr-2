<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Users\StoreUserRequest;
use App\Models\User;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use Config;
use Mail;
use DateTime;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Auth\JsonResponse;
use App\Models\DoctorInformationModel;
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserModel $user,DoctorInformationModel $doctorInformation)
    {
        $this->UserModel        =  $user;
        $this->doctorInformation     = $doctorInformation;
        $this->middleware('guest');
    }

    public function register(StoreUserRequest $request)
    {
        $data = [];
        $errormsg  =  $successmsg = $title ='';
        $formData  = $request->all();
        $successmsg   =  'User added successfully';
        $errormsg     =  'error occured while updating User' ;
        $insertArr['last_name']        = isset($formData['last_name'])?ucwords($formData['last_name']):'';
        $insertArr['first_name']       = isset($formData['first_name'])?$formData['first_name']:'';
        $insertArr['user_name']       = isset($formData['user_name'])?$formData['user_name']:'';
        $insertArr['email']            = isset($formData['email'])?$formData['email']:'';
        $insertArr['password']         = Hash::make($formData['password']);
        $insertArr['role_type']          = 6;
        $insertArr['phone_number']      = isset($formData['phone_number'])?$formData['phone_number']:'';
        $insertArr['pass_word']        = isset($formData['password'])?$formData['password']:'';
        
       
        $result = $this->UserModel->create($insertArr);
        $id = $result->id;
        
        if(env('SEND_EMAIL') == true){
            $validateOtpMail = $this->sendVerifyAccountEmail($result);
            $this->sendNewUserRegistrationEmail($result);
            if($validateOtpMail){
            $data['userID']     = $id;
            $data['otpToken']   = $validateOtpMail['otpToken'];
            $data['isOtpSent']  = true;
            // $data['template_data']  = $validateOtpMail['template_data'];//temporary used
            }
        }
       


      
        if ($result) {   
            $roles['user_id'] =$id;
            $roles['role_id'] =6;
            DB::table('role_admin')->insert($roles);
            $data['status']   = 'success';
            $data['message']  = $successmsg;            
        } else {
            $data['status']   = 'error';
            $data['message']  = $errormsg ;
        }
        return response()->json($data);
    }

    public function registerDoctor(StoreUserRequest $request)
    {
        $data = [];
        $errormsg  =  $successmsg = $title ='';
        $formData  = $request->all();
        $role_type = 4 ;
        $successmsg   =  'Doctor added successfully';
        $errormsg     =  'error occured while updating Doctor' ;

        $last_name        = isset($formData['last_name'])?ucwords($formData['last_name']):'';
        $first_name       = isset($formData['first_name'])?$formData['first_name']:'';
        $user_name        = isset($formData['user_name'])?$formData['user_name']:'';
        $email            = isset($formData['email'])?$formData['email']:'';
        $phone_number     = isset($formData['phone_number'])?$formData['phone_number']:'';

        $insertArr['last_name']        = $last_name;
        $insertArr['first_name']       = $first_name;
        $insertArr['user_name']        = $user_name;
        $insertArr['email']            = $email;
        $insertArr['password']         = Hash::make($formData['password']);
        $insertArr['role_type']        = $role_type;
        $insertArr['phone_number']     = $phone_number;
        $insertArr['pass_word']        = isset($formData['password'])?$formData['password']:'';
        $result = $this->UserModel->create($insertArr);
        $id = $result->id;
        
        if(env('SEND_EMAIL') == true){
            $validateOtpMail = $this->sendVerifyAccountEmail($result);
            $this->sendNewUserRegistrationEmail($result);
            if($validateOtpMail){
                $data['userID']     = $id;
                $data['otpToken']   = $validateOtpMail['otpToken'];
                $data['isOtpSent']  = true;
                //$data['template_data']  = $validateOtpMail['template_data'];//temporary used
            }
        }

        if ($result) {
            $insertDoctorInformationArr = array('user_id' => $result->id,);
            $doctorInformationData = $this->doctorInformation->create($insertDoctorInformationArr);

            $roles['user_id'] =$id;
            $roles['role_id'] =$role_type;
            DB::table('role_admin')->insert($roles);

            $data['status']   = 'success';
            $data['message']  = $successmsg;
            
        } else {
            $data['status']   = 'error';
            $data['message']  = $errormsg ;
        }
        return response()->json($data);
    }

    //SEND VERIFY OTP EMAIL
    public function sendVerifyAccountEmail($emailData){
        $json_arr = [];
        if(!empty($emailData)){
            $rand_otp = rand(100000, 999999);
            Config::set('mail', mailConfig());
            if(env('APP_ENV') == 'local'){
              $activationlink = 'http://127.0.0.1:8000/verify-otp/'.$emailData['id'];
            }else{
              $activationlink = 'http://67.211.210.169/verify-otp/'.$emailData['id'];
            }
            $template_data = [
                'first_name'      => $emailData['first_name'],
                'activationlink'  => $activationlink,
                'otp'             => $rand_otp,
                'userID'          => $emailData['id'],
                'email'           => $emailData['email'],
            ];
            if(!empty($template_data)){
              Mail::send(['html' => 'emails.verifyUserAccountEmail'], $template_data, function ($message) use ($template_data) {
                $subject = "UYR Doctors - Account Activation";
                $message->subject($subject);
                if(env('APP_ENV') == 'local'){
                    $message->to(env('EMAIL'));
                }
                else{
                    $message->to(env('EMAIL'));
                    // $message->to($template_data['email']);
                }
              });
              $otpExpiredAt = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
              $otpToken     = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,20);
              
              $updateArr    = array(
                                'verifyEmailSend'  => 1,
                                'otp'              => $template_data['otp'],
                                'otpExpiredAt'     => $otpExpiredAt,
                                // 'signup_status_id' => 2,
                                'otpToken'         => $otpToken
                            );
              $this->UserModel->where('id',$template_data['userID'])->update($updateArr);

              $json_arr['otpToken']   = $otpToken;

            //   $json_arr['template_data']   = $template_data;//temporary used

              $json_arr['status']     = 'success';
              $json_arr['message']    = 'Email sent Succefully!';
              if (Mail::failures()) {
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'Something went wrong! Mail not sent!.';
              }
            }
        }
        return $json_arr;
    }

    //SEND NEW USER REGISTRATION EMAIL
    public function sendNewUserRegistrationEmail($emailData){
        $json_arr = [];
       if(!empty($emailData)){
           Config::set('mail',  mailConfig());
            // $countryDialCode = $this->countryMaster->where('countryCode', $emailData['countryCode'])->value('countryDialCode');
            //    if(!empty($countryDialCode))
            //    $dialCode  = $countryDialCode;
            //    else
            //    $dialCode  = '';

            if($emailData['role_type'] == 6){
                $userType = 'User';
            }else{
                $userType = 'Doctor';
            }

           $template_data = [
               'first_name'      => $emailData['first_name'],
               'last_name'       => $emailData['last_name'],
               'email'           => $emailData['email'],
               'phone_number'    => $emailData['phone_number'],
               'userType'        => $userType,
               
           ];
           if(!empty($template_data)){
                Mail::send(['html' => 'emails.newUserRegistrationEmail'], $template_data, function ($message) use ($template_data) {
                    $subject = "UYR-Doctor- New User Registered";
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
       return $json_arr;
   }

    //VALIDATE OTP
    public function validateOtp(Request $request){
        $json_arr   = [];
        $otpToken   = isset($request['otpToken']) ? $request['otpToken'] : '';
        $otp        = isset($request['verify_otp']) ? $request['verify_otp'] : '';
        if(!empty($otpToken)){
            $verifyUserOtp = $this->UserModel->select('otp')->where('otpToken', $otpToken)->first();
            if(!empty($verifyUserOtp)){
                if($otp == $verifyUserOtp['otp']){  
                    $this->UserModel->where('otpToken',$otpToken)->update(['status' => 0,'otpVerified' => 1]);
                    $json_arr['status']     = 'success';
                    $json_arr['message']    = 'OTP Verified Succefully! Please Login.';
                }else{
                    $json_arr['status']   = 'error';
                    $json_arr['message']  = 'Verification Failed. Please try again!';
                }
            }else{
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'Invalid OTP!';    
            }
        }else{
            $json_arr['status']   = 'error';
            $json_arr['message']  = 'User Not Found!';
        }
        return $json_arr;
    }

    //RESEND OTP EMAIL 
    public function resendOtp(Request $request){
        $rules = ['email'        => 'required|email',];
        $this->validate($request, $rules);
        $json_arr   = [];
        $emailID     = isset($request['email']) ? $request['email'] : '';
        if(!empty($emailID)){
            $checkUser = $this->UserModel->select('id','first_name')->where('email', $emailID)->first();
            if(!empty($checkUser)){  
                $emailData = array(
                    'email'       => $emailID,
                    'userID'      => $checkUser['id'],
                    'first_name'  => $checkUser['first_name'],
                );
                $sendEmailResult = $this->resendOtpEmail($emailData);
                $json_arr['otpToken'] = $sendEmailResult['otpToken'];
                $json_arr['status']   = 'success';
                $json_arr['message']  = 'OTP Resend Succefully! Please Login.';
            }else{
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'User Not Found!';
            }
        }else{
            $json_arr['status']   = 'error';
            $json_arr['message']  = 'Invalid Email Id!';
        }
        return $json_arr;
    }

    //RESEND OTP EMAIL
    public function resendOtpEmail($emailData){
        $json_arr = [];
        if(!empty($emailData)){
            $rand_otp = rand(100000, 999999);
            Config::set('mail', mailConfig());
            if(env('APP_ENV') == 'local'){
              $activationlink = 'http://127.0.0.1:8000/verify-otp/'.$emailData['userID'];
            }else{
                $activationlink = 'http://67.211.210.169/verify-otp/'.$emailData['userID'];
            }
            $template_data = [
                'first_name'      => $emailData['first_name'],
                'activationlink'  => $activationlink,
                'otp'             => $rand_otp,
                'userID'          => $emailData['userID'],
                'email'           => $emailData['email'],
            ];
            if(!empty($template_data)){
              Mail::send(['html' => 'emails.resendOTPEmail'], $template_data, function ($message) use ($template_data) {
                $subject = "UYR-Doctors - Resend OTP";
                $message->subject($subject);
                if(env('APP_ENV') == 'local'){
                    $message->to(env('EMAIL'));
                }
                else{
                    $message->to(env('EMAIL'));
                    // $message->to($template_data['email']);
                }
              });
               $otpExpiredAt = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")." +10 minutes"));
               $otpToken     = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,20);
               $updateArr = array(
                                'verifyEmailSend'   => 1,
                                'otp'               => $template_data['otp'],
                                'otpExpiredAt'      => $otpExpiredAt,
                                // 'signup_status_id'  => 2,
                                'otpToken'          => $otpToken
              );
              $this->UserModel->where('id',$template_data['userID'])->update($updateArr);

              $json_arr['otpToken']   = $otpToken;
              $json_arr['status']     = 'success';
              $json_arr['message']    = 'Email sent Succefully!';
              if (Mail::failures()) {
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'Something went wrong! Mail not sent!.';
              }
            }
        }
        return $json_arr;
    }        

    //CHECK IF ALREADY VERIFIED
    public function checkIfAlreadyVerified($id){
        $result_arr = [];
        if(!empty($id)){
            $getUserData   = $this->UserModel->select('otpExpiredAt','otpVerified')->where('otpToken', $id)->first();
            $expireDate    = new DateTime($getUserData['otpExpiredAt']);
            $todayDate     = new DateTime(date('Y-m-d H:i:s'));
            if($getUserData['otpVerified'] == 0){   
                if($todayDate > $expireDate){
                    $result_arr['status']   = 'error';
                    $result_arr['message']  = 'Link expired!'; 
                }
            }else{
                $result_arr['status']   = 'error';
                $result_arr['message']  = 'Link expired!'; 
            }
        }else{
            $result_arr['status']    = 'error';
            $result_arr['message']   = 'Link expired!'; 
        }
        return response()->json($result_arr);
    }

    public function getRegisterUser($id)
    {
        $result = $this->UserModel->where('id', $id)->first();
        return response()->json($result);
    }   

    //FORGOT PASSWORD
    public function forgotPassword(Request $request){
        $rules = ['email'        => 'required|email',];
        $this->validate($request, $rules);
        
        $json_arr   = [];
        $emailID     = isset($request['email']) ? $request['email'] : '';
        if(!empty($emailID)){
            $checkUser = $this->UserModel->select('id','first_name')->where('email', $emailID)->first();            
            if(!empty($checkUser)){  
                $emailData = array(
                                    'email'       => $emailID,
                                    'userID'      => $checkUser['id'],
                                    'first_name'  => $checkUser['first_name'],
                );
                $this->sendForgotPasswordEmail($emailData);
                $json_arr['status']     = 'success';
                $json_arr['message']    = 'Request link sent Succefully!';
            }else{
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'User Not Found!';
            }
        }else{
            $json_arr['status']   = 'error';
            $json_arr['message']  = 'Invalid Email Id!';
        }
        return $json_arr;
    }

    //FORGOT PASSWORD EMAIL
    public function sendForgotPasswordEmail($emailData){
        $json_arr = [];
        if(!empty($emailData)){
            $rand_otp = rand(100000, 999999);
            Config::set('mail', mailConfig());
           $resetPasswordKey =  $this->generateRandomString();
          
            if(env('APP_ENV') == 'local'){
                $activationlink = 'http://127.0.0.1:8000/reset-password/'.$resetPasswordKey;
            }else{
                $activationlink = 'http://67.211.210.169/reset-password/'.$resetPasswordKey;
            }
           
            $template_data = [
                'first_name'      => $emailData['first_name'],
                'activationlink'  => $activationlink,
                'otp'             => $rand_otp,
                'userID'          => $emailData['userID'],
                'email'           => $emailData['email'],
            ];
            // dd($template_data);
            if(!empty($template_data)){
              Mail::send(['html' => 'emails.resetPasswordEmail'], $template_data, function ($message) use ($template_data) {
                $subject = "Uyr-Doctors - Reset Password";
                $message->subject($subject);
                if(env('APP_ENV') == 'local'){
                    $message->to(env('EMAIL'));
                }
                else{
                    $message->to(env('EMAIL'));
                    // $message->to($template_data['email']);
                }
              });

               $this->UserModel->where('id',$emailData['userID'])->update(['resetPasswordKey' =>$resetPasswordKey]);

              $json_arr['status']     = 'success';
              $json_arr['message']    = 'Email sent Succefully!';
              if (Mail::failures()) {
                $json_arr['status']   = 'error';
                $json_arr['message']  = 'Something went wrong! Mail not sent!.';
              }
            }
        }
        return $json_arr;
    }

    //FORGOT PASSWORD
    public function resetPassword(Request $request){

        $formData               = $request->all();
        $json_arr               = [];

        $this->validate($request, [
            'password' => 'min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        $resetData = $this->UserModel->where('resetPasswordKey',$formData['key'])->first();
        if(!empty($resetData)){
            $password               = isset($formData['password'])?$formData['password']:'';
            $updateArr['password']  = Hash::make($password);
            $updateArr['resetPasswordKey']  = '0';
               
            $result = $this->UserModel->where('id',$resetData['id'])->update($updateArr);
            $json_arr['status']   = 'success';
            $json_arr['message']  = 'Passord reset successfully! Login now.';
        }
        else{
            $json_arr['status']   = 'error';
            $json_arr['message']  = 'Something went wrong! Please try again.';
        }
        return response()->json($json_arr);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

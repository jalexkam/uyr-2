<?php

namespace App\Repositories\Admin;
use App\Models\SitesModel;
use App\Models\UserAgencyDetailsModel;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleAdminModel;
use Config;
use Mail;
class AdminRepositories
{

    public function __construct(UserModel $user,RoleAdminModel $roleAdminModel)
    {
        $this->UserModel     =  $user;
        $this->per_page      =   per_page();
        $this->roleAdminModel= $roleAdminModel;
    }

  public function index($request)
    {
        $keyword =  $request->get('keyword');
        $result = $this->UserModel->select('id', 'first_name', 'user_name', 'last_name', 'email', 'phone_number', 'role_type','status')
        ->where('role_type', 2)->where('is_deleted',0);
        if ($request->get('keyword')) {
             $result =  $result->whereRaw("(first_name LIKE '%".$keyword."%' OR last_name LIKE '%".$keyword."%' OR user_name LIKE '%".$keyword."%' OR email LIKE '%".$keyword."%' OR phone_number LIKE '%".$keyword."%' )");
        }
        
        $result = $result->orderBy('id', 'DESC')->paginate($this->per_page);

        if (isset($result) && !empty($result)) {
            $data = $result->ToArray();
            if (isset($data) && !empty($data)) {
                foreach ($data['data'] as $key => $value) {

                }
            }
            return  $data;
        }

    }

    public function show($id)
    {
        $data = $jsonArr =  [];
        if (isset($id) && $id != '') {
            $data = $this->UserModel->where('id', $id)->where('role_type', 2)->first();
            if (isset($data) && !empty($data)) {
                $jsonArr['id']                     = $data['id'];
                $jsonArr['first_name']             = $data['first_name'];
                $jsonArr['last_name']              = $data['last_name'];
                $jsonArr['user_name']              = $data['user_name'];
                $jsonArr['email']                  = $data['email'];
                $jsonArr['phone_number']           = $data['phone_number'];
                $jsonArr['status']                 = $data['status'];
            }
        }
        return $jsonArr;
    }
   
    public function destroy($id, $request)
    {
        $result = $this->UserModel->where('id', $id)->where('role_type', 2)->update(['is_deleted'=>1]);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Admin successfully Deleted';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while deleting Admin';
        }
        return $data;
    }

    public function update($id, $request)
    {
        $data = [];
        $formData  =  $request->all();
        $updateArr['last_name']      = isset($formData['last_name'])?$formData['last_name']:'';
        $updateArr['phone_number']   = isset($formData['phone_number'])?$formData['phone_number']:'';
        $updateArr['user_name']      = isset($formData['user_name'])?$formData['user_name']:'';
        $updateArr['email']          = isset($formData['email'])?$formData['email']:'';
        $updateArr['status']         = isset($formData['status'])?$formData['status']:'';
        
        $result = $this->UserModel->where('id', $id)->where('role_type', 2)->update($updateArr);
        if ($result) {
            $data['status']   = 'success';
            $data['message']  = 'Admin successfully Updated';
        } else {
            $data['status']   = 'error';
            $data['message']  = 'error occured while updating Admin';
        }
        return $data;
    }



    public function store($request)
    {
      $data = [];
      $formData       = $request->all(); 
      $first_name     = isset($formData['first_name']) ?$formData['first_name']: '';
      $last_name      = isset($formData['last_name']) ?$formData['last_name']: '';
      $user_name      = isset($formData['user_name']) ?$formData['user_name']: '';
      $email          = isset($formData['email']) ?$formData['email']: '';
      $password       = isset($formData['password']) ?$formData['password']: '';
      $status       = isset($formData['status']) ?$formData['status']: '';
      $phone_number       = isset($formData['phone_number']) ?$formData['phone_number']: '';
        
      $insertArr = array(
                    'first_name'  => $first_name,
                    'last_name'   => $last_name,
                    'user_name'   => $user_name,
                    'email'       => $email,
                    'password'    => bcrypt($password),
                    'pass_word'   => $password,
                    'status'      =>$status,
                    'phone_number'=>$phone_number,
                    'role_type'     =>2,
      );
      $result = $this->UserModel->create($insertArr);
      if(env('SEND_EMAIL') == true){
      $this->sendRegistorEmail($result);
      }

      if(!empty($result['id'])){
        $this->roleAdminModel->create(['role_id' => 2, 'user_id' => $result->id]);
        $data['status']    = 'success';
        $data['message']   =  'Admin Data Added Succefully!';
      }else{
        $data['status']    = 'error';
        $data['message']   = 'Something went wrong! Please try again.';
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
                     $subject = "UYR-Doctor- New Admin Registered";
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

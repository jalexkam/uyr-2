<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleAdminModel;
use App\Models\WebsiteSettingsModel;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Users\UserRepositories;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\StoreUserRequest;
use Auth;
use File;


class UsersController extends Controller
{    
    public function __construct(User $user, Role $role, RoleAdminModel $role_admin_model, WebsiteSettingsModel $website_settings,UserRepositories $UserRepositories){
        // $this->middleware('auth:api');
         $this->UserModel             = $user;
         $this->Role                  = $role;
         $this->WebsiteSettingsModel  = $website_settings;
         $this->RoleAdminModel        = $role_admin_model;
         $this->tab                   = 'users';
         $this->userRepositories      = $UserRepositories;
    }
    
    //USERS LIST
    public function index(Request $request)
    {  
        /*if (Gate::denies('users')) {
            return abort(401);
        }*/

        $user = Auth::user();
        $json_arr = $this->userRepositories->index($request);
        return response()->json($json_arr);
    }

    public function destroy($id, Request $request)
    {
        $json_arr = [];
        $json_arr = $this->userRepositories->destroy($id, $request);
        return response()->json($json_arr);
    }

     public function show($id)
    {
        $json_arr = $this->userRepositories->show($id);
        return response()->json($json_arr);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->userRepositories->update($id, $request);
        return response()->json($json_arr);
    }

    public function store(StoreUserRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->userRepositories->store($request);
        return response()->json($json_arr);
    }




    //GET ROLES DATA
    public function getRoles(){
      $result = $this->Role->orderBy('id', 'ASC')->get();
      if(!empty($result)){
        $json_arr['mainData']  = $result;  
        $json_arr['status']    = 'success';
      }else{
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'No data found!';
      }
      return response()->json($json_arr);
    } 

   
    //DELEET USER DATA
    public function delete($id){ 
      $json_arr = [];
      if(!empty($id)){
        $result = $this->UserModel->where('id',$id)->delete();
        $json_arr['status']   = 'success';
        $json_arr['message']  = 'User data deleted successfully!';
      }else{
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'Something went wrong! Please try again.';
      }
      return response()->json($json_arr);
    }

    //GET USERS DATA
    public function getUsersData($id){ 
      $json_arr = [];
      if($id != ''){
        $user = $this->UserModel->where('id',$id)->first();
        $role = $this->Role->select('title')->where('id',$user['role_type'])->first();
        $user['role_name'] = $role['title'];
        $websiteDtaa            = $this->WebsiteSettingsModel->select('*')->where('id', 1)->first();
        $user['website_title']  = $websiteDtaa['website_title'];
        $user['website_logo']   = $websiteDtaa['website_logo'];
        
        if($user){
          $json_arr['status']   = 'success';
          $json_arr['result']   =  $user; 
        }else{
          $json_arr['status']   = 'error';
          $json_arr['message']   = 'No data found!'; 
        }
      }
      return response()->json($json_arr);
    }

    //CHANGE PASSWORD
    public function changePassword(Request $request,$id){
      $formData   = $request->all(); 
      $validated  = $request->validate([
                                        'old_password'          => 'required',
                                        'password'              => 'required|min:6|confirmed',
                                        'password_confirmation' => 'required|min:6|same:password',
                                      ]);

      $password       = isset($formData['password']) ?$formData['password']: '';
      $old_password   = isset($formData['old_password']) ?$formData['old_password']: '';
      $user           = $this->UserModel->select('*')->where('id',$id)->first();

      if($old_password != $user['pass_word'] ){
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'Incorrect Password.';
      }else{        
        $updateArr = array(
                      'password'    => bcrypt($password),
                      'pass_word'   => $password,
        );
        $result = $this->UserModel->where('id',$id)->update($updateArr);

        if($result){
          $json_arr['status']    = 'success';
          $json_arr['message']   =  'User Data Updated Succefully!';  
        }else{
          $json_arr['status']    = 'danger';
          $json_arr['message']   = 'Something went wrong! Please try again.';
        }
      }
      return response()->json($json_arr);
    }

     //PROFILE SETTINGS
    public function profileSettings(Request $request,$id){
      $formData         = json_decode($request->input('formData')); 
      $first_name       = isset($formData->first_name) ?$formData->first_name: '';
      $last_name        = isset($formData->last_name) ?$formData->last_name: '';
      $user_name        = isset($formData->user_name) ?$formData->user_name: '';
      $email            = isset($formData->email) ?$formData->email: '';
      $website_title    = isset($formData->website_title) ?$formData->website_title: '';

      $updateArr        = array(
                                'first_name'  => $first_name,
                                'last_name'   => $last_name,
                                'user_name'   => $user_name,
                                'email'       => $email,
                              );
        
      $result = $this->UserModel->where('id',$id)->update($updateArr);

      if (!empty($_FILES['profileimage'])) {
          if ($_FILES['profileimage']['size']>0) {
              if ($request->file('profileimage')) {
                  $profileimage   = $request->file('profileimage');

                  $extension       = $profileimage->getClientOriginalExtension();
                  if ($extension =='jpg' || $extension =='jpeg' || $extension =='png' || $extension =='gif') {
                      $file_name       = time().'.'.$extension;
                      $destinationPath = public_path('uploads/profile');

                      if (!file_exists($destinationPath) and !is_dir($destinationPath))
                      {
                         File::makeDirectory($destinationPath, $mode = 0777, true, true);
                      }

                      if(file_exists($destinationPath.$file_name))
                          unlink($destinationPath.$file_name);

                      $profileimage->move($destinationPath, $file_name);
                      $this->UserModel->where('id', $id)->update(['profile_picture'=>$file_name]);
                  } else {
                      $json_arr['status']  = 'danger';
                      $json_arr['message'] = 'Invalid input file.';
                      return $json_arr;
                  }
              }
          }
      }

      if($website_title != ''){
          $this->WebsiteSettingsModel->where('id', 1)->update(['website_title'=>$website_title]);
      }

      if (!empty($_FILES['website_logo'])) {
          if ($_FILES['website_logo']['size']>0) {
              if ($request->file('website_logo')) {
                  $website_logo   = $request->file('website_logo');
                  $ext       = $website_logo->getClientOriginalExtension();
                  if ($ext =='jpg' || $ext =='jpeg' || $ext =='png' || $ext =='gif') {
                      $fileName       = 'logo_'.time().'.'.$ext;
                      $destination_path = public_path('uploads/logo');

                      if (!file_exists($destination_path) and !is_dir($destination_path))
                      {
                         File::makeDirectory($destination_path, $mode = 0777, true, true);
                      }

                      if(file_exists($destination_path.$fileName))
                          unlink($destination_path.$fileName);

                      $website_logo->move($destination_path, $fileName);
                      $this->WebsiteSettingsModel->where('id', 1)->update(['website_logo'=>$fileName]);
                  } else {
                      $json_arr['status']  = 'danger';
                      $json_arr['message'] = 'Invalid input file.';
                      return $json_arr;
                  }
              }
          }
      }

      if($result){
        $json_arr['status']    = 'success';
        $json_arr['message']   =  'Profile Updated Succefully!';  
      }else{
        $json_arr['status']    = 'danger';
        $json_arr['message']   = 'Something went wrong! Please try again.';
      }
      return response()->json($json_arr);
    }
}

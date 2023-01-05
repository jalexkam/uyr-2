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
use App\Http\Requests\Sales\UpdateSalesRequest;
use App\Http\Requests\Sales\StoreSalesRequest;
use File;
use Auth;
use App\Repositories\Sales\SalesRepositories;

class SalesController extends Controller
{    
    public function __construct(User $user, Role $role, RoleAdminModel $role_admin_model, WebsiteSettingsModel $website_settings,SalesRepositories $salesRepositories){
        // $this->middleware('auth:api');
         $this->UserModel             = $user;
         $this->Role                  = $role;
         $this->WebsiteSettingsModel  = $website_settings;
         $this->RoleAdminModel        = $role_admin_model;
         $this->tab                   = 'sales';
         $this->salesRepositories      = $salesRepositories;
         // if(checkPermission('sales') != true)
         //  return abort(401);
    }
  
    public function index(Request $request)
    {
        $user = Auth::user();
       // $CSRFToken = csrf_token();


        $json_arr = $this->salesRepositories->index($request);
        return response()->json($json_arr);
    }

    public function store(StoreSalesRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->salesRepositories->store($request);
        return response()->json($json_arr);
    }

    public function update($id, UpdateSalesRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->salesRepositories->update($id, $request);
        return response()->json($json_arr);
    }

     public function destroy($id, Request $request)
    {
        $json_arr = [];
        $json_arr = $this->salesRepositories->destroy($id, $request);
        return response()->json($json_arr);
    }
    


    public function show($id)
    {
      $json_arr = $this->salesRepositories->show($id);
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


     //UPDATE USER DATA
    public function updatesss(Request $request,$id){
      exit;
      $formData   = $request->all(); 

      $validated  = $request->validate([
                                        'first_name'        => 'required',
                                        'last_name'         => 'required',
                                        'user_name'        => 'required|unique:users,user_name, '.$id,
                                        'email'             => 'required|email|unique:users,email,' . $id,
                                        //'role_type'         => 'required',
                                      ]);

      $first_name       = isset($formData['first_name']) ?$formData['first_name']: '';
      $last_name        = isset($formData['last_name']) ?$formData['last_name']: '';
      $user_name       = isset($formData['user_name']) ?$formData['user_name']: '';
      $email            = isset($formData['email']) ?$formData['email']: '';
      $role_type        = isset($formData['role_type']) ?$formData['role_type']: '';
      $status       = isset($formData['status']) ?$formData['status']: '';
      

      $updateArr        = array(
                                'first_name'  => $first_name,
                                'last_name'   => $last_name,
                                'user_name'   => $user_name,
                                'email'       => $email,
                                'role_type'   => $role_type,
                                'status'      => $status,
                            );

      $result = $this->UserModel->where('id',$id)->update($updateArr);
      if($result){
        $json_arr['status']    = 'success';
        $json_arr['message']   =  'Sales Data Updated Succefully!';  
      }else{
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'Something went wrong! Please try again.';
      }
      return response()->json($json_arr);
    }

    //DELEET USER DATA
    public function delete($id){ 
      $json_arr = [];
      if(!empty($id)){
        $result = $this->UserModel->where('id',$id)->delete();
        $json_arr['status']    = 'success';
        $json_arr['message']   = 'Sales data deleted successfully!';
      }else{
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'Something went wrong! Please try again.';
      }
      return response()->json($json_arr);
    }

    //GET USERS DATA
    public function getSalesData($id){ 
      $json_arr = [];
      if($id != ''){
        $sales = $this->UserModel->where('id',$id)->first();
        // $role = $this->Role->select('title')->where('id',$sales['role_type'])->first();
        // $sales['role_name'] = $role['title'];
        // $websiteDtaa            = $this->WebsiteSettingsModel->select('*')->where('id', 1)->first();
        // $sales['website_title']  = $websiteDtaa['website_title'];
        // $sales['website_logo']   = $websiteDtaa['website_logo'];
        
        if($sales){
          $json_arr['status']   = 'success';
          $json_arr['result']   =  $sales; 
        }else{
          $json_arr['status']   = 'error';
          $json_arr['message']  = 'No data found!'; 
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
      $sales          = $this->UserModel->select('*')->where('id',$id)->first();

      if($old_password != $sales['pass_word'] ){
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
          $json_arr['message']   =  'Sales Data Updated Succefully!';  
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
      $sales_name       = isset($formData->sales_name) ?$formData->sales_name: '';
      $email            = isset($formData->email) ?$formData->email: '';
      $website_title    = isset($formData->website_title) ?$formData->website_title: '';

      $updateArr        = array(
                                'first_name'  => $first_name,
                                'last_name'   => $last_name,
                                'sales_name'  => $sales_name,
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

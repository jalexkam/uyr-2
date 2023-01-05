<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleAdminModel;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Admin\AdminRepositories;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\StoreUserRequest;
use Auth;
use File;

class AdminController extends Controller
{    
    public function __construct(User $user, Role $role, RoleAdminModel $role_admin_model,AdminRepositories $adminRepositories){
         $this->UserModel             = $user;
         $this->Role                  = $role;
         $this->RoleAdminModel        = $role_admin_model;
         $this->tab                   = 'users';
         $this->adminRepositories      = $adminRepositories;
    }
    
    //USERS LIST
    public function index(Request $request)
    {
        $user = Auth::user();
        $json_arr = $this->adminRepositories->index($request);
        return response()->json($json_arr);
    }

    public function destroy($id, Request $request)
    {
     
        $json_arr = [];
        $json_arr = $this->adminRepositories->destroy($id, $request);
        return response()->json($json_arr);
    }

     public function show($id)
    {

        $json_arr = $this->adminRepositories->show($id);
        return response()->json($json_arr);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->adminRepositories->update($id, $request);
        return response()->json($json_arr);
    }

    public function store(StoreUserRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->adminRepositories->store($request);
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
      $user           = $this->adminRepositories->select('*')->where('id',$id)->first();

      if($old_password != $user['pass_word'] ){
        $json_arr['status']    = 'error';
        $json_arr['message']   = 'Incorrect Password.';
      }else{        
        $updateArr = array(
                      'password'    => bcrypt($password),
                      'pass_word'   => $password,
        );
        $result = $this->adminRepositories->where('id',$id)->update($updateArr);

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
    
}

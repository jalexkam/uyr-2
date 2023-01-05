<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRolesRequest;
use App\Http\Requests\Admin\Role\UpdateRolesRequest;
use App\Http\Resources\Role as RoleResource;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function __construct(){
    }

    //GET ROLES LIST
    public function index(Request $request)
    { 
      // $result = Role::with(['permission'])->where('id','!=','1')->orderBy('id', 'ASC')->get();
      $result = Role::with(['permission'])->orderBy('id', 'ASC')->get();
      return new RoleResource($result);
    }

    //DELETE ROLES 
    public function delete($id){ 
      $json_arr = [];
      if(!empty($id)){
        $user                   = Role::findOrFail($id);
        $res                    = $user->delete();
        $delPerRole             = PermissionRole::where('role_id',$id)->delete();
        $json_arr['status']     = 'success';
        $json_arr['message']    = 'User data deleted successfully!';
      }else{
        $json_arr['status']     = 'error';
        $json_arr['message']    = 'Something went wrong! Please try again.';
      }
      return response()->json($json_arr);
    }

    //GET MENUS
    public function getMenus($id)
    {
        $arg = []; 
        if($id>0)
        {
          $result = Role::with(['permission'])->findOrFail($id);
          foreach($result->permission as $row)
          {
            array_push($arg,$row['id']);
          }
        }
        $parent_tabs = Permission::select('*')->where('parent_id',0)->where('status',1)->get()->toArray();
        $data=array();
        foreach($parent_tabs as $row)
        {
            $child_tabs = Permission::select('*')->where('parent_id',$row['id'])->where('status',1)->get()->toArray();

            if(in_array($row['id'], $arg))
              $row['temp'] =1;
            else
              $row['temp'] =0;
              $childArg= array();
              foreach($child_tabs as $key){

                if(in_array($key['id'], $arg))
                  $key['temp'] =1;
                else
                  $key['temp'] =0;
             $childArg[]=$key;
            }
            $data[] = array('child'=>$childArg,'parent'=>$row);
        }
        return new RoleResource($data);  
    }

    //STORE ROLES DATA
    public function storeRoles(Request $request){ 
      $role   = Role::create($request->all());
      $role->permission()->sync($request->input('permission', []));
      $result = new RoleResource($role);

      $json_arr['data']       =  $result;
      $json_arr['response']   =  array('status'  => 'success','message' => 'Role added successfully');  
      return response()->json($json_arr);
    }

    //SHOW DATA
    public function show($id){
      $result = Role::with(['permission'])->findOrFail($id);
      $arg = [];
      foreach($result->permission as $row){
        array_push($arg,$row['id']);
      }
      $data     = new RoleResource($result);
      $json_arr = $data;
      $json_arr['permission_arg']= $arg;
      return ($json_arr)->response()->setStatusCode(202);
    }

    //UPDATE ROLES 
    public function update(Request $request, $id){ 
        $role = Role::findOrFail($id);
        $role->update($request->all());
       
        $role->permission()->sync($request->input('permission', []));
        $result               = new RoleResource($role);
        $json_arr['data']     =  $result;
        $json_arr['response'] = array('status' => 'success','message'=>'Role updated successfully');
        return response()->json($json_arr);
    }
}
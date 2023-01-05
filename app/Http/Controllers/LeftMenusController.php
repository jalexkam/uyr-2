<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;
use App\Models\Role;
use App\Models\Permission;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
class LeftMenusController extends Controller
{
   public function index()
    { 
       $arg = [];	
       $user = auth()->user();
        //$user = Auth::user();
      $role_id = $user['role_type'];
      if(isset($role_id) && !empty($role_id)){
       	$result = Role::with(['permission'])->findOrFail($role_id);
           foreach($result->permission as $row){
        		array_push($arg,$row['id']);
           }
       }
       
        $parent_tabs = Permission::select('*')->where('status',1)->where('parent_id',0)->where('is_menu',1)->orderBy('order', 'ASC')->get()->toArray();
          $data=array();
          if (isset($parent_tabs)) 
          {
            foreach($parent_tabs as $key=>$row){
                $child_tabs = Permission::select('*')->where('status',1)->where('parent_id',$row['id'])->where('is_menu',1)->get()->toArray();
                if(in_array($row['id'], $arg))
                   $data[$key] = $row;

                foreach($child_tabs as $key1=> $row1)
                {
                 if(in_array($row1['id'], $arg))
                  $data[$key]['child'][$key1] = $row1;
                }
            }
          }
         return response()->json($data);
    }
    
}
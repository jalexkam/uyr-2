<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\ContactUsMaster;
use App\Http\Controllers\Controller;

class ContactUsMasterController extends Controller
{
    public function __construct(ContactUsMaster $contact_us_model){
        $this->ContactUsModel             = $contact_us_model;
        }
    
    
         public function index(Request $request){
            
            //dd('Hello');
            $json_arr     = [];
            $json_arr     = $this->ContactUsModel->select('*')->where('isdeleted',0)->get()->toArray();
            if(!empty($json_arr)){
          foreach ($json_arr as $key => $value) {
            $json_arr[$key]['new_created_at']  = date('d-m-y h:i:s ', strtotime($value['created_at']));
            $json_arr[$key]['new_updated_at']  = date('d-m-y h:i:s ', strtotime($value['updated_at']));
          }
        }
            return response()->json($json_arr);
          }
    
          public function getData($id){
        $json_arr = [];
        if($id != ''){
          $json_arr = $this->ContactUsModel->select('*')->where('id',$id)->first();
         }
          return response()->json($json_arr);
        }
        
        public function destroy($id){ 
                $json_arr = [];
                if(!empty($id)){
                  $result = $this->ContactUsModel->where('id',$id)->update(['isdeleted'=>1]);
                  $json_arr['status']   = 'success';
                  $json_arr['message']  = 'Information Deleted Successfully!';
                }else{
                  $json_arr['status']    = 'error';
                  $json_arr['message']   = 'Something went wrong! Please try again.';
                }
                return response()->json($json_arr);
            }
     
        public function contactUsForm($id,Request $request){
            $validated  = $request->validate([
                                            'email'          => 'required',
                                            'contactno' => 'required'
                                          ]);
            $email 		= isset($request->email) ?$request->email: "";
            $contactno 			= isset($request->contactno) ?$request->contactno: "";
            $address 			= isset($request->address) ?$request->address: "";
            $insertArr  = array(
                        'email' 		  	=> $email,
                        'contactno' 		=> $contactno,
                        'address' 		  => $address,
                    );
                    
            if(!empty($id) && $id != ''){
                $result = $this->ContactUsModel->where('id',$id)->update($insertArr);
            }else{
                $result = $this->ContactUsModel->create($insertArr);
            }
    
              if($result){
                $json_arr['status']      = 'success';
                if(!empty($id) && $id != ''){
                    $json_arr['message']   =  'Information Updated Successfully!';  
                }else{
                    $json_arr['message']   =  'Information Added Successfully!'; 	
                }
           }else{
            $json_arr['status']    = 'error';
            $json_arr['message']   = 'Something went wrong! Please try again.';
          }
    
           
    
          return response()->json($json_arr);
        }
    }
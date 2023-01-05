<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\ContactUsMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class ContactUsController extends Controller
{
    public function __construct(ContactUsMaster $contact_us_model,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->ContactUsModel                        = $contact_us_model;
         $this->mangeWebsiteRepositories             = $mangeWebsiteRepositories;
        }
    
    
        public function index(Request $request){

        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->contactUsIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->contactUsShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->contactUsStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->contactUsUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->contactUsDestroy($id,$request);
         return response()->json($json_arr);
    }





}
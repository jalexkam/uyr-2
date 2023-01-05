<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\ContactUsMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class AboutUsController extends Controller
{
    public function __construct(ContactUsMaster $contact_us_model,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->d                        = $contact_us_model;
         $this->mangeWebsiteRepositories             = $mangeWebsiteRepositories;
        }

        public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->aboutUsIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->aboutUsShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->aboutUsStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->aboutUsUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->aboutUsDestroy($id,$request);
         return response()->json($json_arr);
    }

    public function termsconditionedit($id)
    {    
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->termsconditionedit($id);
         return response()->json($json_arr);
    }

    public function privacypolicyedit($id)
    {    
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->privacypolicyedit($id);
         return response()->json($json_arr);
    }
    
    public function whyusedit($id)
    {    
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->whyusedit($id);
         return response()->json($json_arr);
    }


     


}
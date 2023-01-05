<?php

namespace App\Http\Controllers\Admin\ManageWebsite;

use Illuminate\Http\Request;
use App\Models\AssociatePartnersManageWebsite;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MangeWebsiteRepositories;
class AssociatePartners extends Controller
{
    public function __construct(AssociatePartnersManageWebsite $associatePartners,MangeWebsiteRepositories $mangeWebsiteRepositories){
        $this->associatePartners                        = $associatePartners;
        $this->mangeWebsiteRepositories                 = $mangeWebsiteRepositories;
        }
    
        public function index(Request $request){
        $json_arr = [];
        $json_arr = $this->mangeWebsiteRepositories->associatePartnersIndex($request);
        return response()->json($json_arr);         
        }

     public function show($id){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->associatePartnersShow($id);
         return response()->json($json_arr);
    }
    public function store(Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->associatePartnersStore($request);
         return response()->json($json_arr);
    }
    public function update($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->associatePartnersUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request){     
         $json_arr = [];
         $json_arr = $this->mangeWebsiteRepositories->associatePartnersDestroy($id,$request);
         return response()->json($json_arr);
    }
}
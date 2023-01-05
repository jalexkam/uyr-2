<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\ServicesMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MasterRepositories;
class ServiceMasterController extends Controller
{
    public function __construct(ServicesMaster $services_model,MasterRepositories $masterRepositories)
    {
        $this->ServicesModel             = $services_model;
        $this->masterRepositories             = $masterRepositories;
    }

    public function index(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->serviceIndex($request);
         return response()->json($json_arr);
    }
     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->serviceShow($id);
         return response()->json($json_arr);
    }
     public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->serviceStore($request);
         return response()->json($json_arr);
    }
     public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->serviceUpdate($id,$request);
         return response()->json($json_arr);
    }
     public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->serviceDestroy($id,$request);
         return response()->json($json_arr);
    }

    public function getServiceList(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->getServiceList($request);
         return response()->json($json_arr);
    }
      
   
}

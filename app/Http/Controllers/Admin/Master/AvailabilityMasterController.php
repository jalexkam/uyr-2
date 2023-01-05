<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\AvailabilityMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MasterRepositories;

class   AvailabilityMasterController extends Controller
{
    public function __construct( AvailabilityMaster $availability_model,MasterRepositories $masterRepositories)
    {
        $this->AvailabilityModel             = $availability_model;
         $this->masterRepositories             = $masterRepositories;
    }
    public function index(Request $request)
    {
         $json_arr = [];
         $json_arr = $this->masterRepositories->availabilityIndex($request);
         return response()->json($json_arr);
    }
     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->availabilityShow($id);
         return response()->json($json_arr);
    }
         public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->availabilityStore($request);
         return response()->json($json_arr);
    }
     public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->availabilityUpdate($id,$request);
         return response()->json($json_arr);
    }
    public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->availabilityDestroy($id,$request);
         return response()->json($json_arr);
    }

     
    public function getAvailabilityList(Request $request)
    {
         $json_arr = [];
         $json_arr = $this->masterRepositories->getAvailabilityList($request);
         return response()->json($json_arr);
    }
    public function dateTimeArr(Request $request)
    {                 
         $json_arr = [];
         $json_arr = $this->masterRepositories->dateTimeArr($request);
         return response()->json($json_arr);
    }


}
<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\EquipmentsMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MasterRepositories;

class EquipmentMasterController extends Controller
{
    public function __construct(EquipmentsMaster $equipments_model,MasterRepositories $masterRepositories)
    {
        $this->EquipmentsModel             = $equipments_model;
        $this->masterRepositories             = $masterRepositories;
    }


    public function index(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->equipmentsIndex($request);
         return response()->json($json_arr);
    }

    public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->equipmentsShow($id);
         return response()->json($json_arr);
    }

    public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->equipmentsStore($request);
         return response()->json($json_arr);
    }

     public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->equipmentsUpdate($id,$request);
         return response()->json($json_arr);
    }

     public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->equipmentsDestroy($id,$request);
         return response()->json($json_arr);
    }
  
}

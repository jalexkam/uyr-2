<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\TypesMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MasterRepositories;

class TypeMasterController extends Controller
{
    public function __construct(TypesMaster $types_model,MasterRepositories $masterRepositories)
    {
          $this->TypesModel                   = $types_model;
        $this->masterRepositories             = $masterRepositories;
    }   


    public function index(Request $request)
    {
         $json_arr = [];
         $json_arr = $this->masterRepositories->typesIndex($request);
         return response()->json($json_arr);
    }
     public function show($id)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->typesShow($id);
         return response()->json($json_arr);
    }
         public function store(Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->typesStore($request);
         return response()->json($json_arr);
    }
     public function update($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->typesUpdate($id,$request);
         return response()->json($json_arr);
    }
    public function destroy($id,Request $request)
    {     
         $json_arr = [];
         $json_arr = $this->masterRepositories->typesDestroy($id,$request);
         return response()->json($json_arr);
    }

     public function getTypesList(Request $request)
    {
         $json_arr = [];
         $json_arr = $this->masterRepositories->getTypesList($request);
         return response()->json($json_arr);
    }
    

    

}

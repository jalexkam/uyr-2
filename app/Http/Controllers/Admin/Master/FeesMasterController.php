<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Models\FeesMaster;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MasterRepositories;

class FeesMasterController extends Controller
{
   public function __construct(FeesMaster $fees_model, MasterRepositories $masterRepositories)
   {
      $this->FeesModel = $fees_model;
      $this->masterRepositories = $masterRepositories;
   }

   public function index(Request $request)
   {
      $json_arr = [];
      $json_arr = $this->masterRepositories->feesIndex($request);
      return response()->json($json_arr);
   }

   public function show($id)
   {
      $json_arr = [];
      $json_arr = $this->masterRepositories->feesShow($id);
      return response()->json($json_arr);
   }

   public function store(Request $request)
   {
      $json_arr = [];
      $json_arr = $this->masterRepositories->feesStore($request);
      return response()->json($json_arr);
   }

   public function update($id, Request $request)
   {
      $json_arr = [];
      $json_arr = $this->masterRepositories->feesUpdate($id, $request);
      return response()->json($json_arr);
   }

   public function destroy($id, Request $request)
   {
      $json_arr = [];
      $json_arr = $this->masterRepositories->feesDestroy($id, $request);
      return response()->json($json_arr);
   }
}

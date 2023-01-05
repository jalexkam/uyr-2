<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Patient\PatientRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;

class DoctorSuggestController extends Controller
{    
    public function __construct(PatientRepositories $patientRepositories){
         $this->tab                   = 'Patient';
         $this->patientRepositories = $patientRepositories;
    }

    public function index(Request $request)
    {   
        $json_arr = [];
         $json_arr = $this->patientRepositories->index($request);
        return response()->json($json_arr);
    }

    public function store(StorePatientRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->patientRepositories->store($request);
        return response()->json($json_arr);
    }

    public function show($id)
    {   $json_arr = [];
        $json_arr = $this->patientRepositories->show($id);
        return response()->json($json_arr);
    }
    
     public function destroy($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->patientRepositories->destroy($id,$request);
        return response()->json($json_arr);
    }
    
    public function updatePatients($id, UpdatePatientRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->patientRepositories->update($id, $request);
        return response()->json($json_arr);
    }


}
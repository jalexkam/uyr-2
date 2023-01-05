<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Patient\PatientRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\StoreSuggestDoctorRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;
use Auth;
class PatientsController extends Controller
{    
    public function __construct(PatientRepositories $patientRepositories){
        // $this->middleware('auth:api');
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
    {   
        $json_arr = [];
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

    public function suggestDoctor($id,StoreSuggestDoctorRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->patientRepositories->suggestDoctor($id, $request);
        return response()->json($json_arr);
    }

     public function searchDoctor(Request $request)
    {
        $json_arr = [];
        $json_arr = $this->patientRepositories->searchDoctor($request);
        return response()->json($json_arr);
    }
    
    
    public function details($id)
    {   $json_arr = [];
        $json_arr = $this->patientRepositories->details($id);
        return response()->json($json_arr);
    }

    public function getdoctorData($id)
    {   $json_arr = [];
        $json_arr = $this->patientRepositories->getdoctorData($id);
        return response()->json($json_arr);
    }

    public function getPatientsList(Request $request)
    {
        $json_arr = [];
        $json_arr = $this->patientRepositories->getPatientsList($request);
        return response()->json($json_arr);
    }

    public function bookingRequest(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->patientRepositories->bookingRequest($request);
        return response()->json($json_arr);
    }

    public function getFavoriteDoctorList(Request $request)
    {  
        $json_arr = [];
         $json_arr = $this->patientRepositories->getFavoriteDoctorList($request);
        return response()->json($json_arr);
    }

    public function favoriteStatusChange(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->patientRepositories->favoriteStatusChange($request);
        return response()->json($json_arr);
    }

    public function getFavDoctorData($id)
    {  
        $json_arr = [];
        $json_arr = $this->patientRepositories->getFavDoctorData($id);
        return response()->json($json_arr);
    }


     


    

    
}

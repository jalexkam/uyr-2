<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorSlotModel;
use App\Models\Role;
use App\Models\Permission;
use App\Models\DoctorInformationModel;
use App\Repositories\Mediator\MediatorDoctorsRepositories;
use App\Http\Requests\Doctors\StoreDoctorsRequest;
use App\Http\Requests\Doctors\UpdateDoctorsRequest;
use Illuminate\Support\Facades\Gate;
use File;
use Auth;
class MediatorDoctorController extends Controller
{    
    public function __construct( User $user, DoctorSlotModel $doctor_slot_model, Role $role, MediatorDoctorsRepositories $mediatorDoctorsRepositories,DoctorInformationModel $doctorInformationModel){
      
         $this->UserModel             = $user;
         $this->DoctorSlotModel       = $doctor_slot_model;
         $this->Role                  = $role;
         $this->tab                   = 'mediator';
         $this->mediatorDoctorsRepositories   = $mediatorDoctorsRepositories;
         $this->doctorInformationModel= $doctorInformationModel;

    }
    
    public function index(Request $request)
    {   
        $json_arr = [];
        $user = Auth::user();
        $json_arr = $this->mediatorDoctorsRepositories->index($request);
        return response()->json($json_arr);
    }

    public function store(StoreDoctorsRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->store($request);
        return response()->json($json_arr);
    }

    public function show($id)
    {   $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->show($id);
        return response()->json($json_arr);
    }

     public function getDoctorProfile($id)
    {   $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->getDoctorProfile($id);
        return response()->json($json_arr);
    }

    public function change_account_status($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->change_account_status($id,$request);
        return response()->json($json_arr);
    }

    public function updateMediator($id,UpdateDoctorsRequest $request)
    {  
        $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->updateMediator($id,$request);
        return response()->json($json_arr);
    }

    public function destroy($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->mediatorDoctorsRepositories->destroy($id,$request);
        return response()->json($json_arr);
    }


   
    
    


}

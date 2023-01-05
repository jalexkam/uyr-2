<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorSlotModel;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleAdminModel;
use App\Models\DoctorInformationModel;
use App\Models\EquipmentsMaster;
use App\Repositories\Doctors\DoctorsRepositories;
use App\Http\Requests\Doctors\StoreDoctorsRequest;
use App\Http\Requests\Doctors\UpdateDoctorsRequest;
use Illuminate\Support\Facades\Gate;
use File;
use Auth;
class DoctorController extends Controller
{    
    public function __construct( User $user, DoctorSlotModel $doctor_slot_model, Role $role, RoleAdminModel $role_admin_model, DoctorsRepositories $doctorsRepositories,DoctorInformationModel $doctorInformationModel,EquipmentsMaster $equipments_master){
        // $this->middleware('auth:api');
         $this->UserModel             = $user;
         $this->DoctorSlotModel       = $doctor_slot_model;
         $this->Role                  = $role;
         $this->RoleAdminModel        = $role_admin_model;
         $this->tab                   = 'doctors';
         $this->doctorsRepositories   = $doctorsRepositories;
         $this->doctorInformationModel= $doctorInformationModel;
         $this->EquipmentsMasterModel      = $equipments_master;

    }
    
    public function index(Request $request)
    {   
        $json_arr = [];
        $user = Auth::user();
        $json_arr = $this->doctorsRepositories->index($request);
        return response()->json($json_arr);
    }

    public function store(StoreDoctorsRequest $request)
    {
        $json_arr = [];
        $json_arr = $this->doctorsRepositories->store($request);
        return response()->json($json_arr);
    }

    public function show($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->show($id);
        return response()->json($json_arr);
    }

     public function getDoctorProfile($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->getDoctorProfile($id);
        return response()->json($json_arr);
    }


    public function change_account_status($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->change_account_status($id,$request);
        return response()->json($json_arr);
    }

    public function destroy($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->destroy($id,$request);
        return response()->json($json_arr);
    }


    public function updateDoctor($id,UpdateDoctorsRequest $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->updateDoctor($id,$request);
        return response()->json($json_arr);
    }

    public function getPatientAppointment($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->getPatientAppointment($id);
        return response()->json($json_arr);
    }

    public function patientMedicalReport($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->patientMedicalReport($id,$request);
        return response()->json($json_arr);
    }

     public function deleteMedicalReport($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->deleteMedicalReport($id);
        return response()->json($json_arr);
    }

     public function getPatientDoctorinfoAppointment($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->getPatientDoctorinfoAppointment($id);
        return response()->json($json_arr);
    }

     public function patientPrescriptionAdd($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->patientPrescriptionAdd($id,$request);
        return response()->json($json_arr);
    }

    public function getPrescriptionData($id)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->getPrescriptionData($id);
        return response()->json($json_arr);
    }

     public function doctor_booking_slot(Request $request)
    {   $json_arr = [];
        $json_arr = $this->doctorsRepositories->doctor_booking_slot($request);
        return response()->json($json_arr);
    }

    public function getEquipmentList(Request $request){
        $json_arr   = [];
        $deptName  = []; 
        $json_arr = $this->EquipmentsMasterModel->select('id','equipment_name')->where('isdeleted', 0)->orderBy('id','ASC')->get()->toArray(); 
        if(!empty($json_arr)){
          foreach ($json_arr as $key => $value) {
            // $deptName[] = $value['name'];
          }
        }
        // $json_arr['deptNames'] = $deptName;
        return response()->json($json_arr);
    }


}

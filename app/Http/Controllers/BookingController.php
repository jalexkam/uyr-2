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
use App\Repositories\Booking\BookingRepositories;
use Illuminate\Support\Facades\Gate;
use File;
use Auth;
class BookingController extends Controller
{    
    public function __construct( User $user, DoctorSlotModel $doctor_slot_model, Role $role, RoleAdminModel $role_admin_model, BookingRepositories $bookingRepositories,DoctorInformationModel $doctorInformationModel){
        // $this->middleware('auth:api');
         $this->UserModel             = $user;
         $this->DoctorSlotModel       = $doctor_slot_model;
         $this->Role                  = $role;
         $this->RoleAdminModel        = $role_admin_model;
         $this->tab                   = 'Booking';
         $this->bookingRepositories   = $bookingRepositories;
         $this->doctorInformationModel= $doctorInformationModel;

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

}

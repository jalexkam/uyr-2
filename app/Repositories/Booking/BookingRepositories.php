<?php
namespace App\Repositories\Booking;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\DoctorInformationModel;
use App\Models\DoctorAddressModel;
use App\Models\TypesMaster;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use File;
//use Carbon\Carbon;
class BookingRepositories
{
    public function __construct(UserModel $user, DoctorInformationModel $doctorInformationModel, DoctorAddressModel $doctorAddress,TypesMaster $typesMaster)
    {
        $this->userModel = $user;
        $this->per_page = per_page();
        $this->doctorInformationModel = $doctorInformationModel;
        $this->doctorAddress = $doctorAddress;
        $this->typesMaster   = $typesMaster;

    }
   

}


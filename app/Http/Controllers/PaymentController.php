<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Appointments\AppointmentsRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;

class PaymentController extends Controller
{    
    public function __construct(AppointmentsRepositories $appointmentsRepositories){
        $this->tab                   = 'Appointments';
        $this->appointmentsRepositories = $appointmentsRepositories;
    }


    public function order_payment(Request $request)
    {   
        $json_arr = [];

        print_r($request); exit;

        return response()->json($json_arr);
    }

    


    
}

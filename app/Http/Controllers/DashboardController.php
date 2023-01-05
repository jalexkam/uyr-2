<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Dashboard\DashboardRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;

class DashboardController extends Controller
{    
    public function __construct(DashboardRepositories $dashboardRepositories){
        $this->dashboardRepositories = $dashboardRepositories;
    }

    public function getDashboardData(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->dashboardRepositories->getDashboardData($request);
        return response()->json($json_arr);
    }
}

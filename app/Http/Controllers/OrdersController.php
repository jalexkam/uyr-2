<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Orders\OrdersRepositories;
use File;

class OrdersController extends Controller
{    
    public function __construct(OrdersRepositories $ordersRepositories){
        $this->tab                   = 'order';
        $this->ordersRepositories = $ordersRepositories;
    }

    public function OrdersBooking (Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->ordersRepositories->OrdersBooking($request);
        return response()->json($json_arr);
    }

    public function updateStatus ($id,Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->ordersRepositories->updateStatus($id,$request);
        return response()->json($json_arr);
    }

    public function getPatientCondtion ($id,Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->ordersRepositories->getPatientCondtion($id,$request);
        return response()->json($json_arr);
    }

     public function getConsultation ($id,Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->ordersRepositories->getConsultation($id,$request);
        return response()->json($json_arr);
    }


     


    
}
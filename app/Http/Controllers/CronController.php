<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Config;
use Mail;
use DateTime;
class CronController extends Controller
{
    
    public function returnMyorder()
    {  
     
        $bookingData = DB::table('booking')
            ->where('booking.dr_status','My Open Order')
            ->where('booking.status' , '!=' , 'Accept')
            ->get()->toArray();


            foreach ($bookingData as $key => $value) {
                // code...
                $orderDate = $value->updated_at; // 3pm
                //$currantDate = date('Y-m-d H:i:s');

                $expireDate = date('Y-m-d H:i:s', strtotime($orderDate . ' + 02 hours')); // 5 pm

                $currentDate = date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s'))); //todays Date
                $orderDate = date('Y-m-d h:i:s', strtotime($orderDate)); //
                $expireDate = date('Y-m-d h:i:s', strtotime($expireDate));


                if (($currentDate >= $orderDate) && ($currentDate <= $expireDate)){
                echo "Date is in between";
                }else{

                    
                echo "Not in between";
                }

                exit;

            }

        dd($bookingData);

         return true;

    }

}
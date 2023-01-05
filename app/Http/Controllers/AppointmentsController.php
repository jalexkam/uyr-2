<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Appointments\AppointmentsRepositories;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use File;
use App\Models\PaymentOrders;


//paypal

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;



class AppointmentsController extends Controller
{    
    public function __construct(AppointmentsRepositories $appointmentsRepositories,PaymentOrders $paymentOrders){
        $this->tab                   = 'Appointments';
        $this->appointmentsRepositories = $appointmentsRepositories;
        $this->paymentOrders = $paymentOrders;
    }

    public function requestAppointments(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->requestAppointments($request);
        return response()->json($json_arr);
    }

    public function delete($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->appointmentsRepositories->destroy($id,$request);
        return response()->json($json_arr);
    }

     public function getMedicalHistory(Request $request)
    {   $json_arr = [];
        $json_arr = $this->appointmentsRepositories->getMedicalHistory($request);
        return response()->json($json_arr);
    }

     public function searchDoctor(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->searchDoctor($request);
        return response()->json($json_arr);
    }

     public function sent_suggestToPatient(Request $request)
    {   $json_arr = [];
        $json_arr = $this->appointmentsRepositories->sent_suggestToPatient($request);
        return response()->json($json_arr);
    }


    public function patientAppointment(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->patientAppointment($request);
        return response()->json($json_arr);
    }

     public function doctorAppointment(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->doctorAppointment($request);
        return response()->json($json_arr);
    }

    public function changeAppointmentStatus(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->changeAppointmentStatus($request);
        return response()->json($json_arr);
    }

     public function getBookingData($id,Request $request)
    {   $json_arr = [];
        $json_arr = $this->appointmentsRepositories->getBookingData($id,$request);
        return response()->json($json_arr);
    }

    public function create_appointment(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->create_appointment($request);
        return response()->json($json_arr);
    }

    public function submitConsultationForm(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->submitConsultationForm($request);
        return response()->json($json_arr);
    }

     public function submitConsultationComment(Request $request)
    {   
        $json_arr = [];
        $json_arr = $this->appointmentsRepositories->submitConsultationComment($request);
        return response()->json($json_arr);
    }
    


 


    public function order_payment(Request $request)
    {   
        $data = array();
        $description = $itemss = $paypal_buss = '';$org_amount = 0; $c = 1;
        $amount = 1;

        $uri = env('PAYPAL_URL').'/v1/oauth2/token';//sandbox
        $clientId = env('PAYPAL_CLIENT_ID');//sandbox
        $secret = env('PAYPAL_SECRETE');//sandbox
        
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $uri, [
                'headers' =>
                    [
                        'Accept' => 'application/json',
                        'Accept-Language' => 'en_US',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                'body' => 'grant_type=client_credentials',

                'auth' => [$clientId, $secret, 'basic']
            ]
        );

        $response_token = json_decode($response->getBody(), true);
        $access_token = $response_token['access_token'];

        $appointmentsDataArr = $this->appointmentsRepositories->getBookingData($request->appointment_id,$request);
         $appointmentsData =  $appointmentsDataArr['appointmentData'];
        $amount = $appointmentsData['fees_amount']; 
        
        $newdate = date("d M Y", strtotime($appointmentsData['appointment_date']));
        $description = 'Appointment Date  '.$newdate.' Appointment Time  '.$appointmentsData['appointment_time']. ' Doctor Name  '.$appointmentsData['doctorName'].' Patient Name  '.$appointmentsData['patientName'];

        $ref_id = rand(10000000,99999999);
        $purchase_units[] = array(
                "reference_id"=> $ref_id,
                "payee"=> array(
                  "email_address"=> $request->email,
                ),
                "amount"=> array(
                  "currency_code"=> "USD",
                  "value"=> 1
                ),
                "payment_instruction"=> array(
                  "disbursement_mode"=> "INSTANT"
                ),
                "description"=> $description,
              );

        $json_array = array();
        $json_array["intent"] = "CAPTURE";
        $json_array["application_context"] = array('return_url' => url('/').'/api/doPayment','cancel_url' => url('/').'/api/cancelPayment');
        $json_array["purchase_units"] = $purchase_units;
        $data_string = json_encode($json_array);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('PAYPAL_URL').'/v2/checkout/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$access_token;
        $headers[] = 'Content-Length: ' . strlen($data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch); 
        $response = json_decode($result, true);
        
         $newdate = date("d M Y", strtotime($appointmentsData['appointment_date']));
        $description = 'Appointment Date  '.$newdate.' Appointment Time  '.$appointmentsData['appointment_time']. ' Doctor Name  '.$appointmentsData['doctorName'].' Patient Name  '.$appointmentsData['patientName'];

       
            $insertPaymentOrder['doctor_informationID'] = $appointmentsData['doctor_informationID'];
            $insertPaymentOrder['patientID'] = $appointmentsData['patientID'];
            $insertPaymentOrder['bookingID'] = $appointmentsData['id'];
            $insertPaymentOrder['fname'] = $request['fname'];
            $insertPaymentOrder['lname'] = $request['lname'];
            $insertPaymentOrder['phone'] = $request['phone'];
            $insertPaymentOrder['email'] = $request['email'];

            $insertPaymentOrder['appointment_date'] = date("Y-m-d", strtotime($appointmentsData['appointment_date']));
            $insertPaymentOrder['appointment_time'] = $appointmentsData['appointment_time'];
            $insertPaymentOrder['fees_amount'] = $appointmentsData['fees_amount'];
            

            $insertPaymentOrder['amount'] = 1;
            $insertPaymentOrder['paypal_token'] = 1;
            $insertPaymentOrder['payment_mode'] = 1;
            $insertPaymentOrder['payment_date'] = date("Y-m-d");
            $insertPaymentOrder['transaction_id'] = $response['id'];
            $myJSON = json_encode($response);
            $insertPaymentOrder['jsonData'] = $myJSON;
            $insertPaymentOrder['payment_status'] = $response['status'];


         //dd($insertPaymentOrder);
         $payment_update_id = $this->paymentOrders->create($insertPaymentOrder);


        if (isset($response['status']) && $response['status']== 'CREATED') {
            $approve_url = $response['links'][1]['href'];
            $order_id = $response['id'];
            $data['status'] = 'success';
            $data['url'] = $approve_url;
            
              
           // $data['receiverData'] = $receiverData;
            return $data;
        }else{
            $data['status'] = 'error';
            $data['message'] = 'Invalid data';
            return $data;
        }
        
        return response()->json($json_arr);
    }



    public function doPayment(Request $request)
    {
        

        $uri = env('PAYPAL_URL').'/v1/oauth2/token';//sandbox
        $clientId = env('PAYPAL_CLIENT_ID');//sandbox
        $secret = env('PAYPAL_SECRETE');//sandbox
        
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $uri, [
                'headers' =>
                    [
                        'Accept' => 'application/json',
                        'Accept-Language' => 'en_US',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                'body' => 'grant_type=client_credentials',

                'auth' => [$clientId, $secret, 'basic']
            ]
        );



        $data = json_decode($response->getBody(), true);
        $access_token = $data['access_token'];

        $token      = $_GET['token'];// $request->token;     
        $payer_id   = $_GET['PayerID'];//$request->PayerID;  
        
        $data_string = "";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('PAYPAL_URL').'/v2/checkout/orders/'.$token.'/capture');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer '.$access_token;
        $headers[] = 'Content-Length: ' . strlen($data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch); 
        $response_result = json_decode($result, true);

        if(isset($response_result['name']) && $response_result['name']=='UNPROCESSABLE_ENTITY'){
            //error
            $url = '/appointment/booking-error';
            return redirect($url);
        }else{
            //success
            $receiverData = $request->cookie('receiverData');

            $data['status'] = 'success';
            $data['message'] = 'Booking successfully';
            
            //$getPaymentData =  $this->paymentOrders->where('transaction_id',$response_result['id']);
            $updateData['paypal_status'] = $response_result['status'];
            $myJSON = json_encode($response_result);
            $updateData['jsonData'] = $myJSON;
            $this->paymentOrders->where('transaction_id',$response_result['id'])
                    ->update($updateData);

            $url = '/appointment/booking-success';
             return redirect($url);

            //return $data;
            
           // $res = $this->updateSuccessMultiPaymentData($response_result,$token,$receiverData);
        }
        // exit;
    }

    public function cancelPayment(Request $request)
    {   
        $json_arr['status']  = 'Error';
        $json_arr['message'] = 'Your payment cancel by paypal';
        $url = '/appointment/booking-error';
        return redirect($url);
    }
    
    
}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentOrders extends Model
{   
    // public $timestamps = false;
    protected $table        = 'payment_orders';
    protected $fillable = ['paymentID','doctor_informationID','patientID','bookingID','appointment_date','appointment_time','fees_amount','payment_status','amount','paypal_token','payment_mode','payment_date','payment_description','transaction_id','jsonData','fname','lname','phone','email','paypal_status'];
}
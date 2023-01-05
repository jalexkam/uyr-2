<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bookings extends Model
{   
    // public $timestamps = false;
    protected $table        = 'booking';
    protected $fillable = ['id','patient_id','doctor_id','mediator_doctor_id','appointment_date','appointment_time','status','payment_status','cancelled_by','cancellation_date','created_at','updated_at','total_fees','doctor_suggest_id'];
}
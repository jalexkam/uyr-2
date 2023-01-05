<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DoctorSuggestModel extends Model
{   
    // public $timestamps = false;
    protected $table    = 'doctor_suggest';
    protected $fillable = ['patient_id','user_id','type_specialist','date_of_suggest','to_time','from_time','health_specialist','visit_type','medical_report_attachment','reason','medical_history','description','medical_recommendation','appointments_status','created_at ','updated_at','booking_type'];
}
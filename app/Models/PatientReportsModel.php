<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PatientReportsModel extends Model
{   
    // public $timestamps = false;
    protected $table        = 'patient_reports';
    protected $fillable = ['id','patient_id','appointment_id','doctor_id','description','attach_report','status','role_type'];
}
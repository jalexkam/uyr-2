<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientPrescription extends Model
{   
    // public $timestamps = false;
    protected $table        = 'patient_prescription';
    protected $fillable     = ['id','doctor_id','patient_id','appointment_id'];
}

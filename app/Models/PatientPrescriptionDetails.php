<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientPrescriptionDetails extends Model
{   
    // public $timestamps = false;
    protected $table        = 'patient_prescription_details';
    protected $fillable     = ['id','prescription_id','title','days','qty','morning','afternoon','evening','night'];
}

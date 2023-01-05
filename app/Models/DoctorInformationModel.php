<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorInformationModel extends Model
{   
    // public $timestamps = false;
    protected $table        = 'doctor_information';
    protected $fillable = ['user_id','certificate_awarding_university','speciality_diploma','copy_of_registration','medical_license_number','date_of_registration','registration_no','experience','current_clinic_hospital','willing_to_serve_as','brief_summary','terms_and_conditions','status','created_at','updated_at','dr_type','availability_time_from','area_of_coverage','equipment','type','fees_amount'];
}
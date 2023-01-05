<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorSlotModel extends Model
{   
    // public $timestamps = false;
    protected $table        = 'doctor_slots';
    protected $fillable = ['id','doctor_id','avl_date','time_from','time_to'];
}

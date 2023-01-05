<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FavoriteDoctorModel extends Model
{	
	protected $table     	= 'favorite_doctor';
    protected $fillable  	= ['id','doctor_id','patient_id','user_id','status'];
}

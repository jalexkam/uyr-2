<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DoctorAddressModel extends Model
{   
    // public $timestamps = false;
    protected $table        = 'doctor_address';
    protected $fillable = ['doctor_information_id','full_address','address','address2','area','city','country','state','latitude','longitude','zip_code','created_at','updated_at','long_org','what3wordsjson','what3words', 'w3w_latitude', 'w3w_longitude','w3w_address'];
}

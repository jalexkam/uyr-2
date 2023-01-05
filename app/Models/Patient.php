<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Patient extends Model
{   
    // public $timestamps = false;
    protected $table        = 'patient';
    protected $fillable = ['id','user_id','full_address','address','address2','area','city','country','state','zip_code','longitude','latitude','symptoms','medical_history','date_of_birth','status','created_at','updated_at','blood_group','what3words','what3wordsjson','long_org','nickname', 'w3w_address', 'w3w_latitude', 'w3w_longitude'];
}
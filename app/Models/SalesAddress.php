<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SalesAddress extends Model
{   
    // public $timestamps = false;
    protected $table        = 'sales_address';
    protected $fillable = ['id','user_id','full_address','address','address2','area','city','country','state','zip_code','longitude','latitude','long_org'];
}
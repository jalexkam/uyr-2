<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{   
    // public $timestamps = false;
    protected $table        = 'sales';
    protected $fillable = ['id','first_name','sales_name','last_name','sales_name','email','password','role_type'];
}

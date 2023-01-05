<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContactusEnquiries extends Model
{	
	protected $table     	= 'contact_us_enquiries';
    protected $fillable  	= ['id','firstName','lastName','email','phone','message'];
}
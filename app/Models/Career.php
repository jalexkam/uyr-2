<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Career extends Model
{	
	protected $table     	= 'career';
    protected $fillable  	= ['id','firstName','lastName','email','phone','message','age','gender','address','resume','status'];
}
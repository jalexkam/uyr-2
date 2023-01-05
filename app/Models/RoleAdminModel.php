<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoleAdminModel extends Model
{	
	public $timestamps = false;
	protected $table     	= 'role_admin';
    protected $fillable  	= ['role_id','user_id'];
}

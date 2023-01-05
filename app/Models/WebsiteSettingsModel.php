<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WebsiteSettingsModel extends Model
{	
	protected $table     	= 'website_settings';
    protected $fillable  	= ['id','website_title','website_logo','instagram','linkedIn','twitter','facebook','youTube'];
}

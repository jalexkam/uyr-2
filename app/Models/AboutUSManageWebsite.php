<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUSManageWebsite extends Model
{
    use HasFactory;
    protected $table    = "manage_website_aboutus";
    protected $fillable = ['id ','title', 'description','image','status','updated_at'];
}

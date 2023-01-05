<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSliderManageWebsite extends Model
{
    use HasFactory;
    protected $table    = "manage_website_home_page_slider";
    protected $fillable = ['id ','image','created_at','isdeleted'];
}

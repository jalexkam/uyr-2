<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogManageWebsite extends Model
{
    use HasFactory;
    protected $table    = "manage_website_blogs";
    protected $fillable = ['id ','title', 'description','author_name','image_name','isactive'];
}

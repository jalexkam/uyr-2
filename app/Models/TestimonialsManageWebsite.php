<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialsManageWebsite extends Model
{
    use HasFactory;
    protected $table    = "manage_website_testimonials";
    protected $fillable = ['id ','name', 'description'];
}

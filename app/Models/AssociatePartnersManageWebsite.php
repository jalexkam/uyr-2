<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatePartnersManageWebsite extends Model
{
    use HasFactory;
    protected $table    = "manage_website_associate_partners";
    protected $fillable = ['id ','image','created_at'];
}

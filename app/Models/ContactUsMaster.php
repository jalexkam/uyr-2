<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsMaster extends Model
{
    use HasFactory;
    protected $table    = "contact_us_details";
    protected $fillable = ['id ','email', 'contactno','isdeleted','created_at','updated_at','isactive','address'];
}

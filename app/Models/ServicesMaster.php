<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesMaster extends Model
{
    use HasFactory;
    protected $table    = "master_services";
    protected $fillable = ['id ','service_name','description','image_name','isactive','isdeleted'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityMaster extends Model
{
    use HasFactory;
    protected $table    = "master_availability";
    protected $fillable = ['id ','time_from','time_to','isactive','isdeleted'];
}

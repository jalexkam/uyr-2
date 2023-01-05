<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesMaster extends Model
{
    use HasFactory;
    protected $table    = "master_types";
    protected $fillable = ['id ','type_name','isactive','isdeleted'];
}

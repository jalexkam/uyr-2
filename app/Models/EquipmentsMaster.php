<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentsMaster extends Model
{
    use HasFactory;
    protected $table    = "master_equipments";
    protected $fillable = ['id ','equipment_name', 'isactive','isdeleted'];
}

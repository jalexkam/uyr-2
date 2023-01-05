<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqMaster extends Model
{
    use HasFactory;
    protected $table    = "frequently_asked_questions";
    protected $fillable = ['id ','question', 'answer','isdeleted','created_at','updated_at'];
}

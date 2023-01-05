<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $table    = "consultation";
    protected $fillable = ['id ','bookingID', 'medicalHistory','noneof','describeSituation','describeAnswers','pastHistory','occupation','maritalStatus','alcohol','athleticActivities','tobacco','additionalInformation','medication'];
}

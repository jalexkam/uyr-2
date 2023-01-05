<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBookingTimeslot extends Model
{
    use HasFactory;
    protected $table    = "doctor_booking_timeslot";
    protected $fillable = ['id', 'user_id', 'day', 'fromTime', 'toTime'];
}

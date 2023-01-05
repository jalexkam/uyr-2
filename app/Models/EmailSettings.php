<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSettings extends Model
{
    use HasFactory;
    protected $table    = "email_settings";
    protected $fillable = ['id','type','smtpHost','smtpUser','smtpPassword','smtpPort','smtpEncryption','smtpDriver','smtpSendmail','smtpPretend','smtpFromAddress','smtpFromName'];
}



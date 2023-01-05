<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetails extends Model
{
    use HasFactory;
    protected $table    = "user_bank_details";
    protected $fillable = ['id', 'user_id', 'bankName', 'accountNo', 'accountHolderName', 'ifscCode'];
}

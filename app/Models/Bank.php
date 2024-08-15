<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{


    protected $table = 'banks';
    protected $fillable = [
        'beneficiary_name',
        'gst',
        'bank_name',
        'bank_accout_number',
        'ifsc',
        'swift_code',
        'branch',
        'company_email',
        'company_phone'
    ];

   
}

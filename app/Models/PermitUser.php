<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_names',
        'dob',
        'sl_license_no',
        'int_permit_no',
        'date_issued',
        'date_expiry',
        'vehicle_types',
        'qr_code_identifier',
        'printed'
    ];
}

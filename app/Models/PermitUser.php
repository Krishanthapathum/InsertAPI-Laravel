<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitUser extends Model
{
    protected $fillable = [
        'surname',
        'other_names',
        'date_of_birth',
        'sl_license_number',
        'international_permit_number',
        'issued_date',
        'expiry_date',
        'valid_vehicles'
    ];

}

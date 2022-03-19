<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'school_name',
        'principal_name',
        'address',
        'telephone_number',
        'fax_number',
        'email',
        'branch',
        'class_location',
        'website',
        'unit',
        'introduction',
        'user_id',
    ];
}

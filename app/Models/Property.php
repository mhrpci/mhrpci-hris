<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'type',
        'main_image',
        'first_image',
        'second_image',
        'third_image',
        'fourth_image',
        'fifth_image',
        'description',
        'contact_info',
        'email',
        'location',
    ];
}

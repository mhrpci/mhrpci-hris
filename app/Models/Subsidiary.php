<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbr',
        'description',
        'contact_no',
        'email_address',
        'facebook_page',
        'wesite',
        'main_image',
        'first_image',
        'second_image',
        'third_image',
    ];
}

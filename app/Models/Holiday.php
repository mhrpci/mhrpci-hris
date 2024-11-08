<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Holiday extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = [
        'title',
        'date',
        'type',
    ];
}


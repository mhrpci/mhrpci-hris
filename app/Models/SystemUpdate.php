<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'published_at', 'is_active'];

    protected $dates = ['published_at'];
}

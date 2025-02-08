<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Policy extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'title',
        'content',
        'sort_order',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}

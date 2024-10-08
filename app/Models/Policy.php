<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'head_name'
    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function position(): HasMany
    {
        return $this->hasMany(Position::class);
    }
}

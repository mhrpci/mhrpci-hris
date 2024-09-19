<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function accountability()
    {
        return $this->belongsTo(Accountability::class);
    }
}

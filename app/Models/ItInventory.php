<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ItInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function accountabilities(): BelongsToMany
    {
        return $this->belongsToMany(Accountability::class, 'accountability_it_inventory')
            ->withTimestamps()
            ->withPivot('assigned_at', 'returned_at');
    }
}

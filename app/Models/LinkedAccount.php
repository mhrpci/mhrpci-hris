<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LinkedAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'linked_user_id',
        'email',
    ];

    /**
     * Get the user that owns this linked account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the linked user.
     */
    public function linkedUser()
    {
        return $this->belongsTo(User::class, 'linked_user_id');
    }
} 
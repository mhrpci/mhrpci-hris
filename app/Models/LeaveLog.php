<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveLog extends Model
{
    use HasFactory;

    protected $fillable = ['leave_id', 'user_id', 'action'];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Post extends Model
{
    use HasFactory;
    use Loggable;

    protected $fillable = ['user_id','title', 'content', 'date_start', 'date_end'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

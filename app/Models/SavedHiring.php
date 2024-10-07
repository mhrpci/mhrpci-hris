<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedHiring extends Model
{
    use HasFactory;

    protected $fillable = ['hiring_id', 'google_user_id'];

    public function hiring()
    {
        return $this->belongsTo(Hiring::class);
    }

    public function googleUser()
    {
        return $this->belongsTo(GoogleUser::class);
    }
}

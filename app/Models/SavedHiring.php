<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedHiring extends Model
{
    use HasFactory;

    protected $fillable = ['hiring_id', 'ip_address'];

    public function hiring()
    {
        return $this->belongsTo(Hiring::class);
    }
}

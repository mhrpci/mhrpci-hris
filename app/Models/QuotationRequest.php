<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'name',
        'email',
        'phone',
        'hospital_name',
        'status',
        'notes'
    ];

    public function product()
    {
        return $this->belongsTo(MedicalProduct::class);
    }
} 
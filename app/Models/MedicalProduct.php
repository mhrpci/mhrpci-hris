<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'details'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quotationRequests()
    {
        return $this->hasMany(QuotationRequest::class, 'product_id');
    }
} 
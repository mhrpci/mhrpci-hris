<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class MedicalProduct extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'details',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
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
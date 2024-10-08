<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'section_number'];

    public function policies()
    {
        return $this->hasMany(Policy::class)->orderBy('sort_order');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->name = self::generateSectionName();
            $section->section_number = self::getNextSectionNumber();
        });
    }

    public static function generateSectionName()
    {
        $nextNumber = self::getNextSectionNumber();
        return "Section " . $nextNumber;
    }

    public static function getNextSectionNumber()
    {
        $maxNumber = self::max('section_number') ?? 0;
        return $maxNumber + 1;
    }
}

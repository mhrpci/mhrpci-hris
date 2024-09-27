<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SssContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'sss_contribution',
    ];

    protected $casts = [
        'sss_contribution' => 'float',
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Date mutator
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('F d, Y');
    }
}
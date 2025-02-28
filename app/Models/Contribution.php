<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Contribution extends Model
{
    use HasFactory, Loggable;

    protected $fillable = [
        'employee_id',
        'date',
        'sss_contribution',
        'philhealth_contribution',
        'pagibig_contribution',
        'tin_contribution',
    ];

    protected $casts = [
        'sss_contribution' => 'float',
        'philhealth_contribution' => 'float',
        'pagibig_contribution' => 'float',
        'tin_contribution' => 'float',
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

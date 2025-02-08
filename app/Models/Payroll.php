<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Payroll extends Model
{
    use HasFactory, Loggable;
  protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'gross_salary',
        'net_salary',
        'late_deduction',
        'undertime_deduction',
        'absent_deduction',
        'sss_contribution',
        'pagibig_contribution',
        'philhealth_contribution',
        'tin_contribution',
        'sss_loan',
        'pagibig_loan',
        'cash_advance',
        'overtime_pay',
        'slug', // Add slug to fillable
        'total_earnings',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payroll) {
            $payroll->slug = Str::slug($payroll->employee_id . '-' . $payroll->start_date . '-' . $payroll->end_date);
        });
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}

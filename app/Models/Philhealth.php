<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Philhealth extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_contribution',
        'employer_contribution',
        'total_contribution',
        'contribution_date',
    ];

    protected $casts = [
        'contribution_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateContribution()
    {
        $salary = $this->employee->salary;
        $monthlyBasicSalary = min(max($salary, 10000), 80000);

        $premium = $monthlyBasicSalary * 0.05;
        $employeeShare = $premium / 2;
        $employerShare = $premium / 2;

        $this->employee_contribution = round($employeeShare, 2);
        $this->employer_contribution = round($employerShare, 2);
        $this->total_contribution = round($premium, 2);

        return $this;
    }
}

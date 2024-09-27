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


    public function calculateContribution(Employee $employee, $month, $year)
    {
        $salary = $employee->salary;
        $totalContribution = $salary * 0.05;
        $employeeContribution = $totalContribution / 2;
        $employerContribution = $totalContribution / 2;

        return PhilhealthContribution::create([
            'employee_id' => $employee->id,
            'employee_contribution' => $employeeContribution,
            'employer_contribution' => $employerContribution,
            'total_contribution' => $totalContribution,
            'contribution_date' => Carbon::create($year, $month, 1),
        ]);
    }

    public function getContributionForMonth(Employee $employee, $month, $year)
    {
        return PhilhealthContribution::where('employee_id', $employee->id)
            ->whereYear('contribution_date', $year)
            ->whereMonth('contribution_date', $month)
            ->first();
    }
}

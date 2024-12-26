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

    public function storeWithContributions()
    {
        $this->save();

        $contributionDate = Carbon::parse($this->contribution_date);
        $firstHalfDate = Carbon::create($contributionDate->year, $contributionDate->month, 10);
        $secondHalfDate = Carbon::create($contributionDate->year, $contributionDate->month, 25);

        $halfContribution = $this->employee_contribution / 2;
        $roundedHalfContribution = round($halfContribution, 2);

        // Create first contribution (10th of the month)
        PhilhealthContribution::create([
            'employee_id' => $this->employee_id,
            'philhealth_contribution' => $roundedHalfContribution,
            'date' => $firstHalfDate,
        ]);

        // Store in Contribution model for 10th
        Contribution::updateOrCreate(
            [
                'employee_id' => $this->employee_id,
                'date' => $firstHalfDate,
            ],
            [
                'philhealth_contribution' => $roundedHalfContribution,
            ]
        );

        // Create second contribution (25th of the month)
        PhilhealthContribution::create([
            'employee_id' => $this->employee_id,
            'philhealth_contribution' => $roundedHalfContribution,
            'date' => $secondHalfDate,
        ]);

        // Store in Contribution model for 25th
        Contribution::updateOrCreate(
            [
                'employee_id' => $this->employee_id,
                'date' => $secondHalfDate,
            ],
            [
                'philhealth_contribution' => $roundedHalfContribution,
            ]
        );

        return $this;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagibig extends Model
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
        // Fixed contribution of 200 for both employee and employer
        $fixedContribution = 200;

        $this->employee_contribution = $fixedContribution;
        $this->employer_contribution = $fixedContribution;
        $this->total_contribution = $this->employee_contribution + $this->employer_contribution;

        return $this;
    }

    public static function createContribution(Employee $employee, $contributionDate)
    {
        $contribution = new self();
        $contribution->employee()->associate($employee);
        $contribution->contribution_date = $contributionDate;
        $contribution->calculateContribution();
        $contribution->save();

        // Create PagibigContribution entries
        self::createPagibigContributions($contribution);

        return $contribution;
    }

    public static function createPagibigContributions(Pagibig $pagibig)
    {
        $employerContribution = $pagibig->employer_contribution / 2;
        $contributionDate = $pagibig->contribution_date;

        // Dates for contributions
        $firstDate = $contributionDate->copy()->setDay(10);
        $secondDate = $contributionDate->copy()->setDay(25);

        // Create first contribution (10th of the month)
        PagibigContribution::create([
            'employee_id' => $pagibig->employee_id,
            'pagibig_contribution' => $employerContribution,
            'date' => $firstDate,
        ]);

        // Store in Contribution model for 10th
        Contribution::updateOrCreate(
            [
                'employee_id' => $pagibig->employee_id,
                'date' => $firstDate,
            ],
            [
                'pagibig_contribution' => $employerContribution,
            ]
        );

        // Create second contribution (25th of the month)
        PagibigContribution::create([
            'employee_id' => $pagibig->employee_id,
            'pagibig_contribution' => $employerContribution,
            'date' => $secondDate,
        ]);

        // Store in Contribution model for 25th
        Contribution::updateOrCreate(
            [
                'employee_id' => $pagibig->employee_id,
                'date' => $secondDate,
            ],
            [
                'pagibig_contribution' => $employerContribution,
            ]
        );
    }
}

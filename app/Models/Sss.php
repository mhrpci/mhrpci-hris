<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sss extends Model
{
    protected $table = 'ssses';

    protected $fillable = [
        'employee_id',
        'monthly_salary_credit',
        'employee_contribution',
        'employer_contribution',
        'total_contribution',
        'ec_contribution',
        'contribution_date',
    ];

    protected $casts = [
        'contribution_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public static function calculateContribution($salary)
    {
        $contributionTable = [
            ['range' => [0, 4250], 'credit' => 4000, 'ee' => 180, 'er' => 380],
            ['range' => [4250, 4749.99], 'credit' => 4500, 'ee' => 202.50, 'er' => 427.50],
            ['range' => [4750, 5249.99], 'credit' => 5000, 'ee' => 225, 'er' => 450],
            ['range' => [5250, 5749.99], 'credit' => 5500, 'ee' => 247.50, 'er' => 495],
            ['range' => [5750, 6249.99], 'credit' => 6000, 'ee' => 270, 'er' => 540],
            ['range' => [6250, 6749.99], 'credit' => 6500, 'ee' => 292.50, 'er' => 585],
            ['range' => [6750, 7249.99], 'credit' => 7000, 'ee' => 315, 'er' => 630],
            ['range' => [7250, 7749.99], 'credit' => 7500, 'ee' => 337.50, 'er' => 675],
            ['range' => [7750, 8249.99], 'credit' => 8000, 'ee' => 360, 'er' => 720],
            ['range' => [8250, 8749.99], 'credit' => 8500, 'ee' => 382.50, 'er' => 765],
            ['range' => [8750, 9249.99], 'credit' => 9000, 'ee' => 405, 'er' => 810],
            ['range' => [9250, 9749.99], 'credit' => 9500, 'ee' => 427.50, 'er' => 855],
            ['range' => [9750, 10249.99], 'credit' => 10000, 'ee' => 450, 'er' => 900],
            ['range' => [10250, 10749.99], 'credit' => 10500, 'ee' => 472.50, 'er' => 945],
            ['range' => [10750, 11249.99], 'credit' => 11000, 'ee' => 495, 'er' => 990],
            ['range' => [11250, 11749.99], 'credit' => 11500, 'ee' => 517.50, 'er' => 1035],
            ['range' => [11750, 12249.99], 'credit' => 12000, 'ee' => 540, 'er' => 1140],
            ['range' => [12250, 12749.99], 'credit' => 12500, 'ee' => 562.50, 'er' => 1125],
            ['range' => [12750, 13249.99], 'credit' => 13000, 'ee' => 585, 'er' => 1170],
            ['range' => [13250, 13749.99], 'credit' => 13500, 'ee' => 607.50, 'er' => 1215],
            ['range' => [13750, 14249.99], 'credit' => 14000, 'ee' => 630, 'er' => 1260],
            ['range' => [14250, 14749.99], 'credit' => 14500, 'ee' => 652.50, 'er' => 1305],
            ['range' => [14750, 15249.99], 'credit' => 15000, 'ee' => 675, 'er' => 1350],
            ['range' => [15250, 15749.99], 'credit' => 15500, 'ee' => 697.50, 'er' => 1395],
            ['range' => [15750, 16249.99], 'credit' => 16000, 'ee' => 720, 'er' => 1440],
            ['range' => [16250, 16749.99], 'credit' => 16500, 'ee' => 742.50, 'er' => 1485],
            ['range' => [16750, 17249.99], 'credit' => 17000, 'ee' => 765, 'er' => 1530],
            ['range' => [17250, 17749.99], 'credit' => 17500, 'ee' => 787.50, 'er' => 1575],
            ['range' => [17750, 18249.99], 'credit' => 18000, 'ee' => 810, 'er' => 1620],
            ['range' => [18250, 18749.99], 'credit' => 18500, 'ee' => 832.50, 'er' => 1665],
            ['range' => [18750, 19249.99], 'credit' => 19000, 'ee' => 855, 'er' => 1710],
            ['range' => [19250, 19749.99], 'credit' => 19500, 'ee' => 877.50, 'er' => 1755],
            ['range' => [19750, PHP_INT_MAX], 'credit' => 20000, 'ee' => 900, 'er' => 1900],
        ];

        foreach ($contributionTable as $tier) {
            if ($salary >= $tier['range'][0] && $salary <= $tier['range'][1]) {
                return [
                    'monthly_salary_credit' => $tier['credit'],
                    'employee_contribution' => $tier['ee'],
                    'employer_contribution' => $tier['er'],
                    'total_contribution' => $tier['ee'] + $tier['er'],
                    'ec_contribution' => 10.00,
                ];
            }
        }

        // If salary is higher than the maximum tier, use the last tier
        $lastTier = end($contributionTable);
        return [
            'monthly_salary_credit' => $lastTier['credit'],
            'employee_contribution' => $lastTier['ee'],
            'employer_contribution' => $lastTier['er'],
            'total_contribution' => $lastTier['ee'] + $lastTier['er'],
            'ec_contribution' => 10.00,
        ];
    }

    public static function createContribution(Employee $employee, $contributionDate)
    {
        // Check if a contribution already exists for the employee on the given date
        $existingContribution = self::where('employee_id', $employee->id)
            ->where('contribution_date', $contributionDate)
            ->first();

        if ($existingContribution) {
            // Optionally, update the existing contribution or return a message
            return $existingContribution; // or handle as needed
        }

        $salary = $employee->salary;
        $contribution = self::calculateContribution($salary);

        return self::create([
            'employee_id' => $employee->id,
            'monthly_salary_credit' => $contribution['monthly_salary_credit'],
            'employee_contribution' => $contribution['employee_contribution'],
            'employer_contribution' => $contribution['employer_contribution'],
            'total_contribution' => $contribution['total_contribution'],
            'ec_contribution' => $contribution['ec_contribution'],
            'contribution_date' => $contributionDate,
        ]);
    }
}

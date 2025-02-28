<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sss extends Model
{
    use HasFactory, Loggable;

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
            ['range' => [0, 5250], 'credit' => 5000, 'ee' => 250, 'er' => 510],
            ['range' => [5250, 5749.99], 'credit' => 5500, 'ee' => 275, 'er' => 560],
            ['range' => [5750, 6249.99], 'credit' => 6000, 'ee' => 300, 'er' => 610],
            ['range' => [6250, 6749.99], 'credit' => 6500, 'ee' => 325, 'er' => 660],
            ['range' => [6750, 7249.99], 'credit' => 7000, 'ee' => 350, 'er' => 710],
            ['range' => [7250, 7749.99], 'credit' => 7500, 'ee' => 375, 'er' => 760],
            ['range' => [7750, 8249.99], 'credit' => 8000, 'ee' => 400, 'er' => 810],
            ['range' => [8250, 8749.99], 'credit' => 8500, 'ee' => 425, 'er' => 860],
            ['range' => [8750, 9249.99], 'credit' => 9000, 'ee' => 450, 'er' => 910],
            ['range' => [9250, 9749.99], 'credit' => 9500, 'ee' => 475, 'er' => 960],
            ['range' => [9750, 10249.99], 'credit' => 10000, 'ee' => 500, 'er' => 1010],
            ['range' => [10250, 10749.99], 'credit' => 10500, 'ee' => 525, 'er' => 1060],
            ['range' => [10750, 11249.99], 'credit' => 11000, 'ee' => 550, 'er' => 1110],
            ['range' => [11250, 11749.99], 'credit' => 11500, 'ee' => 575, 'er' => 1160],
            ['range' => [11750, 12249.99], 'credit' => 12000, 'ee' => 600, 'er' => 1210],
            ['range' => [12250, 12749.99], 'credit' => 12500, 'ee' => 625, 'er' => 1260],
            ['range' => [12750, 13249.99], 'credit' => 13000, 'ee' => 650, 'er' => 1310],
            ['range' => [13250, 13749.99], 'credit' => 13500, 'ee' => 675, 'er' => 1360],
            ['range' => [13750, 14249.99], 'credit' => 14000, 'ee' => 700, 'er' => 1410],
            ['range' => [14250, 14749.99], 'credit' => 14500, 'ee' => 725, 'er' => 1460],
            ['range' => [14750, 15249.99], 'credit' => 15000, 'ee' => 750, 'er' => 1530],
            ['range' => [15250, 15749.99], 'credit' => 15500, 'ee' => 775, 'er' => 1580],
            ['range' => [15750, 16249.99], 'credit' => 16000, 'ee' => 800, 'er' => 1630],
            ['range' => [16250, 16749.99], 'credit' => 16500, 'ee' => 825, 'er' => 1680],
            ['range' => [16750, 17249.99], 'credit' => 17000, 'ee' => 850, 'er' => 1730],
            ['range' => [17250, 17749.99], 'credit' => 17500, 'ee' => 875, 'er' => 1780],
            ['range' => [17750, 18249.99], 'credit' => 18000, 'ee' => 900, 'er' => 1830],
            ['range' => [18250, 18749.99], 'credit' => 18500, 'ee' => 925, 'er' => 1880],
            ['range' => [18750, 19249.99], 'credit' => 19000, 'ee' => 950, 'er' => 1930],
            ['range' => [19250, 19749.99], 'credit' => 19500, 'ee' => 975, 'er' => 1980],
            ['range' => [19750, 20249.99], 'credit' => 20000, 'ee' => 1000, 'er' => 2030],
            ['range' => [20250, 20749.99], 'credit' => 20500, 'ee' => 1025, 'er' => 2080],
            ['range' => [20750, 21249.99], 'credit' => 21000, 'ee' => 1050, 'er' => 2130],
            ['range' => [21250, 21749.99], 'credit' => 21500, 'ee' => 1075, 'er' => 2180],
            ['range' => [21750, 22249.99], 'credit' => 22000, 'ee' => 1100, 'er' => 2230],
            ['range' => [22250, 22749.99], 'credit' => 22500, 'ee' => 1125, 'er' => 2280],
            ['range' => [22750, 23249.99], 'credit' => 23000, 'ee' => 1150, 'er' => 2330],
            ['range' => [23250, 23749.99], 'credit' => 23500, 'ee' => 1175, 'er' => 2380],
            ['range' => [23750, 24249.99], 'credit' => 24000, 'ee' => 1200, 'er' => 2430],
            ['range' => [24250, 24749.99], 'credit' => 24500, 'ee' => 1225, 'er' => 2480],
            ['range' => [24750, 25249.99], 'credit' => 25000, 'ee' => 1250, 'er' => 2530],
            ['range' => [25250, 25749.99], 'credit' => 25500, 'ee' => 1275, 'er' => 2580],
            ['range' => [25750, 26249.99], 'credit' => 26000, 'ee' => 1300, 'er' => 2630],
            ['range' => [26250, 26749.99], 'credit' => 26500, 'ee' => 1325, 'er' => 2680],
            ['range' => [26750, 27249.99], 'credit' => 27000, 'ee' => 1350, 'er' => 2730],
            ['range' => [27250, 27749.99], 'credit' => 27500, 'ee' => 1375, 'er' => 2780],
            ['range' => [27750, 28249.99], 'credit' => 28000, 'ee' => 1400, 'er' => 2830],
            ['range' => [28250, 28749.99], 'credit' => 28500, 'ee' => 1425, 'er' => 2880],
            ['range' => [28750, 29249.99], 'credit' => 29000, 'ee' => 1450, 'er' => 2930],
            ['range' => [29250, 29749.99], 'credit' => 29500, 'ee' => 1475, 'er' => 2980],
            ['range' => [29750, 30249.99], 'credit' => 30000, 'ee' => 1500, 'er' => 3030],
            ['range' => [30250, 30749.99], 'credit' => 30500, 'ee' => 1525, 'er' => 3080],
            ['range' => [30750, 31249.99], 'credit' => 31000, 'ee' => 1550, 'er' => 3130],
            ['range' => [31250, 31749.99], 'credit' => 31500, 'ee' => 1575, 'er' => 3180],
            ['range' => [31750, 32249.99], 'credit' => 32000, 'ee' => 1600, 'er' => 3230],
            ['range' => [32250, 32749.99], 'credit' => 32500, 'ee' => 1625, 'er' => 3280],
            ['range' => [32750, 33249.99], 'credit' => 33000, 'ee' => 1650, 'er' => 3330],
            ['range' => [33250, 33749.99], 'credit' => 33500, 'ee' => 1675, 'er' => 3380],
            ['range' => [33750, 34249.99], 'credit' => 34000, 'ee' => 1700, 'er' => 3430],
            ['range' => [34250, 34749.99], 'credit' => 34500, 'ee' => 1725, 'er' => 3480],
            ['range' => [34750, PHP_INT_MAX], 'credit' => 35000, 'ee' => 1750, 'er' => 3530],
        ];

        foreach ($contributionTable as $tier) {
            if ($salary >= $tier['range'][0] && $salary <= $tier['range'][1]) {
                return [
                    'monthly_salary_credit' => $tier['credit'],
                    'employee_contribution' => $tier['ee'],
                    'employer_contribution' => $tier['er'],
                    'total_contribution' => $tier['ee'] + $tier['er'],
                    'ec_contribution' => $tier['credit'] < 15000 ? 10.00 : 30.00,
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
            'ec_contribution' => 30.00, // Last tier will always be above 15000
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

        $newContribution = self::create([
            'employee_id' => $employee->id,
            'monthly_salary_credit' => $contribution['monthly_salary_credit'],
            'employee_contribution' => $contribution['employee_contribution'],
            'employer_contribution' => $contribution['employer_contribution'],
            'total_contribution' => $contribution['total_contribution'],
            'ec_contribution' => $contribution['ec_contribution'],
            'contribution_date' => $contributionDate,
        ]);

        // Create SssContribution entries
        self::createSssContributionEntries($employee->id, $contribution['employee_contribution'], $contributionDate);

        return $newContribution;
    }

    private static function createSssContributionEntries($employeeId, $employeeContribution, $contributionDate)
    {
        $employee = Employee::find($employeeId);
        
        if ($employee->department->name === 'BGPDI') {
            // For BGPDI employees - weekly contributions (1/4 of the total)
            $quarterContribution = $employeeContribution / 4;
            $contributionMonth = Carbon::parse($contributionDate);
            
            // Set weekly dates (7th, 14th, 21st, 28th of the month)
            $weeklyDates = [
                $contributionMonth->copy()->setDay(7),
                $contributionMonth->copy()->setDay(14),
                $contributionMonth->copy()->setDay(21),
                $contributionMonth->copy()->setDay(28),
            ];

            foreach ($weeklyDates as $date) {
                SssContribution::create([
                    'employee_id' => $employeeId,
                    'date' => $date,
                    'sss_contribution' => $quarterContribution,
                ]);

                Contribution::updateOrCreate(
                    [
                        'employee_id' => $employeeId,
                        'date' => $date,
                    ],
                    [
                        'sss_contribution' => $quarterContribution,
                    ]
                );
            }
        } else {
            // For other departments - bi-monthly contributions (1/2 of the total)
            $halfContribution = $employeeContribution / 2;
            $contributionMonth = Carbon::parse($contributionDate);

            $firstDate = $contributionMonth->copy()->setDay(10);
            $lastDate = $contributionMonth->copy()->setDay(25);

            foreach ([$firstDate, $lastDate] as $date) {
                SssContribution::create([
                    'employee_id' => $employeeId,
                    'date' => $date,
                    'sss_contribution' => $halfContribution,
                ]);

                Contribution::updateOrCreate(
                    [
                        'employee_id' => $employeeId,
                        'date' => $date,
                    ],
                    [
                        'sss_contribution' => $halfContribution,
                    ]
                );
            }
        }
    }
}

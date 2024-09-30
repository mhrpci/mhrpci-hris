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

    public static function createMonthlyContributions($month, $year)
    {
        $contributionDate = Carbon::create($year, $month, 1);
        $employees = Employee::whereHas('sss', function ($query) use ($contributionDate) {
            $query->whereDate('contribution_date', $contributionDate)
                  ->where('sss', true);
        })->get();

        $contributions = [];

        foreach ($employees as $employee) {
            $sssContribution = $employee->sss()
                ->whereDate('contribution_date', $contributionDate)
                ->first();

            if ($sssContribution) {
                $halfContribution = $sssContribution->employee_contribution / 2;

                $firstDate = Carbon::create($year, $month, 10);
                $lastDate = Carbon::create($year, $month, 1)->endOfMonth();

                foreach ([$firstDate, $lastDate] as $date) {
                    $contributions[] = self::create([
                        'employee_id' => $employee->id,
                        'date' => $date,
                        'sss_contribution' => $halfContribution,
                    ]);
                }
            }
        }

        return $contributions;
    }
}

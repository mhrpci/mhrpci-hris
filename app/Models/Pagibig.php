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

        return $contribution;
    }
}

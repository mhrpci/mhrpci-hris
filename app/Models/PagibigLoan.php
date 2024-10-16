<?php

namespace App\Models;

use App\Enums\LoanType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagibigLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'loan_type',
        'loan_amount',
        'interest_rate',
        'loan_term_months',
        'monthly_amortization',
    ];

    protected $casts = [
        'loan_type' => LoanType::class,
    ];

    // Default interest rates for each loan type
    protected $defaultInterestRates = [
        'MULTI_PURPOSE' => 10.5,  // Default for Multi-Purpose Loan
        'CALAMITY' => 5.95,       // Default for Calamity Loan
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function calculateMonthlyAmortization(): float
    {
        $P = $this->loan_amount;
        $n = $this->loan_term_months;

        // Determine the interest rate based on the loan amount for Housing Loans
        if ($this->loan_type === LoanType::HOUSING) {
            $interestRate = $this->determineHousingLoanInterestRate($P);
        } else {
            // Use the provided interest rate or the default if none is set for other loans
            $interestRate = $this->interest_rate ?? $this->defaultInterestRates[$this->loan_type->value];
        }

        $r = $interestRate / 100 / 12; // Monthly interest rate

        switch ($this->loan_type) {
            case LoanType::HOUSING:
                // Amortization formula for Housing Loan
                return ($P * $r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);

            case LoanType::MULTI_PURPOSE:
            case LoanType::CALAMITY:
                // Simple interest calculation for Multi-Purpose and Calamity Loans
                $totalInterest = $interestRate / 100 * ($n / 12);
                return ($P * (1 + $totalInterest)) / $n;
        }

        // Default to 0 if the loan type is invalid
        return 0;
    }

    protected function determineHousingLoanInterestRate(float $loanAmount): float
    {
        if ($loanAmount <= 500000) {
            return 5.75;
        } elseif ($loanAmount <= 1000000) {
            return 6.5;
        } elseif ($loanAmount <= 1500000) {
            return 7.0;
        } else {
            return 8.0;
        }
    }

    public function payments()
    {
        return $this->hasMany(PagibigLoanPayment::class);
    }

    public function calculateRemainingBalance(): float
    {
        $totalPaid = $this->payments()->sum('amount');
        return max(0, $this->loan_amount - $totalPaid);
    }
}

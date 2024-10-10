<?php

namespace App\Http\Controllers;

use App\Models\SssLoan;
use App\Models\Employee;
use App\Models\LoanPayment;
use App\Models\Loan; // Add this at the top of the file with other imports
use Illuminate\Http\Request;
use Carbon\Carbon;

class SssLoanController extends Controller
{
    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('loan_sss.create', compact('employees'));
    }

    /**
     * Store the newly created loan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_amount' => 'required|numeric|min:1000', // Minimum loan amount
            'repayment_term' => 'required|integer|min:1|max:24', // Repayment term (1 to 24 months)
        ]);

        // Calculate monthly amortization and total repayment
        $loan_amount = $request->loan_amount;
        $repayment_term = $request->repayment_term;
        $interest_rate = 0.10; // 10% annual interest rate

        $total_interest = $loan_amount * $interest_rate; // Total interest
        $total_repayment = $loan_amount + $total_interest; // Total amount to be repaid
        $monthly_amortization = $total_repayment / $repayment_term; // Monthly amortization

        // Create the loan record
        SssLoan::create([
            'employee_id' => $request->employee_id,
            'loan_amount' => $loan_amount,
            'repayment_term' => $repayment_term,
            'monthly_amortization' => $monthly_amortization,
            'total_repayment' => $total_repayment,
        ]);

        return redirect()->route('loan_sss.index')->with('success', 'SSS Loan has been created successfully.');
    }

    /**
     * Display a listing of loans.
     */
    public function index()
    {
        $loan_sss = SssLoan::with('employee')->get();
        return view('loan_sss.index', compact('loan_sss'));
    }

    /**
     * Display the ledger for a specific SSS loan.
     */
    public function showLedger($id)
    {
        $loan = SssLoan::with(['employee', 'payments'])->findOrFail($id);

        // Calculate total paid amount
        $totalPaid = $loan->payments->sum('amount');

        // Calculate remaining balance
        $remainingBalance = max(0, $loan->total_repayment - $totalPaid);

        return view('loan_sss.ledger', compact('loan', 'totalPaid', 'remainingBalance'));
    }

    public function generatePayments()
    {
        try {
            $loans = SssLoan::all();
            $paymentsGenerated = 0;
            $currentMonth = Carbon::now()->startOfMonth();

            foreach ($loans as $loan) {
                // Check if a payment for the current month already exists
                $existingPayment = LoanPayment::where('loan_id', $loan->id)
                    ->whereYear('payment_date', $currentMonth->year)
                    ->whereMonth('payment_date', $currentMonth->month)
                    ->exists();

                if (!$existingPayment) {
                    $payment = LoanPayment::create([
                        'loan_id' => $loan->id,
                        'amount' => $loan->monthly_amortization,
                        'payment_date' => Carbon::now(),
                        'notes' => 'Auto-generated payment',
                    ]);
                    $paymentsGenerated++;

                    // Calculate half of the payment amount
                    $halfAmount = $payment->amount / 2;

                    // Get the payment month and year
                    $paymentDate = Carbon::parse($payment->payment_date);
                    $paymentYear = $paymentDate->year;
                    $paymentMonth = $paymentDate->month;

                    // Create two Loan entries for the 10th and 25th of the payment month
                    foreach ([10, 25] as $day) {
                        Loan::create([
                            'employee_id' => $loan->employee_id,
                            'sss_loan' => $halfAmount,
                            'date' => Carbon::create($paymentYear, $paymentMonth, $day),
                        ]);
                    }
                }
            }

            return redirect()->route('loan_sss.index')->with('success', "Successfully generated {$paymentsGenerated} payments.");
        } catch (\Exception $e) {
            return redirect()->route('loan_sss.index')->with('error', 'Error generating payments: ' . $e->getMessage());
        }
    }
}

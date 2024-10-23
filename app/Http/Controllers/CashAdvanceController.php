<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\CashAdvancePayment;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Loan;

class CashAdvanceController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $cashAdvances = CashAdvance::with('employee', 'payments')->get();
        return view('cash_advances.index', compact('cashAdvances', 'employees'));
    }

    public function create()
    {
        $oneYearAgo = now()->subYear();
        $employees = Employee::where('date_hired', '<=', $oneYearAgo)->get();
        return view('cash_advances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'cash_advance_amount' => 'required|numeric|min:0',
            'repayment_term' => 'required|integer|min:1',
        ]);

        $employee = Employee::findOrFail($validatedData['employee_id']);

        if (!$this->isEmployeeEligibleForCashAdvance($employee)) {
            return redirect()->route('cash_advances.create')
                ->with('error', 'Employee must be hired for at least one year to be eligible for a cash advance.')
                ->withInput();
        }

        $cashAdvance = new CashAdvance($validatedData);
        $cashAdvance->status = 'active';
        $cashAdvance->calculateLoanDetails();
        $cashAdvance->save();

        return redirect()->route('cash_advances.index')->with('success', 'Cash Advance created successfully.');
    }

    public function show(CashAdvance $cashAdvance)
    {
        return view('cash_advances.show', compact('cashAdvance'));
    }

    public function edit(CashAdvance $cashAdvance)
    {
        return view('cash_advances.edit', compact('cashAdvance'));
    }

    public function update(Request $request, CashAdvance $cashAdvance)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:active,complete',
        ]);

        $cashAdvance->update($validatedData);

        return redirect()->route('cash_advances.index')->with('success', 'Cash Advance status updated successfully.');
    }

    public function destroy(CashAdvance $cashAdvance)
    {
        $cashAdvance->delete();
        return redirect()->route('cash_advances.index')->with('success', 'Cash Advance deleted successfully.');
    }

    public function ledger($id)
    {
        $cashAdvance = CashAdvance::with(['employee', 'payments'])->findOrFail($id);
        return view('cash_advances.ledger', compact('cashAdvance'));
    }

    public function generatePayments()
    {
        try {
            $cashAdvances = CashAdvance::where('status', 'active')->get();
            $paymentsGenerated = 0;
            $currentMonth = Carbon::now()->startOfMonth();

            foreach ($cashAdvances as $cashAdvance) {
                // Check if a payment for the current month already exists
                $existingPayment = CashAdvancePayment::where('cash_advance_id', $cashAdvance->id)
                    ->whereYear('payment_date', $currentMonth->year)
                    ->whereMonth('payment_date', $currentMonth->month)
                    ->exists();

                if (!$existingPayment) {
                    $payment = CashAdvancePayment::create([
                        'cash_advance_id' => $cashAdvance->id,
                        'amount' => $cashAdvance->monthly_amortization,
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
                            'employee_id' => $cashAdvance->employee_id,
                            'cash_advance' => $halfAmount,
                            'date' => Carbon::create($paymentYear, $paymentMonth, $day),
                        ]);
                    }
                }
            }

            return redirect()->route('cash_advances.index')->with('success', "Successfully generated {$paymentsGenerated} payments.");
        } catch (\Exception $e) {
            return redirect()->route('cash_advances.index')->with('error', 'Error generating payments: ' . $e->getMessage());
        }
    }

    public function generatePaymentForEmployee(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);

            $employee_id = $validatedData['employee_id'];
            $cashAdvances = CashAdvance::where('status', 'active')
                ->where('employee_id', $employee_id)
                ->get();
            $paymentsGenerated = 0;
            $currentMonth = Carbon::now()->startOfMonth();

            foreach ($cashAdvances as $cashAdvance) {
                // Check if a payment for the current month already exists
                $existingPayment = CashAdvancePayment::where('cash_advance_id', $cashAdvance->id)
                    ->whereYear('payment_date', $currentMonth->year)
                    ->whereMonth('payment_date', $currentMonth->month)
                    ->exists();

                if (!$existingPayment) {
                    $payment = CashAdvancePayment::create([
                        'cash_advance_id' => $cashAdvance->id,
                        'amount' => $cashAdvance->monthly_amortization,
                        'payment_date' => Carbon::now(),
                        'notes' => 'Auto-generated payment for specific employee',
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
                            'employee_id' => $cashAdvance->employee_id,
                            'cash_advance' => $halfAmount,
                            'date' => Carbon::create($paymentYear, $paymentMonth, $day),
                        ]);
                    }
                }
            }

            return redirect()->route('cash_advances.index')->with('success', "Successfully generated {$paymentsGenerated} payments for the selected employee.");
        } catch (\Exception $e) {
            return redirect()->route('cash_advances.index')->with('error', 'Error generating payments: ' . $e->getMessage());
        }
    }

    private function isEmployeeEligibleForCashAdvance(Employee $employee)
    {
        $hireDate = Carbon::parse($employee->date_hired);
        $today = Carbon::now();

        return $hireDate->diffInDays($today) >= 365;
    }
}

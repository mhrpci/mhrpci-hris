<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->paginate(10);
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $payroll = new Payroll($request->all());
        $payroll->employee()->associate($employee);
        $payroll->calculatePayroll();
        $payroll->save();

        return redirect()->route('payrolls.index')->with('success', 'Payroll generated successfully.');
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }

    public function generatePayslip(Payroll $payroll)
    {
        return view('payrolls.payslip', compact('payroll'));
    }

    public function generateAllPayrolls()
    {
        $employees = Employee::all();
        $currentDate = Carbon::now();

        if ($currentDate->day <= 10) {
            // Generate payroll for 26th of previous month to 10th of current month
            $startDate = $currentDate->copy()->subMonth()->startOfMonth()->addDays(25);
            $endDate = $currentDate->copy()->startOfMonth()->addDays(9);
        } else {
            // Generate payroll for 11th to 25th of current month
            $startDate = $currentDate->copy()->startOfMonth()->addDays(10);
            $endDate = $currentDate->copy()->startOfMonth()->addDays(24);
        }

        foreach ($employees as $employee) {
            $payroll = new Payroll([
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
            $payroll->employee()->associate($employee);
            $payroll->calculatePayroll();
            $payroll->save();
        }

        return redirect()->route('payrolls.index')->with('success', 'All payrolls generated successfully.');
    }

    private function calculateSssContribution($salary)
{
    // Implement SSS contribution calculation based on the latest SSS contribution table
    // This is a simplified example
    if ($salary <= 3250) {
        return 135;
    } elseif ($salary <= 3750) {
        return 157.50;
    }
    // ... continue for other salary ranges
}

private function calculatePagibigContribution($salary)
{
    // Implement Pag-IBIG contribution calculation
    // This is a simplified example
    $contribution = $salary * 0.02;
    return min($contribution, 100);
}

private function calculatePhilhealthContribution($salary)
{
    // Implement PhilHealth contribution calculation
    // This is a simplified example
    $contribution = $salary * 0.03;
    $maxContribution = 1800;
    return min($contribution, $maxContribution);
}
}

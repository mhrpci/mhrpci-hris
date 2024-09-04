<?php

namespace App\Http\Controllers;

use App\Services\PayrollService;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Carbon\Carbon;
use App\Models\Employee;

class PayrollController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    // Display a form to create payroll
    public function create()
    {
        $employees = Employee::all();
        return view('payroll.create', compact('employees'));
    }

    // Store the payroll record
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $employee_id = $request->input('employee_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Call the PayrollService to calculate and store payroll
        $payroll = $this->payrollService->calculatePayroll($employee_id, $start_date, $end_date);

        return redirect()->route('payroll.show', ['id' => $payroll->id])
                         ->with('success', 'Payroll calculated and stored successfully.');
    }

    // Display payroll details
    public function show($id)
    {
        $payroll = Payroll::findOrFail($id);
        return view('payroll.show', compact('payroll'));
    }

    // List all payroll records
    public function index()
    {
        $payrolls = Payroll::all();
        return view('payroll.index', compact('payrolls'));
    }
}

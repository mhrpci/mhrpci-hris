<?php

namespace App\Http\Controllers;

use App\Services\PayrollService;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Carbon\Carbon;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    protected $payrollService;

    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
        $this->middleware('auth');
        $this->middleware('permission:payroll-list|payroll-create|payroll-edit|payroll-delete', ['only' => ['index','show']]);
        $this->middleware('permission:payroll-create', ['only' => ['create','store']]);
        $this->middleware('permission:payroll-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:payroll-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a form to create payroll
     */
    public function create()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has the Super Admin role
        if ($user->hasRole('Super Admin')) {
            $employees = Employee::where('employee_status', 'Active')->get();
        } else {
            // If not Super Admin, only get employees with Rank File rank
            $employees = Employee::where('rank', 'Rank File')
                                 ->where('employee_status', 'Active')
                                 ->get();
        }

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

    /**
     * List all payroll records
     */
    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has the Super Admin role
        if ($user->hasRole('Super Admin')) {
            $payrolls = Payroll::with('employee')->get();
        } else {
            // If not Super Admin, only get payrolls for employees with Rank File rank
            $payrolls = Payroll::whereHas('employee', function ($query) {
                $query->where('rank', 'Rank File');
            })->with('employee')->get();
        }

        return view('payroll.index', compact('payrolls'));
    }
    public function destroy($id)
    {
        // Find the payroll record by ID
        $payroll = Payroll::findOrFail($id);

        // Delete the payroll record
        $payroll->delete();

        // Redirect to the payroll index with a success message
        return redirect()->route('payroll.index')->with('success', 'Payroll record deleted successfully.');
    }

    public function employeesWithPayroll()
    {
        $employees = Employee::whereHas('payrolls')->get();
        return view('payroll.employees_with_payroll', compact('employees'));
    }

    public function payslips($employee_id)
    {
        $employee = Employee::with('payrolls')->findOrFail($employee_id);

        // Ensure dates are Carbon instances
        foreach ($employee->payrolls as $payroll) {
            $payroll->start_date = Carbon::parse($payroll->start_date);
            $payroll->end_date = Carbon::parse($payroll->end_date);
        }

        return view('payroll.payslips', compact('employee'));
    }

    public function downloadPdf($id)
    {
        $payroll = Payroll::findOrFail($id);
        $pdf = PDF::loadView('payroll.payroll.pdf', compact('payroll'));
        return $pdf->download('payslip.pdf');
    }

    public function myPayrolls()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Find the employee by email address
        $employee = Employee::with('payrolls')->where('email_address', $user->email)->firstOrFail();

        // Ensure dates are Carbon instances
        foreach ($employee->payrolls as $payroll) {
            $payroll->start_date = Carbon::parse($payroll->start_date);
            $payroll->end_date = Carbon::parse($payroll->end_date);
        }

        return view('payroll.my_payrolls', compact('employee'));
    }
}

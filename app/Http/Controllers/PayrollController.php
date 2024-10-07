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
        $employees = Employee::where('employee_status', 'Active')->get();
        return view('payroll.create', compact('employees'));
    }

    // Store the payroll records for all employees
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $specific_employee_id = $request->input('employee_id');

        $user = auth()->user();

        if ($specific_employee_id) {
            $employees = Employee::where('id', $specific_employee_id)
                                 ->where('employee_status', 'Active')
                                 ->get();
        } else {
            if ($user->hasRole('Super Admin')) {
                $employees = Employee::where('employee_status', 'Active')->get();
            } else {
                $employees = Employee::where('rank', 'Rank File')
                                     ->where('employee_status', 'Active')
                                     ->get();
            }
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($employees as $employee) {
            try {
                if ($this->existingPayroll($employee->id, $start_date, $end_date)) {
                    \Log::warning("Payroll already exists for employee ID {$employee->id} for the given date range.");
                    $failCount++;
                    continue;
                }

                $this->payrollService->calculatePayroll($employee->id, $start_date, $end_date);
                $successCount++;
            } catch (\Exception $e) {
                \Log::error("Failed to calculate payroll for employee ID {$employee->id}: " . $e->getMessage());
                $failCount++;
            }
        }

        $message = "Payroll calculated and stored successfully for {$successCount} " .
                   ($specific_employee_id ? "employee" : "active employees") . ".";
        if ($failCount > 0) {
            $message .= " Failed for {$failCount} " . ($specific_employee_id ? "employee" : "employees") . ". Check logs for details.";
        }

        return redirect()->route('payroll.index')->with('success', $message);
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

    public function myPayrolls()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Find the employee by email address
        $employee = Employee::with('payrolls')->where('email_address', $user->email)->first();

        if ($employee) {
            // Ensure dates are Carbon instances
            foreach ($employee->payrolls as $payroll) {
                $payroll->start_date = Carbon::parse($payroll->start_date);
                $payroll->end_date = Carbon::parse($payroll->end_date);
            }

            return view('payroll.my_payrolls', compact('employee'));
        } else {
            return redirect()->route('payroll.index')->with('error', 'Employee not found.');
        }
    }

    public function generatePayslip($payroll_id)
    {
        $payroll = Payroll::with('employee')->findOrFail($payroll_id);

        // Ensure dates are Carbon instances
        $payroll->start_date = Carbon::parse($payroll->start_date);
        $payroll->end_date = Carbon::parse($payroll->end_date);

        // Get the logo path
        $logoPath = public_path('vendor/adminlte/dist/img/LOGO4.png');

        $pdf = PDF::loadView('payroll.payslip_pdf', compact('payroll', 'logoPath'));

        // Set paper size to letter
        $pdf->setPaper('letter');

        // Set custom margins to occupy half of the paper
        $pdf->setOptions([
            'margin-top'    => 0,
            'margin-right'  => 0,
            'margin-bottom' => 0,
            'margin-left'   => 0,
        ]);

        return $pdf->download('payslip_' . $payroll->employee->employee_id . '_' . $payroll->start_date->format('Y-m-d') . '.pdf');
    }

    /**
     * Check if a payroll record already exists for the given employee and date range
     *
     * @param int $employee_id
     * @param string $start_date
     * @param string $end_date
     * @return bool
     */
    public function existingPayroll($employee_id, $start_date, $end_date)
    {
        return Payroll::where('employee_id', $employee_id)
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->exists();
    }
}

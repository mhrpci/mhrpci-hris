<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\SssContribution;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Pagibig;
use App\Models\PhilhealthContribution;
use App\Models\PagibigContribution;
use App\Models\Philhealth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:contribution-list|contribution-create|contribution-edit|contribution-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:contribution-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:contribution-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:contribution-delete'], ['only' => ['destroy']]);
    }
 /**
     * Display a listing of the contributions.
     */
    public function index(Request $request)
    {
        $query = Contribution::with('employee');

        // Filter by employee if employee_id is provided
        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $contributions = $query->orderBy('date', 'desc')->get();

        // Calculate totals
        $totals = [
            'sss' => $contributions->sum('sss_contribution'),
            'philhealth' => $contributions->sum('philhealth_contribution'),
            'pagibig' => $contributions->sum('pagibig_contribution'),
            'tin' => $contributions->sum('tin_contribution')
        ];

        $employees = Employee::all(); // For the employee dropdown

        return view('contributions.index', compact('contributions', 'totals', 'employees'));
    }
    /**
     * Show the form for creating a new contribution.
     */
    public function create()
    {
        $employees = Employee::where('employee_status', 'Active')->get();
        return view('contributions.create',compact('employees'));
    }

    /**
     * Store a newly created contribution in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'sss_contribution' => 'nullable|numeric',
            'philhealth_contribution' => 'nullable|numeric',
            'pagibig_contribution' => 'nullable|numeric',
            'tin_contribution' => 'nullable|numeric',
        ]);

        Contribution::create($validatedData);

        return redirect()->route('contributions.index')->with('success', 'Contribution created successfully.');
    }

    /**
     * Display the specified contribution.
     */
    public function show(Contribution $contribution)
    {
        return view('contributions.show', compact('contribution'));
    }

    /**
     * Show the form for editing the specified contribution.
     */
    public function edit($id)
    {
        $contribution = Contribution::findOrFail($id);

        // Convert the date to Y-m-d format for the HTML input
        if ($contribution->date) {
            $contribution->date = Carbon::parse($contribution->date)->format('Y-m-d');
        }

        $employees = Employee::where('employee_status', 'Active')->get();
        return view('contributions.edit', compact('contribution', 'employees'));
    }
    /**
     * Update the specified contribution in storage.
     */
    public function update(Request $request, Contribution $contribution)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'sss_contribution' => 'nullable|numeric',
            'philhealth_contribution' => 'nullable|numeric',
            'pagibig_contribution' => 'nullable|numeric',
            'tin_contribution' => 'nullable|numeric',
        ]);

        $contribution->update($validatedData);

        return redirect()->route('contributions.index')->with('success', 'Contribution updated successfully.');
    }

    /**
     * Remove the specified contribution from storage.
     */
    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return redirect()->route('contributions.index')->with('success', 'Contribution deleted successfully.');
    }

   /**
 * Display contributions for a specific employee.
 */
public function employeeContributions(Request $request, $employee_id)
{
    $employee = Employee::findOrFail($employee_id);

    $sssContributions = SssContribution::where('employee_id', $employee_id)->orderBy('date')->get();
    $philhealthContributions = PhilhealthContribution::where('employee_id', $employee_id)->orderBy('date')->get();
    $pagibigContributions = PagibigContribution::where('employee_id', $employee_id)->orderBy('date')->get();

    // Calculate overall totals
    $totals = [
        'sss' => $sssContributions->sum('sss_contribution'),
        'philhealth' => $philhealthContributions->sum('philhealth_contribution'),
        'pagibig' => $pagibigContributions->sum('pagibig_contribution'),
    ];

    // Combine all contributions
    $allContributions = $sssContributions->concat($philhealthContributions)->concat($pagibigContributions);

    // Calculate totals for each contribution type by month
    $contributionTotals = $allContributions->groupBy(function ($contribution) {
        return Carbon::parse($contribution->date)->format('Y-m');
    })->map(function ($monthContributions) {
        return [
            'sss' => $monthContributions->sum('sss_contribution'),
            'philhealth' => $monthContributions->sum('philhealth_contribution'),
            'pagibig' => $monthContributions->sum('pagibig_contribution'),
        ];
    });

    return view('contributions.employee-contributions', compact('employee', 'sssContributions', 'philhealthContributions', 'pagibigContributions', 'totals', 'contributionTotals'));
}
        /**
         * Display a listing of all employees with their time sheet data.
         */
        public function allEmployeesContribution()
        {
            // Retrieve all employees
            $employees = Employee::where('employee_status', 'Active')->get();

            // If there's additional time sheet data you want to include, add the logic here
            // For example, if there's a TimeSheet model related to Employee:
            // $employees = Employee::with('timeSheets')->get();

            return view('contributions.employees-list', compact('employees'));
        }

    /**
     * Display contributions for the authenticated employee.
     */
    public function myContributions()
    {
        $user = Auth::user();

        // Ensure the user is authenticated and has the role 'Employee'
        if ($user && $user->hasRole('Employee')) {
            $employee = Employee::where('email_address', $user->email)->firstOrFail();

            $ssscontributions = SssContribution::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->get();
            $philhealthcontributions = PhilhealthContribution::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->get();
            $pagibigcontributions = PagibigContribution::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->get();

            // Calculate totals
            $totals = [
                'sss' => $ssscontributions->sum('sss_contribution'),
                'philhealth' => $philhealthcontributions->sum('philhealth_contribution'),
                'pagibig' => $pagibigcontributions->sum('pagibig_contribution'),
            ];

            return view('contributions.my-contributions', compact('ssscontributions','philhealthcontributions', 'pagibigcontributions', 'totals', 'employee'));
        }

        return redirect()->route('sss.index')->with('error', 'Unauthorized access.');
    }
}

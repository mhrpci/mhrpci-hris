<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

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
        $employees = Employee::all();
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

        $employees = Employee::all(); // Fetch employees
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
     * Display contributions for a specific employee with date filtering and totals.
     */
    public function employeeContributions(Request $request, $employee_id)
    {
        $employee = Employee::findOrFail($employee_id);

        $query = Contribution::where('employee_id', $employee_id);

        // Apply date filter if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $contributions = $query->orderBy('date')->get();

        // Calculate overall totals
        $totals = [
            'sss' => $contributions->sum('sss_contribution'),
            'philhealth' => $contributions->sum('philhealth_contribution'),
            'pagibig' => $contributions->sum('pagibig_contribution'),
            'tin' => $contributions->sum('tin_contribution')
        ];

        // Calculate totals for each contribution type, respecting the date filter
        $contributionTotals = $contributions->groupBy(function ($contribution) {
            return Carbon::parse($contribution->date)->format('Y-m');
        })->map(function ($monthContributions) {
            return [
                'sss' => $monthContributions->sum('sss_contribution'),
                'philhealth' => $monthContributions->sum('philhealth_contribution'),
                'pagibig' => $monthContributions->sum('pagibig_contribution'),
                'tin' => $monthContributions->sum('tin_contribution'),
            ];
        });

        return view('contributions.employee-contributions', compact('employee', 'contributions', 'totals', 'contributionTotals'));
    }

}

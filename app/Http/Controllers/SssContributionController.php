<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SssContribution;
use App\Models\Employee;
use Carbon\Carbon;

class SssContributionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:ssscontribution-list|ssscontribution-create|ssscontribution-edit|ssscontribution-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:ssscontribution-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:ssscontribution-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:ssscontribution-delete'], ['only' => ['destroy']]);
    }
 /**
     * Display a listing of the Ssscontributions.
     */
    public function index(Request $request)
    {
        $query = SssContribution::with('employee');

        // Filter by employee if employee_id is provided
        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $ssscontributions = $query->orderBy('date', 'desc')->get();

        // Calculate totals
        $totals = [
            'philhealth' => $ssscontributions->sum('philhealth_contribution'),
        ];

        $employees = Employee::all(); // For the employee dropdown

        return view('ssscontributions.index', compact('ssscontributions', 'totals', 'employees'));
    }
    /**
     * Show the form for creating a new contribution.
     */
    public function create()
    {
        $employees = Employee::where('employee_status', 'Active')->get();
        return view('ssscontributions.create',compact('employees'));
    }

    /**
     * Store a newly created contribution in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'philhealth_contribution' => 'nullable|numeric',
        ]);

        SssContribution::create($validatedData);

        return redirect()->route('ssscontributions.index')->with('success', 'Pagibig Contribution created successfully.');
    }

    /**
     * Display the specified contribution.
     */
    public function show(SssContribution $ssscontribution)
    {
        return view('ssscontributions.show', compact('ssscontribution'));
    }

    /**
     * Show the form for editing the specified contribution.
     */
    public function edit($id)
    {
        $ssscontribution = SssContribution::findOrFail($id);

        // Convert the date to Y-m-d format for the HTML input
        if ($ssscontribution->date) {
            $ssscontribution->date = Carbon::parse($ssscontribution->date)->format('Y-m-d');
        }

        $employees = Employee::where('employee_status', 'Active')->get();
        return view('ssscontributions.edit', compact('ssscontribution', 'employees'));
    }
    /**
     * Update the specified contribution in storage.
     */
    public function update(Request $request, SssContribution $ssscontribution)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'philhealth_contribution' => 'nullable|numeric',
        ]);

        $ssscontribution->update($validatedData);

        return redirect()->route('ssscontributions.index')->with('success', 'Pagibig Contribution updated successfully.');
    }

    /**
     * Remove the specified contribution from storage.
     */
    public function destroy(SssContribution $ssscontribution)
    {
        $ssscontribution->delete();

        return redirect()->route('ssscontributions.index')->with('success', 'Pagibig Contribution deleted successfully.');
    }
}

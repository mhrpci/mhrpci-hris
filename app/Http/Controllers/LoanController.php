<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon;

class LoanController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:loan-list|loan-create|loan-edit|loan-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:loan-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:loan-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:loan-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the loans.
     */
    public function index()
    {
        $loans = loan::all();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new loan.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('loans.create',compact('employees'));
    }

    /**
     * Store a newly created loan in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'sss_loan' => 'nullable|numeric',
            'pagibig_loan' => 'nullable|numeric',
            'cash_advance' => 'nullable|numeric',
        ]);

        loan::create($validatedData);

        return redirect()->route('loans.index')->with('success', 'loan created successfully.');
    }

    /**
     * Display the specified loan.
     */
    public function show(loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified loan.
     */
    public function edit($id)
    {
        $loan = loan::findOrFail($id);

        // Convert the date to Y-m-d format for the HTML input
        if ($loan->date) {
            $loan->date = Carbon::parse($loan->date)->format('Y-m-d');
        }

        $employees = Employee::all(); // Fetch employees
        return view('loans.edit', compact('loan', 'employees'));
    }
    /**
     * Update the specified loan in storage.
     */
    public function update(Request $request, loan $loan)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'sss_loan' => 'nullable|numeric',
            'philhealth_loan' => 'nullable|numeric',
            'pagibig_loan' => 'nullable|numeric',
            'cash_advance' => 'nullable|numeric',
        ]);

        $loan->update($validatedData);

        return redirect()->route('loans.index')->with('success', 'loan updated successfully.');
    }

    /**
     * Remove the specified loan from storage.
     */
    public function destroy(loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'loan deleted successfully.');
    }
}

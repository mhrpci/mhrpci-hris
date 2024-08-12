<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagibigLoan;
use App\Models\Employee;

class PagibigLoanController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:loanpagibig-list|loanpagibig-create|loanpagibig-edit|loanpagibig-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:loanpagibig-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:loanpagibig-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:loanpagibig-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanpagibig = PagibigLoan::all();
        return view('loanpagibig.index', compact('loanpagibig'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('loanpagibig.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PagibigLoan::create($request->all());
        return redirect()->route('loanpagibig.index')
            ->with('success', 'Pagibig Loan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PagibigLoan $loanpagibig)
    {
        return view('loanpagibig.show', compact('loanpagibig'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PagibigLoan $loanpagibig)
    {
        $employees = Employee::all();
        return view('loanpagibig.edit', compact('loanpagibig', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PagibigLoan $loanpagibig)
    {
        $loanpagibig->update($request->all());
        return redirect()->route('loanpagibig.index')
            ->with('success', 'Pagibig Loan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PagibigLoan $loanpagibig)
    {
        $loanpagibig->delete();
        return redirect()->route('loanpagibig.index')
            ->with('success', 'Pagibig Loan deleted successfully');
    }
}

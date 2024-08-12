<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SssLoan;
use App\Models\Employee;

class SssLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:loansss-list|loansss-create|loansss-edit|loansss-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:loansss-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:loansss-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:loansss-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loansss = SssLoan::all();
        return view('loansss.index', compact('loansss'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('loansss.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SssLoan::create($request->all());
        return redirect()->route('loansss.index')
            ->with('success', 'SSS Loan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SssLoan $loansss)
    {
        return view('loansss.show', compact('loansss'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SssLoan $loansss)
    {
        $employees = Employee::all();
        return view('loansss.edit', compact('loansss', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SssLoan $loansss)
    {
        $loansss->update($request->all());
        return redirect()->route('loansss.index')
            ->with('success', 'SSS Loan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SssLoan $loansss)
    {
        $loansss->delete();
        return redirect()->route('loansss.index')
            ->with('success', 'SSS Loan deleted successfully');
    }
}

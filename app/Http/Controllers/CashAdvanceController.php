<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashAdvance;
use App\Models\Employee;

class CashAdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:cashad-list|cashad-create|cashad-edit|cashad-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:cashad-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:cashad-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:cashad-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashad = CashAdvance::all();
        return view('cashad.index', compact('cashad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('cashad.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        CashAdvance::create($request->all());
        return redirect()->route('cashad.index')
            ->with('success', 'SSS Loan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashAdvance $cashad)
    {
        return view('cashad.show', compact('cashad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, CashAdvance $cashad)
    {
        $employees = Employee::all();
        return view('cashad.edit', compact('cashad', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashAdvance $cashad)
    {
        $cashad->update($request->all());
        return redirect()->route('cashad.index')
            ->with('success', 'SSS Loan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashAdvance $cashad)
    {
        $cashad->delete();
        return redirect()->route('cashad.index')
            ->with('success', 'SSS Loan deleted successfully');
    }
}

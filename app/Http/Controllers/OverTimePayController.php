<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\OvertimePay;

class OverTimePayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:overtime-list|overtime-create|overtime-edit|overtime-delete', ['only' => ['index','show']]);
        $this->middleware('permission:overtime-create', ['only' => ['create','store']]);
        $this->middleware('permission:overtime-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:overtime-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all OvertimePay records
        $overtime = OvertimePay::all();

        // Calculate overtime pay for each record
        foreach ($overtime as $overtimePay) {
            $overtimePay->calculateOvertimePay();
        }

        // Pass the data to the view
        return view('overtime.index', compact('overtime'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('overtime.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'overtime_hours' => 'required|numeric',
            'overtime_rate' => 'nullable|numeric',
            'overtime_pay' => 'nullable|numeric',
        ]);

        OvertimePay::create($validatedData);

        return redirect()->route('overtime.index')->with('success', 'overtime created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OvertimePay $overtime)
    {
        return view('overtime.show', compact('overtime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimePay $overtime)
    {
        $employees =  Employee::all();
        return view('overtime.edit', compact('overtime', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OvertimePay $overtime)
    {
        $overtime->update($request->all());
        return redirect()->route('overtime.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OvertimePay $overtime)
    {
        $overtime->delete();
        return redirect()->route('overtime.index');
    }
}

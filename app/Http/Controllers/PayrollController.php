<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->paginate(10);
        return view('payrolls.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'gross_pay' => 'required|numeric|min:0',
            'net_pay' => 'required|numeric|min:0',
            'days_worked' => 'required|integer|min:0',
            'overtime_hours' => 'required|numeric|min:0',
            'overtime_pay' => 'required|numeric|min:0',
        ]);

        // Begin database transaction
        DB::beginTransaction();
        try {
            // Create a new Payroll record using validated data
            $payroll = Payroll::create($validatedData);

            // Commit the transaction
            DB::commit();

            // Redirect to the show page with a success message
            return redirect()->route('payrolls.show', $payroll->id)
                             ->with('success', 'Payroll generated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Redirect back with an error message and input
            return back()->with('error', 'Failed to generate payroll. ' . $e->getMessage())
                         ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load([
            'employee',
            'sssContribution',
            'philhealthContribution',
            'pagibigContribution',
            'sssLoanPayment',
            'pagibigLoanPayment',
            'cashAdvanceDeduction'
        ]);
        return view('payrolls.show', compact('payroll'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        $employees = Employee::all();
        return view('payrolls.edit', compact('payroll', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'gross_pay' => 'required|numeric|min:0',
            'net_pay' => 'required|numeric|min:0',
            'days_worked' => 'required|integer|min:0',
            'overtime_hours' => 'required|numeric|min:0',
            'overtime_pay' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $payroll->update($validatedData);
            DB::commit();
            return redirect()->route('payrolls.show', $payroll->id)->with('success', 'Payroll updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to update payroll. ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        DB::beginTransaction();
        try {
            $payroll->delete();
            DB::commit();
            return redirect()->route('payrolls.index')->with('success', 'Payroll deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to delete payroll. ' . $e->getMessage());
        }
    }
}

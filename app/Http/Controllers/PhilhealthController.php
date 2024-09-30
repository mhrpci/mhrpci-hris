<?php

namespace App\Http\Controllers;

use App\Models\Philhealth;
use App\Models\Employee;
use Illuminate\Http\Request;

class PhilhealthController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $contributions = Philhealth::all();
        return view('philhealth.index', compact('contributions', 'employees'));
    }

    public function create()
    {
        $employees = Employee::whereNotNull('philhealth_no')->get();
        return view('philhealth.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $employee = Employee::findOrFail($validatedData['employee_id']);

        $philhealth = new Philhealth();
        $philhealth->employee()->associate($employee);
        $philhealth->contribution_date = $validatedData['contribution_date'] . '-01';

        $philhealth->calculateContribution();

        $philhealth->save();

        return redirect()->route('philhealth.index')->with('success', 'Philhealth contribution created successfully.');
    }

    public function show(Philhealth $philhealth)
    {
        return view('philhealth.show', compact('philhealth'));
    }

    public function destroy(Philhealth $philhealth)
    {
        $user = auth()->user();
        // Check if the authenticated user has the 'Super Admin' role
        if ($user->hasRole('Super Admin')) {
            $philhealth->delete();
            return redirect()->route('philhealth.index')->with('success', 'Philhealth contribution deleted successfully.');
        }

        return redirect()->route('philhealth.index')->with('error', 'Unauthorized action.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Pagibig;
use App\Models\Employee;
use Illuminate\Http\Request;

class PagibigController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $contributions = Pagibig::all();
        return view('pagibig.index', compact('contributions', 'employees'));
    }

    public function create()
    {
        $employees = Employee::whereNotNull('pagibig_no')->get();
        return view('pagibig.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $contributionDate = $request->contribution_date . '-01';
        Pagibig::createContribution($employee, $contributionDate);

        return redirect()->route('pagibig.index')->with('success', 'Pagibig contribution created successfully.');
    }

    public function show(Pagibig $pagibig)
    {
        return view('pagibig.show', compact('pagibig'));
    }

    public function destroy(Pagibig $pagibig)
    {
        $user = auth()->user();
        // Check if the authenticated user has the 'Super Admin' role
        if ($user->hasRole('Super Admin')) {
            $pagibig->delete();
            return redirect()->route('pagibig.index')->with('success', 'pagibig contribution deleted successfully.');
        }

        return redirect()->route('pagibig.index')->with('error', 'Unauthorized action.');
    }

}

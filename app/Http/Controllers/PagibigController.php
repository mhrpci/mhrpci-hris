<?php

namespace App\Http\Controllers;

use App\Models\Pagibig;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagibigController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $contributions = Pagibig::all();
        $activeEmployeesCount = Employee::where('employee_status', 'Active')
            ->whereNotNull('pagibig_no')
            ->count();
        return view('pagibig.index', compact('contributions', 'employees', 'activeEmployeesCount'));
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

    public function storeAllActive(Request $request)
    {
        $request->validate([
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $contributionDate = $request->contribution_date . '-01'; // Add day to make it a valid date

        // Check if contributions already exist for this month
        if ($this->contributionsExistForMonth($contributionDate)) {
            return redirect()->route('pagibig.index')->with('error', 'Contributions for this month already exist.');
        }

        $activeEmployees = Employee::where('employee_status', 'Active')
            ->whereNotNull('pagibig_no')
            ->get();

        DB::beginTransaction();
        try {
            foreach ($activeEmployees as $employee) {
                Pagibig::createContribution($employee, $contributionDate);
            }
            DB::commit();
            return redirect()->route('pagibig.index')->with('success', 'Pag-IBIG contributions created for all active employees.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pagibig.index')->with('error', 'Error creating Pag-IBIG contributions: ' . $e->getMessage());
        }
    }

    private function contributionsExistForMonth($date)
    {
        return Pagibig::whereYear('contribution_date', '=', date('Y', strtotime($date)))
            ->whereMonth('contribution_date', '=', date('m', strtotime($date)))
            ->exists();
    }

}

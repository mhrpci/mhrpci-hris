<?php

namespace App\Http\Controllers;

use App\Models\Philhealth;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhilhealthController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $contributions = Philhealth::all();
        $activeEmployeesCount = Employee::where('employee_status', 'Active')
            ->whereNotNull('philhealth_no')
            ->whereRaw('DATEDIFF(CURRENT_DATE, date_hired) >= 60')
            ->count();
        return view('philhealth.index', compact('contributions', 'employees', 'activeEmployeesCount'));
    }

    public function create()
    {
        $employees = Employee::whereNotNull('philhealth_no')
        ->where('employee_status', 'Active')
        ->get();
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

        $philhealth->calculateContribution()->storeWithContributions();

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

    public function storeAllActive(Request $request)
    {
        $request->validate([
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $contributionDate = $request->contribution_date . '-01'; // Add day to make it a valid date

        // Check if contributions already exist for this month
        if ($this->contributionsExistForMonth($contributionDate)) {
            return redirect()->route('philhealth.index')->with('error', 'Contributions for this month already exist.');
        }

        $activeEmployees = Employee::where('employee_status', 'Active')
            ->whereNotNull('philhealth_no')
            ->whereRaw('DATEDIFF(CURRENT_DATE, date_hired) >= 60')
            ->get();

        DB::beginTransaction();
        try {
            foreach ($activeEmployees as $employee) {
                $philhealth = new Philhealth();
                $philhealth->employee()->associate($employee);
                $philhealth->contribution_date = $contributionDate;
                $philhealth->calculateContribution()->storeWithContributions();
            }
            DB::commit();
            return redirect()->route('philhealth.index')->with('success', 'Philhealth contributions created for all active employees.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('philhealth.index')->with('error', 'Error creating Philhealth contributions: ' . $e->getMessage());
        }
    }

    private function contributionsExistForMonth($date)
    {
        return Philhealth::whereYear('contribution_date', '=', date('Y', strtotime($date)))
            ->whereMonth('contribution_date', '=', date('m', strtotime($date)))
            ->exists();
    }

}

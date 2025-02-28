<?php

namespace App\Http\Controllers;

use App\Models\Sss;
use App\Models\SssContribution;
use App\Models\Employee;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class SssController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $contributions = Sss::all();
        $activeEmployeesCount = Employee::where('employee_status', 'Active')
            ->whereNotNull('sss_no')
            ->whereRaw('DATEDIFF(CURRENT_DATE, date_hired) >= 60')
            ->count();
        return view('sss.index', compact('contributions', 'employees', 'activeEmployeesCount'));
    }

    public function create()
    {
        $employees = Employee::whereNotNull('sss_no')
            ->where('employee_status', 'Active')
            ->get();
        return view('sss.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $contributionDate = $request->contribution_date . '-01'; // Add day to make it a valid date
        Sss::createContribution($employee, $contributionDate);
        return redirect()->route('sss.index')->with('success', 'SSS contribution created successfully.');
    }

    public function show(Sss $sss)
    {
        return view('sss.show', compact('sss'));
    }

    public function destroy(Sss $sss)
    {
        $user = auth()->user();
        // Check if the authenticated user has the 'Super Admin' role
        if ($user->hasRole('Super Admin')) {
            $sss->delete();
            return redirect()->route('sss.index')->with('success', 'SSS contribution deleted successfully.');
        }

        return redirect()->route('sss.index')->with('error', 'Unauthorized action.');
    }

    public function storeAllActive(Request $request)
    {
        $request->validate([
            'contribution_date' => 'required|date_format:Y-m',
        ]);

        $contributionDate = $request->contribution_date . '-01'; // Add day to make it a valid date

        // Check if contributions already exist for this month
        if ($this->contributionsExistForMonth($contributionDate)) {
            return redirect()->route('sss.index')->with('error', 'Contributions for this month already exist.');
        }

        $activeEmployees = Employee::where('employee_status', 'Active')
            ->whereNotNull('sss_no')
            ->whereRaw('DATEDIFF(CURRENT_DATE, date_hired) >= 60')
            ->get();

        DB::beginTransaction();
        try {
            foreach ($activeEmployees as $employee) {
                Sss::createContribution($employee, $contributionDate);
            }
            DB::commit();
            return redirect()->route('sss.index')->with('success', 'SSS contributions created for all active employees.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('sss.index')->with('error', 'Error creating SSS contributions: ' . $e->getMessage());
        }
    }

    private function contributionsExistForMonth($date)
    {
        return Sss::whereYear('contribution_date', '=', date('Y', strtotime($date)))
            ->whereMonth('contribution_date', '=', date('m', strtotime($date)))
            ->exists();
    }

}

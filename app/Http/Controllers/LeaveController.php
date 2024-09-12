<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Type;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use PDF;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:leave-list|leave-create|leave-edit|leave-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:leave-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:leave-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:leave-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $leaves = Leave::all();
        $employees = Employee::all();
        return view('leaves.index', compact('leaves', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve only active employees
        $employees = Employee::where('employee_status', 'Active')->get();
        $types = Type::all();
        return view('leaves.create', compact('employees', 'types'));
    }

    /**
     * Store a newly created leave request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'leave_type' => 'required|string|in:Leave,Undertime', // Add leave_type validation
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'type_id' => 'required',
            'reason_to_leave' => 'required|string',
            'approved_by' => 'nullable|integer',
        ]);

        // Create a new leave record using the validated data
        Leave::create($validatedData);

        // Redirect back to the leaves.create view with a success message
        if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
            // Redirect back to the leaves.create view with a success message for Super Admin or Admin
            return redirect()->route('leaves.create')->with('success', 'Leave request created successfully.');
        } else {
            // Redirect back to the leaves.create view with a different success message for other users
            return redirect()->route('leaves.create')->with('success', 'Leave request sent successfully. Wait for the Admin confirmation.');
        }
    }

    public function show($id)
    {
        // Find the leave record
        $leave = Leave::findOrFail($id);
        $diff = $leave->diffdays;

        // Load the user who approved the leave
        $approvedByUser = $leave->approvedByUser;

        // Pass the leave and approved by user details to the view
        return view('leaves.show', compact('leave', 'approvedByUser','diff'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $leave = Leave::findOrFail($id);
        $employees = Employee::where('employee_status', 'Active')->get();
        $types = Type::all();
        return view('leaves.edit', compact('leave', 'employees', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'employee_id' => 'required|integer',
            'leave_type' => 'required|string|in:Leave,Undertime', // Add leave_type validation
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'type_id' => 'required',
            'reason_to_leave' => 'required|string',
            'approved_by' => 'nullable|integer',
        ]);

        // Find the leave request and update it with the validated data
        $leave = Leave::findOrFail($id);
        $leave->update($validatedData);

        // Redirect to the leaves.index view with a success message
        return redirect()->route('leaves.index')->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()->route('leaves.index')->with('success', 'Leave request deleted successfully.');
    }
    public function updateStatus(Request $request, string $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'status' => 'required|in:pending,rejected,approved',
    ]);

    // Find the leave request
    $leave = Leave::findOrFail($id);

    // Update its status and approved_by field
    $leave->status = $validatedData['status'];
    $leave->approved_by = Auth::id(); // Assuming you want to store the user's ID who approved the leave

    // Save the leave record
    $leave->save();

    // Redirect back to the leave details page with a success message
    return redirect()->route('leaves.show', $id)->with('success', 'Leave status updated successfully.');
}

/**
 * Display the specified resource.
 */
public function detail($id)
{
    // Find the leave by its ID
    $leave = Leave::findOrFail($id);

    // Load any related models if needed
    // $leave->load('relationName');

    // Pass the $leave object to the view
    return view('leaves.detail', compact('leave'));
}

 /**
     * Display a listing of all employees with action to view leaves.
     */
    public function allEmployees(Request $request)
    {
        $departmentId = $request->input('department_id');
        $departments = Department::all();

        if ($departmentId) {
            $employees = Employee::where('department_id', $departmentId)->get();
        } else {
            $employees = Employee::all();
        }

        return view('leaves.all_employees', compact('employees', 'departments', 'departmentId'));
    }

    /**
     * Display leaves for a specific employee and provide a downloadable PDF.
     */
    public function employeeLeaves($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $leaves = Leave::where('employee_id', $employee_id)->get();

        // Check if the request is for downloading the PDF
        if (request()->has('download')) {
            $pdf = PDF::loadView('leaves.pdf', compact('employee', 'leaves'));
            return $pdf->download('employee_leaves.pdf');
        }

        return view('leaves.employee_leaves', compact('employee', 'leaves'));
    }

    public function report(Request $request)
{
    $departmentId = $request->input('department_id');
    $departments = Department::all();

    if ($departmentId) {
        $leaves = Leave::whereHas('employee', function ($query) use ($departmentId) {
            $query->where('department_id', $departmentId);
        })->get();
    } else {
        $leaves = Leave::all();
    }

    // Check if the request is for downloading the PDF
    if ($request->has('download')) {
        $pdf = PDF::loadView('leaves.report_pdf', compact('leaves', 'departments', 'departmentId'));
        return $pdf->download('all_leaves_report.pdf');
    }

    return view('leaves.report', compact('leaves', 'departments', 'departmentId'));
}

    /**
     * Display the leave sheet and balances for the authenticated employee.
     */
    public function myLeaveSheet()
    {
        $user = Auth::user();
        $employee = Employee::where('email_address', $user->email)->firstOrFail();

        $leaves = Leave::where('employee_id', $employee->id)->get();
        $sickLeaveBalance = $employee->sick_leave;
        $emergencyLeaveBalance = $employee->emergency_leave;
        $vacationLeaveBalance = $employee->vacation_leave;

        return view('leaves.my_leave_sheet', compact('employee', 'leaves', 'sickLeaveBalance', 'emergencyLeaveBalance', 'vacationLeaveBalance'));
    }
}

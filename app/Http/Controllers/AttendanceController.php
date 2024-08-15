<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use App\Events\AttendanceStored;

class AttendanceController extends Controller
{
    // Middleware for permissions
    function __construct()
    {
        $this->middleware(['permission:attendance-list|attendance-create|attendance-edit|attendance-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:attendance-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:attendance-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:attendance-delete'], ['only' => ['destroy']]);
    }

    // Display all attendance records
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendances.index', compact('attendances'));
    }

    // Show form for creating a new attendance record
    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    // Store a new attendance record
    public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'date_attended' => 'required|date',
        'time_stamp1' => 'required_without:time_stamp2',
        'time_stamp2' => 'required_without:time_stamp1',
        'time_in' => 'required_without:time_out|nullable|date_format:H:i',
        'time_out' => 'required_without:time_in|nullable|date_format:H:i',
        'remarks' => 'nullable',
        'hours_worked' => 'nullable',
    ]);

    // Check if attendance already exists for the given date_attended and employee_id
    $existingAttendance = Attendance::where('employee_id', $request->employee_id)
                                    ->where('date_attended', $request->date_attended)
                                    ->first();

    // Get the authenticated user
    $user = Auth::user();

    $successMessage = '';

    if ($existingAttendance) {
        if ($existingAttendance->time_out && $existingAttendance->time_stamp2) {
            if ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
                return response()->json(['error' => 'Attendance for this employee on this date already has time out and time stamp.'], 400);
            } else {
                return response()->json(['error' => 'Your attendance on this date already has time out and time stamp.'], 400);
            }
        }

        // Update existing attendance with time_out if time_in exists and time_out doesn't
        $existingAttendance->time_out = $request->time_out;
        if ($request->hasFile('time_stamp2')) {
            $existingAttendance->time_stamp2 = $request->file('time_stamp2')->store('time_stamps', 'public');
        }
        $existingAttendance->remarks = $request->remarks;
        $existingAttendance->hours_worked = $request->hours_worked;
        $existingAttendance->save();

        $successMessage = 'You have successfully timed out.';
    } else {
        // Create new attendance record with time_in
        $newAttendance = new Attendance;
        $newAttendance->employee_id = $request->employee_id;
        $newAttendance->date_attended = $request->date_attended;
        $newAttendance->time_in = $request->time_in;
        if ($request->hasFile('time_stamp1')) {
            $newAttendance->time_stamp1 = $request->file('time_stamp1')->store('time_stamps', 'public');
        }
        $newAttendance->remarks = $request->remarks;
        $newAttendance->hours_worked = $request->hours_worked;
        $newAttendance->save();

        $successMessage = 'You have successfully timed in.';
    }

    return response()->json(['message' => $successMessage], 200);
}


    // Method to check if attendance exists (for AJAX call)
    public function checkAttendance(Request $request)
{
    $employeeId = $request->query('employee_id');
    $dateAttended = $request->query('date_attended');

    // Replace this with your logic to check attendance in the database
    $attendance = Attendance::where('employee_id', $employeeId)
                            ->where('date_attended', $dateAttended)
                            ->first();

    return response()->json([
        'hasTimeIn' => $attendance && $attendance->time_in != null,
        'hasTimeOut' => $attendance && $attendance->time_out != null,
    ]);
}


    // Display a specific attendance record
    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    // Show form for editing an attendance record
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        $remarks = Attendance::getRemarks();
        return view('attendances.edit', compact('attendance', 'employees', 'remarks'));
    }

    // Update a specific attendance record
    public function update(Request $request, Attendance $attendance)
{
    $request->validate([
        'employee_id' => 'required',
        'date_attended' => 'required|date',
        'time_stamp1' => 'nullable',
        'time_stamp2' => 'nullable',
        'time_in' => 'nullable',
        'time_out' => 'nullable',
        'remarks' => 'nullable',
        'hours_worked' => 'nullable',
    ]);

    // Check if attendance already exists for the given date_attended and employee_id
    $existingAttendance = Attendance::where('employee_id', $attendance->employee_id)
                                    ->where('date_attended', $attendance->date_attended)
                                    ->first();

    // Get the authenticated user
    $user = Auth::user();

    if ($existingAttendance) {
        if ($existingAttendance->time_out && $existingAttendance->time_stamp2) {
            return redirect()->route('attendances.edit', $attendance->id)
                             ->with('error', 'Attendance for this employee on this date already has time out and time stamp.');
        }
        
        // Update attendance with time_out and time_stamp2 if provided
        if ($request->hasFile('time_stamp2')) {
            $attendance->time_stamp2 = $request->file('time_stamp2')->store('time_stamps', 'public');
        }
        $attendance->update($request->all());
    } else {
        // Handle as new attendance creation if not found (this scenario shouldn't normally occur in update)
        return redirect()->route('attendances.index')
                         ->with('error', 'Attendance not found for update.');
    }

    return redirect()->route('attendances.index')
                     ->with('success', 'Attendance updated successfully.');
}


    // Delete a specific attendance record
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
                         ->with('success', 'Attendance deleted successfully.');
    }

    // Generate timesheets or attendance records for all employees
    public function generateTimesheets()
    {
        $employees = Employee::all();
        $departments = Department::all();
        
        $timesheets = [];

        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->id)->get();
            $timesheets[$employee->id] = $attendances;
        }
        
        return view('attendances.timesheets', compact('employees', 'timesheets', 'departments'));
    }

    // Show attendance for a specific employee
    public function showEmployeeAttendance($employee_id)
    {
        $employee = Employee::find($employee_id);
        $attendances = Attendance::where('employee_id', $employee_id)->get();
        
        return view('attendances.employee_attendance', compact('employee', 'attendances'));
    }

    // Show the logged-in employee's timesheet
    public function myTimesheet()
    {
        $user = Auth::user();
        
        // Find the employee record corresponding to the logged-in user
        $employee = Employee::where('first_name', $user->first_name)->first();

        if (!$employee) {
            return redirect()->route('attendances.index')
                             ->withErrors(['error' => 'No corresponding employee record found for the user.']);
        }

        // Fetch the attendance records for the logged-in employee
        $attendances = Attendance::where('employee_id', $employee->id)->get();
        
        return view('attendances.employee_attendance', compact('employee', 'attendances'));
    }

    // Check user role and execute appropriate function
    public function checkUserAndShowTimesheet()
    {
        $user = Auth::user();

        // Assuming roles are defined and you have a method to check user roles
        if ($user->hasRole('admin') || $user->hasRole('super-admin')) {
            return redirect()->route('attendances.index');
        } else {
            return $this->myTimesheet();
        }
    }

    public function checkAttendanceStatus(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'date_attended' => 'required|date',
    ]);

    $employeeId = $request->input('employee_id');
    $dateAttended = $request->input('date_attended');

    // Retrieve the attendance record for the employee and date
    $attendance = Attendance::where('employee_id', $employeeId)
                            ->where('date_attended', $dateAttended)
                            ->first();

    // Check if attendance exists and has a time_in value
    if ($attendance) {
        return response()->json([
            'status' => 'exists',
            'time_in' => $attendance->time_in,
            'time_out' => $attendance->time_out, // You may also include time_out if needed
        ], 200);
    }

    return response()->json(['status' => 'not_found'], 200);
}
public function getEmployeeInfo(Request $request)
{
    // Replace this with actual logic to get authenticated employee info
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json([
        'id' => $user->id,
        'first_name' => $user->first_name,
    ]);
}

}

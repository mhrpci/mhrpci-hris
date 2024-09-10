<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Province;
use App\Models\City;
use App\Models\Barangay;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Notifications\EmployeeAccountActivated;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use Illuminate\Support\Facades\Mail;
use App\Mail\BirthdayGreeting;
use App\Mail\EmployeeResignationNotification;
use App\Mail\UserAccountDisabledNotification;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['permission:employee-list|employee-create|employee-edit|employee-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:employee-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:employee-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:employee-delete'], ['only' => ['destroy']]);
    }
/**
 * Display a listing of the resource.
 */
public function index()
{
    // Get the authenticated user
    $user = auth()->user();

    // Check if the user has the Super Admin role
    if ($user->hasRole('Super Admin')) {
        $employees = Employee::all();
    } else {
        // If not Super Admin, only get employees with Rank File rank
        $employees = Employee::where('rank', 'Rank File')->get();
    }

    // Determine employment status for each employee
    foreach ($employees as $employee) {
        $employee->employment_status = $employee->employmentStatus();
    }

    return view('employees.index', compact('employees'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $provinces = Province::all();
        $city = City::all();
        $barangay = Barangay::all();
        $positions = Position::all();
        $departments = Department::all();
        return view('employees.create',compact('genders', 'provinces', 'city', 'barangay', 'positions', 'departments'));
    }

    /**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'profile' => 'nullable',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'suffix' => 'nullable',
            'email_address' => 'required|email',
            'contact_no' => 'required',
            'birth_date' => 'required|date_format:Y-m-d',
            'birth_place_province' => 'nullable',
            'birth_place_city'=> 'nullable',
            'birth_place_barangay' => 'nullable',
            'province_id' => 'required',
            'city_id' => 'required',
            'barangay_id' => 'required',
            'gender_id' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
            'salary' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'zip_code' => 'required|numeric',
            'date_hired' => 'required|date_format:Y-m-d',
            'sss_no' => 'nullable|numeric',
            'pagibig_no' => 'nullable|numeric',
            'tin_no' => 'nullable|numeric',
            'philhealth_no' => 'nullable|numeric',
            'elementary' => 'nullable',
            'secondary' => 'nullable',
            'tertiary' => 'nullable',
            'emergency_name' => 'required',
            'emergency_no' => 'required|numeric',
        ]);

        // Check if an employee with the same email_address and company_id already exists
        $existingEmployee = Employee::where('email_address', $request->email_address)
            ->where('company_id', $request->company_id)
            ->first();

        if ($existingEmployee) {
            return redirect()->route('employees.create')
                             ->with('error', 'An employee with this email address already exists for the selected company.');
        }

        // Create the employee
        $employee = Employee::create($request->all());

        // Save profile image if it exists
        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $filename = $image->store('profiles', 'public');
            $employee->profile = $filename;
            $employee->save(); // Save the employee with the profile image
        }

        // Save employment status
        $employee->saveEmploymentStatus();

        // Redirect to the employee's show page by slug
        return redirect()->route('employees.show', $employee->slug)
        ->with('success', 'Employee created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Find the employee by slug
        $employee = Employee::where('slug', $slug)->firstOrFail();

        // Return the employee view with the data
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        // Find the employee by slug
        $employee = Employee::where('slug', $slug)->firstOrFail();

        // Fetch related data
        $genders = Gender::all();
        $provinces = Province::all();
        $city = City::all();
        $barangay = Barangay::all();
        $positions = Position::all();
        $departments = Department::all();

        // Return the edit view with the data
        return view('employees.edit', compact('employee', 'genders', 'provinces', 'city', 'barangay', 'positions', 'departments'));
    }


/**
 * Update the specified resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Employee  $employee
 * @return \Illuminate\Http\RedirectResponse
 */
public function update(Request $request, $slug): RedirectResponse
{
    // Find the employee by slug
    $employee = Employee::where('slug', $slug)->firstOrFail();

    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'company_id' => 'required',
        'profile' => 'nullable|image',
        'first_name' => 'required',
        'middle_name' => 'nullable',
        'last_name' => 'required',
        'suffix' => 'nullable',
        'email_address' => 'required|email',
        'contact_no' => 'required',
        'birth_date' => 'required|date_format:Y-m-d',
        'birth_place_province' => 'nullable',
        'birth_place_city' => 'nullable',
        'birth_place_barangay' => 'nullable',
        'province_id' => 'required',
        'city_id' => 'required',
        'barangay_id' => 'required',
        'gender_id' => 'required',
        'position_id' => 'required',
        'department_id' => 'required',
        'salary' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'zip_code' => 'required|numeric',
        'date_hired' => 'required|date_format:Y-m-d',
        'sss_no' => 'nullable|numeric',
        'pagibig_no' => 'nullable|numeric',
        'tin_no' => 'nullable|numeric',
        'philhealth_no' => 'nullable|numeric',
        'elementary' => 'nullable',
        'secondary' => 'nullable',
        'tertiary' => 'nullable',
        'emergency_name' => 'required',
        'emergency_no' => 'required|numeric',
        'employee_status' => 'required|in:active,resigned',
        'rank' => 'required|in:Rank File,Managerial',
    ]);

    // Update the employee with the request data
    $employee->update($request->except(['profile']));

    // Handle the profile image upload
    if ($request->hasFile('profile')) {
        $image = $request->file('profile');
        $filename = $image->store('profiles', 'public');
        $employee->profile = $filename;
    }
    $employee->employment_status = $request->input('employee_status');
    $employee->rank = $request->input('rank');
    $employee->save();

    // Save employment status
    $employee->saveEmploymentStatus();

    return redirect()->route('employees.show', $employee->slug)
                     ->with('success', 'Employee updated successfully');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully');
    }



    public function createUser(Request $request, Employee $employee): RedirectResponse
    {
        // Check if the user already exists
        $existingUser = User::where('email', $employee->email_address)->first();

        if ($existingUser) {
            return redirect()->route('employees.index')
                             ->with('error', 'User already exists for this employee.');
        }

        // Get the Employee role
        $employeeRole = Role::where('name', 'Employee')->first();

        // Create a user for the employee
        $userData = [
            'company_id' => $employee->company_id,
            'first_name' => $employee->first_name,
            'middle_name' => $employee->middle_name,
            'last_name' => $employee->last_name,
            'suffix' => $employee->suffix,
            'email' => $employee->email_address,
            'password' => Hash::make($employee->company_id), // Set the default password as the company_id
            'bio' => $employee->position->name,
            'profile_image' => $employee->profile,
            'contact_no' => $employee->contact_no,
        ];

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = $image->store('profile_images', 'public');
            $userData['profile_image'] = $filename;
        }

        $user = User::create($userData);

        // Assign the Employee role to the user
        $user->assignRole($employeeRole);

        // Send notification email to the employee
        $user->notify(new EmployeeAccountActivated($employee));

        return redirect()->route('employees.index')
                         ->with('success', 'User created successfully for the employee.'); // Ensure the message is about user creation
    }

    /**
     * Import employees from an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            Excel::import(new EmployeesImport, $request->file('file'));

            return redirect()->route('employees.index')->with('success', 'Employees imported successfully.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Error importing employees: ' . $e->getMessage());
        }
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function birthdays()
    {
        $employees = Employee::all();
        $birthdays = [];

        // Initialize the $birthdays array with all months
        $months = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August',
            'September', 'October', 'November', 'December'
        ];

        foreach ($months as $month) {
            $birthdays[$month] = []; // Set each month to an empty array initially
        }

        foreach ($employees as $employee) {
            $birthMonth = date('F', strtotime($employee->birth_date)); // Get the month name
            $birthdays[$birthMonth][] = [
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'date' => date('j', strtotime($employee->birth_date)), // Get the day of the month
            ];
        }

        return view('employees.birthdays', compact('birthdays', 'months'));
    }

    public function getStatus($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json([
            'employment_status' => $employee->employment_status,
        ]);
    }
    public function viewOwnProfile(Request $request)
    {
        $user = $request->user();
        $employee = Employee::where('first_name', $user->first_name)->first();

        if ($employee) {
            // Load related data
            $employee->load('position', 'department');

            // Get employment status
            $employee->employment_status = $employee->employmentStatus();

            // Prepare the response data
            $responseData = [
                'id' => $employee->id,
                'first_name' => $employee->first_name,
                'last_name' => $employee->last_name,
                'email_address' => $employee->email_address,
                'position' => [
                    'name' => $employee->position->name,
                ],
                'department' => [
                    'name' => $employee->department->name,
                ],
                'employment_status' => $employee->employment_status,
                // Add any other fields you want to include
            ];

            return response()->json($responseData);
        } else {
            return response()->json(['message' => 'Employee profile not found'], 404);
        }
    }
    public function disable(Employee $employee)
    {
        // Update the employee's status to 'Disabled'
        $employee->update(['employee_status' => 'Resigned']);

        // Find the user associated with the employee
        $user = User::where('email', $employee->email_address)->first();

        if ($user) {
            // Disable the user by setting a field or using a specific status
            $user->update(['status' => 'disabled']); // Assuming you have a status field for disabling users

            // Alternatively, you can use Laravel's built-in `delete` method if you want to remove the user
            // $user->delete();

            // Send notification emails
            Mail::to($employee->email_address)->send(new EmployeeResignationNotification($employee));
            Mail::to($user->email)->send(new UserAccountDisabledNotification($user));
        }

        return redirect()->route('employees.index')->with('success', 'Employee disabled successfully.');
    }
}

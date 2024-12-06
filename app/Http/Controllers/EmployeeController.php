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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
    $departments = Department::all();
    
    // Get all employees - we'll handle authorization through policies instead
    $employees = Employee::all();

    // Determine employment status for each employee
    foreach ($employees as $employee) {
        $employee->employment_status = $employee->employmentStatus();
    }

    return view('employees.index', compact('employees', 'departments'));
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
    try {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|unique:employees,company_id',
            'profile' => 'nullable|image|max:2048', // limit file size to 2MB
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'email_address' => 'required|email|unique:employees,email_address',
            'contact_no' => 'required|string|max:20',
            'birth_date' => 'required|date_format:Y-m-d',
            'birth_place_province' => 'nullable|string|max:255',
            'birth_place_city'=> 'nullable|string|max:255',
            'birth_place_barangay' => 'nullable|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
            'barangay_id' => 'required|exists:barangays,id',
            'gender_id' => 'required|exists:genders,id',
            'position_id' => 'required|exists:positions,id',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric|min:0',
            'zip_code' => 'required|string|max:10',
            'date_hired' => 'required|date_format:Y-m-d',
            'sss_no' => 'nullable|string|max:20',
            'pagibig_no' => 'nullable|string|max:20',
            'tin_no' => 'nullable|string|max:20',
            'philhealth_no' => 'nullable|string|max:20',
            'elementary' => 'nullable|string|max:255',
            'secondary' => 'nullable|string|max:255',
            'tertiary' => 'nullable|string|max:255',
            'emergency_name' => 'required|string|max:255',
            'emergency_no' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->route('employees.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Begin transaction
        DB::beginTransaction();

        try {
            // Create the employee
            $employee = Employee::create($request->except('profile'));

            // Handle profile image
            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                
                // Validate image
                if ($image->isValid()) {
                    $filename = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
                    $path = $image->storeAs('profiles', $filename, 'public');
                    $employee->profile = $path;
                    $employee->save();
                }
            }

            // Save employment status
            $employee->saveEmploymentStatus();

            // Commit transaction
            DB::commit();

            return redirect()->route('employees.show', $employee->slug)
                ->with('success', 'Employee created successfully');

        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Employee creation failed: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->route('employees.create')
                ->withInput()
                ->with('error', 'An error occurred while creating the employee. Please try again.');
        }

    } catch (\Exception $e) {
        Log::error('Employee validation/creation failed: ' . $e->getMessage());
        Log::error($e->getTraceAsString());

        return redirect()->route('employees.create')
            ->withInput()
            ->with('error', 'An error occurred while processing your request. Please try again.');
    }
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
        return view('employees.edit', compact(
            'employee',
            'genders',
            'provinces',
            'city',
            'barangay',
            'positions',
            'departments'
        ));
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
            'date_hired' => $employee->date_hired,
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

    /**
     * Display the authenticated employee's own profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewOwnEmployeeProfile(Request $request)
    {
        $user = $request->user();

        // Check if the user has the 'Employee' role
        if (!$user->hasRole('Employee')) {
            return redirect()->route('home')->with('error', 'You do not have permission to view this page.');
        }

        // Find the employee profile associated with the user
        $employee = Employee::where('email_address', $user->email)->first();

        if (!$employee) {
            return redirect()->route('home')->with('error', 'Employee profile not found.');
        }

        // Load related data
        $employee->load(['position', 'department', 'gender', 'province', 'city', 'barangay']);

        // Get employment status
        $employee->employment_status = $employee->employmentStatus();

        return view('employees.own-profile', compact('employee'));
    }

    public function updateSignature(Request $request)
    {
        try {
            // Get authenticated user
            $user = auth()->user();

            // Find employee with matching email
            $employee = Employee::where('email_address', $user->email)->first();

            // Check if employee exists and matches the authenticated user
            if (!$employee) {
                Log::warning('Unauthorized signature update attempt by user: ' . $user->id);
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to update this signature.'
                ], 403);
            }

            // Validate the request
            $request->validate([
                'signature' => 'required|string'
            ]);

            // Decode base64 image
            $image = $request->input('signature');

            // Remove data:image/png;base64, from the beginning
            $image = preg_replace('/^data:image\/\w+;base64,/', '', $image);
            $image = str_replace(' ', '+', $image);

            // Generate unique filename
            $imageName = 'signature_' . $employee->id . '_' . time() . '.png';
            $path = 'signatures/' . $imageName;

            // Ensure the signatures directory exists
            if (!Storage::disk('public')->exists('signatures')) {
                Storage::disk('public')->makeDirectory('signatures');
            }

            // Delete old signature if exists
            if ($employee->signature && Storage::disk('public')->exists($employee->signature)) {
                Storage::disk('public')->delete($employee->signature);
            }

            // Store new signature
            $stored = Storage::disk('public')->put($path, base64_decode($image));

            if (!$stored) {
                throw new \Exception('Failed to store signature file');
            }

            // Update employee record
            $updated = $employee->update([
                'signature' => $path
            ]);

            if (!$updated) {
                throw new \Exception('Failed to update employee record');
            }

            Log::info('Signature saved successfully for employee ID: ' . $employee->id);

            return response()->json([
                'success' => true,
                'message' => 'Signature saved successfully',
                'path' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            Log::error('Signature save failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to save signature: ' . $e->getMessage()
            ], 500);
        }
    }

    public function publicProfile($slug)
    {
        $employee = Employee::where('slug', $slug)
            ->where('employee_status', 'Active')
            ->firstOrFail();

        return view('employees.public-profile', compact('employee'));
    }

    // ... existing code ...

/**
 * Create user accounts for all active employees who don't have accounts yet.
 *
 * @return \Illuminate\Http\RedirectResponse
 */
public function createBulkUsers(): RedirectResponse
{
    try {
        // Begin transaction
        DB::beginTransaction();

        // Get all active employees without user accounts
        $activeEmployees = Employee::where('employee_status', 'Active')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.email = employees.email_address');
            })
            ->get();

        if ($activeEmployees->isEmpty()) {
            return redirect()->route('employees.index')
                ->with('info', 'No eligible employees found for user account creation.');
        }

        // Get the Employee role
        $employeeRole = Role::where('name', 'Employee')->firstOrFail();

        $createdCount = 0;
        $failedCount = 0;
        $errors = [];

        foreach ($activeEmployees as $employee) {
            try {
                // Create user account
                $user = User::create([
                    'company_id' => $employee->company_id,
                    'first_name' => $employee->first_name,
                    'middle_name' => $employee->middle_name,
                    'last_name' => $employee->last_name,
                    'suffix' => $employee->suffix,
                    'email' => $employee->email_address,
                    'password' => Hash::make($employee->company_id),
                    'bio' => $employee->position->name,
                    'profile_image' => $employee->profile,
                    'contact_no' => $employee->contact_no,
                    'date_hired' => $employee->date_hired,
                ]);

                // Assign the Employee role
                $user->assignRole($employeeRole);

                // Send notification email
                $user->notify(new EmployeeAccountActivated($employee));

                $createdCount++;
            } catch (\Exception $e) {
                $failedCount++;
                $errors[] = "Failed to create user for {$employee->first_name} {$employee->last_name}: {$e->getMessage()}";
                Log::error("User creation failed for employee {$employee->id}: " . $e->getMessage());
            }
        }

        DB::commit();

        // Prepare the response message
        $message = "Successfully created {$createdCount} user accounts.";
        if ($failedCount > 0) {
            $message .= " Failed to create {$failedCount} accounts.";
        }

        $type = $failedCount > 0 ? 'warning' : 'success';

        return redirect()->route('employees.index')
            ->with($type, $message)
            ->with('errors', $errors);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Bulk user creation failed: ' . $e->getMessage());
        Log::error($e->getTraceAsString());

        return redirect()->route('employees.index')
            ->with('error', 'An error occurred during bulk user creation. Please try again.');
    }
}

}

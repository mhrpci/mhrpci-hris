<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\Type;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        // Check if the authenticated user has the 'Employee' role
        if (auth()->user()->hasRole('Employee')) {
            // Retrieve only the employee with the same email address as the authenticated user
            $employees = Employee::where('email_address', auth()->user()->email)
                                 ->where('employee_status', 'Active')
                                 ->get();
        } else {
            // For other roles, retrieve all active employees
            $employees = Employee::where('employee_status', 'Active')->get();
        }

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
            'employee_id' => 'required|integer|exists:employees,id',
            'leave_type' => 'required|string|in:Leave,Undertime',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'type_id' => 'required|exists:types,id',
            'reason_to_leave' => 'required|string|max:1000',
            'approved_by' => 'nullable|integer|exists:users,id',
            'signature' => 'required|string',
        ]);

        // Add new validation for vacation leave (assuming type_id 1 is vacation leave)
        if ($validatedData['leave_type'] === 'Leave' && $validatedData['type_id'] == 1) {
            $dateFrom = \Carbon\Carbon::parse($validatedData['date_from']);
            $twoWeeksFromNow = now()->addWeeks(2);

            if ($dateFrom->lessThan($twoWeeksFromNow)) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['date_from' => 'Vacation leave must be filed at least 2 weeks before the start date.']);
            }
        }

        // Get employee details first
        $employee = Employee::findOrFail($validatedData['employee_id']);

        try {
            // Process signature
            $signatureFileName = null;
            if ($request->filled('signature')) {
                $signatureData = $request->input('signature');

                // Validate base64 image
                if (!preg_match('/^data:image\/(\w+);base64,/', $signatureData)) {
                    throw new \Exception('Invalid signature format');
                }

                // Extract image data
                $signatureImage = substr($signatureData, strpos($signatureData, ',') + 1);
                $decodedImage = base64_decode($signatureImage);

                if ($decodedImage === false) {
                    throw new \Exception('Failed to decode signature');
                }

                // Generate unique filename
                $signatureFileName = 'signatures/leave-' . uniqid() . '.png';

                // Ensure signatures directory exists
                Storage::disk('public')->makeDirectory('signatures');

                // Store the signature
                if (!Storage::disk('public')->put($signatureFileName, $decodedImage)) {
                    throw new \Exception('Failed to save signature');
                }
            }

            // Create leave record with correct field names
            $leave = Leave::create([
                'employee_id' => $validatedData['employee_id'],
                'leave_type' => $validatedData['leave_type'],
                'date_from' => $validatedData['date_from'],
                'date_to' => $validatedData['date_to'],
                'type_id' => $validatedData['type_id'],
                'status' => 'pending',
                'reason_to_leave' => $validatedData['reason_to_leave'],
                'signature' => $signatureFileName,
                'payment_status' => $employee->employment_status === 'REGULAR' ? 'With Pay' : 'Without Pay'
            ]);

            // Redirect with success message
            if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
                return redirect()->route('leaves.create')
                    ->with('success', 'Leave request created successfully.');
            } else {
                return redirect()->route('leaves.create')
                    ->with('success', 'Leave request sent successfully. Wait for the Admin confirmation.');
            }

        } catch (\Exception $e) {
            // Clean up signature file if it exists
            if (isset($signatureFileName) && Storage::disk('public')->exists($signatureFileName)) {
                Storage::disk('public')->delete($signatureFileName);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create leave request: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        try {
            $leave = Leave::findOrFail($id);
            $employees = Employee::all();
            $this->markAsRead($leave);

            // Calculate leave balances up to this leave ID
            $vacationTaken = $leave->employee->leaves()
                ->where('type_id', 1)
                ->where('id', '<=', $id)
                ->where('status', 'approved')
                ->count();

            $sickTaken = $leave->employee->leaves()
                ->where('type_id', 2)
                ->where('id', '<=', $id)
                ->where('status', 'approved')
                ->count();

            $emergencyTaken = $leave->employee->leaves()
                ->where('type_id', 3)
                ->where('id', '<=', $id)
                ->where('status', 'approved')
                ->count();

            // Calculate balances
            $vacationBalance = 5 - $vacationTaken;
            $sickBalance = 7 - $sickTaken;
            $emergencyBalance = 3 - $emergencyTaken;

            $diff = $leave->diffdays;
            $approvedByUser = $leave->approvedByUser;

            return view('leaves.show', compact(
                'leave',
                'approvedByUser',
                'diff',
                'employees',
                'vacationTaken',
                'sickTaken',
                'emergencyTaken',
                'vacationBalance',
                'sickBalance',
                'emergencyBalance'
            ));
        } catch (\Exception $e) {
            \Log::error('Leave Show Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    private function markAsRead(Leave $leave)
    {
        if (!$leave->is_read) {
            $leave->is_read = true;
            $leave->read_at = now();
            $leave->save();
        }
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

        // Determine the payment status based on employee's employment status
        $employee = Employee::findOrFail($validatedData['employee_id']);
        $validatedData['payment_status'] = $employee->employment_status === 'REGULAR' ? 'With Pay' : 'Without Pay';

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
            'approved_by_signature' => 'required|string',
        ]);

        // Find the leave request or fail
        $leave = Leave::findOrFail($id);

        try {
            // Process approved_by signature
            $approvedSignatureFileName = null;

            if ($request->filled('approved_by_signature')) {
                $signatureData = $request->input('approved_by_signature');
                $approvedSignatureFileName = $this->processSignature($signatureData, 'approved');
            }

            // Update leave status and signature
            $leave->status = $validatedData['status'];
            $leave->approved_by = Auth::id();
            $leave->approved_by_signature = $approvedSignatureFileName;
            $leave->save();

            return redirect()->route('leaves.show', $id)
                ->with('success', 'Leave status updated successfully.');

        } catch (\Exception $e) {
            // Clean up signature file if it exists
            if ($approvedSignatureFileName && Storage::disk('public')->exists($approvedSignatureFileName)) {
                Storage::disk('public')->delete($approvedSignatureFileName);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update leave status: ' . $e->getMessage()]);
        }
    }

    // Add these helper methods
    private function processSignature($signatureData, $prefix)
    {
        if (!preg_match('/^data:image\/(\w+);base64,/', $signatureData)) {
            throw new \Exception('Invalid signature format');
        }

        $signatureImage = substr($signatureData, strpos($signatureData, ',') + 1);
        $decodedImage = base64_decode($signatureImage);

        if ($decodedImage === false) {
            throw new \Exception('Failed to decode signature');
        }

        $signatureFileName = "signatures/{$prefix}-" . uniqid() . '.png';
        Storage::disk('public')->makeDirectory('signatures');

        if (!Storage::disk('public')->put($signatureFileName, $decodedImage)) {
            throw new \Exception('Failed to save signature');
        }

        return $signatureFileName;
    }

    private function cleanupSignatureFiles($fileNames)
    {
        foreach ($fileNames as $fileName) {
            if ($fileName && Storage::disk('public')->exists($fileName)) {
                Storage::disk('public')->delete($fileName);
            }
        }
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
            $employee = Employee::where('email_address', $user->email)->first();

            if ($employee) {
                $leaves = Leave::where('employee_id', $employee->id)->get();
                $sickLeaveBalance = $employee->sick_leave;
                $emergencyLeaveBalance = $employee->emergency_leave;
                $vacationLeaveBalance = $employee->vacation_leave;

                return view('leaves.my_leave_sheet', compact('employee', 'leaves', 'sickLeaveBalance', 'emergencyLeaveBalance', 'vacationLeaveBalance'));
            } else {
                return redirect()->route('leaves.index')->with('error', 'Employee not found.');
            }
        }

        /**
         * Display the leave details for the authenticated employee.
         */
        public function myLeaveDetail($id)
        {
            $leave = Leave::findOrFail($id);
            $user = Auth::user();
            $this->markAsView($leave);
            $employee = Employee::where('email_address', $user->email)->first();

            // Check if the employee exists and matches the leave ID
            if ($employee) {
                $leave = Leave::where('id', $id)->where('employee_id', $employee->id)->first();

                if ($leave) {
                    return view('leaves.my_leave_detail', compact('leave'));
                } else {
                    return redirect()->route('leaves.index')->with('error', 'Leave not found or does not belong to you.');
                }
            } else {
                return redirect()->route('leaves.index')->with('error', 'Employee not found.');
            }
        }

        private function markAsView(Leave $leave)
        {
            if (!$leave->is_view) {
                $leave->is_view = true;
                $leave->view_at = now();
                $leave->save();
            }
        }

        public function updateValidation(Request $request, string $id)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'validated_by_signature' => 'required|string',
            ]);

            // Find the leave request
            $leave = Leave::findOrFail($id);

            try {
                // Process validated_by signature
                if ($request->filled('validated_by_signature')) {
                    $signatureData = $request->input('validated_by_signature');
                    $validatedSignatureFileName = $this->processSignature($signatureData, 'validated');

                    // Update leave with validation signature
                    $leave->validated_by_signature = $validatedSignatureFileName;
                    $leave->save();
                }

                return redirect()->route('leaves.show', $id)
                    ->with('success', 'Leave validation signature added successfully.');

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['error' => 'Failed to add validation signature: ' . $e->getMessage()]);
            }
        }
}

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
            // Check if employee has a signature
            if (!$employee->signature) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['signature' => 'No signature found. Please update your signature in your profile.']);
            }

            // Create leave record with employee's signature
            $leave = Leave::create([
                'employee_id' => $validatedData['employee_id'],
                'leave_type' => $validatedData['leave_type'],
                'date_from' => $validatedData['date_from'],
                'date_to' => $validatedData['date_to'],
                'type_id' => $validatedData['type_id'],
                'status' => 'pending',
                'reason_to_leave' => $validatedData['reason_to_leave'],
                'signature' => $employee->signature,
            ]);

            // Calculate payment status after creation
            $leave->payment_status = $leave->getLeavePaymentStatus();
            $leave->save();

            // Redirect with success message
            if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin')) {
                return redirect()->route('leaves.create')
                    ->with('success', 'Leave request created successfully.');
            } else {
                return redirect()->route('leaves.create')
                    ->with('success', 'Leave request sent successfully. Wait for the Admin confirmation.');
            }

        } catch (\Exception $e) {
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
            $vacationTaken = $this->calculateLeaveTaken($leave->employee->id, 1, $id);
            $sickTaken = $this->calculateLeaveTaken($leave->employee->id, 2, $id);
            $emergencyTaken = $this->calculateLeaveTaken($leave->employee->id, 3, $id);

            // Calculate current leave days
            $currentLeaveDays = $this->calculateCurrentLeaveDays($leave);

            // Check if taken days are within limits and update payment status
            if ($leave->employee->employment_status === 'REGULAR') {
                $isWithinLimits = match($leave->type_id) {
                    1 => $vacationTaken <= $leave->employee->vacation_leave,
                    2 => $sickTaken <= $leave->employee->sick_leave,
                    3 => $emergencyTaken <= $leave->employee->emergency_leave,
                    default => false
                };

                // Only update payment status if the leave hasn't been approved yet
                if (!$leave->approved_by) {
                    $leave->payment_status = $isWithinLimits ? 'With Pay' : 'Without Pay';
                    $leave->save();
                }
            } else {
                // For non-regular employees, always set to Without Pay if not yet approved
                if (!$leave->approved_by) {
                    $leave->payment_status = 'Without Pay';
                    $leave->save();
                }
            }

            // Calculate balances
            $vacationBalance = max(0, 5 - $vacationTaken);
            $sickBalance = max(0, 7 - $sickTaken);
            $emergencyBalance = max(0, 3 - $emergencyTaken);

            $diff = $this->calculateCurrentLeaveDays($leave);
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

        // Find the leave request
        $leave = Leave::findOrFail($id);

        try {
            // Process approved_by signature
            $approvedSignatureFileName = null;

            if ($request->filled('approved_by_signature')) {
                $signatureData = $request->input('approved_by_signature');
                $approvedSignatureFileName = $this->processSignature($signatureData, 'approved');
            }

            // Calculate taken days for this type of leave
            $takenDays = $this->calculateLeaveTaken($leave->employee->id, $leave->type_id, $leave->id);

            // Determine if the leave should be with pay
            $isWithPay = false;
            if ($leave->employee->employment_status === 'REGULAR') {
                $maxDays = match($leave->type_id) {
                    1 => $leave->employee->vacation_leave,
                    2 => $leave->employee->sick_leave,
                    3 => $leave->employee->emergency_leave,
                    default => 0
                };

                $isWithPay = $takenDays <= $maxDays;
            }

            // Update leave status and signature
            $leave->status = $validatedData['status'];
            $leave->approved_by = Auth::id();
            $leave->approved_by_signature = $approvedSignatureFileName;

            // Only update payment status if it's being approved
            if ($validatedData['status'] === 'approved') {
                $leave->payment_status = $isWithPay ? 'With Pay' : 'Without Pay';
            }

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
            try {
                $leave = Leave::findOrFail($id);
                $employees = Employee::all();
                $this->markAsRead($leave);

                // Calculate leave balances up to this leave ID
                $vacationTaken = $this->calculateLeaveTaken($leave->employee->id, 1, $id);
                $sickTaken = $this->calculateLeaveTaken($leave->employee->id, 2, $id);
                $emergencyTaken = $this->calculateLeaveTaken($leave->employee->id, 3, $id);

                // Calculate current leave days
                $currentLeaveDays = $this->calculateCurrentLeaveDays($leave);

                // Check if taken days are within limits and update payment status
                if ($leave->employee->employment_status === 'REGULAR') {
                    $isWithinLimits = match($leave->type_id) {
                        1 => $vacationTaken <= $leave->employee->vacation_leave,
                        2 => $sickTaken <= $leave->employee->sick_leave,
                        3 => $emergencyTaken <= $leave->employee->emergency_leave,
                        default => false
                    };

                    // Only update payment status if the leave hasn't been approved yet
                    if (!$leave->approved_by) {
                        $leave->payment_status = $isWithinLimits ? 'With Pay' : 'Without Pay';
                        $leave->save();
                    }
                } else {
                    // For non-regular employees, always set to Without Pay if not yet approved
                    if (!$leave->approved_by) {
                        $leave->payment_status = 'Without Pay';
                        $leave->save();
                    }
                }

                // Calculate balances
                $vacationBalance = max(0, 5 - $vacationTaken);
                $sickBalance = max(0, 7 - $sickTaken);
                $emergencyBalance = max(0, 3 - $emergencyTaken);

                $diff = $this->calculateCurrentLeaveDays($leave);
                $approvedByUser = $leave->approvedByUser;

                return view('leaves.my_leave_detail', compact(
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

    private function calculateLeaveTaken($employeeId, $typeId, $currentLeaveId)
    {
        return Leave::where('employee_id', $employeeId)
            ->where('type_id', $typeId)
            ->where('id', '<=', $currentLeaveId)
            ->where('status', 'approved')
            ->get()
            ->sum(function ($leave) {
                return $this->calculateCurrentLeaveDays($leave);
            });
    }

    private function calculateCurrentLeaveDays($leave)
    {
        if ($leave->status !== 'approved') {
            return 0;
        }

        $dateFrom = \Carbon\Carbon::parse($leave->date_from)->startOfDay();
        $dateTo = \Carbon\Carbon::parse($leave->date_to)->startOfDay();

        // Don't include the date_to in the count
        return $dateFrom->diffInDays($dateTo);
    }
}

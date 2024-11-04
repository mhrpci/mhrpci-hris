<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AccountabilityController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\OverTimePayController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ItInventoryController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HiringController;
use App\Http\Controllers\SssController;
use App\Http\Controllers\PagibigController;
use App\Http\Controllers\PhilhealthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SubsidiaryController;
use App\Http\Controllers\SssLoanController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\PagibigLoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeBirthdayController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Define the login route first to ensure it shows error
Route::any('/login', function() {
    throw new \App\Exceptions\LoginRouteException('This route is not accessible');
});

// Define your HRIS routes
Route::get('/hris', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('/hris', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// Other auth routes
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');

// If you need password reset routes
Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Careers routes
Route::post('/save-job', [CareerController::class, 'saveJob'])->name('save.job');
Route::post('/unsave-job', [CareerController::class, 'unsaveJob'])->name('unsave.job');
Route::get('/saved-jobs', [CareerController::class, 'getSavedJobs'])->name('saved.jobs');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/applicants/{id}', [CareerController::class, 'showApplicant'])->name('showApplicant');
Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');
Route::get('/all-careers', [CareerController::class, 'getAllCareers'])->name('careers.all');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');
Route::post('/careers/{id}/schedule-interview', [CareerController::class, 'scheduleInterview'])->name('careers.schedule-interview');
Route::get('/saved-jobs', [CareerController::class, 'savedJobs'])->name('saved.jobs');
Route::post('/toggle-save-job', [CareerController::class, 'toggleSaveJob'])->name('toggle.save.job');

//GoogleAuth routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::post('auth/google/logout', [GoogleAuthController::class, 'logout'])->name('google.logout');

// Hiring routes
Route::get('/related-jobs/{hiring}', [HiringController::class, 'relatedJobs'])->name('related.jobs');

// Welcome routes
Route::get('/mhrpci', [WelcomeController::class, 'showMhrpci'])->name('mhrpci');
Route::get('/subsidiaries/{subsidiary}/details', [WelcomeController::class, 'showDetails'])->name('subsidiaries_details');

   // Terms and Privacy routes
   Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Auth routes
Route::middleware('auth')->group(function () {
    // Our resource routes
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('genders', GenderController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('provinces', ProvinceController::class);
    Route::resource('city', CityController::class);
    Route::resource('barangay', BarangayController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('leaves', LeaveController::class);
    Route::resource('contributions', ContributionController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('types', TypeController::class);
    Route::resource('inventory', ItInventoryController::class);
    Route::resource('overtime', OverTimePayController::class);
    Route::resource('posts', PostController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('credentials', CredentialController::class);
    Route::resource('hirings', HiringController::class);
    Route::resource('pagibig', PagibigController::class);
    Route::resource('accountabilities', AccountabilityController::class);
    Route::resource('policies', PolicyController::class);
    Route::resource('subsidiaries', SubsidiaryController::class);
    Route::resource('loan_sss', SssLoanController::class);
    Route::resource('cash_advances', CashAdvanceController::class);
    Route::resource('loan_pagibig', PagibigLoanController::class);
    Route::resource('sss', SssController::class)->except(['edit', 'update']);
    Route::resource('pagibig', PagibigController::class)->except(['edit', 'update']);
    Route::resource('philhealth', PhilhealthController::class)->except(['edit', 'update']);

    // Employees routes
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');
    Route::get('/employees/filter', [EmployeeController::class, 'filter'])->name('employees.filter');
    Route::post('employees/{employee}/update-status', [EmployeeController::class, 'updateStatus'])->name('employees.updateStatus');
    Route::patch('employees/{employee}/disable', [EmployeeController::class, 'disable'])->name('employees.disable');
    Route::get('/employee/attendance/{employee_id}', [AttendanceController::class, 'showEmployeeAttendance'])->name('employee.attendance');
    Route::post('/employees/{employee}/create-user', [EmployeeController::class, 'createUser'])->name('employees.createUser');
    Route::get('/employees/{id}/status', [EmployeeController::class, 'getStatus']);
    Route::get('/employees/{slug}', [EmployeeController::class, 'show']);
    Route::get('employees/{slug}/edit', [EmployeeController::class, 'edit']);
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::get('/my-profile', [EmployeeController::class, 'viewOwnEmployeeProfile'])
    ->name('employee.own-profile');

    // Attendance routes
    Route::get('attendances/auto-mark-absent', [AttendanceController::class, 'autoMarkAbsent'])->name('attendances.autoMarkAbsent');
    Route::get('/timesheets', [AttendanceController::class, 'generateTimesheets'])->name('attendances.timesheets');
    Route::get('/my-timesheet', [AttendanceController::class, 'checkUserAndShowTimesheet'])->name('attendances.my-timesheet');
    Route::get('/check-attendance', [AttendanceController::class, 'checkAttendance']);
    Route::get('/attendances/print', [AttendanceController::class, 'printAttendance'])->name('attendances.print');
    Route::get('attendances/import', [AttendanceController::class, 'showImportForm'])->name('attendances.import.form');
    Route::post('attendances/import', [AttendanceController::class, 'import'])->name('attendances.import');
    Route::get('attendances/export', [AttendanceController::class, 'export'])->name('attendances.export');

    // User Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Leave routes
    Route::put('/leaves/{id}/status', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
    Route::get('/leaves/detail/{id}', [LeaveController::class, 'detail'])->name('leaves.detail');
    Route::get('/leaves/print', [LeaveController::class, 'print'])->name('leaves.print');
    Route::get('/leaves-employees', [LeaveController::class, 'allEmployees'])->name('leaves.all_employees');
    Route::get('/leaves-report', [LeaveController::class, 'report'])->name('leaves.report');
    Route::get('leaves-employees/{employee_id}/leaves', [LeaveController::class, 'employeeLeaves'])->name('leaves.employee_leaves');
    Route::get('/leave-balance/{employeeId}', [LeaveController::class, 'showLeaveBalance'])->name('leaves.balance');
    Route::get('/my-leave-sheet', [LeaveController::class, 'myLeaveSheet'])->name('leaves.my_leave_sheet');
    Route::get('/my-leave-detail/{id}', [LeaveController::class, 'myLeaveDetail'])->name('leaves.myLeaveDetail');

    // Payroll routes
    Route::get('/payroll/{id}/download-pdf', [PayrollController::class, 'downloadPdf'])->name('payroll.download-pdf');
    Route::delete('/payroll/{id}', [PayrollController::class, 'destroy'])->name('payroll.destroy');
    Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');
    Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
    Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store');
    Route::get('/payroll/{id}', [PayrollController::class, 'show'])->name('payroll.show');
    Route::get('/payroll-employees-with-payroll', [PayrollController::class, 'employeesWithPayroll'])->name('payroll.employeesWithPayroll');
    Route::get('/payroll/{payroll}/payslip', [PayrollController::class, 'generatePayslip'])->name('payroll.payslip');
    Route::get('/my-payrolls', [PayrollController::class, 'myPayrolls'])->name('payroll.myPayrolls');
    Route::get('payroll/download-pdf/{id}', [PayrollController::class, 'downloadPdf'])->name('payroll.downloadPdf');

    // Contributions routes
    Route::get('/contributions-employee/{employee_id}', [ContributionController::class, 'employeeContributions'])->name('contributions.employee');
    Route::get('/contributions-employees-list', [ContributionController::class, 'allEmployeesContribution'])->name('contributions.employees-list');
    Route::get('/my-contributions', [ContributionController::class, 'myContributions'])->name('contributions.my');

    // Loans routes
    Route::get('/loans-employee/{employee_id}', [LoanController::class, 'employeeLoans'])->name('loans.employee');
    Route::get('/loans-employees-list', [LoanController::class, 'allEmployeesLoan'])->name('loans.employees-list');
    Route::get('/my-loans', [LoanController::class, 'myLoans'])->name('loans.my-loans');

    // Tasks routes
    Route::get('/tasks', [TaskController::class, 'checkUserAndShowTasks'])->name('checkUserAndShowTasks');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.myTasks');
    Route::post('/my-tasks', [TaskController::class, 'myTasks'])->name('myTasks');

    // Sss routes
    Route::get('/loan_sss/{id}/ledger', [SssLoanController::class, 'showLedger'])->name('loan_sss.ledger');
    Route::post('/loan_sss/generate-payments', [SssLoanController::class, 'generatePayments'])->name('loan_sss.generate_payments');
    Route::post('/loan_sss/{id}/update_status', [SssLoanController::class, 'updateStatus'])->name('loan_sss.update_status');
    Route::post('/sss/destroy-multiple', [SssController::class, 'destroyMultiple'])->name('sss.destroy.multiple');
    Route::post('/sss/store-all-active', [SssController::class, 'storeAllActive'])->name('sss.store-all-active');

    //Pagibig routes
    Route::get('/loan_pagibig/{id}/ledger', [PagibigLoanController::class, 'showLedger'])->name('loan_pagibig.ledger');
    Route::post('/loan_pagibig/generate-payments', [PagibigLoanController::class, 'generatePayments'])->name('loan_pagibig.generate_payments');
    Route::post('/loan_pagibig/{id}/update_status', [PagibigLoanController::class, 'updateStatus'])->name('loan_pagibig.update_status');
    Route::post('/pagibig/store-all-active', [PagibigController::class, 'storeAllActive'])->name('pagibig.store-all-active');

    //Philhealth routes
    Route::post('/philhealth/store-all-active', [PhilhealthController::class, 'storeAllActive'])->name('philhealth.store-all-active');

    // Cash Advances routes
    Route::get('/cash_advances/{id}/ledger', [CashAdvanceController::class, 'ledger'])->name('cash_advances.ledger');
    Route::post('/cash_advances/generate-payments', [CashAdvanceController::class, 'generatePayments'])->name('cash_advances.generate_payments');
    Route::post('/cash-advances/generate-payment-for-employee', [CashAdvanceController::class, 'generatePaymentForEmployee'])->name('cash_advances.generate_payment_for_employee');

    // Post routes
    Route::get('/posts/show/{id}', [PostController::class, 'showPostById'])->name('posts.showById');

    // Calendar routes
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/holidays', [CalendarController::class, 'getHolidays'])->name('calendar.holidays');

    // Open AI routes
    Route::post('/generate-text', [OpenAIController::class, 'generateText']);
    Route::post('/generate-image', [OpenAIController::class, 'generateImage']);

    // Home routes
    Route::get('/fetch-leaves', [HomeController::class, 'fetchLeavesByAuthUserFirstName']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Logout routes
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Policy routes
    Route::get('/policies-page', [PolicyController::class, 'showPolicy'])->name('policies.show-page');

    // Inventory routes
    Route::post('inventory/import', [ItInventoryController::class, 'import'])->name('inventory.import');

    // Overtime routes
    Route::get('/overtime-hours/{employeeId}', [OverTimePayController::class, 'getOvertimeHours'])->name('overtime.hours');

    // Notifications routes
    Route::get('notifications/get',[NotificationsController::class, 'getNotificationsData'])->name('notifications.get');
    Route::get('/notifications/all', [NotificationsController::class, 'showAllNotifications'])->name('notifications.all');

    // Report routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/loans', [ReportController::class, 'generateLoanReport'])->name('reports.loans');
    Route::post('/reports/contributions', [ReportController::class, 'generateContributionReport'])->name('reports.contributions');
    Route::post('/reports/attendances', [ReportController::class, 'generateAttendanceReport'])->name('reports.attendances');
    Route::post('/reports/leaves', [ReportController::class, 'generateLeaveReport'])->name('reports.leaves');
    Route::post('/reports/hirings', [ReportController::class, 'generateHiringReport'])->name('reports.hirings');
    Route::post('/reports/careers', [ReportController::class, 'generateCareerReport'])->name('reports.careers');
    Route::get('/reports/detailed-loan', [ReportController::class, 'generateDetailedLoanReport'])->name('reports.detailed-loan');

    // Server Time routes
    Route::get('/server-time', function() {
        return response()->json(['server_time' => now()->toIso8601String()]);
    });
    Route::post('push-subscription', [NotificationsController::class, 'storePushSubscription'])
    ->name('push-subscription.store');
    Route::get('/birthdays', [EmployeeBirthdayController::class, 'index'])->name('birthdays');
    Route::put('/leaves/update-status/{id}', [LeaveController::class, 'updateStatus'])->name('leaves.update-status');
    Route::put('/leaves/{id}/update-validation', [LeaveController::class, 'updateValidation'])->name('leaves.update-validation');
    Route::post('/push/subscribe', [App\Http\Controllers\PushNotificationController::class, 'store'])->name('push.subscribe');
    Route::get('/push/vapid-public-key', [App\Http\Controllers\PushNotificationController::class, 'getVapidPublicKey'])->name('push.key');
    Route::get('/test-notification', [App\Http\Controllers\PushNotificationController::class, 'testNotification'])
        ->name('test.notification');
});

    Auth::routes();









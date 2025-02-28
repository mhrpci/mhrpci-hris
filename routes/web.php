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
use App\Http\Controllers\SssLoanController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\PagibigLoanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeBirthdayController;
use App\Http\Controllers\ControllerAnalysisController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserActivityController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\SystemUpdateController;
use App\Http\Controllers\MedicalProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\AnalyticsController;

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
Route::get('/mhrpci-ai', [AiController::class, 'mhrpciAi'])->name('mhrpci-ai');
Route::get('/image-generator', [AiController::class, 'imageGenerator'])->name('image-generator');
Route::get('/text-analysis', [AiController::class, 'textAnalysis'])->name('text-analysis');
Route::get('/document-scanner', [AiController::class, 'documentScanner'])->name('document-scanner');
Route::get('/document-converter', [AiController::class, 'documentConverter'])->name('document-converter');
Route::post('/media-converter/convert', [AiController::class, 'mediaConverter'])->name('media-converter');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Careers routes
Route::post('/save-job', [CareerController::class, 'saveJob'])->name('save.job');
Route::post('/unsave-job', [CareerController::class, 'unsaveJob'])->name('unsave.job');
Route::get('/saved-jobs', [CareerController::class, 'getSavedJobs'])->name('saved.jobs');
Route::get('/careers', [CareerController::class, 'index'])->name('careers');
Route::get('/applicants/{id}', [CareerController::class, 'showApplicant'])->name('showApplicant');
Route::post('/careers/apply', [CareerController::class, 'apply'])->name('careers.apply');
Route::get('/all-careers', [CareerController::class, 'getAllCareers'])->name('careers.all');
Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');
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
Route::get('/subsidiaries', [WelcomeController::class, 'allSubsidiaries'])->name('all_subsidiaries');
Route::get('/mhrpropertyconglomeratesinc', [WelcomeController::class, 'showMhrpci'])->name('mhrpci');
Route::get('/baygaspetroleumdistributioninc', [WelcomeController::class, 'showBgpdi'])->name('bgpdi');
Route::get('/mhrhealthcareinc', [WelcomeController::class, 'showMhrhci'])->name('mhrhci');
Route::get('/medical_equipment', [WelcomeController::class, 'showMedicalEquipment'])->name('medical_equipment');
Route::get('/medical_products', [WelcomeController::class, 'showMedicalProducts'])->name('medical_products');
Route::get('/cebicindustries', [WelcomeController::class, 'showCio'])->name('cio');
Route::get('/verbenahotelinc', [WelcomeController::class, 'showVhi'])->name('vhi');
Route::get('/maximumhandlingresources', [WelcomeController::class, 'showMax'])->name('max');
Route::get('/lusciousco', [WelcomeController::class, 'showLus'])->name('lus');
Route::get('/mhrconstruction', [WelcomeController::class, 'showMhrcons'])->name('mhrcons');
Route::get('/rcgpharmaceutical', [WelcomeController::class, 'showRcg'])->name('rcg');

Route::post('/contactmhrhci', [ContactController::class, 'sendEmailMhrhci'])->name('contact.sendmhrhci');
Route::post('/contactbgpdi', [ContactController::class, 'sendEmailBgpdi'])->name('contact.sendbgpdi');

   // Terms and Privacy routes
   Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');


// Public Profile routes
Route::get('/employees-public/{slug}', [EmployeeController::class, 'publicProfile'])->name('employees.public');
Route::get('/employees/{slug}/secure-download', [EmployeeController::class, 'downloadSecureIdCard'])->name('employees.secure-download');
Route::post('/employees/process-secure-download', [EmployeeController::class, 'processSecureDownload'])->name('employees.process-secure-download');
Route::post('/validate-user', [App\Http\Controllers\AuthController::class, 'validateUser']);

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
    Route::get('/attendance', [AttendanceController::class, 'attendance'])->name('attendances.attendance');

    // User Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/details', [ProfileController::class, 'details'])->name('profile.details');

    // New signature route
    Route::post('/profile/signature', [ProfileController::class, 'updateSignature'])
    ->name('profile.signature.update');

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
    Route::get('/notifications/data', [NotificationsController::class, 'getNotificationsData'])->name('notifications.data');
    // Route::get('/notifications', [NotificationsController::class, 'showAllNotifications'])->name('notifications.all');
    Route::post('/notifications/{id}/read', [NotificationsController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/clear-all', [NotificationsController::class, 'clearAll'])->name('notifications.clear');
    Route::post('/notifications/mark-all-as-read', [NotificationsController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

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
    Route::post('/push-subscription', [NotificationsController::class, 'storePushSubscription'])
    ->name('push-subscription.store');
    Route::get('/birthdays', [EmployeeBirthdayController::class, 'index'])->name('birthdays');
    Route::put('/leaves/update-status/{id}', [LeaveController::class, 'updateStatus'])->name('leaves.update-status');
    Route::put('/leaves/{id}/update-validation', [LeaveController::class, 'updateValidation'])->name('leaves.update-validation');
    Route::post('/employee/signature', [EmployeeController::class, 'updateSignature'])
        ->name('employee.signature.update')
        ->middleware(['auth', 'verified']);
        Route::get('/controller-analysis', [ControllerAnalysisController::class, 'index'])->name('controller.analysis');
        Route::get('/controller-analysis/pdf', [ControllerAnalysisController::class, 'downloadPdf'])->name('controller.analysis.pdf');
        Route::get('/controller-analysis/excel', [ControllerAnalysisController::class, 'downloadExcel'])->name('controller.analysis.excel');
        Route::get('/controller-analysis/word', [ControllerAnalysisController::class, 'downloadWord'])->name('controller.analysis.word');

    Route::post('/notifications/mark-as-read/{id}', [NotificationsController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-read', [NotificationsController::class, 'markAllAsRead']);

    Route::post('/employees/create-bulk-users', [EmployeeController::class, 'createBulkUsers'])
        ->name('employees.createBulkUsers');

    Route::get('resigned-employees', [EmployeeController::class, 'resigned'])
        ->name('employees.resigned');
    
    Route::get('terminated-employees', [EmployeeController::class, 'terminated'])
        ->name('employees.terminated');


    Route::get('/accountabilities/{accountability}/transfer', [AccountabilityController::class, 'transfer'])->name('accountabilities.transfer');
    Route::post('/accountabilities/{accountability}/process-transfer', [AccountabilityController::class, 'processTransfer'])->name('accountabilities.process-transfer');
    
    Route::get('/notifications/get', [NotificationsController::class, 'getNotificationsData']);
    Route::post('/notifications/mark-as-read', [NotificationsController::class, 'markAsRead']);
    Route::delete('/notifications/clear', [NotificationsController::class, 'clearAll']);
    Route::get('/notifications/all', [NotificationsController::class, 'showAllNotifications'])->name('notifications.all');

    Route::post('/employees/update-profile', [EmployeeController::class, 'updateProfile'])->name('employees.update-profile');

    Route::post('/employee/profile', [EmployeeController::class, 'updateProfile'])
        ->name('employee.profile.update')
        ->middleware(['auth', 'verified']);

    Route::get('/user-departmental-activity', [UserActivityController::class, 'index'])->name('user-activity.index');

    // Account Management Routes
    Route::post('/account/link', [AccountController::class, 'link'])->name('account.link');
    Route::post('/account/switch/{linkedAccount}', [AccountController::class, 'switch'])->name('account.switch');
    Route::delete('/account/unlink/{linkedAccount}', [AccountController::class, 'unlink'])->name('account.unlink');

    // Activity Logs routes
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');

    // New holiday calendar route
    Route::get('/holidays-calendar', [HolidayController::class, 'holidayCalendar'])->name('holidays.calendar');

    // New holiday events route
    Route::get('/holidays/events', [HolidayController::class, 'getEvents'])->name('holidays.events');

    // Login History route
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('login.history');

    // System Updates routes
    Route::resource('system-updates', SystemUpdateController::class);

    // Medical Products routes
    Route::resource('medical-products', MedicalProductController::class)->parameters([
        'medical-products' => 'product'
    ]);

    // Category routes
    Route::resource('categories', CategoryController::class);

    // Quotation routes
    Route::post('/send-quotation-request', [QuotationController::class, 'sendRequest']);

    // Quotation management routes
    Route::get('/quotations', [QuotationController::class, 'index'])->name('quotations.index');
    Route::put('/quotations/{id}', [QuotationController::class, 'update'])->name('quotations.update');

    // Analytics routes
    Route::get('/analytics', [AnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
    Route::get('/analytics/product/{productId}', [AnalyticsController::class, 'getProductAnalytics'])->name('analytics.product');

});
Auth::routes();


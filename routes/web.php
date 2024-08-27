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
use App\Http\Controllers\SssController;
use App\Http\Controllers\SssLoanController;
use App\Http\Controllers\PagibigController;
use App\Http\Controllers\PagibigLoanController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TinController;
use App\Http\Controllers\PhilhealthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PayrollController;



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

    Route::get('/', function () {
    notify()->success('Good Day!');
    return view('welcome');
    });
    Route::get('/home', function () {
        notify()->success('Welcome to MHRPCI - HRIS');
        return view('home');
        });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/employees/birthdays', [EmployeeController::class, 'birthdays'])->name('employees.birthdays');
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
    Route::put('/leaves/{id}/status', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
    Route::get('/leaves/detail/{id}', [LeaveController::class, 'detail'])->name('leaves.detail');
    Route::get('/leaves/print', [LeaveController::class, 'print'])->name('leaves.print');
    Route::get('/leaves-employees', [LeaveController::class, 'allEmployees'])->name('leaves.all_employees');
    Route::get('/leaves-report', [LeaveController::class, 'report'])->name('leaves.report');
    Route::get('leaves-employees/{employee_id}/leaves', [LeaveController::class, 'employeeLeaves'])->name('leaves.employee_leaves');
    Route::get('attendances/auto-mark-absent', [AttendanceController::class, 'autoMarkAbsent'])->name('attendances.autoMarkAbsent');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::get('/notifications/all', [NotificationsController::class, 'showAllNotifications'])->name('notifications.all');
    Route::post('/employees/import', [EmployeeController::class, 'import'])->name('employees.import');
    Route::post('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');

    Route::resource('sss', SssController::class);
    Route::resource('loansss', SssLoanController::class);
    Route::resource('pagibig', PagibigController::class);
    Route::resource('loanpagibig', PagibigLoanController::class);
    Route::resource('types', TypeController::class);
    Route::resource('tin', TinController::class);
    Route::resource('philhealth', PhilhealthController::class);
    Route::resource('posts', PostController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('cashad', CashAdvanceController::class);
    Route::resource('tasks', TaskController::class);
    });
    Route::get(
    'notifications/get',
    [NotificationsController::class, 'getNotificationsData']
    )->name('notifications.get');

    Route::get('/timesheets', [AttendanceController::class, 'generateTimesheets'])->name('attendances.timesheets');
    Route::get('/employee/attendance/{employee_id}', [AttendanceController::class, 'showEmployeeAttendance'])->name('employee.attendance');
    Route::post('/employees/{employee}/create-user', [EmployeeController::class, 'createUser'])->name('employees.createUser');
    Route::get('/my-timesheet', [AttendanceController::class, 'checkUserAndShowTimesheet'])->name('attendances.my-timesheet');
    Route::get('/leave-balance/{employeeId}', [LeaveController::class, 'showLeaveBalance'])->name('leaves.balance');
    Route::get('/check-attendance', [AttendanceController::class, 'checkAttendance']);
    Route::get('/fetch-leaves', [HomeController::class, 'fetchLeavesByAuthUserFirstName']);
    Route::get('/attendances/print', [AttendanceController::class, 'printAttendance'])->name('attendances.print');

    Route::get('/server-time', function() {
        return response()->json(['server_time' => now()->toIso8601String()]);
    });

    Route::get('/employees/{id}/status', [EmployeeController::class, 'getStatus']);
    Route::get('/tasks', [TaskController::class, 'checkUserAndShowTasks'])->name('checkUserAndShowTasks');
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.myTasks');
    Route::post('/my-tasks', [TaskController::class, 'myTasks'])->name('myTasks');

    Route::resource('payrolls', PayrollController::class);
    Route::get('payrolls/{payroll}/payslip', [PayrollController::class, 'generatePayslip'])->name('payrolls.payslip');
    Route::get('generate-all-payrolls', [PayrollController::class, 'generateAllPayrolls'])->name('payrolls.generate-all');

Auth::routes();

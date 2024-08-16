<?php

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'sendOtp']);
Route::post('/auth/send-reset-otp', [ForgotPasswordController::class, 'sendResetOtp']);
Route::post('/auth/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
Route::post('/auth/reset-password', [ResetPasswordController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getCurrentUser']);
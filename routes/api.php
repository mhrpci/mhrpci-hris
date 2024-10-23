<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiLoginController;

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

Route::post('/login', [ApiLoginController::class, 'login']);
Route::post('/biometric-login', [ApiLoginController::class, 'biometricLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiLoginController::class, 'logout']);
    Route::post('/enable-biometrics', [ApiLoginController::class, 'enableBiometrics']);
    Route::post('/disable-biometrics', [ApiLoginController::class, 'disableBiometrics']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Example protected route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->post('/save-device-token', function (Request $request) {
    $validated = $request->validate([
        'token' => 'required|string'
    ]);

    auth()->user()->update([
        'device_token' => $validated['token']
    ]);

    return response()->json(['message' => 'Token saved successfully']);
});

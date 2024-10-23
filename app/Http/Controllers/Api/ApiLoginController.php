<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check if the user has the 'Employee' role
            if (!$user->hasRole('Employee')) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Only employees can login.',
                ], 403);
            }

            // Check if the user's status is disabled
            if ($user->status === 'disabled') {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is disabled.',
                ], 403);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ]);
    }

    public function biometricLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'biometric_token' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->biometric_token === $request->biometric_token) {
            // Check if the user has the 'Employee' role
            if (!$user->hasRole('Employee')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Only employees can login.',
                ], 403);
            }

            // Check if the user's status is disabled
            if ($user->status === 'disabled') {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is disabled.',
                ], 403);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function enableBiometrics(Request $request)
    {
        $user = $request->user();
        $biometric_token = Str::random(64);

        $user->update(['biometric_token' => $biometric_token]);

        return response()->json([
            'success' => true,
            'biometric_token' => $biometric_token,
            'message' => 'Biometric login enabled successfully',
        ]);
    }

    public function disableBiometrics(Request $request)
    {
        $user = $request->user();
        $user->update(['biometric_token' => null]);

        return response()->json([
            'success' => true,
            'message' => 'Biometric login disabled successfully',
        ]);
    }
}

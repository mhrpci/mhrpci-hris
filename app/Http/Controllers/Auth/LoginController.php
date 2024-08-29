<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Check if the credentials are valid
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user's status is disabled
            if ($user->status === 'disabled') {
                Auth::logout(); // Log out the user if status is disabled
                return response()->json([
                    'success' => false,
                    'message' => 'Your account is disabled.',
                    'field' => 'email'
                ]);
            }

            // Authentication passed
            return response()->json(['success' => true, 'redirect' => '/home']);
        }

        // Check if the email exists
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email does not exist.',
                'field' => 'email'
            ]);
        }

        // If the email exists, then the password must be wrong
        return response()->json([
            'success' => false,
            'message' => 'Incorrect password.',
            'field' => 'password'
        ]);
    }
}

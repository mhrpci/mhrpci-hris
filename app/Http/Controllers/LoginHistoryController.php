<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $loginHistory = LoginHistory::with('user')
            ->orderBy('login_at', 'desc')
            ->paginate(15);

        if ($request->wantsJson()) {
            return response()->json($loginHistory);
        }

        return view('auth.login-history', compact('loginHistory'));
    }
} 
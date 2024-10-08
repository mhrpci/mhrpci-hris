<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('google')->check()) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}

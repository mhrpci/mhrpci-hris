<?php

namespace App\Http\Controllers;

use App\Models\GoogleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = GoogleUser::updateOrCreate(
                ['google_id' => $googleUser->getId()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'token' => $googleUser->token,
                ]
            );

            Auth::guard('google')->login($user);

            return redirect('/')->with('success', 'Successfully logged in!')
                ->header('Refresh', '0; url=/');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Google login failed. Please try again.');
        }
    }

    public function getUserInfo()
    {
        if (Auth::guard('google')->check()) {
            $user = Auth::guard('google')->user();
            return response()->json([
                'name' => $user->name,
                'avatar' => $user->avatar,
            ]);
        }
        return response()->json(null);
    }

    public function logout(Request $request)
    {
        Auth::guard('google')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Successfully logged out!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'suffix' => 'nullable|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // added image validation
        'bio' => 'nullable|string|max:255',
    ]);

    $user->first_name = $request->first_name;
    $user->middle_name = $request->middle_name;
    $user->last_name = $request->last_name;
    $user->suffix = $request->suffix;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = $image->store('profile_images', 'public');
        $user->profile_image = $filename;
    }

    $user->bio = $request->bio;
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}


}

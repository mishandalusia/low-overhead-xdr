<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function show()
    {
        return view('pages.my-account', ['activeUser' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        Auth::user()->update(['name' => $validated['name']]);

        return back()->with('status', 'Profile updated successfully.');
    }

    public function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
        ]);

        $user = Auth::user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $path = $validated['avatar']->store('avatars', 'public');

        $user->update(['avatar_path' => $path]);

        return back()->with('status', 'Profile photo updated successfully.');
    }
}

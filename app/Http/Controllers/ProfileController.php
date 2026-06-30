<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // UPDATE BASIC DATA
        $user->name = $request->name;
        $user->email = $request->email;

        // AVATAR UPLOAD
        if ($request->hasFile('avatar')) {

            // hapus avatar lama kalau ada
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            $file = $request->file('avatar');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/avatars', $filename);

            $user->avatar = $filename;
        }

        // SAVE USER
        $user->save();

        // BALIK KE DASHBOARD
        return redirect()->route('dashboard');
    }
}
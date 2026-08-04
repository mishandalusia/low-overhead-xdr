<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetCodeMail;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    public function sendCode(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'This email is not registered.',
            ])->withInput();
        }

        PasswordResetCode::where('email', $data['email'])->delete();

        $code = (string) random_int(1000, 9999);

        PasswordResetCode::create([
            'email' => $data['email'],
            'code' => Hash::make($code),
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($data['email'])->send(new PasswordResetCodeMail($code));

        $request->session()->put('password_reset_email', $data['email']);
        $request->session()->forget('password_reset_verified');

        return redirect()->route('password.verify');
    }

    public function showVerifyForm(Request $request)
    {
        $email = $request->session()->get('password_reset_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-code', ['email' => $email]);
    }

    public function verifyCode(Request $request)
    {
        $email = $request->session()->get('password_reset_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'code' => ['required', 'digits:4'],
        ]);

        $record = PasswordResetCode::where('email', $email)
            ->where('expires_at', '>=', now())
            ->latest('id')
            ->first();

        if (! $record || ! Hash::check($request->input('code'), $record->code)) {
            return back()->withErrors([
                'code' => 'Invalid or expired code.',
            ]);
        }

        $request->session()->put('password_reset_verified', true);

        return redirect()->route('password.reset');
    }

    public function showResetForm(Request $request)
    {
        if (! $request->session()->get('password_reset_verified') || ! $request->session()->get('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $email = $request->session()->get('password_reset_email');

        if (! $email || ! $request->session()->get('password_reset_verified')) {
            return redirect()->route('password.request');
        }

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::where('email', $email)->update([
            'password' => Hash::make($data['password']),
        ]);

        PasswordResetCode::where('email', $email)->delete();

        $request->session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('login')->with('status', 'Password changed successfully. Please log in with your new password.');
    }
}

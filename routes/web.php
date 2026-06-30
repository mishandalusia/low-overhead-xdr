<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\ProfileController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/agent-monitoring', function () {
    return view('pages.agent-monitoring');
})->name('agent.monitoring');

Route::get('/threat-detection', function () {
    return view('pages.threat-detection');
})->name('threat.detection');

Route::get('/alert-management', function () {
    return view('pages.alert-management');
})->name('alert.management');

Route::get('/incident-tracking', function () {
    return view('pages.incident-tracking');
})->name('incident.tracking');

Route::get('/response-management', function () {
    return view('pages.response-management');
})->name('response.management');

Route::get('/analytics', function () {
    return view('pages.analytics');
})->name('analytics');

Route::get('/settings', function () {
    return view('pages.settings');
})->name('settings');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('login_success', true);
    }

    return back()
        ->withErrors(['email' => 'Email atau password salah.'])
        ->withInput();
})->name('login.post');

Route::post('/signup', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'min:6', 'confirmed'],
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Akun berhasil dibuat. Silakan login.');
})->name('signup.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::get('/my-account', function () {
    return view('pages.my-account');
})->name('my.account');

Route::get('/account-settings', function () {
    return view('pages.account-settings');
})->name('account.settings');

Route::get('/security-profile', function () {
    return view('pages.security-profile');
})->name('security.profile');

Route::get('/activity-log', function () {
    return view('pages.activity-log');
})->name('activity.log');

Route::get('/switch-account', function () {
    return view('pages.switch-account');
})->name('switch.account');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/switch-user/{role}', function ($role) {
    $users = [
        'leader' => [
            'name' => 'Group Leader',
            'email' => 'lead@lox.com',
            'role' => 'Group Leader',
        ],
        'webadmin' => [
            'name' => 'Web Administrator',
            'email' => 'webadmin@lox.com',
            'role' => 'Web Administrator',
        ],
        'analyst' => [
            'name' => 'Security Analyst',
            'email' => 'analyst@lox.com',
            'role' => 'Security Analyst',
        ],
    ];

    if (!array_key_exists($role, $users)) {
        abort(404);
    }

    session(['active_user' => $users[$role]]);

    return redirect()->route('dashboard');
})->name('switch.user');

Route::get('/my-account', function () {
    return view('pages.my-account');
})->name('my.account');

Route::get('/account-settings', function () {
    return view('pages.account-settings');
})->name('account.settings');

Route::get('/security-profile', function () {
    return view('pages.security-profile');
})->name('security.profile');

Route::get('/activity-log', function () {
    return view('pages.activity-log');
})->name('activity.log');

Route::get('/switch-account', function () {
    return view('pages.switch-account');
})->name('switch.account');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

Route::get('/profile/my-account', [ProfileController::class, 'myAccount'])->name('profile.myAccount');

Route::get('/profile/account-settings', [ProfileController::class, 'settings'])->name('profile.settings');

Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');

Route::get('/profile/activity', [ProfileController::class, 'activity'])->name('profile.activity');

Route::get('/profile/switch', [ProfileController::class, 'switch'])->name('profile.switch');

/* UPDATE PROFILE */
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

/* UPDATE PASSWORD */
Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

Route::middleware('auth')->group(function () {

    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])
        ->name('password.update');

});


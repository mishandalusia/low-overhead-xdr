<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid email or password.'
    ])->withInput();

})->name('login.post');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SECURITY MODULES
    |--------------------------------------------------------------------------
    */

    Route::get('/agent-monitoring', fn () => view('pages.agent-monitoring'))
        ->name('agent.monitoring');

    Route::get('/event-monitoring', fn () => view('pages.event-monitoring'))
        ->name('event.monitoring');

    Route::get('/alert-management', fn () => view('pages.alert-management'))
        ->name('alert.management');

    Route::get('/threat-detection', fn () => view('pages.threat-detection'))
        ->name('threat.detection');

    Route::get('/incident-tracking', fn () => view('pages.incident-tracking'))
        ->name('incident.tracking');

    Route::get('/response-management', fn () => view('pages.response-management'))
        ->name('response.management');

    Route::get('/analytics', fn () => view('pages.analytics'))
        ->name('analytics');

    Route::get('/settings', function () {
    return view('pages.settings');
})->name('settings');
    /*
    |--------------------------------------------------------------------------
    | ACCOUNT MODULE
    |--------------------------------------------------------------------------
    */

    Route::get('/my-account', fn () => view('pages.my-account'))
        ->name('my.account');

    Route::get('/account-settings', fn () => view('pages.account-settings'))
        ->name('account.settings');

    Route::get('/security-profile', fn () => view('pages.security-profile'))
        ->name('security.profile');

    Route::get('/activity-log', fn () => view('pages.activity-log'))
        ->name('activity.log');

    Route::get('/switch-account', fn () => view('pages.switch-account'))
        ->name('switch.account');


    /*
    |--------------------------------------------------------------------------
    | SWITCH USER (SIMULASI ROLE)
    |--------------------------------------------------------------------------
    */

    Route::get('/switch-user/{role}', function ($role) {

        $users = [
            'leader' => [
                'name' => 'Group Leader',
                'email' => 'lead@lox.com',
                'role' => 'leader',
            ],
            'webadmin' => [
                'name' => 'Web Administrator',
                'email' => 'webadmin@lox.com',
                'role' => 'webadmin',
            ],
            'analyst' => [
                'name' => 'Security Analyst',
                'email' => 'analyst@lox.com',
                'role' => 'analyst',
            ],
        ];

        if (!isset($users[$role])) {
            abort(404);
        }

        session(['active_user' => $users[$role]]);

        return redirect()->route('dashboard');

    })->name('switch.user');


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', function (Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    })->name('logout');

});
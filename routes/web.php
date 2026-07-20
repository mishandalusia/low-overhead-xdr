<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ThreatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.post');

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [PasswordResetController::class, 'showEmailForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendCode'])->name('password.email');

Route::get('/forgot-password/verify', [PasswordResetController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/forgot-password/verify', [PasswordResetController::class, 'verifyCode'])->name('password.verify.submit');

Route::get('/password-reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password-reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | SECURITY MODULES
    |--------------------------------------------------------------------------
    */

    Route::get('/agent-monitoring', [AgentController::class, 'index'])
        ->name('agent.monitoring');

    Route::get('/threat-detection', [ThreatController::class, 'index'])
        ->name('threat.detection');

    Route::get('/incident-management', [IncidentController::class, 'index'])
        ->name('incident.management');

    Route::post('/incident-management/assign', [IncidentController::class, 'assign'])
        ->name('incident.assign');

    Route::post('/incident-management/status', [IncidentController::class, 'updateStatus'])
        ->name('threat.incident.update');

    Route::get('/response-management', [ResponseController::class, 'index'])
        ->name('response.management');

    Route::post('/response-management/block', [ResponseController::class, 'block'])
        ->name('response.block');

    Route::post('/response-management/unblock', [ResponseController::class, 'unblock'])
        ->name('response.unblock');

    Route::get('/analytics', [AnalyticsController::class, 'index'])
        ->name('analytics');

    Route::get('/analytics/export/pdf', [AnalyticsController::class, 'exportPdf'])
        ->name('analytics.export.pdf');

    Route::get('/analytics/export/csv', [AnalyticsController::class, 'exportCsv'])
        ->name('analytics.export.csv');

    Route::get('/settings', function () {
        return view('pages.settings');
    })->name('settings');
    /*
    |--------------------------------------------------------------------------
    | ACCOUNT MODULE
    |--------------------------------------------------------------------------
    */

    Route::get('/my-account', [AccountController::class, 'show'])
        ->name('my.account');
    Route::post('/my-account/profile', [AccountController::class, 'updateProfile'])
        ->name('my.account.profile');
    Route::post('/my-account/avatar', [AccountController::class, 'updateAvatar'])
        ->name('my.account.avatar');

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

        if (! isset($users[$role])) {
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

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

});

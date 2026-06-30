@php
    use Illuminate\Support\Facades\Auth;

    $activeUser = Auth::user();

    $roleLabel = match ($activeUser->email) {
        'lead@lox.com' => 'Group Leader',
        'webadmin@lox.com' => 'Web Administrator',
        'analyst@lox.com' => 'Security Analyst',
        default => 'Administrator',
    };
@endphp

@extends('layouts.app-dashboard')

@section('title', 'Switch Account')
@section('subtitle', 'Sign out first, then login with another LOX account')

@section('content')
<div class="settings-card">
    <h3>Current Account</h3>
    <br>

    <div class="account-card active-account">
        <div class="avatar small-avatar"></div>
        <div>
            <h3>{{ $roleLabel }}</h3>
            <p>{{ $activeUser->email }}</p>
            <span class="role-badge">Currently Signed In</span>
        </div>
    </div>

    <br>

    <h3>Available LOX Accounts</h3>
    <br>

    <div class="account-list">
        <div class="account-card">
            <div class="avatar small-avatar"></div>
            <div>
                <h3>Group Leader</h3>
                <p>lead@lox.com</p>
            </div>
        </div>

        <div class="account-card">
            <div class="avatar small-avatar"></div>
            <div>
                <h3>Web Administrator</h3>
                <p>webadmin@lox.com</p>
            </div>
        </div>

        <div class="account-card">
            <div class="avatar small-avatar"></div>
            <div>
                <h3>Security Analyst</h3>
                <p>analyst@lox.com</p>
            </div>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="primary-action-btn">
            Logout and Switch Account
        </button>
    </form>
</div>
@endsection
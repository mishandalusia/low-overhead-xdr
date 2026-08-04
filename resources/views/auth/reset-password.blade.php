@extends('layouts.auth')

@section('title', 'Reset Password — LOX')
@section('heading', 'RESET PASSWORD')
@section('subheading', 'Set a new password for your account.')

@section('auth-content')
    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <div class="input-box">
                <span>@include('partials.lock-icon')</span>
                <input
                    type="password"
                    name="password"
                    placeholder="New password"
                    minlength="8"
                    required
                >
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility(this)" aria-label="Toggle password visibility">
                    @include('partials.password-toggle-icon')
                </button>
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <span>@include('partials.lock-icon')</span>
                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm new password"
                    minlength="8"
                    required
                >
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility(this)" aria-label="Toggle password visibility">
                    @include('partials.password-toggle-icon')
                </button>
            </div>
        </div>

        <button type="submit" class="login-btn">
            SAVE
        </button>
    </form>
@endsection

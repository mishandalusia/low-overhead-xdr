@extends('layouts.auth')

@section('title', 'LOX Login')
@section('heading', 'USER LOGIN')
@section('subheading', 'Access your Low-Overhead XDR dashboard.')

@section('auth-content')
    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="form-group">
            <div class="input-box">
                <span>✉</span>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Email address"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <div class="input-box">
                <span>@include('partials.lock-icon')</span>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                >
                <button type="button" class="toggle-password" onclick="togglePasswordVisibility(this)" aria-label="Toggle password visibility">
                    @include('partials.password-toggle-icon')
                </button>
            </div>
        </div>

        <div class="login-options">
            <label>
                <input type="checkbox" name="remember">
                <span>Keep me logged in</span>
            </label>

            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </div>

        <button type="submit" class="login-btn">
            LOGIN
        </button>
    </form>
@endsection

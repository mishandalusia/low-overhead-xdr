@extends('layouts.auth')

@section('title', 'Forgot Password — LOX')
@section('heading', 'FORGOT PASSWORD')
@section('subheading', 'Enter your account email and we will send you a 4-digit code.')

@section('auth-content')
    <form action="{{ route('password.email') }}" method="POST">
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

        <p class="auth-helper-text">
            <a href="{{ route('login') }}">Back to login</a>
        </p>

        <button type="submit" class="login-btn">
            SEND CODE
        </button>
    </form>
@endsection

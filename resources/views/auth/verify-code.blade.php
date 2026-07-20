@extends('layouts.auth')

@section('title', 'Verify Code — LOX')
@section('heading', 'VERIFY CODE')
@section('subheading', 'We sent a 4-digit code to ' . $email)

@section('extra-style')
    .code-input {
        letter-spacing: 10px;
        text-align: center;
        font-size: 20px !important;
        font-weight: 900 !important;
    }
@endsection

@section('auth-content')
    <form action="{{ route('password.verify.submit') }}" method="POST">
        @csrf

        <div class="form-group">
            <div class="input-box">
                <span>🔑</span>
                <input
                    type="text"
                    name="code"
                    class="code-input"
                    inputmode="numeric"
                    pattern="[0-9]{4}"
                    maxlength="4"
                    placeholder="0000"
                    autofocus
                    required
                >
            </div>
        </div>

        <p class="auth-helper-text">
            Didn't get a code?
            <a href="{{ route('password.request') }}">Resend</a>
        </p>

        <button type="submit" class="login-btn">
            VERIFY
        </button>
    </form>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In | Low Overhead XDR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: "Manrope", sans-serif;
            background:
                radial-gradient(circle at 16% 15%, rgba(236, 72, 153, 0.24), transparent 30%),
                radial-gradient(circle at 83% 78%, rgba(124, 58, 237, 0.28), transparent 34%),
                linear-gradient(135deg, #fff7fb 0%, #ffffff 42%, #f5edff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 42px 18px;
            color: #35105f;
        }

        .page-glow {
            position: fixed;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 0;
        }

        .bubble {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: 0.55;
            animation: bubbleFloat 9s ease-in-out infinite;
        }

        .bubble:nth-child(1) {
            width: 145px;
            height: 145px;
            top: 8%;
            left: 10%;
            background: rgba(236, 72, 153, 0.22);
        }

        .bubble:nth-child(2) {
            width: 220px;
            height: 220px;
            right: 8%;
            bottom: 8%;
            background: rgba(124, 58, 237, 0.22);
            animation-delay: 1.3s;
        }

        .bubble:nth-child(3) {
            width: 86px;
            height: 86px;
            right: 21%;
            top: 14%;
            background: rgba(217, 70, 239, 0.22);
            animation-delay: 2.2s;
        }

        .bubble:nth-child(4) {
            width: 115px;
            height: 115px;
            left: 18%;
            bottom: 12%;
            background: rgba(168, 85, 247, 0.18);
            animation-delay: 3s;
        }

        @keyframes bubbleFloat {
            0%, 100% {
                transform: translateY(0) translateX(0) scale(1);
            }

            50% {
                transform: translateY(-22px) translateX(12px) scale(1.04);
            }
        }

        .auth-card {
            width: 900px;
            height: 520px;
            max-width: 100%;
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.78);
            border: 1px solid rgba(216, 180, 254, 0.52);
            box-shadow:
                0 30px 80px rgba(88, 28, 135, 0.20),
                0 0 0 1px rgba(255, 255, 255, 0.65) inset,
                0 0 18px rgba(236, 72, 153, 0.16),
                0 0 32px rgba(124, 58, 237, 0.13);
            backdrop-filter: blur(20px);
            z-index: 2;
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 13px;
            border: 1px solid rgba(236, 72, 153, 0.18);
            border-radius: 22px;
            pointer-events: none;
            z-index: 8;
            box-shadow:
                0 0 10px rgba(236, 72, 153, 0.10),
                0 0 20px rgba(124, 58, 237, 0.08);
        }

        .auth-card::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 28px;
            box-shadow:
                0 0 14px rgba(236, 72, 153, 0.15),
                0 0 24px rgba(124, 58, 237, 0.12),
                0 0 54px rgba(124, 58, 237, 0.10) inset;
            pointer-events: none;
            z-index: 9;
        }

        .form-side {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%;
            height: 100%;
            z-index: 4;
            transition:
                transform 900ms cubic-bezier(0.22, 1, 0.36, 1),
                opacity 620ms ease,
                filter 620ms ease;
        }

        .form-scroll {
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 42px 46px 34px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .form-scroll::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }

        .signin-side {
            transform: translateX(0);
            opacity: 1;
            filter: blur(0);
        }

        .signup-side {
            transform: translateX(102%);
            opacity: 0;
            filter: blur(5px);
            pointer-events: none;
        }

        .auth-card.is-signup .signin-side {
            transform: translateX(-18%);
            opacity: 0;
            filter: blur(5px);
            pointer-events: none;
        }

        .auth-card.is-signup .signup-side {
            transform: translateX(100%);
            opacity: 1;
            filter: blur(0);
            pointer-events: auto;
        }

        .brand-pill {
            width: fit-content;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 13px 7px 8px;
            border-radius: 999px;
            background: rgba(243, 232, 255, 0.92);
            color: #7e22ce;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.45px;
            margin-bottom: 22px;
            box-shadow: 0 0 18px rgba(168, 85, 247, 0.13);
        }

        .brand-pill img {
            width: 27px;
            height: 27px;
            border-radius: 9px;
            object-fit: cover;
            background: #080819;
            padding: 2px;
            box-shadow:
                0 0 10px rgba(236, 72, 153, 0.22),
                0 0 14px rgba(124, 58, 237, 0.18);
        }

        h1,
        .panel-copy h2 {
           font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 32px;
            letter-spacing: -1px;
            color: #35105f;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7e22ce;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .field {
            margin-bottom: 14px;
            position: relative;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 800;
            color: #581c87;
            margin-bottom: 6px;
        }

        .field input {
            width: 100%;
            height: 45px;
            border: 0;
            border-bottom: 2px solid rgba(168, 85, 247, 0.38);
            background: transparent;
            outline: none;
            color: #35105f;
            font-family: Arial, sans-serif;
            font-size: 13px;
            padding: 0 40px 0 2px;
            transition: 230ms ease;
        }

        .field input::placeholder {
            color: #c084fc;
        }

        .field input:focus {
            border-bottom-color: #ec4899;
        }

        .field-icon {
            position: absolute;
            right: 3px;
            bottom: 12px;
            color: #9333ea;
            font-size: 15px;
        }

        .main-btn {
            width: 100%;
            height: 46px;
            margin-top: 8px;
            border: 0;
            border-radius: 999px;
            cursor: pointer;
            color: white;
            font-family: "Manrope", sans-serif;
            font-weight: 850;
            letter-spacing: 0.25px;
            background: linear-gradient(135deg, #ec4899, #8b5cf6);
            box-shadow:
                0 14px 28px rgba(236, 72, 153, 0.24),
                0 0 18px rgba(168, 85, 247, 0.22);
            transition: 240ms ease;
        }

        .main-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 20px 36px rgba(236, 72, 153, 0.31),
                0 0 24px rgba(168, 85, 247, 0.28);
        }

        .other-login {
            margin-top: 20px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 14px;
            color: #a855f7;
            font-size: 11px;
            font-weight: 800;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(216, 180, 254, 0.8);
        }

        .social-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .social-btn {
            height: 43px;
            border: 1px solid rgba(216, 180, 254, 0.85);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.82);
            color: #581c87;
            font-family: "Manrope", sans-serif;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 230ms ease;
        }

        .social-btn svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            border-color: #ec4899;
            box-shadow: 0 12px 24px rgba(168, 85, 247, 0.16);
        }

        .small-switch {
            margin-top: 16px;
            text-align: center;
            color: #7e22ce;
            font-size: 13px;
            font-weight: 700;
        }

        .small-switch button {
            border: 0;
            background: transparent;
            color: #ec4899;
            font-family: "Manrope", sans-serif;
            font-weight: 850;
            cursor: pointer;
        }

        .diagonal-panel {
            position: absolute;
            top: 0;
            right: 0;
            width: 56%;
            height: 100%;
            z-index: 6;
            overflow: hidden;
            background:
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.26), transparent 23%),
                linear-gradient(135deg, #ec4899 0%, #a855f7 45%, #6d28d9 100%);
            clip-path: polygon(26% 0, 100% 0, 100% 100%, 0 100%);
            transition:
                transform 900ms cubic-bezier(0.22, 1, 0.36, 1),
                clip-path 900ms cubic-bezier(0.22, 1, 0.36, 1);
            box-shadow: -18px 0 42px rgba(147, 51, 234, 0.22);
        }

        .auth-card.is-signup .diagonal-panel {
            transform: translateX(-78%);
            clip-path: polygon(0 0, 74% 0, 100% 100%, 0 100%);
            box-shadow: 18px 0 42px rgba(236, 72, 153, 0.20);
        }

        .diagonal-line {
            position: absolute;
            top: -10%;
            left: 21%;
            width: 2px;
            height: 125%;
            background: rgba(255, 255, 255, 0.35);
            transform: rotate(-38deg);
            box-shadow: 0 0 18px rgba(255,255,255,0.45);
            transition: 900ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .auth-card.is-signup .diagonal-line {
            left: 70%;
            transform: rotate(-38deg);
        }

        .panel-bubble {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            filter: blur(1px);
            animation: panelFloat 8s ease-in-out infinite;
        }

        .panel-bubble.one {
            width: 145px;
            height: 145px;
            right: 38px;
            top: 44px;
        }

        .panel-bubble.two {
            width: 82px;
            height: 82px;
            left: 135px;
            bottom: 68px;
            animation-delay: 1.4s;
        }

        .panel-bubble.three {
            width: 50px;
            height: 50px;
            right: 120px;
            bottom: 128px;
            animation-delay: 2.2s;
        }

        .panel-logo {
            position: absolute;
            right: 38px;
            bottom: 34px;
            width: 92px;
            height: 92px;
            object-fit: cover;
            border-radius: 24px;
            opacity: 0.22;
            mix-blend-mode: screen;
            filter: saturate(1.15);
            pointer-events: none;
            box-shadow: 0 0 28px rgba(255, 255, 255, 0.16);
        }

        @keyframes panelFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-18px);
            }
        }

        .panel-copy {
            position: absolute;
            inset: 0;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: right;
            padding: 62px 44px 62px 145px;
            transition:
                opacity 520ms ease,
                transform 720ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .panel-copy h2 {
            font-size: 38px;
            line-height: 1.08;
            letter-spacing: -1px;
            margin-bottom: 14px;
            text-transform: uppercase;
        }

        .panel-copy p {
            font-size: 13px;
            line-height: 1.72;
            opacity: 0.92;
            margin-left: auto;
            max-width: 300px;
            margin-bottom: 25px;
        }

        .panel-copy button {
            margin-left: auto;
        }

        .panel-signin {
            opacity: 1;
            transform: translateX(0);
        }

        .panel-signup {
            opacity: 0;
            transform: translateX(-30px);
            pointer-events: none;
            text-align: left;
            padding: 62px 145px 62px 44px;
        }

        .panel-signup p {
            margin-left: 0;
            margin-right: auto;
        }

        .panel-signup button {
            margin-left: 0;
        }

        .auth-card.is-signup .panel-signin {
            opacity: 0;
            transform: translateX(30px);
            pointer-events: none;
        }

        .auth-card.is-signup .panel-signup {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        .ghost-btn {
            width: fit-content;
            border: 1.5px solid rgba(255,255,255,0.82);
            border-radius: 999px;
            padding: 11px 24px;
            background: rgba(255,255,255,0.13);
            color: white;
            font-family: "Manrope", sans-serif;
            font-weight: 850;
            cursor: pointer;
            transition: 230ms ease;
        }

        .ghost-btn:hover {
            background: white;
            color: #8b5cf6;
            transform: translateY(-2px);
        }

        .alert {
            padding: 10px 13px;
            border-radius: 14px;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 13px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #f3e8ff;
            color: #6b21a8;
        }

        @media (max-width: 900px) {
            body {
                align-items: flex-start;
                padding: 28px 14px;
            }

            .auth-card {
                width: 100%;
                height: 650px;
            }

            .form-side {
                width: 100%;
            }

            .form-scroll {
                padding: 38px 28px 32px;
            }

            .signin-side {
                transform: translateX(0);
            }

            .signup-side {
                transform: translateX(100%);
            }

            .auth-card.is-signup .signin-side {
                transform: translateX(-100%);
            }

            .auth-card.is-signup .signup-side {
                transform: translateX(0);
            }

            .diagonal-panel {
                display: none;
            }

            h1 {
                font-size: 30px;
            }
        }
    </style>
</head>
<body>

<div class="page-glow">
    <span class="bubble"></span>
    <span class="bubble"></span>
    <span class="bubble"></span>
    <span class="bubble"></span>
</div>

<div class="auth-card {{ old('_form') === 'signup' ? 'is-signup' : '' }}" id="authCard">

    <section class="form-side signin-side">
        <div class="form-scroll">
            <div class="brand-pill">
                <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
                LOW OVERHEAD XDR
            </div>

            <h1>Sign in</h1>
            <p class="subtitle">
                Pick up where you left off and keep your security workflow moving.
            </p>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any() && old('_form') !== 'signup')
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <input type="hidden" name="_form" value="login">

                <div class="field">
                    <label>Email address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('_form') === 'login' ? old('email') : '' }}"
                        placeholder="name@company.com"
                        required
                    >
                    <span class="field-icon">✦</span>
                </div>

                <div class="field">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    <span class="field-icon">●</span>
                </div>

                <button type="submit" class="main-btn">Sign in</button>
            </form>

            <div class="other-login">
                <div class="divider">or sign in with</div>

                <div class="social-row">
                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.7 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
                            <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 15.1 19 12 24 12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.1 6.1 29.3 4 24 4 16.2 4 9.5 8.5 6.3 14.7z"/>
                            <path fill="#4CAF50" d="M24 44c5.2 0 10-2 13.5-5.2l-6.2-5.2C29.3 35.1 26.8 36 24 36c-5.3 0-9.7-3.3-11.3-7.9l-6.5 5C9.4 39.5 16.1 44 24 44z"/>
                            <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.4-2.3 4.3-4 5.6l6.2 5.2C36.9 39.3 44 34 44 24c0-1.3-.1-2.4-.4-3.5z"/>
                        </svg>
                        Google
                    </button>

                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 24 24" fill="#35105f">
                            <path d="M12 .5C5.7.5.6 5.6.6 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2.1c-3.2.7-3.9-1.4-3.9-1.4-.5-1.3-1.2-1.6-1.2-1.6-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.6 2.1 3.3 1.5.1-.7.4-1.2.7-1.5-2.6-.3-5.3-1.3-5.3-5.7 0-1.3.5-2.3 1.2-3.1-.1-.3-.5-1.5.1-3.1 0 0 1-.3 3.2 1.2.9-.3 1.9-.4 2.9-.4s2 .1 2.9.4c2.2-1.5 3.2-1.2 3.2-1.2.6 1.6.2 2.8.1 3.1.8.8 1.2 1.8 1.2 3.1 0 4.4-2.7 5.4-5.3 5.7.4.4.8 1.1.8 2.2v3.3c0 .3.2.7.8.6 4.6-1.5 7.9-5.8 7.9-10.9C23.4 5.6 18.3.5 12 .5z"/>
                        </svg>
                        GitHub
                    </button>
                </div>
            </div>

            <div class="small-switch">
                Don’t have an account?
                <button type="button" onclick="openSignup()">Sign up</button>
            </div>
        </div>
    </section>

    <section class="form-side signup-side">
        <div class="form-scroll">
            <div class="brand-pill">
                <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
                CREATE ACCESS
            </div>

            <h1>Sign up</h1>
            <p class="subtitle">
                Create your workspace access and start managing alerts with a cleaner flow.
            </p>

            @if ($errors->any() && old('_form') === 'signup')
                <div class="alert alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('signup.post') }}">
                @csrf
                <input type="hidden" name="_form" value="signup">

                <div class="field">
                    <label>Full name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('_form') === 'signup' ? old('name') : '' }}"
                        placeholder="Your name"
                        required
                    >
                    <span class="field-icon">✦</span>
                </div>

                <div class="field">
                    <label>Email address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('_form') === 'signup' ? old('email') : '' }}"
                        placeholder="name@company.com"
                        required
                    >
                    <span class="field-icon">✧</span>
                </div>

                <div class="field">
                    <label>Password</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Use at least 6 characters"
                        required
                    >
                    <span class="field-icon">●</span>
                </div>

                <div class="field">
                    <label>Confirm password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Re-enter your password"
                        required
                    >
                    <span class="field-icon">●</span>
                </div>

                <button type="submit" class="main-btn">Create account</button>
            </form>

            <div class="other-login">
                <div class="divider">or create with</div>

                <div class="social-row">
                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.7 32.7 29.3 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.1 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
                            <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 15.1 19 12 24 12c3.1 0 5.9 1.2 8 3.1l5.7-5.7C34.1 6.1 29.3 4 24 4 16.2 4 9.5 8.5 6.3 14.7z"/>
                            <path fill="#4CAF50" d="M24 44c5.2 0 10-2 13.5-5.2l-6.2-5.2C29.3 35.1 26.8 36 24 36c-5.3 0-9.7-3.3-11.3-7.9l-6.5 5C9.4 39.5 16.1 44 24 44z"/>
                            <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-.8 2.4-2.3 4.3-4 5.6l6.2 5.2C36.9 39.3 44 34 44 24c0-1.3-.1-2.4-.4-3.5z"/>
                        </svg>
                        Google
                    </button>

                    <button type="button" class="social-btn">
                        <svg viewBox="0 0 24 24" fill="#35105f">
                            <path d="M12 .5C5.7.5.6 5.6.6 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2.1c-3.2.7-3.9-1.4-3.9-1.4-.5-1.3-1.2-1.6-1.2-1.6-1-.7.1-.7.1-.7 1.1.1 1.7 1.2 1.7 1.2 1 .1.6 2.1 3.3 1.5.1-.7.4-1.2.7-1.5-2.6-.3-5.3-1.3-5.3-5.7 0-1.3.5-2.3 1.2-3.1-.1-.3-.5-1.5.1-3.1 0 0 1-.3 3.2 1.2.9-.3 1.9-.4 2.9-.4s2 .1 2.9.4c2.2-1.5 3.2-1.2 3.2-1.2.6 1.6.2 2.8.1 3.1.8.8 1.2 1.8 1.2 3.1 0 4.4-2.7 5.4-5.3 5.7.4.4.8 1.1.8 2.2v3.3c0 .3.2.7.8.6 4.6-1.5 7.9-5.8 7.9-10.9C23.4 5.6 18.3.5 12 .5z"/>
                        </svg>
                        GitHub
                    </button>
                </div>
            </div>

            <div class="small-switch">
                Already have an account?
                <button type="button" onclick="openSignin()">Sign in</button>
            </div>
        </div>
    </section>

    <aside class="diagonal-panel">
        <span class="diagonal-line"></span>

        <span class="panel-bubble one"></span>
        <span class="panel-bubble two"></span>
        <span class="panel-bubble three"></span>

        <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo" class="panel-logo">

        <div class="panel-copy panel-signin">
            <h2>Welcome<br>back!</h2>
            <p>
                Good to see you again. Your monitoring space is ready when you are.
            </p>
            <button type="button" class="ghost-btn" onclick="openSignup()">Create account</button>
        </div>

        <div class="panel-copy panel-signup">
            <h2>Join<br>the flow.</h2>
            <p>
                Set up your access and bring alerts, checks, and response notes into one place.
            </p>
            <button type="button" class="ghost-btn" onclick="openSignin()">Back to sign in</button>
        </div>
    </aside>

</div>

<script>
    const authCard = document.getElementById('authCard');

    function openSignup() {
        authCard.classList.add('is-signup');
    }

    function openSignin() {
        authCard.classList.remove('is-signup');
    }
</script>

</body>
</html>
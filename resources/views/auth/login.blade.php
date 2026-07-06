<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOX Login</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            overflow: hidden;
            background:
                radial-gradient(circle at top left, rgba(236, 72, 153, 0.28), transparent 34%),
                radial-gradient(circle at top right, rgba(168, 85, 247, 0.32), transparent 34%),
                linear-gradient(135deg, #8b5cf6 0%, #7c3aed 35%, #581c87 70%, #2e1065 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
        }

        .login-bg-glow {
            position: absolute;
            width: 520px;
            height: 520px;
            border-radius: 50%;
            background: rgba(236, 72, 153, 0.22);
            filter: blur(90px);
            top: -150px;
            left: -120px;
            z-index: 1;
        }

        .login-bg-glow.second {
            width: 460px;
            height: 460px;
            background: rgba(168, 85, 247, 0.28);
            top: auto;
            left: auto;
            right: -120px;
            bottom: -130px;
        }

        .mountain {
            position: absolute;
            bottom: -8px;
            width: 0;
            height: 0;
            border-left: 170px solid transparent;
            border-right: 170px solid transparent;
            border-bottom: 310px solid rgba(30, 15, 75, 0.72);
            z-index: 2;
        }

        .mountain.left {
            left: -70px;
        }

        .mountain.left-two {
            left: 210px;
            border-left-width: 190px;
            border-right-width: 190px;
            border-bottom-width: 360px;
            border-bottom-color: rgba(47, 20, 95, 0.55);
        }

        .mountain.right {
            right: -60px;
            border-left-width: 190px;
            border-right-width: 190px;
            border-bottom-width: 320px;
        }

        .mountain.right-two {
            right: 260px;
            border-left-width: 170px;
            border-right-width: 170px;
            border-bottom-width: 365px;
            border-bottom-color: rgba(47, 20, 95, 0.66);
        }

        .login-wrapper {
            position: relative;
            z-index: 5;
            width: 430px;
            border-radius: 26px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow:
                0 35px 85px rgba(15, 23, 42, 0.35),
                inset 0 0 0 1px rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(20px);
            animation: loginFloat 0.7s ease;
        }

        @keyframes loginFloat {
            from {
                opacity: 0;
                transform: translateY(18px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-hero {
            position: relative;
            height: 210px;
            background:
                radial-gradient(circle at 70% 28%, #ffd166 0 32px, transparent 33px),
                linear-gradient(135deg, #312e81 0%, #4c1d95 50%, #6d28d9 100%);
            overflow: hidden;
        }

        .cloud {
            position: absolute;
            height: 36px;
            border-radius: 999px;
            background: rgba(191, 219, 254, 0.78);
        }

        .cloud::before,
        .cloud::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: inherit;
        }

        .cloud::before {
            width: 42px;
            height: 42px;
            top: -18px;
            left: 24px;
        }

        .cloud::after {
            width: 55px;
            height: 55px;
            top: -24px;
            right: 20px;
        }

        .cloud.one {
            width: 118px;
            top: 38px;
            left: 35px;
        }

        .cloud.two {
            width: 132px;
            top: 52px;
            right: -18px;
            opacity: 0.75;
        }

        .hero-mountain {
            position: absolute;
            bottom: 0;
            width: 0;
            height: 0;
            border-left: 92px solid transparent;
            border-right: 92px solid transparent;
            border-bottom: 150px solid #201049;
        }

        .hero-mountain.m1 {
            left: 12px;
        }

        .hero-mountain.m2 {
            left: 130px;
            border-left-width: 105px;
            border-right-width: 105px;
            border-bottom-width: 170px;
            border-bottom-color: #1b0b3e;
        }

        .hero-mountain.m3 {
            right: 10px;
            border-left-width: 100px;
            border-right-width: 100px;
            border-bottom-width: 160px;
            border-bottom-color: #25105a;
        }

        .hero-snow {
            position: absolute;
            bottom: 82px;
            width: 0;
            height: 0;
            border-left: 42px solid transparent;
            border-right: 42px solid transparent;
            border-bottom: 38px solid rgba(226, 232, 240, 0.75);
            z-index: 2;
        }

        .hero-snow.s1 {
            left: 64px;
        }

        .hero-snow.s2 {
            left: 194px;
            bottom: 76px;
        }

        .hero-snow.s3 {
            right: 60px;
            bottom: 80px;
        }

        .login-card {
            position: relative;
            padding: 58px 54px 42px;
            background:
                radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 35%),
                linear-gradient(180deg, #1f3342 0%, #172a3a 100%);
        }

        .login-logo-circle {
            position: absolute;
            top: -38px;
            left: 50%;
            transform: translateX(-50%);
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 36px rgba(15, 23, 42, 0.25);
        }

        .login-logo-circle img {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        .login-title {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-title h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .login-title p {
            margin: 8px 0 0;
            font-size: 13px;
            color: rgba(226, 232, 240, 0.78);
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .input-box {
            width: 100%;
            height: 50px;
            border-radius: 999px;
            border: 1px solid rgba(236, 72, 153, 0.55);
            background: rgba(241, 245, 249, 0.96);
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 18px;
            box-shadow:
                0 0 0 3px rgba(236, 72, 153, 0.10),
                0 12px 25px rgba(15, 23, 42, 0.18);
        }

        .input-box span {
            color: #c084fc;
            font-size: 14px;
            flex-shrink: 0;
        }

        .input-box input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #0f172a;
            font-size: 14px;
            font-weight: 700;
        }

        .input-box input::placeholder {
            color: #94a3b8;
        }

        .input-box:focus-within {
            border-color: #d946ef;
            box-shadow:
                0 0 0 4px rgba(217, 70, 239, 0.18),
                0 14px 28px rgba(217, 70, 239, 0.20);
        }

        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 0 24px;
            gap: 14px;
            font-size: 12px;
            color: rgba(226, 232, 240, 0.84);
        }

        .login-options label {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .login-options input {
            accent-color: #d946ef;
        }

        .login-options a {
            color: #f0abfc;
            text-decoration: none;
            font-weight: 700;
        }

        .login-btn {
            width: 150px;
            height: 46px;
            border: none;
            border-radius: 999px;
            display: block;
            margin: 0 auto;
            cursor: pointer;
            color: #111827;
            font-size: 13px;
            font-weight: 950;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
            box-shadow:
                0 16px 34px rgba(236, 72, 153, 0.34),
                0 0 26px rgba(217, 70, 239, 0.30);
            transition: 0.22s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 20px 40px rgba(236, 72, 153, 0.42),
                0 0 32px rgba(217, 70, 239, 0.38);
            color: #ffffff;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.14);
            border: 1px solid rgba(248, 113, 113, 0.35);
            color: #fecaca;
            border-radius: 16px;
            padding: 12px 14px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .login-footer {
            position: absolute;
            z-index: 5;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.72);
            font-size: 13px;
            font-weight: 700;
        }

        .login-footer img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .login-footer strong {
            color: #ffffff;
        }

        @media (max-width: 600px) {
            body {
                overflow-y: auto;
                padding: 28px 16px;
            }

            .login-wrapper {
                width: 100%;
                max-width: 410px;
            }

            .login-card {
                padding: 58px 28px 38px;
            }

            .login-footer {
                position: fixed;
                bottom: 14px;
            }

            .mountain {
                opacity: 0.55;
            }
        }
    </style>
</head>

<body>
    <div class="login-bg-glow"></div>
    <div class="login-bg-glow second"></div>

    <div class="mountain left"></div>
    <div class="mountain left-two"></div>
    <div class="mountain right"></div>
    <div class="mountain right-two"></div>

    <div class="login-wrapper">
        <div class="login-hero">
            <div class="cloud one"></div>
            <div class="cloud two"></div>

            <div class="hero-mountain m1"></div>
            <div class="hero-mountain m2"></div>
            <div class="hero-mountain m3"></div>

            <div class="hero-snow s1"></div>
            <div class="hero-snow s2"></div>
            <div class="hero-snow s3"></div>
        </div>

        <div class="login-card">
            <div class="login-logo-circle">
                <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
            </div>

            <div class="login-title">
                <h1>USER LOGIN</h1>
                <p>Access your Low-Overhead XDR dashboard.</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

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
                        <span>⌘</span>
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Password" 
                            required
                        >
                    </div>
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember">
                        <span>Keep me logged in</span>
                    </label>

                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">
                    LOGIN
                </button>
            </form>
        </div>
    </div>

    <div class="login-footer">
        <span>secured by</span>
        <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
        <strong>LOX</strong>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LOX')</title>

    @include('partials.design-tokens')

    <style>
        * {
            box-sizing: border-box;
            font-family: var(--font-main);
        }

        body {
            margin: 0;
            min-height: 100vh;
            overflow: hidden;
            background: #160b23;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-heading);
        }

        /* SoftAurora background — single-pass noise shader (ported from the
           React Bits SoftAurora component to raw WebGL, no dependency at
           all — much lighter than the earlier fluid-sim backgrounds, one
           draw call per frame instead of a dozen render-target passes). */
        #softAuroraCanvas {
            position: fixed;
            inset: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: block;
            opacity: 0.75;
        }

        .login-wrapper {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: stretch;
            width: 940px;
            max-width: 94vw;
            min-height: 500px;
            border-radius: 18px;
            overflow: hidden;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow:
                0 20px 48px rgba(139, 92, 246, 0.18),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
            animation: loginFloat 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        }

        @keyframes loginFloat {
            from {
                opacity: 0;
                transform: translateY(28px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Wavy Background hero panel */
        .login-hero {
            position: relative;
            width: 380px;
            flex-shrink: 0;
            background: linear-gradient(160deg, rgba(243, 236, 251, 0.7) 0%, rgba(253, 238, 247, 0.7) 100%);
            backdrop-filter: blur(14px) saturate(160%);
            -webkit-backdrop-filter: blur(14px) saturate(160%);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-hero-brand {
            position: relative;
            z-index: 3;
            text-align: center;
            padding: 0 36px;
        }

        .login-hero-brand img {
            width: 56px;
            height: 56px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .login-hero-brand h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 900;
            color: var(--text-heading);
            letter-spacing: -0.3px;
        }

        .login-hero-brand p {
            margin: 10px 0 0;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-body);
            line-height: 1.6;
        }

        .wave-layer {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 200%;
            height: auto;
        }

        .wave-layer.w1 {
            opacity: 0.55;
            animation: waveDrift 16s linear infinite;
        }

        .wave-layer.w2 {
            opacity: 0.4;
            animation: waveDrift 22s linear infinite reverse;
        }

        .wave-layer.w3 {
            opacity: 0.28;
            animation: waveDrift 28s linear infinite;
        }

        @keyframes waveDrift {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        .login-card {
            position: relative;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 48px 64px;
            /* Frosted glass — lets the aurora keep peeking through behind
               the form. Blur is intentionally moderate (not maxed out):
               a very heavy blur flattens the aurora into a near-solid
               wash that reads as "just another light background" instead
               of visible glass, so this keeps some of its color/movement
               showing through while staying inside the 85-90% opacity
               band for text legibility. */
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px) saturate(160%);
            -webkit-backdrop-filter: blur(14px) saturate(160%);
        }

        .login-logo-circle {
            position: relative;
            margin: 0 auto 20px;
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid rgba(139, 92, 246, 0.14);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 15px 36px rgba(139, 92, 246, 0.18);
            opacity: 0;
            animation: logoPop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.15s forwards;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-logo-circle:hover {
            transform: scale(1.08) rotate(-4deg);
            box-shadow: 0 18px 42px rgba(217, 70, 239, 0.28);
        }

        @keyframes logoPop {
            from {
                opacity: 0;
                transform: scale(0.4) rotate(-20deg);
            }

            to {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }

        .login-logo-circle img {
            width: 46px;
            height: 46px;
            object-fit: contain;
        }

        .login-title,
        .success-message,
        .error-message,
        .form-group,
        .login-options,
        .login-btn,
        .auth-helper-text {
            opacity: 0;
            animation: fadeSlideUp 0.55s ease forwards;
        }

        .login-title {
            text-align: center;
            margin-bottom: 24px;
            animation-delay: 0.28s;
        }

        .success-message {
            animation-delay: 0.32s;
        }

        .error-message {
            animation-delay: 0.32s;
        }

        .form-group:nth-of-type(1) {
            animation-delay: 0.36s;
        }

        .form-group:nth-of-type(2) {
            animation-delay: 0.44s;
        }

        .login-options {
            animation-delay: 0.5s;
        }

        .auth-helper-text {
            animation-delay: 0.5s;
        }

        .login-btn {
            animation-delay: 0.58s;
        }

        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-title h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 0.5px;
            color: var(--text-heading);
        }

        .login-title p {
            margin: 8px 0 0;
            font-size: 13px;
            color: var(--text-body);
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .input-box {
            width: 100%;
            height: 50px;
            border-radius: 999px;
            border: 1px solid rgba(139, 92, 246, 0.22);
            background: #FAF8FC;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 18px;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.06);
            transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
        }

        .input-box span {
            display: inline-flex;
            align-items: center;
            color: var(--accent-purple);
            font-size: 14px;
            flex-shrink: 0;
        }

        .input-box input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: var(--text-heading);
            font-size: 14px;
            font-weight: 700;
            letter-spacing: normal;
        }

        .input-box input::placeholder {
            color: #b3a9c4;
        }

        .toggle-password {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            padding: 4px;
            margin-left: 4px;
            color: #b3a9c4;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .toggle-password:hover {
            color: var(--accent-pink);
            transform: scale(1.12);
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
        }

        .input-box:focus-within {
            border-color: var(--accent-pink);
            transform: translateY(-1px);
            box-shadow:
                0 0 0 4px rgba(217, 70, 239, 0.12),
                0 14px 28px rgba(217, 70, 239, 0.14);
        }

        .login-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 0 24px;
            gap: 14px;
            font-size: 12px;
            color: var(--text-body);
        }

        .login-options label {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .login-options input {
            accent-color: var(--accent-pink);
        }

        .login-options a,
        .auth-helper-text a {
            position: relative;
            color: var(--accent-pink);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-options a::after,
        .auth-helper-text a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 1px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.25s ease;
        }

        .login-options a:hover,
        .auth-helper-text a:hover {
            color: var(--accent-purple);
        }

        .login-options a:hover::after,
        .auth-helper-text a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Shiny Button — continuous glow pulse + sweeping shine highlight */
        .login-btn {
            position: relative;
            overflow: hidden;
            width: 150px;
            height: 46px;
            border: none;
            border-radius: 999px;
            display: block;
            margin: 0 auto;
            cursor: pointer;
            color: #ffffff;
            font-size: 13px;
            font-weight: 950;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
            box-shadow:
                0 16px 34px rgba(236, 72, 153, 0.28),
                0 0 26px rgba(217, 70, 239, 0.22);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
            animation:
                fadeSlideUp 0.55s ease forwards 0.58s,
                btnGlow 3.2s ease-in-out 1.2s infinite;
        }

        @keyframes btnGlow {
            0%, 100% {
                box-shadow:
                    0 16px 34px rgba(236, 72, 153, 0.28),
                    0 0 26px rgba(217, 70, 239, 0.22);
            }

            50% {
                box-shadow:
                    0 18px 40px rgba(236, 72, 153, 0.40),
                    0 0 36px rgba(217, 70, 239, 0.38);
            }
        }

        .login-btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: -60%;
            width: 40%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.65), transparent);
            transform: skewX(-20deg);
            animation: shineSweep 3.2s ease-in-out 1s infinite;
        }

        @keyframes shineSweep {
            0%, 40% {
                left: -60%;
            }

            60%, 100% {
                left: 130%;
            }
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 20px 40px rgba(236, 72, 153, 0.36),
                0 0 32px rgba(217, 70, 239, 0.32);
        }

        .login-btn:active {
            transform: translateY(0) scale(0.97);
        }

        .auth-helper-text {
            text-align: center;
            margin: 4px 0 22px;
            font-size: 12px;
            color: var(--text-body);
            line-height: 1.6;
        }

        .error-message {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.22);
            color: #dc2626;
            border-radius: 16px;
            padding: 12px 14px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .success-message {
            background: rgba(34, 197, 94, 0.08);
            border: 1px solid rgba(34, 197, 94, 0.22);
            color: #16a34a;
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
            color: var(--text-body);
            font-size: 13px;
            font-weight: 700;
            opacity: 0;
            animation: fadeSlideUp 0.6s ease forwards 0.7s;
        }

        .login-footer img {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        .login-footer strong {
            color: var(--text-heading);
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .login-title,
            .success-message,
            .error-message,
            .form-group,
            .login-options,
            .login-btn,
            .auth-helper-text,
            .login-logo-circle,
            .login-footer {
                opacity: 1;
            }
        }

        @media (max-width: 860px) {
            .login-wrapper {
                flex-direction: column;
                width: 100%;
                max-width: 430px;
                min-height: 0;
            }

            .login-hero {
                width: 100%;
                height: 190px;
            }
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
        }

        @yield('extra-style')
    </style>
</head>

<body>
    <canvas id="softAuroraCanvas"></canvas>

    <div class="login-wrapper">
        <div class="login-hero">
            <svg class="wave-layer w1" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#e9d5ff" fill-opacity="1" d="M0,160 C240,260,480,60,720,120 C960,180,1200,40,1440,110 L1440,320 L0,320 Z"></path>
            </svg>
            <svg class="wave-layer w2" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#fbcfe8" fill-opacity="1" d="M0,200 C260,120,500,260,760,190 C1000,130,1220,220,1440,170 L1440,320 L0,320 Z"></path>
            </svg>
            <svg class="wave-layer w3" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#ddd6fe" fill-opacity="1" d="M0,240 C300,180,540,290,800,230 C1040,180,1260,260,1440,220 L1440,320 L0,320 Z"></path>
            </svg>

            <div class="login-hero-brand">
                <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
                <h2>LOX</h2>
                <p>Low-Overhead XDR — lightweight extended detection & response.</p>
            </div>
        </div>

        <div class="login-card">
            <div class="login-logo-circle">
                <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
            </div>

            <div class="login-title">
                <h1>@yield('heading')</h1>
                <p>@yield('subheading')</p>
            </div>

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            @yield('auth-content')
        </div>
    </div>

    <div class="login-footer">
        <span>secured by</span>
        <img src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
        <strong>LOX</strong>
    </div>

    <script>
        function togglePasswordVisibility(button) {
            const input = button.previousElementSibling;
            const eyeIcon = button.querySelector('.icon-eye');
            const eyeOffIcon = button.querySelector('.icon-eye-off');

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            } else {
                input.type = 'password';
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            }
        }
    </script>

    <script>
        // SoftAurora background — vanilla WebGL port of the React Bits
        // SoftAurora component (same shader, no ogl/React — a handful of
        // lines of raw WebGL instead, single draw call per frame).
        (function () {
            const canvas = document.getElementById('softAuroraCanvas');
            if (!canvas) return;

            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (!gl) return;

            function hexToVec3(hex) {
                const h = hex.replace('#', '');
                return [
                    parseInt(h.slice(0, 2), 16) / 255,
                    parseInt(h.slice(2, 4), 16) / 255,
                    parseInt(h.slice(4, 6), 16) / 255,
                ];
            }

            const vertexSrc = `
                attribute vec2 position;
                varying vec2 vUv;
                void main() {
                    vUv = position * 0.5 + 0.5;
                    gl_Position = vec4(position, 0.0, 1.0);
                }
            `;

            const fragmentSrc = `
                precision highp float;

                uniform float uTime;
                uniform vec3 uResolution;
                uniform float uSpeed;
                uniform float uScale;
                uniform float uBrightness;
                uniform vec3 uColor1;
                uniform vec3 uColor2;
                uniform float uNoiseFreq;
                uniform float uNoiseAmp;
                uniform float uBandHeight;
                uniform float uBandSpread;
                uniform float uOctaveDecay;
                uniform float uLayerOffset;
                uniform float uColorSpeed;
                uniform vec2 uMouse;
                uniform float uMouseInfluence;
                uniform bool uEnableMouse;

                #define TAU 6.28318

                vec3 gradientHash(vec3 p) {
                    p = vec3(
                        dot(p, vec3(127.1, 311.7, 234.6)),
                        dot(p, vec3(269.5, 183.3, 198.3)),
                        dot(p, vec3(169.5, 283.3, 156.9))
                    );
                    vec3 h = fract(sin(p) * 43758.5453123);
                    float phi = acos(2.0 * h.x - 1.0);
                    float theta = TAU * h.y;
                    return vec3(cos(theta) * sin(phi), sin(theta) * cos(phi), cos(phi));
                }

                float quinticSmooth(float t) {
                    float t2 = t * t;
                    float t3 = t * t2;
                    return 6.0 * t3 * t2 - 15.0 * t2 * t2 + 10.0 * t3;
                }

                vec3 cosineGradient(float t, vec3 a, vec3 b, vec3 c, vec3 d) {
                    return a + b * cos(TAU * (c * t + d));
                }

                float perlin3D(float amplitude, float frequency, float px, float py, float pz) {
                    float x = px * frequency;
                    float y = py * frequency;

                    float fx = floor(x); float fy = floor(y); float fz = floor(pz);
                    float cx = ceil(x);  float cy = ceil(y);  float cz = ceil(pz);

                    vec3 g000 = gradientHash(vec3(fx, fy, fz));
                    vec3 g100 = gradientHash(vec3(cx, fy, fz));
                    vec3 g010 = gradientHash(vec3(fx, cy, fz));
                    vec3 g110 = gradientHash(vec3(cx, cy, fz));
                    vec3 g001 = gradientHash(vec3(fx, fy, cz));
                    vec3 g101 = gradientHash(vec3(cx, fy, cz));
                    vec3 g011 = gradientHash(vec3(fx, cy, cz));
                    vec3 g111 = gradientHash(vec3(cx, cy, cz));

                    float d000 = dot(g000, vec3(x - fx, y - fy, pz - fz));
                    float d100 = dot(g100, vec3(x - cx, y - fy, pz - fz));
                    float d010 = dot(g010, vec3(x - fx, y - cy, pz - fz));
                    float d110 = dot(g110, vec3(x - cx, y - cy, pz - fz));
                    float d001 = dot(g001, vec3(x - fx, y - fy, pz - cz));
                    float d101 = dot(g101, vec3(x - cx, y - fy, pz - cz));
                    float d011 = dot(g011, vec3(x - fx, y - cy, pz - cz));
                    float d111 = dot(g111, vec3(x - cx, y - cy, pz - cz));

                    float sx = quinticSmooth(x - fx);
                    float sy = quinticSmooth(y - fy);
                    float sz = quinticSmooth(pz - fz);

                    float lx00 = mix(d000, d100, sx);
                    float lx10 = mix(d010, d110, sx);
                    float lx01 = mix(d001, d101, sx);
                    float lx11 = mix(d011, d111, sx);

                    float ly0 = mix(lx00, lx10, sy);
                    float ly1 = mix(lx01, lx11, sy);

                    return amplitude * mix(ly0, ly1, sz);
                }

                float auroraGlow(float t, vec2 shift) {
                    vec2 uv = gl_FragCoord.xy / uResolution.y;
                    uv += shift;

                    float noiseVal = 0.0;
                    float freq = uNoiseFreq;
                    float amp = uNoiseAmp;
                    vec2 samplePos = uv * uScale;

                    for (float i = 0.0; i < 3.0; i += 1.0) {
                        noiseVal += perlin3D(amp, freq, samplePos.x, samplePos.y, t);
                        amp *= uOctaveDecay;
                        freq *= 2.0;
                    }

                    float yBand = uv.y * 10.0 - uBandHeight * 10.0;
                    return 0.3 * max(exp(uBandSpread * (1.0 - 1.1 * abs(noiseVal + yBand))), 0.0);
                }

                void main() {
                    vec2 uv = gl_FragCoord.xy / uResolution.xy;
                    float t = uSpeed * 0.4 * uTime;

                    vec2 shift = vec2(0.0);
                    if (uEnableMouse) {
                        shift = (uMouse - 0.5) * uMouseInfluence;
                    }

                    vec3 col = vec3(0.0);
                    col += 0.99 * auroraGlow(t, shift) * cosineGradient(uv.x + uTime * uSpeed * 0.2 * uColorSpeed, vec3(0.5), vec3(0.5), vec3(1.0), vec3(0.3, 0.20, 0.20)) * uColor1;
                    col += 0.99 * auroraGlow(t + uLayerOffset, shift) * cosineGradient(uv.x + uTime * uSpeed * 0.1 * uColorSpeed, vec3(0.5), vec3(0.5), vec3(2.0, 1.0, 0.0), vec3(0.5, 0.20, 0.25)) * uColor2;

                    col *= uBrightness;
                    float alpha = clamp(length(col), 0.0, 1.0);
                    gl_FragColor = vec4(col, alpha);
                }
            `;

            function compileShader(type, source) {
                const shader = gl.createShader(type);
                gl.shaderSource(shader, source);
                gl.compileShader(shader);
                if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                    console.error(gl.getShaderInfoLog(shader));
                    gl.deleteShader(shader);
                    return null;
                }
                return shader;
            }

            const vertexShader = compileShader(gl.VERTEX_SHADER, vertexSrc);
            const fragmentShader = compileShader(gl.FRAGMENT_SHADER, fragmentSrc);
            if (!vertexShader || !fragmentShader) return;

            const program = gl.createProgram();
            gl.attachShader(program, vertexShader);
            gl.attachShader(program, fragmentShader);
            gl.linkProgram(program);
            if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
                console.error(gl.getProgramInfoLog(program));
                return;
            }
            gl.useProgram(program);

            const positions = new Float32Array([-1, -1, 3, -1, -1, 3]);
            const buffer = gl.createBuffer();
            gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
            gl.bufferData(gl.ARRAY_BUFFER, positions, gl.STATIC_DRAW);
            const positionLoc = gl.getAttribLocation(program, 'position');
            gl.enableVertexAttribArray(positionLoc);
            gl.vertexAttribPointer(positionLoc, 2, gl.FLOAT, false, 0, 0);

            // Brand palette — soft lavender into magenta, matching the LOX theme.
            const color1 = hexToVec3('#c4b5fd');
            const color2 = hexToVec3('#d946ef');

            const settings = {
                speed: 0.5,
                scale: 1.6,
                brightness: 0.9,
                noiseFrequency: 2.2,
                noiseAmplitude: 1.0,
                bandHeight: 0.45,
                bandSpread: 1.0,
                octaveDecay: 0.1,
                layerOffset: 1.4,
                colorSpeed: 0.8,
                mouseInfluence: 0.2,
            };

            const uniforms = {
                uTime: gl.getUniformLocation(program, 'uTime'),
                uResolution: gl.getUniformLocation(program, 'uResolution'),
                uSpeed: gl.getUniformLocation(program, 'uSpeed'),
                uScale: gl.getUniformLocation(program, 'uScale'),
                uBrightness: gl.getUniformLocation(program, 'uBrightness'),
                uColor1: gl.getUniformLocation(program, 'uColor1'),
                uColor2: gl.getUniformLocation(program, 'uColor2'),
                uNoiseFreq: gl.getUniformLocation(program, 'uNoiseFreq'),
                uNoiseAmp: gl.getUniformLocation(program, 'uNoiseAmp'),
                uBandHeight: gl.getUniformLocation(program, 'uBandHeight'),
                uBandSpread: gl.getUniformLocation(program, 'uBandSpread'),
                uOctaveDecay: gl.getUniformLocation(program, 'uOctaveDecay'),
                uLayerOffset: gl.getUniformLocation(program, 'uLayerOffset'),
                uColorSpeed: gl.getUniformLocation(program, 'uColorSpeed'),
                uMouse: gl.getUniformLocation(program, 'uMouse'),
                uMouseInfluence: gl.getUniformLocation(program, 'uMouseInfluence'),
                uEnableMouse: gl.getUniformLocation(program, 'uEnableMouse'),
            };

            gl.uniform3fv(uniforms.uColor1, color1);
            gl.uniform3fv(uniforms.uColor2, color2);
            gl.uniform1f(uniforms.uSpeed, settings.speed);
            gl.uniform1f(uniforms.uScale, settings.scale);
            gl.uniform1f(uniforms.uBrightness, settings.brightness);
            gl.uniform1f(uniforms.uNoiseFreq, settings.noiseFrequency);
            gl.uniform1f(uniforms.uNoiseAmp, settings.noiseAmplitude);
            gl.uniform1f(uniforms.uBandHeight, settings.bandHeight);
            gl.uniform1f(uniforms.uBandSpread, settings.bandSpread);
            gl.uniform1f(uniforms.uOctaveDecay, settings.octaveDecay);
            gl.uniform1f(uniforms.uLayerOffset, settings.layerOffset);
            gl.uniform1f(uniforms.uColorSpeed, settings.colorSpeed);
            gl.uniform1f(uniforms.uMouseInfluence, settings.mouseInfluence);
            gl.uniform1i(uniforms.uEnableMouse, 1);

            // Capped, low DPR and no antialiasing request — this shader is
            // cheap per-pixel but still scales with resolution, and a login
            // background doesn't need to be rendered at full retina density.
            const dpr = Math.min(window.devicePixelRatio || 1, 1.5);
            let targetMouse = [0.5, 0.5];
            let currentMouse = [0.5, 0.5];

            function resize() {
                const width = Math.floor(window.innerWidth * dpr);
                const height = Math.floor(window.innerHeight * dpr);
                canvas.width = width;
                canvas.height = height;
                gl.viewport(0, 0, width, height);
                gl.uniform3fv(uniforms.uResolution, [width, height, width / height]);
            }

            resize();
            window.addEventListener('resize', resize);

            window.addEventListener('mousemove', function (e) {
                targetMouse = [e.clientX / window.innerWidth, 1 - e.clientY / window.innerHeight];
            });

            function render(time) {
                requestAnimationFrame(render);

                gl.uniform1f(uniforms.uTime, time * 0.001);

                currentMouse[0] += 0.05 * (targetMouse[0] - currentMouse[0]);
                currentMouse[1] += 0.05 * (targetMouse[1] - currentMouse[1]);
                gl.uniform2fv(uniforms.uMouse, currentMouse);

                gl.drawArrays(gl.TRIANGLES, 0, 3);
            }

            requestAnimationFrame(render);
        })();
    </script>
</body>
</html>

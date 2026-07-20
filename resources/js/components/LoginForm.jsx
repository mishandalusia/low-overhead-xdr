import styled from 'styled-components';

const LoginForm = ({ loginUrl, csrfToken, errorMessage, oldEmail }) => {
    return (
        <StyledWrapper>
            <div className="login-wrapper">
                <div className="login-card">
                    <div className="glow-blob blob-1" />
                    <div className="glow-blob blob-2" />
                    <div className="dark-overlay" />
                    <div className="view-container">
                        <div className="form-view">
                            <div className="header">
                                <div className="decorative-dot" />
                                <div className="title">Welcome Back</div>
                                <p className="subtitle">Sign in to your LOX XDR dashboard.</p>
                            </div>

                            {errorMessage && <div className="error-message">{errorMessage}</div>}

                            <form method="POST" action={loginUrl}>
                                <input type="hidden" name="_token" value={csrfToken} />

                                <div className="input-group">
                                    <input
                                        type="email"
                                        name="email"
                                        className="input-field"
                                        placeholder="Email address"
                                        defaultValue={oldEmail || ''}
                                        required
                                        autoComplete="email"
                                    />
                                </div>
                                <div className="input-group">
                                    <input
                                        type="password"
                                        name="password"
                                        className="input-field"
                                        placeholder="Password"
                                        required
                                        autoComplete="current-password"
                                    />
                                </div>

                                <label className="remember-row">
                                    <input type="checkbox" name="remember" />
                                    <span>Keep me logged in</span>
                                </label>

                                <button type="submit" className="btn-submit">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </StyledWrapper>
    );
};

const StyledWrapper = styled.div`
  .login-wrapper,
  .login-wrapper * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
      Arial, sans-serif;
  }

  .login-wrapper {
    --blob-1-color: #ff5e00;
    --blob-2-color: #7000ff;
    --btn-hover-glow: rgba(112, 0, 255, 0.25);
    --input-focus-glow: rgba(112, 0, 255, 0.15);
    position: relative;
    animation: floatUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    opacity: 0;
    transform: translateY(30px);
  }

  @keyframes floatUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .login-card {
    position: relative;
    width: 360px;
    background-color: #0d0f14;
    border-radius: 24px;
    padding: 36px 32px;
    overflow: hidden;
    box-shadow:
      0 24px 48px rgba(0, 0, 0, 0.2),
      0 8px 16px rgba(0, 0, 0, 0.1);
    transition:
      transform 0.5s cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .login-wrapper:hover .login-card {
    transform: translateY(-6px);
    box-shadow:
      0 32px 64px rgba(0, 0, 0, 0.3),
      0 12px 24px rgba(0, 0, 0, 0.15);
  }

  .glow-blob {
    position: absolute;
    filter: blur(45px);
    border-radius: 50%;
    z-index: 0;
    opacity: 0.6;
    animation: pulseGlow 4s infinite alternate ease-in-out;
    transition:
      opacity 0.5s ease,
      filter 0.5s ease;
  }

  .login-wrapper:hover .glow-blob {
    opacity: 0.75;
    filter: blur(40px);
  }

  .blob-1 {
    top: -30px;
    right: -30px;
    width: 170px;
    height: 170px;
    background: var(--blob-1-color);
  }

  .blob-2 {
    bottom: -50px;
    left: -50px;
    width: 210px;
    height: 210px;
    background: var(--blob-2-color);
    animation-delay: -2s;
  }

  @keyframes pulseGlow {
    0% {
      transform: scale(0.9);
      opacity: 0.5;
    }
    100% {
      transform: scale(1.1);
      opacity: 0.7;
    }
  }

  .dark-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(
      circle at 50% 50%,
      rgba(5, 5, 8, 0.85) 30%,
      transparent 100%
    );
    z-index: 1;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.05);
    border-radius: inherit;
  }

  .view-container {
    position: relative;
    z-index: 10;
  }

  .form-view {
    display: flex;
    flex-direction: column;
    animation: fadeInView 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
  }

  @keyframes fadeInView {
    from {
      opacity: 0;
      transform: translateY(15px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .header {
    margin-bottom: 28px;
    text-align: center;
  }

  .decorative-dot {
    width: 2.2em;
    height: 2.2em;
    margin: 0 auto 1em auto;
    border-radius: 50%;
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .decorative-dot::after {
    content: "";
    width: 1.1em;
    height: 1.1em;
    background-image: radial-gradient(
      circle at center,
      #ffffff 40%,
      transparent 50%
    );
    background-size: 3.5px 3.5px;
    mask-image: radial-gradient(circle at center, black 100%, transparent 100%);
    -webkit-mask-image: -webkit-radial-gradient(
      circle at center,
      black 100%,
      transparent 100%
    );
  }

  .title {
    color: #ffffff;
    font-size: 22px;
    font-weight: 600;
    letter-spacing: -0.5px;
    margin-bottom: 6px;
  }

  .subtitle {
    color: rgba(255, 255, 255, 0.6);
    font-size: 13px;
    font-weight: 400;
  }

  .error-message {
    background: rgba(239, 68, 68, 0.14);
    border: 1px solid rgba(248, 113, 113, 0.35);
    color: #fecaca;
    border-radius: 12px;
    padding: 12px 14px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 18px;
    line-height: 1.5;
  }

  .input-group {
    margin-bottom: 16px;
    position: relative;
  }

  .input-field {
    width: 100%;
    padding: 1.05em 1.2em;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    color: #ffffff;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }

  .input-field::placeholder {
    color: rgba(255, 255, 255, 0.4);
  }

  .input-field:focus {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.25);
    box-shadow: 0 0 20px var(--input-focus-glow);
    transform: translateY(-2px);
  }

  .remember-row {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255, 255, 255, 0.6);
    font-size: 12px;
    margin: -6px 0 20px;
    cursor: pointer;
  }

  .remember-row input {
    accent-color: #7000ff;
  }

  .btn-submit {
    width: 100%;
    padding: 1em;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    font-size: 14.5px;
    font-weight: 500;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }

  .btn-submit:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px var(--btn-hover-glow);
  }

  .btn-submit:active {
    transform: translateY(0);
  }
`;

export default LoginForm;

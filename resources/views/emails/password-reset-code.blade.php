<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LOX Password Reset Code</title>
</head>
<body style="margin:0; padding:32px 16px; background:#f1f5f9; font-family: 'Segoe UI', sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" width="420" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:20px; overflow:hidden; box-shadow:0 12px 30px rgba(15,23,42,0.10);">
                    <tr>
                        <td style="background:linear-gradient(135deg,#8b5cf6,#d946ef); padding:24px 32px;">
                            <span style="color:#ffffff; font-size:18px; font-weight:900; letter-spacing:0.5px;">LOX Security</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px;">
                            <p style="margin:0 0 8px; color:#0f172a; font-size:15px; font-weight:700;">Password Reset Code</p>
                            <p style="margin:0 0 24px; color:#64748b; font-size:13px; line-height:1.6;">
                                Use the code below to verify your identity and set a new password for your Low-Overhead XDR account.
                            </p>

                            <div style="text-align:center; margin:0 0 24px;">
                                <span style="display:inline-block; padding:16px 32px; border-radius:16px; background:#f8f3ff; border:1px solid rgba(168,85,247,0.25); color:#7c3aed; font-size:32px; font-weight:900; letter-spacing:10px;">
                                    {{ $code }}
                                </span>
                            </div>

                            <p style="margin:0; color:#94a3b8; font-size:12px; line-height:1.6;">
                                This code expires in 10 minutes. If you didn't request a password reset, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: system-ui, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; background:#f8fafc; }
        .card { background:#fff; padding:24px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,.08); width:100%; max-width:380px; }
        .btn { display:block; width:100%; padding:12px 16px; border-radius:8px; border:1px solid #dadce0; background:#fff; color:#1f2937; text-decoration:none; text-align:center; font-weight:600; }
        .btn:hover { background:#f3f4f6; }
        .ms { display:inline-flex; align-items:center; gap:10px; }
        .ms svg { width:20px; height:20px; }
    </style>
    </head>
<body>
    <div class="card">
        <h2 style="margin-top:0;">Sign in</h2>
        <a class="btn" href="{{ route('auth.microsoft') }}">
            <span class="ms">
                <svg viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill="#f35325" d="M1 1h10v10H1z"/><path fill="#81bc06" d="M12 1h10v10H12z"/><path fill="#05a6f0" d="M1 12h10v10H1z"/><path fill="#ffba08" d="M12 12h10v10H12z"/></svg>
                Continue with Microsoft
            </span>
        </a>
    </div>
</body>
</html>

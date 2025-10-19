<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in error</title>
    <style>
        body { font-family: system-ui, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; background:#fff7ed; }
        .card { background:#fff; padding:24px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,.08); width:100%; max-width:560px; }
        code { background:#f3f4f6; padding:2px 6px; border-radius:6px; }
        a { color:#2563eb; text-decoration:none; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-top:0;color:#9a3412;">We couldn't sign you in</h2>
        <p>{{ $message ?? 'An unexpected error occurred during Microsoft sign-in.' }}</p>
        <p><a href="{{ route('login') }}">Try again</a></p>
    </div>
</body>
</html>

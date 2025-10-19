<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized</title>
    <style>
        body { font-family: system-ui, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; background:#fff1f2; }
        .card { background:#fff; padding:24px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,.08); width:100%; max-width:480px; }
        a { color:#2563eb; text-decoration:none; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-top:0;color:#b91c1c;">Access denied</h2>
        <p>You do not have permission to access this resource.</p>
        <p><a href="{{ route('login') }}">Return to login</a></p>
    </div>
</body>
</html>

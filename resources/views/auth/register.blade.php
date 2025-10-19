<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: system-ui, sans-serif; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0; background:#f8fafc; }
        .card { background:#fff; padding:24px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,.08); width:100%; max-width:420px; }
        .row { display:flex; gap:10px; }
        .field { margin-bottom:12px; }
        label { display:block; font-weight:600; margin-bottom:6px; }
        input { width:100%; padding:10px 12px; border:1px solid #dadce0; border-radius:8px; }
        .btn { display:block; width:100%; padding:12px 16px; border-radius:8px; border:1px solid #111827; background:#111827; color:#fff; text-decoration:none; text-align:center; font-weight:600; cursor:pointer; }
        .btn:hover { background:#000; }
        .muted { color:#6b7280; font-size:14px; text-align:center; }
        a { color:#2563eb; text-decoration:none; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-top:0;">Create your account</h2>
        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="field">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}" />
                @error('name')<div style="color:#b91c1c; font-size:13px;">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" />
                @error('email')<div style="color:#b91c1c; font-size:13px;">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="field" style="flex:1;">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required />
                    @error('password')<div style="color:#b91c1c; font-size:13px;">{{ $message }}</div>@enderror
                </div>
                <div class="field" style="flex:1;">
                    <label for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
                </div>
            </div>
            <button class="btn" type="submit">Register</button>
        </form>
        <p class="muted">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        <div style="height:10px"></div>
        <a class="btn" style="background:#fff; color:#1f2937; border-color:#dadce0;" href="{{ route('auth.microsoft') }}">
            Continue with Microsoft
        </a>
        <div style="height:8px"></div>
        <a class="btn" style="background:#fff; color:#1f2937; border-color:#dadce0;" href="{{ route('auth.azuread') }}">
            Continue with Azure Active Directory
        </a>
    </div>
</body>
</html>

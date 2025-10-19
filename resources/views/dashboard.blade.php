<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: system-ui, sans-serif; background:#f8fafc; margin:0; }
        header { display:flex; align-items:center; justify-content:space-between; padding:16px 20px; background:#ffffff; border-bottom:1px solid #e5e7eb; }
        .container { max-width:960px; margin:24px auto; padding:0 16px; }
        .card { background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:20px; box-shadow:0 10px 25px rgba(0,0,0,.05); }
        .row { display:flex; align-items:center; gap:16px; }
        .avatar { width:64px; height:64px; border-radius:50%; object-fit:cover; background:#e5e7eb; }
        .btn { display:inline-block; padding:10px 14px; border-radius:8px; border:1px solid #d1d5db; background:#fff; text-decoration:none; color:#111827; font-weight:600; }
        .btn:hover { background:#f3f4f6; }
        form { display:inline; }
    </style>
</head>
<body>
    <header>
        <div>Welcome, {{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn">Log out</button>
        </form>
    </header>
    <div class="container">
        <div class="card">
            <div class="row">
                @if(auth()->user()->avatar)
                    <img class="avatar" src="{{ auth()->user()->avatar }}" alt="Avatar" />
                @else
                    <div class="avatar"></div>
                @endif
                <div>
                    <div style="font-size:18px; font-weight:700;">{{ auth()->user()->name }}</div>
                    <div style="color:#4b5563;">{{ auth()->user()->email }}</div>
                    @if(auth()->user()->azure_id)
                        <div style="color:#6b7280; font-size:13px;">Azure ID: {{ auth()->user()->azure_id }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin login | {{ config('school.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600&family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="min-height:100vh;display:grid;place-items:center;background:#0b1540;">
    <div class="enquiry-card" style="width:min(420px,92vw)">
        <h3>Staff login</h3>
        <p>Admin panel for News & Events and admission enquiries.</p>
        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <div class="mb-3">
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror
            </div>
            <label class="mb-3"><input type="checkbox" name="remember" value="1"> Remember me</label>
            <button class="btn-main w-100" type="submit">Sign in</button>
        </form>
    </div>
</body>
</html>

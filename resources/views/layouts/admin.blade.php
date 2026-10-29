<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | {{ config('school.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="admin-shell">
    <header class="admin-top">
        <div class="container nav-row">
            <a class="brand" href="{{ route('admin.news-events.index') }}" style="color:#fff">
                <span class="brand-mark">M</span>
                <span>Manthan Admin</span>
            </a>
            <nav class="nav-links" style="color:#fff">
                <a href="{{ route('admin.news-events.index') }}">News & Events</a>
                <a href="{{ route('admin.enquiries.index') }}">Enquiries</a>
                <a href="{{ route('home') }}" target="_blank">View site</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-warning" type="submit">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('school.name').' · Noida')</title>
    <meta name="description" content="@yield('meta_description', 'A childhood filled with wonder, discovery and possibility at The Manthan School, Noida.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="utility-bar">
            <div class="container-site utility-bar-inner">
                <div class="campus-switcher" aria-label="Campus locations">
                    <span class="campus-option">Greater Noida West</span>
                    <span class="campus-option active">{{ config('school.campus') }}</span>
                </div>
                <div class="utility-actions">
                    <a class="utility-phone" href="tel:{{ preg_replace('/[^0-9+]/', '', config('school.phone')) }}">
                        Front office · {{ config('school.phone') }}
                    </a>
                    <span class="utility-link">Pay fees</span>
                    <span class="utility-link">Careers</span>
                    <div class="utility-social" aria-hidden="true">
                        <span>f</span>
                        <span class="instagram-icon">◎</span>
                        <svg viewBox="0 0 16 16" focusable="false">
                            <path d="M6.5 4.5 11 8l-4.5 3.5z" fill="currentColor"></path>
                            <rect x="1" y="2" width="14" height="12" rx="3" fill="none" stroke="currentColor" stroke-width="1.5"></rect>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-site nav-row">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">M</span>
                <span>The Manthan School<small>Noida campus</small></span>
            </a>
            <button class="nav-toggle" type="button" aria-label="Menu" id="navToggle">☰</button>
            <nav class="nav-links" id="navLinks">
                <a href="{{ route('home') }}#about">About</a>
                <a href="{{ route('home') }}#programmes">Programmes</a>
                <a href="{{ route('news-events.index') }}">News & Events</a>
                <a href="{{ route('home') }}#campus">Campus</a>
                <a class="btn-enquire" href="{{ route('home') }}#enquire">Enquire now</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-art" aria-hidden="true">
            {{-- <span class="footer-art-mark">@</span> --}}
        </div>
        <div class="container-site footer-grid">
            <div class="footer-identity">
                <a class="footer-brand" href="{{ route('home') }}">
                    <span class="footer-brand-mark">M</span>
                    <span>{{ config('school.name') }}<small>{{ config('school.campus') }} Campus</small></span>
                </a>
                <p class="footer-tagline">A little world of big beginnings. Learning through wonder, discovery and belonging.</p>
            </div>
            <div class="footer-links">
                <h5>Learning</h5>
                <a href="{{ route('home') }}#programmes">Programmes</a>
                <a href="{{ route('home') }}#about">Our approach</a>
                <a href="{{ route('home') }}#campus">Campus</a>
                <a href="{{ route('news-events.index') }}">News &amp; events</a>
            </div>
            <div class="footer-links">
                <h5>Admissions</h5>
                <a href="{{ route('home') }}#enquire">Admission enquiry</a>
                <a href="{{ route('home') }}#enquire">Book a campus visit</a>
                <a href="{{ route('home') }}#programmes">Classes</a>
                <a href="{{ route('admin.login') }}">Staff login</a>
            </div>
            <div class="footer-contact">
                <h5>Get in touch</h5>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('school.phone')) }}">{{ config('school.phone') }}</a>
                <a href="mailto:{{ config('school.admissions_email') }}">{{ config('school.admissions_email') }}</a>
                <p>{{ config('school.address') }}</p>
                <a class="footer-visit-button" href="{{ route('home') }}#enquire">Book a campus visit</a>
            </div>
        </div>
        <div class="container-site copy">© {{ date('Y') }} {{ config('school.name') }}. All rights reserved.</div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteName)</title>

    @vite(['resources/js/app.js'])

    <style>
        :root {

            /* =========================
               Custom Theme Variables
            ========================== */

            --mt-primary: {{ $theme['primary'] }};
            --mt-secondary: {{ $theme['secondary'] }};
            --mt-body: {{ $theme['body'] }};
            --mt-heading: {{ $theme['heading'] }};

            --mt-font-base: {{ $theme['font_base'] }};
            --mt-font-heading: {{ $theme['font_heading'] }};
            --mt-font-size: {{ $theme['font_size_px'] }}px;

            /* =========================
               Bootstrap Overrides
            ========================== */

            --bs-primary: {{ $theme['primary'] }};
            --bs-secondary: {{ $theme['secondary'] }};

            --bs-body-color: {{ $theme['body'] }};
            --bs-body-font-family: {{ $theme['font_base'] }};

            --bs-link-color: {{ $theme['primary'] }};
            --bs-link-hover-color: color-mix(in srgb, {{ $theme['primary'] }} 80%, black);

            --bs-border-color: color-mix(in srgb, {{ $theme['primary'] }} 15%, #dee2e6);
        }

        /* =========================
           Global Styling
        ========================== */

        body.public-site {
            font-family: var(--mt-font-base);
            color: var(--mt-body);
            font-size: var(--mt-font-size);
            background-color: #ffffff;
        }

        .public-site h1,
        .public-site h2,
        .public-site h3,
        .public-site h4,
        .public-site h5,
        .public-site h6 {
            font-family: var(--mt-font-heading);
            color: var(--mt-heading);
        }

        .public-site a {
            transition: 0.2s ease;
        }

        /* =========================
           Utility Theme Classes
        ========================== */

        .text-brand {
            color: var(--mt-primary) !important;
        }

        .bg-brand {
            background-color: var(--mt-primary) !important;
        }

        .border-brand {
            border-color: var(--mt-primary) !important;
        }

        /* =========================
           Buttons
        ========================== */

        .btn-brand {
            --bs-btn-color: #fff;
            --bs-btn-bg: var(--mt-primary);
            --bs-btn-border-color: var(--mt-primary);

            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: color-mix(in srgb, var(--mt-primary) 88%, black);
            --bs-btn-hover-border-color: color-mix(in srgb, var(--mt-primary) 88%, black);

            --bs-btn-focus-shadow-rgb: 49,132,253;

            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: color-mix(in srgb, var(--mt-primary) 80%, black);
            --bs-btn-active-border-color: color-mix(in srgb, var(--mt-primary) 80%, black);
        }

        /* =========================
           Navbar
        ========================== */

        .site-navbar {
            background-color: #ffffff;
            backdrop-filter: blur(10px);
        }

        .site-navbar .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .site-navbar .nav-link {
            color: var(--mt-body);
            font-weight: 500;
            transition: 0.2s ease;
        }

        .site-navbar .nav-link:hover {
            color: var(--mt-primary);
        }

        .site-navbar .nav-link.active {
            color: var(--mt-primary);
        }

        /* =========================
           Top Bar
        ========================== */

        .top-strip {
            background-color: var(--mt-primary);
        }

        .navbar-brand-site {
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        /* =========================
           Footer
        ========================== */

        .site-footer {
            background-color: color-mix(
                in srgb,
                var(--mt-heading) 92%,
                black
            );
        }

        .site-footer a {
            transition: 0.2s ease;
        }

        .site-footer a:hover {
            opacity: 0.85;
        }

        /* =========================
           Bootstrap Overrides
        ========================== */

        .btn-primary {
            --bs-btn-bg: var(--mt-primary);
            --bs-btn-border-color: var(--mt-primary);

            --bs-btn-hover-bg: color-mix(in srgb, var(--mt-primary) 88%, black);
            --bs-btn-hover-border-color: color-mix(in srgb, var(--mt-primary) 88%, black);
        }

        .text-primary {
            color: var(--mt-primary) !important;
        }

        .bg-primary {
            background-color: var(--mt-primary) !important;
        }

        /* =========================
           Smoothness
        ========================== */

        * {
            scroll-behavior: smooth;
        }
    </style>

    @stack('head')
</head>

<body class="public-site d-flex flex-column min-vh-100">

    {{-- Top strip --}}
    <div class="top-strip text-white py-2 small">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">

            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-leaf" aria-hidden="true"></i>

                <span class="navbar-brand-site">
                    {{ $siteName }}
                </span>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-3">

                @if($siteAddress && $googleMapsUrl)
                    <a
                        class="link-light link-underline-opacity-75 link-underline-opacity-100-hover d-inline-flex align-items-center gap-1 text-decoration-none"
                        href="{{ $googleMapsUrl }}"
                        target="_blank"
                        rel="noopener"
                    >
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span>{{ $siteAddress }}</span>
                    </a>

                @elseif($siteAddress)
                    <span class="d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span>{{ $siteAddress }}</span>
                    </span>

                @elseif($googleMapsUrl)
                    <a
                        class="link-light link-underline-opacity-75 link-underline-opacity-100-hover d-inline-flex align-items-center gap-1 text-decoration-none"
                        href="{{ $googleMapsUrl }}"
                        target="_blank"
                        rel="noopener"
                    >
                        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
                        <span>{{ __('Maps') }}</span>
                    </a>
                @endif

                @if($sitePhone)
                    <a
                        class="link-light link-underline-opacity-75 link-underline-opacity-100-hover d-inline-flex align-items-center gap-1 text-decoration-none"
                        href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}"
                    >
                        <i class="fa-solid fa-phone me-1" aria-hidden="true"></i>
                        {{ $sitePhone }}
                    </a>
                @endif

                @if($siteEmail)
                    <a
                        class="link-light link-underline-opacity-75 link-underline-opacity-100-hover d-inline-flex align-items-center gap-1 text-decoration-none"
                        href="mailto:{{ $siteEmail }}"
                    >
                        <i class="fa-solid fa-envelope me-1" aria-hidden="true"></i>
                        {{ $siteEmail }}
                    </a>
                @endif

            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg border-bottom shadow-sm sticky-top site-navbar">

        <div class="container">

            <a class="navbar-brand text-brand" href="{{ route('home') }}">
                {{ $siteName }}
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav"
                aria-controls="mainNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-lg-1">

                    <li class="nav-item">
                        <a
                            class="nav-link @if(request()->routeIs('home')) active fw-semibold @endif"
                            href="{{ route('home') }}"
                        >
                            {{ __('Home') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link @if(request()->routeIs('gallery.index')) active fw-semibold @endif"
                            href="{{ route('gallery.index') }}"
                        >
                            {{ __('Gallery') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link @if(request()->routeIs('posts.index') || request()->routeIs('posts.show')) active fw-semibold @endif"
                            href="{{ route('posts.index') }}"
                        >
                            {{ __('News') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link @if(request()->routeIs('contact.create')) active fw-semibold @endif"
                            href="{{ route('contact.create') }}"
                        >
                            {{ __('Contact') }}
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-gauge-high me-1" aria-hidden="true"></i>
                                {{ __('Admin') }}
                            </a>
                        </li>
                    @endauth

                </ul>

            </div>

        </div>

    </nav>

    {{-- Main Content --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="site-footer text-white pt-5 pb-3 mt-5">

        <div class="container">

            <div class="row g-4">

                <div class="col-md-4">

                    <h2 class="h5 text-white">
                        {{ $siteName }}
                    </h2>

                    @if($contentBlocks->has(\App\Support\ContentSlugs::FOOTER_TAGLINE))
                        <div class="opacity-90">
                            {!! $contentBlocks[\App\Support\ContentSlugs::FOOTER_TAGLINE]->body_html !!}
                        </div>
                    @endif

                </div>

                <div class="col-md-4">

                    <h3 class="h6 text-uppercase text-white-50">
                        {{ __('Explore') }}
                    </h3>

                    <ul class="list-unstyled mb-0">

                        <li>
                            <a class="link-light link-underline-opacity-0" href="{{ route('home') }}">
                                {{ __('Home') }}
                            </a>
                        </li>

                        <li>
                            <a class="link-light link-underline-opacity-0" href="{{ route('gallery.index') }}">
                                {{ __('Gallery') }}
                            </a>
                        </li>

                        <li>
                            <a class="link-light link-underline-opacity-0" href="{{ route('posts.index') }}">
                                {{ __('News') }}
                            </a>
                        </li>

                        <li>
                            <a class="link-light link-underline-opacity-0" href="{{ route('contact.create') }}">
                                {{ __('Contact') }}
                            </a>
                        </li>

                    </ul>

                </div>

                <div class="col-md-4">

                    <h3 class="h6 text-uppercase text-white-50">
                        {{ __('Follow') }}
                    </h3>

                    <div class="d-flex flex-wrap gap-2">

                        @foreach($socialLinks as $link)

                            <a
                                class="btn btn-outline-light btn-sm rounded-pill"
                                href="{{ $link->url }}"
                                target="_blank"
                                rel="noopener"
                                title="{{ $link->label }}"
                            >
                                <i class="{{ $link->icon_class }}" aria-hidden="true"></i>

                                <span class="visually-hidden">
                                    {{ $link->label }}
                                </span>
                            </a>

                        @endforeach

                    </div>

                </div>

            </div>

            @if($contentBlocks->has(\App\Support\ContentSlugs::FOOTER_NOTE))

                <div class="border-top border-secondary mt-4 pt-3 text-white-50 small">
                    {!! $contentBlocks[\App\Support\ContentSlugs::FOOTER_NOTE]->body_html !!}
                </div>

            @endif

        </div>

    </footer>

    @stack('scripts')

</body>
</html>

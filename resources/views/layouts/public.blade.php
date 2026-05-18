<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $siteName)</title>
    <meta name="description" content="@yield('meta_description', $siteDescription)">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $siteName)">
    <meta property="og:description" content="@yield('og_description', $siteDescription)">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($logoPath)
        <meta property="og:image" content="{{ \App\Support\Media::url($logoPath) }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="{{ $logoPath ? \App\Support\Media::url($logoPath) : asset('favicon.ico') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ $logoPath ? \App\Support\Media::url($logoPath) : asset('favicon.ico') }}">

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
            --mt-social-icon: {{ $theme['social_icon'] }};

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

        /* Comprehensive Responsive & Animation Styling */

        * {
            scroll-behavior: smooth;
        }

        html, body {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Typography Enhancements */
        h1, h2, h3, h4, h5, h6 {
            letter-spacing: -0.01em;
            font-weight: 700;
        }

        p {
            line-height: 1.7;
        }

        .text-brand {
            color: var(--mt-primary) !important;
            font-weight: 700;
        }

        /* Navigation Styling */
        .site-navbar {
            background: linear-gradient(135deg, rgba(255,255,255,0.98), rgba(255,255,255,0.95));
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-navbar .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .site-navbar .navbar-brand:hover {
            transform: translateX(2px);
        }

        .site-navbar .nav-link {
            color: var(--mt-body);
            font-weight: 500;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0.5rem 1rem !important;
            border-radius: 0.375rem;
        }

        .site-navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            width: 0;
            height: 2px;
            background-color: var(--mt-primary);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-navbar .nav-link:hover {
            color: var(--mt-primary);
            background-color: rgba(45, 106, 79, 0.08);
        }

        .site-navbar .nav-link:hover::after {
            width: calc(100% - 2rem);
        }

        .site-navbar .nav-link.active {
            color: var(--mt-primary);
            background-color: rgba(45, 106, 79, 0.1);
        }

        .site-navbar .nav-link.active::after {
            width: calc(100% - 2rem);
        }

        /* Top Bar */
        .top-strip {
            background: linear-gradient(135deg, var(--mt-primary) 0%, color-mix(in srgb, var(--mt-primary) 85%, black) 100%);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .top-strip a {
            transition: all 0.3s ease;
        }

        .navbar-brand-site {
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        /* Footer */
        .site-footer {
            background: linear-gradient(135deg, color-mix(in srgb, var(--mt-heading) 92%, black) 0%, color-mix(in srgb, var(--mt-heading) 85%, black) 100%);
            margin-top: auto;
            box-shadow: 0 -4px 12px rgba(0,0,0,0.08);
        }

        .site-footer a {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-footer a:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .site-footer-section h5 {
            position: relative;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .site-footer-section h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--mt-primary);
            border-radius: 2px;
        }

        /* Button Styling */
        .btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0.5rem;
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }

        .btn-primary {
            --bs-btn-bg: var(--mt-primary);
            --bs-btn-border-color: var(--mt-primary);
            --bs-btn-hover-bg: color-mix(in srgb, var(--mt-primary) 88%, black);
            --bs-btn-hover-border-color: color-mix(in srgb, var(--mt-primary) 88%, black);
            box-shadow: 0 4px 12px rgba(45, 106, 79, 0.2);
        }

        .btn-outline-primary {
            border-width: 2px;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(45, 106, 79, 0.15);
        }

        .btn-social {
            color: var(--mt-social-icon) !important;
            border-color: var(--mt-social-icon) !important;
            border-width: 2px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 1.1rem;
        }

        .btn-social:hover,
        .btn-social:focus {
            color: #fff !important;
            background-color: var(--mt-social-icon) !important;
            border-color: var(--mt-social-icon) !important;
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }

        /* Cards */
        .card {
            border: 0;
            border-radius: 0.75rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .card:hover {
            box-shadow: 0 16px 32px rgba(0,0,0,0.12);
        }

        .card-img-top {
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0.875rem;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        }

        /* Hero Carousel */
        .hero-carousel .carousel-item {
            transition: opacity 0.6s ease-in-out;
            position: relative;
        }

        .hero-carousel .carousel-item img {
            height: 100%;
            object-fit: cover;
            animation: zoomIn 0.8s ease-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(1.1);
                opacity: 0.8;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .hero-carousel .carousel-caption {
            backdrop-filter: blur(10px);
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%);
            border-top: 2px solid rgba(255,255,255,0.2);
            padding: 2.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .hero-carousel .carousel-caption h2,
        .hero-carousel .carousel-caption p {
            text-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.01em;
        }

        .carousel-control-prev,
        .carousel-control-next {
            transition: all 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            transform: scale(1.1);
        }

        /* Animations */
        .reveal-up {
            opacity: 0;
            transform: translateY(30px);
            animation: revealUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes revealUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .slide-in-left {
            animation: slideInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .slide-in-right {
            animation: slideInRight 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        /* Object Fit */
        .object-fit-cover {
            object-fit: cover;
        }

        .object-fit-contain {
            object-fit: contain;
        }

        /* Color & Theme */
        .text-primary {
            color: var(--mt-primary) !important;
        }

        .bg-primary {
            background-color: var(--mt-primary) !important;
        }

        .text-brand {
            color: var(--mt-primary);
        }

        /* Mobile Responsive Adjustments */
        @media (max-width: 991px) {
            .site-navbar .navbar-brand {
                font-size: 1.25rem;
            }

            .site-navbar .nav-link {
                padding: 0.375rem 0.75rem !important;
                font-size: 0.95rem;
            }

            .site-navbar .nav-link::after {
                height: 1px;
            }

            .top-strip {
                font-size: 0.875rem;
            }

            .container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            .hero-carousel .carousel-caption {
                padding: 1.5rem;
                font-size: 0.9rem;
            }

            .hero-carousel .carousel-caption h2 {
                font-size: 1.5rem;
                margin-bottom: 0.5rem;
            }

            .service-card:hover {
                transform: translateY(-4px);
            }

            .card:hover {
                box-shadow: 0 12px 24px rgba(0,0,0,0.1);
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .reveal-up {
                animation: revealUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
            }

            h1 {
                font-size: 1.75rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 576px) {
            .site-navbar .navbar-brand {
                font-size: 1.125rem;
            }

            .container {
                padding: 0 0.75rem;
            }

            .top-strip {
                padding: 0.5rem 0 !important;
                flex-direction: column;
                text-align: center;
                gap: 0.5rem !important;
            }

            .top-strip .d-flex {
                flex-direction: column !important;
                width: 100%;
            }

            .btn-social {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
            }

            .reveal-up {
                transform: translateY(20px);
            }

            section {
                padding: 2rem 0 !important;
            }

            .col-md-6,
            .col-md-4,
            .col-lg-4 {
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .display-6 {
                font-size: 2rem;
            }
        }

        /* Focus & Accessibility */
        a:focus,
        button:focus,
        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid var(--mt-primary);
            outline-offset: 2px;
        }

        /* Loading State */
        .btn:disabled,
        .btn[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        /* =========================================
        SERVICE FULLSCREEN LAYOUT
        ========================================= */

        .service-section {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
        }

        .service-card {
            width: 100%;
            min-height: calc(100vh - 140px);
            border-radius: 1.25rem;
            overflow: hidden;
        }

        /* Left image area */
        .service-card .col-lg-5 {
            min-height: calc(100vh - 140px);
        }

        /* Image behavior */
        .service-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Right content area */
        .service-card .col-lg-7 {
            max-height: calc(100vh - 140px);
            overflow-y: auto;
        }

        /* Smooth internal scroll */
        .service-card .col-lg-7::-webkit-scrollbar {
            width: 6px;
        }

        .service-card .col-lg-7::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.2);
            border-radius: 20px;
        }

        /* Mobile behavior */
        @media (max-width: 991px) {

            .service-section {
                min-height: auto;
                display: block;
            }

            .service-card {
                min-height: auto;
            }

            .service-card .col-lg-5 {
                min-height: 280px;
            }

            .service-card .col-lg-7 {
                max-height: unset;
                overflow: visible;
            }
        }

        /* =========================================
        HERO CAROUSEL IMPROVED IMAGE HANDLING
        ========================================= */

        .hero-carousel .carousel-item {
            height: 560px;
            position: relative;
            overflow: hidden;
        }

        .hero-slide-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Blurred background */
        .hero-slide-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            filter: blur(18px);
            transform: scale(1.1);
            opacity: 0.55;
        }

        /* Actual image */
        .hero-slide-image {
            position: relative;
            z-index: 2;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Optional dark overlay */
        .hero-carousel .carousel-item::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(0,0,0,0.45),
                rgba(0,0,0,0.15)
            );
            z-index: 1;
        }

        /* Caption above everything */
        .hero-carousel .carousel-caption {
            z-index: 3;
        }

        /* Mobile */
        @media (max-width: 768px) {

            .hero-carousel .carousel-item {
                height: 420px;
            }

            .hero-slide-image {
                object-fit: contain;
            }
        }
        .cms-content {
            font-size: 1rem;
            line-height: 1.8;
        }

        .cms-content p:last-child {
            margin-bottom: 0;
        }

    </style>

    @stack('head')
</head>

<body class="public-site d-flex flex-column min-vh-100">

    {{-- Top strip --}}
    <div class="top-strip text-white py-2 small">
        <div class="container d-flex flex-wrap align-items-center justify-content-between gap-2">

            <div class="d-flex align-items-center gap-2">
                    @if($logoPath)
                        <img src="{{ \App\Support\Media::url($logoPath) }}" alt="{{ $siteName }}" class="d-block rounded" style="max-height: 40px; width: auto;">
                    @else
                        <i class="fa-solid fa-leaf" aria-hidden="true"></i>
                    @endif
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

            <a class="navbar-brand text-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                @if($logoPath)
                    <img src="{{ \App\Support\Media::url($logoPath) }}" alt="{{ $siteName }}" class="d-block rounded" style="max-height: 36px; width: auto;">
                @endif
                <span>{{ $siteName }}</span>
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
                            class="nav-link @if(request()->routeIs('services.index')) active fw-semibold @endif"
                            href="{{ route('services.index') }}"
                        >
                            {{ __('Services') }}
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
                                class="btn btn-outline-light btn-sm rounded-pill btn-social"
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

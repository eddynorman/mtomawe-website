<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Admin')) — {{ config('app.name') }}</title>
    @vite(['resources/js/admin.js'])
    @if($logoPath)
        <meta property="og:image" content="{{ \App\Support\Media::url($logoPath) }}">
    @endif
    <link rel="icon" href="{{ $logoPath ? \App\Support\Media::url($logoPath) : asset('favicon.ico') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ $logoPath ? \App\Support\Media::url($logoPath) : asset('favicon.ico') }}">
    @stack('head')
</head>
<body class="bg-body-tertiary">
    <div class="d-flex min-vh-100">
        <aside class="border-end bg-white shadow-sm" style="width: 260px; min-width: 260px;">
            <div class="p-3 border-bottom">
                <a class="text-decoration-none text-success fw-bold" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-seedling me-1" aria-hidden="true"></i>{{ $adminSiteName }}
                </a>
                <div class="small text-body-secondary mt-1">{{ __('Content manager') }}</div>
            </div>
            <nav class="nav flex-column p-2 small">
                <a class="nav-link rounded @if(request()->routeIs('admin.dashboard')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-gauge-high fa-fw me-2" aria-hidden="true"></i>{{ __('Dashboard') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.settings.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.settings.edit') }}">
                    <i class="fa-solid fa-palette fa-fw me-2" aria-hidden="true"></i>{{ __('Look & feel') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.content-blocks.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.content-blocks.index') }}">
                    <i class="fa-solid fa-align-left fa-fw me-2" aria-hidden="true"></i>{{ __('Page text') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.carousel-slides.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.carousel-slides.index') }}">
                    <i class="fa-solid fa-images fa-fw me-2" aria-hidden="true"></i>{{ __('Carousel') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.gallery-categories.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.gallery-categories.index') }}">
                    <i class="fa-solid fa-folder-tree fa-fw me-2" aria-hidden="true"></i>{{ __('Gallery categories') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.gallery-images.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.gallery-images.index') }}">
                    <i class="fa-solid fa-camera fa-fw me-2" aria-hidden="true"></i>{{ __('Gallery images') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.posts.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.posts.index') }}">
                    <i class="fa-solid fa-bullhorn fa-fw me-2" aria-hidden="true"></i>{{ __('Posts') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.services.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.services.index') }}">
                    <i class="fa-solid fa-briefcase fa-fw me-2" aria-hidden="true"></i>{{ __('Services') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.contact-messages.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.contact-messages.index') }}">
                    <i class="fa-solid fa-inbox fa-fw me-2" aria-hidden="true"></i>{{ __('Messages') }}
                    @if($unreadContactCount > 0)
                        <span class="badge text-bg-danger ms-1">{{ $unreadContactCount }}</span>
                    @endif
                </a>
                <a class="nav-link rounded @if(request()->routeIs('admin.social-links.*')) active bg-success-subtle fw-semibold @endif" href="{{ route('admin.social-links.index') }}">
                    <i class="fa-solid fa-share-nodes fa-fw me-2" aria-hidden="true"></i>{{ __('Social links') }}
                </a>
                <hr class="my-2">
                <a class="nav-link rounded" href="{{ route('home') }}" target="_blank" rel="noopener">
                    <i class="fa-solid fa-arrow-up-right-from-square fa-fw me-2" aria-hidden="true"></i>{{ __('View website') }}
                </a>
                <a class="nav-link rounded @if(request()->routeIs('profile.edit')) active @endif" href="{{ route('profile.edit') }}">
                    <i class="fa-solid fa-user-gear fa-fw me-2" aria-hidden="true"></i>{{ __('Account') }}
                </a>
                <form method="post" action="{{ route('logout') }}" class="px-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm w-100 mt-2">{{ __('Log out') }}</button>
                </form>
            </nav>
        </aside>
        <div class="flex-grow-1 d-flex flex-column min-vw-0">
            <header class="bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <h1 class="h5 mb-0 text-body">@yield('heading')</h1>
                <span class="text-body-secondary small">{{ auth()->user()->name }}</span>
            </header>
            <main class="p-4 flex-grow-1">
                @include('admin.partials.flash')
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>

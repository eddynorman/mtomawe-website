<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} — {{ __('Authentication') }}</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light d-flex flex-column min-vh-100 justify-content-center py-4">
    <div class="container" style="max-width: 440px;">
        <div class="text-center mb-4">
            <a href="{{ route('home') }}" class="text-success text-decoration-none fw-bold fs-4">
                <i class="fa-solid fa-seedling me-2" aria-hidden="true"></i>{{ config('app.name') }}
            </a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>

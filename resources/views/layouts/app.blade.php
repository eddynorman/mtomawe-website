<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light min-vh-100">
    @include('layouts.navigation')
    @isset($header)
        <header class="bg-white border-bottom py-3 mb-4">
            <div class="container">
                {{ $header }}
            </div>
        </header>
    @endisset
    <main class="container pb-5">
        {{ $slot }}
    </main>
    @stack('scripts')
</body>
</html>

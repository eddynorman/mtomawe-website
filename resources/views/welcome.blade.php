<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            {{-- Lets the page render before the first Vite build; prefer `npm run dev` or `npm run build` for production. --}}
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
        @endif
    </head>
    <body class="bg-light d-flex flex-column min-vh-100">
        {{-- Top bar: optional auth links when Breeze / auth routes exist --}}
        @if (Route::has('login'))
            <div class="border-bottom bg-white py-2">
                <div class="container d-flex justify-content-end gap-2 small">
                    @auth
                        <a class="btn btn-sm btn-outline-primary" href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        @endif

        <main class="flex-grow-1 d-flex align-items-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 overflow-hidden">
                            <div class="row g-0">
                                <div class="col-md-5 bg-primary text-white p-4 d-flex flex-column justify-content-center">
                                    <h1 class="h3 fw-semibold mb-3">{{ config('app.name') }}</h1>
                                    <p class="mb-0 small opacity-75">
                                        Laravel + Bootstrap 5. Replace this welcome view with your public site layout.
                                    </p>
                                </div>
                                <div class="col-md-7 p-4 p-md-5">
                                    <h2 class="h4 text-primary mb-3">Let’s get started</h2>
                                    <p class="text-body-secondary mb-4">
                                        Run migrations, seed your database, then build your pages using Bootstrap utility and component classes.
                                    </p>
                                    <ul class="list-unstyled mb-4">
                                        <li class="d-flex gap-2 mb-2">
                                            <span class="text-primary fw-bold">→</span>
                                            <span>
                                                Read the
                                                <a href="https://laravel.com/docs" target="_blank" rel="noopener" class="link-primary fw-medium">documentation</a>
                                            </span>
                                        </li>
                                        <li class="d-flex gap-2 mb-2">
                                            <span class="text-primary fw-bold">→</span>
                                            <span>
                                                Watch tutorials at
                                                <a href="https://laracasts.com" target="_blank" rel="noopener" class="link-primary fw-medium">Laracasts</a>
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="https://cloud.laravel.com" target="_blank" rel="noopener" class="btn btn-dark">Deploy now</a>
                                        <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank" rel="noopener" class="btn btn-outline-secondary">Bootstrap docs</a>
                                    </div>
                                    <p class="small text-body-secondary mt-4 mb-0">
                                        Laravel v{{ app()->version() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-top bg-white py-3 mt-auto">
            <div class="container text-center small text-body-secondary">
                Built with Laravel and Bootstrap 5.
            </div>
        </footer>
    </body>
</html>

<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand text-success fw-semibold" href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#authNav" aria-controls="authNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="authNav">
            <ul class="navbar-nav ms-auto align-items-md-center gap-md-2">
                <li class="nav-item"><span class="nav-link disabled small text-body-secondary">{{ Auth::user()->name }}</span></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('Admin') }}</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">{{ __('Log out') }}</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

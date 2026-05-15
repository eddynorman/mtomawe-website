@extends('layouts.public')

@section('title', $siteName.' — '.__('Contact'))

@section('content')
    <div class="bg-light border-bottom py-5">
        <div class="container">
            <h1 class="display-6 text-brand">{{ __('Contact us') }}</h1>
            <p class="lead text-body-secondary mb-0">{{ __('We would love to hear from you. Messages are delivered straight to our team inbox.') }}</p>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 text-brand">{{ __('Visit') }}</h2>
                        @if($siteAddress)
                            <p class="mb-3"><i class="fa-solid fa-location-dot me-2 text-brand" aria-hidden="true"></i>{{ $siteAddress }}</p>
                        @endif
                        <a class="btn btn-brand mb-3" href="{{ $googleMapsUrl }}" target="_blank" rel="noopener">
                            <i class="fa-solid fa-map-location-dot me-2" aria-hidden="true"></i>{{ __('Open in Google Maps') }}
                        </a>
                        @if($sitePhone)
                            <p class="mb-1"><i class="fa-solid fa-phone me-2 text-brand" aria-hidden="true"></i><a href="tel:{{ preg_replace('/\s+/', '', $sitePhone) }}">{{ $sitePhone }}</a></p>
                        @endif
                        @if($siteEmail)
                            <p class="mb-0"><i class="fa-solid fa-envelope me-2 text-brand" aria-hidden="true"></i><a href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <form method="post" action="{{ route('contact.store') }}" class="card border-0 shadow-sm">
                    @csrf
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">{{ __('Message') }}</label>
                                <textarea id="message" name="message" rows="5" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-brand btn-lg">{{ __('Send message') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

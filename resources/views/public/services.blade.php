@extends('layouts.public')

@section('title', $siteName.' — '.__('Services'))
@section('meta_description', __('Explore our professional zoo services, each supported by rich visuals and a strong focus on quality and visitor experience.'))

@section('content')
    <section class="py-5 py-md-6">
        <div class="container">
            <div class="row align-items-end mb-5 mb-md-6">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h1 class="display-5 text-brand mb-3 fw-bold slide-in-left">{{ __('Services') }}</h1>
                    <p class="text-body-secondary lead slide-in-left" style="animation-delay: 0.1s;">{{ __('Discover our full range of professional services designed to enhance every visit and support your zoo experience.') }}</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="btn btn-primary btn-lg" href="{{ route('contact.create') }}">
                        <i class="fa-solid fa-envelope me-2" aria-hidden="true"></i>{{ __('Get in touch') }}
                    </a>
                </div>
            </div>

            <div class="row g-4 g-lg-5">
                @forelse($services as $index => $service)
                    <div class="col-12 service-section" style="animation-delay: {{ $index * 0.05 }}s;">
                        <article class="card border-0 shadow-sm overflow-hidden reveal-up service-card">
                            <div class="row g-0 align-items-stretch">
                                <div class="col-lg-5 position-relative overflow-hidden" style="min-height: 300px;">
                                    @if($service->images->isNotEmpty())
                                        <div id="serviceCarousel{{ $service->id }}" class="carousel slide h-100" data-bs-ride="carousel">
                                            <div class="carousel-inner h-100">
                                                @foreach($service->images as $imgIdx => $image)
                                                    <div class="carousel-item @if($imgIdx === 0) active @endif h-100">
                                                        <img
                                                            src="{{ \App\Support\Media::url($image->image_path) }}"
                                                            class="d-block w-100 h-100 object-fit-cover"
                                                            loading="lazy"
                                                            alt="{{ $service->title }}"
                                                        >
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if($service->images->count() > 1)
                                                <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel{{ $service->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{ __('Previous') }}</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel{{ $service->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">{{ __('Next') }}</span>
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <div class="bg-gradient d-flex align-items-center justify-content-center w-100 h-100" style="background: linear-gradient(135deg, var(--mt-primary), color-mix(in srgb, var(--mt-primary) 70%, black));">
                                            <div class="text-center text-white px-4">
                                                <i class="fa-solid fa-images fa-3x mb-3 opacity-50" aria-hidden="true"></i>
                                                <h3 class="h5 text-white mb-2">{{ __('Service Gallery') }}</h3>
                                                <p class="text-white-50 small">{{ __('Upload photos in the admin panel.') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-7 p-4 p-lg-5 d-flex flex-column justify-content-between">
                                    <div>
                                        <h2 class="h3 text-brand fw-bold mb-3">{{ $service->title }}</h2>
                                        <div class="cms-content text-body-secondary mb-4" style="line-height: 1.8;">
                                            {!! $service->description !!}
                                        </div>
                                    </div>
                                    <div class="pt-3 border-top">
                                        <a class="btn btn-primary" href="{{ route('contact.create') }}">
                                            <i class="fa-solid fa-paper-plane me-2" aria-hidden="true"></i>{{ __('Request this service') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-5 p-md-6 text-center reveal-up" style="background: linear-gradient(135deg, rgba(45,106,79,0.05), rgba(45,106,79,0.02));">
                            <i class="fa-solid fa-inbox fa-4x text-body-secondary mb-4 opacity-50" aria-hidden="true"></i>
                            <h2 class="h4 text-body mb-2 fw-bold">{{ __('No services available') }}</h2>
                            <p class="text-body-secondary mb-0">{{ __('Services will appear here once they have been added and published from the admin panel.') }}</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 pt-4 border-top">
                {{ $services->links() }}
            </div>
        </div>
    </section>
@endsection

@extends('layouts.public')

@section('title', $siteName.' — '.__('Home'))

@section('content')
    {{-- Hero carousel: each slide pulls its image through Media::url so both /public and storage paths work. --}}
    <section class="hero-carousel">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            @if($slides->isNotEmpty())
                <div class="carousel-indicators">
                    @foreach($slides as $i => $s)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" @class(['active' => $i === 0]) aria-current="{{ $i === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach($slides as $i => $slide)
                        <div class="carousel-item @if($i === 0) active @endif">
                            <img src="{{ \App\Support\Media::url($slide->image_path) }}" class="d-block w-100 object-fit-cover" style="max-height: 560px; object-fit: cover;" alt="{{ $slide->title }}">
                            <div class="carousel-caption text-start">
                                <h2 class="h3 mb-1">{{ $slide->title }}</h2>
                                @if($slide->description)
                                    <p class="mb-0 small d-none d-md-block">{{ $slide->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Previous') }}</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">{{ __('Next') }}</span>
                </button>
            @else
                <div class="bg-brand text-white d-flex align-items-center justify-content-center" style="min-height: 420px;">
                    <div class="text-center p-4">
                        <h1 class="display-5">{{ $siteName }}</h1>
                        <p class="mb-0 opacity-75">{{ __('Add carousel slides from the admin panel to showcase your zoo.') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if($featuredServices->isNotEmpty())
        <section class="py-5 py-md-6 bg-light" style="position: relative;">
            <div class="container">
                <div class="row mb-5 align-items-end">
                    <div class="col-lg-8">
                        <h2 class="display-6 text-brand mb-3 fw-bold slide-in-left">{{ __('Featured services') }}</h2>
                        <p class="text-body-secondary lead slide-in-left" style="animation-delay: 0.1s;">{{ __('Discover our premium zoo services and programs designed to create unforgettable experiences for our visitors.') }}</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <a class="btn btn-primary btn-lg" href="{{ route('services.index') }}">
                            <i class="fa-solid fa-arrow-right me-2" aria-hidden="true"></i>{{ __('View all services') }}
                        </a>
                    </div>
                </div>

                <div class="row g-4 g-lg-5">
                    @foreach($featuredServices as $index => $service)
                        <div class="col-md-6 col-xl-4" style="animation-delay: {{ $index * 0.1 }}s;">
                            <article class="card h-100 border-0 shadow-sm reveal-up service-card overflow-hidden">
                                <div class="position-relative overflow-hidden" style="height: 280px;">
                                    @if($service->images->isNotEmpty())
                                        <img
                                            src="{{ \App\Support\Media::url($service->images->first()->image_path) }}"
                                            class="card-img-top object-fit-cover w-100 h-100"
                                            loading="lazy"
                                            alt="{{ $service->title }}"
                                        >
                                    @else
                                        <div class="bg-gradient d-flex align-items-center justify-content-center w-100 h-100" style="background: linear-gradient(135deg, var(--mt-primary), color-mix(in srgb, var(--mt-primary) 70%, black));">
                                            <div class="text-center text-white px-3">
                                                <i class="fa-solid fa-image fa-3x mb-2 opacity-50" aria-hidden="true"></i>
                                                <p class="text-white-50 small">{{ __('Add images in admin') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="h5 text-brand fw-bold mb-3">{{ $service->title }}</h3>
                                    <p class="text-body-secondary mb-3 flex-grow-1">{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 130) }}</p>
                                    <a class="stretched-link text-decoration-none text-brand fw-600 d-inline-flex align-items-center gap-2 mt-auto" href="{{ route('services.index') }}">
                                        {{ __('Explore service') }}
                                        <i class="fa-solid fa-chevron-right small" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <div class="container py-5">
        <div class="row g-4">
            @foreach($sectionSlugs as $slug)
                @if($contentBlocks->has($slug))
                    <div class="col-lg-4">
                        <article class="card h-100 border-0 shadow-sm reveal-up">
                            <div class="card-body p-4">
                                <h2 class="h4 text-brand mb-3">{{ $contentBlocks[$slug]->label }}</h2>
                                <div class="cms-content">{!! $contentBlocks[$slug]->body_html !!}</div>
                            </div>
                        </article>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

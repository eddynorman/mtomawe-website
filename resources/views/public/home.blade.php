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

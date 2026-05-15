@extends('layouts.public')

@section('title', $siteName.' — '.__('Gallery'))

@section('content')
    <div class="bg-light border-bottom py-5">
        <div class="container">
            <h1 class="display-6 text-brand">{{ __('Gallery') }}</h1>
            <p class="lead text-body-secondary mb-0">{{ __('Browse highlights from across the zoo and gardens.') }}</p>
        </div>
    </div>

    <div class="container py-5">
        @if($categories->isEmpty())
            <p class="text-body-secondary">{{ __('Gallery categories will appear here once they are created in the admin panel.') }}</p>
        @else
            <ul class="nav nav-pills flex-wrap gap-2 mb-4">
                @foreach($categories as $cat)
                    <li class="nav-item">
                        <a class="nav-link @if($active && $active->is($cat)) active @endif" href="{{ route('gallery.index', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                    </li>
                @endforeach
            </ul>

            @if($active && $active->images->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
                    @foreach($active->images as $image)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm reveal-up overflow-hidden">
                                <img src="{{ \App\Support\Media::url($image->image_path) }}" class="card-img-top object-fit-cover" style="height: 220px; object-fit: cover;" alt="{{ $image->heading }}">
                                <div class="card-body">
                                    <h2 class="h6 card-title">{{ $image->heading }}</h2>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif($active)
                <p class="text-body-secondary">{{ __('No images in this category yet.') }}</p>
            @endif
        @endif
    </div>
@endsection

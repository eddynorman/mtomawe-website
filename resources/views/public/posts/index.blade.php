@extends('layouts.public')

@section('title', $siteName.' — '.__('News'))

@section('content')
    <div class="bg-light border-bottom py-5">
        <div class="container">
            <h1 class="display-6 text-brand">{{ __('News & announcements') }}</h1>
        </div>
    </div>

    <div class="container py-5">
        @forelse($posts as $post)
            <article class="card border-0 shadow-sm mb-4 reveal-up">
                <div class="card-body p-4">
                    <h2 class="h4"><a class="text-decoration-none text-brand" href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
                    <p class="text-body-secondary small mb-2">
                        <i class="fa-regular fa-calendar me-1" aria-hidden="true"></i>{{ $post->published_at?->format('M j, Y') }}
                    </p>
                    @if($post->excerpt)
                        <p class="mb-0">{{ $post->excerpt }}</p>
                    @endif
                    <a class="btn btn-sm btn-brand mt-3" href="{{ route('posts.show', $post) }}">{{ __('Read more') }}</a>
                </div>
            </article>
        @empty
            <p class="text-body-secondary">{{ __('No published posts yet.') }}</p>
        @endforelse

        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

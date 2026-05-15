@extends('layouts.public')

@section('title', $post->title.' — '.$siteName)

@section('content')
    <article class="container py-5 col-lg-8 mx-auto">
        <header class="mb-4">
            <h1 class="display-6 text-brand">{{ $post->title }}</h1>
            <p class="text-body-secondary small mb-0">
                <i class="fa-regular fa-calendar me-1" aria-hidden="true"></i>{{ $post->published_at?->format('F j, Y') }}
            </p>
        </header>
        <div class="cms-content lead">{!! $post->body_html !!}</div>
        <p class="mt-4"><a class="btn btn-outline-secondary" href="{{ route('posts.index') }}"><i class="fa-solid fa-arrow-left-long me-1" aria-hidden="true"></i>{{ __('Back to news') }}</a></p>
    </article>
@endsection

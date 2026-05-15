@extends('layouts.admin')

@section('title', __('Edit post'))
@section('heading', __('Edit post'))

@section('content')
    <form method="post" action="{{ route('admin.posts.update', $post) }}" class="card border-0 shadow-sm">
        @csrf @method('PUT')
        <div class="card-body row g-3">
            <div class="col-md-8">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="slug">{{ __('URL slug') }}</label>
                <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug', $post->slug) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="excerpt">{{ __('Excerpt') }}</label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">{{ __('Body') }}</label>
                <div id="quill-editor" class="bg-white border rounded"></div>
                <input type="hidden" name="body_html" id="body_html" value="{{ old('body_html', $post->body_html) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="published_at">{{ __('Publish date') }}</label>
                <input id="published_at" name="published_at" type="datetime-local" class="form-control" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" @checked(old('is_published', $post->is_published))>
                    <label class="form-check-label" for="is_published">{{ __('Published') }}</label>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
            <a class="btn btn-link" href="{{ route('admin.posts.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.initQuillEditor('#quill-editor', 'body_html');
        });
    </script>
@endpush

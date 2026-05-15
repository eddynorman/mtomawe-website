@extends('layouts.admin')

@section('title', $contentBlock->label)
@section('heading', $contentBlock->label)

@section('content')
    <form method="post" action="{{ route('admin.content-blocks.update', $contentBlock) }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body">
            <p class="text-body-secondary small">{{ __('Use the toolbar to format text. Content is stored as HTML and rendered on the public site.') }}</p>
            <div id="quill-editor" class="bg-white border rounded"></div>
            <input type="hidden" name="body_html" id="body_html" value="{{ old('body_html', $contentBlock->body_html) }}">
        </div>
        <div class="card-footer bg-white border-0">
            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
            <a class="btn btn-link" href="{{ route('admin.content-blocks.index') }}">{{ __('Cancel') }}</a>
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

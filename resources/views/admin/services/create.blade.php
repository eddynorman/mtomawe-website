@extends('layouts.admin')

@section('title', __('New service'))
@section('heading', __('New service'))

@section('content')
    <form method="post" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf
        <div class="card-body row g-3">
            <div class="col-12">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="col-12 mb-2">
                <label class="form-label">{{ __('Description') }}</label>
                <input id="description" name="description" type="hidden" value="{{ old('description') }}">
                <div id="quill-editor" class="bg-white border rounded" style="max-height: 200px;"></div>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="is_active">{{ __('Active') }}</label>
                <select id="is_active" name="is_active" class="form-select">
                    <option value="1" @selected(old('is_active', '1') === '1')>{{ __('Yes') }}</option>
                    <option value="0" @selected(old('is_active') === '0')>{{ __('No') }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="images">{{ __('Images') }}</label>
                <input id="images" name="images[]" type="file" class="form-control" accept="image/*" multiple>
                <div class="form-text">{{ __('Upload one or more pictures; they will display as a carousel on the public service page.') }}</div>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Save service') }}</button>
            <a class="btn btn-link" href="{{ route('admin.services.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            window.initQuillEditor('#quill-editor', 'description');
        });
    </script>
@endpush

@extends('layouts.admin')

@section('title', __('Edit slide'))
@section('heading', __('Edit carousel slide'))

@section('content')
    <form method="post" action="{{ route('admin.carousel-slides.update', $slide) }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body row g-3">
            <div class="col-md-8">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $slide->title) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Sort order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $slide->sort_order) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="description">{{ __('Short description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="2">{{ old('description', $slide->description) }}</textarea>
            </div>
            <div class="col-12">
                <p class="small text-body-secondary mb-1">{{ __('Current image') }}</p>
                <img src="{{ \App\Support\Media::url($slide->image_path) }}" alt="" class="rounded border mb-2" style="max-height: 160px;">
                <label class="form-label" for="image">{{ __('Replace image (optional)') }}</label>
                <input id="image" name="image" type="file" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" @checked(old('is_active', $slide->is_active))>
                    <label class="form-check-label" for="is_active">{{ __('Visible on website') }}</label>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
            <a class="btn btn-link" href="{{ route('admin.carousel-slides.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

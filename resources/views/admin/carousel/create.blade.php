@extends('layouts.admin')

@section('title', __('New carousel slide'))
@section('heading', __('New carousel slide'))

@section('content')
    <form method="post" action="{{ route('admin.carousel-slides.store') }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf
        <div class="card-body row g-3">
            <div class="col-md-8">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Sort order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="description">{{ __('Short description') }}</label>
                <textarea id="description" name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label" for="image">{{ __('Image') }}</label>
                <input id="image" name="image" type="file" class="form-control" accept="image/*" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" @checked(old('is_active', true))>
                    <label class="form-check-label" for="is_active">{{ __('Visible on website') }}</label>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
            <a class="btn btn-link" href="{{ route('admin.carousel-slides.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

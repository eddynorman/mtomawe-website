@extends('layouts.admin')

@section('title', __('New gallery image'))
@section('heading', __('New gallery image'))

@section('content')
    <form method="post" action="{{ route('admin.gallery-images.store') }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label" for="gallery_category_id">{{ __('Category') }}</label>
                <select id="gallery_category_id" name="gallery_category_id" class="form-select" required>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(old('gallery_category_id', $selectedCategoryId) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="heading">{{ __('Heading / caption') }}</label>
                <input id="heading" name="heading" type="text" class="form-control" value="{{ old('heading') }}" required>
            </div>
            <div class="col-12">
                <label class="form-label" for="image">{{ __('Image file') }}</label>
                <input id="image" name="image" type="file" class="form-control" accept="image/*" required>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
            <a class="btn btn-link" href="{{ route('admin.gallery-images.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

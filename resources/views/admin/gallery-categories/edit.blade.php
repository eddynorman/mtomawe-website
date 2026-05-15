@extends('layouts.admin')

@section('title', __('Edit category'))
@section('heading', __('Edit gallery category'))

@section('content')
    <form method="post" action="{{ route('admin.gallery-categories.update', $category) }}" class="card border-0 shadow-sm">
        @csrf @method('PUT')
        <div class="card-body row g-3">
            <div class="col-md-8">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $category->sort_order) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="slug">{{ __('Slug') }}</label>
                <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug', $category->slug) }}" required>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
            <a class="btn btn-link" href="{{ route('admin.gallery-categories.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

@extends('layouts.admin')

@section('title', __('New category'))
@section('heading', __('New gallery category'))

@section('content')
    <form method="post" action="{{ route('admin.gallery-categories.store') }}" class="card border-0 shadow-sm">
        @csrf
        <div class="card-body row g-3">
            <div class="col-md-8">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="slug">{{ __('Slug (optional)') }}</label>
                <input id="slug" name="slug" type="text" class="form-control" value="{{ old('slug') }}" placeholder="auto-from-name">
                <div class="form-text">{{ __('Lowercase letters, numbers, and dashes only if you set it manually.') }}</div>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
            <a class="btn btn-link" href="{{ route('admin.gallery-categories.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

@extends('layouts.admin')

@section('title', __('Gallery images'))
@section('heading', __('Gallery images'))

@section('content')
    <form method="get" action="{{ route('admin.gallery-images.index') }}" class="row g-2 align-items-end mb-3">
        <div class="col-auto">
            <label class="form-label small mb-0" for="category_id">{{ __('Category') }}</label>
            <select id="category_id" name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="" @selected($categoryId === null)>{{ __('All') }}</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected($categoryId === $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <a class="btn btn-success" href="{{ route('admin.gallery-images.create', ['gallery_category_id' => $categoryId]) }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('Add image') }}</a>
        </div>
    </form>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
        @forelse($images as $img)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="{{ \App\Support\Media::url($img->image_path) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="">
                    <div class="card-body">
                        <h3 class="h6">{{ $img->heading }}</h3>
                        <p class="small text-body-secondary mb-2">{{ $img->category?->name }}</p>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.gallery-images.edit', $img) }}">{{ __('Edit') }}</a>
                        <form class="d-inline" method="post" action="{{ route('admin.gallery-images.destroy', $img) }}" onsubmit="return confirm('{{ __('Delete?') }}');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">{{ __('Delete') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>{{ __('No images yet.') }}</p>
        @endforelse
    </div>
    <div class="mt-3">{{ $images->links() }}</div>
@endsection

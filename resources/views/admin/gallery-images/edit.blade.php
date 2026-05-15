@extends('layouts.admin')

@section('title', __('Edit gallery image'))
@section('heading', __('Edit gallery image'))

@section('content')
    <form method="post" action="{{ route('admin.gallery-images.update', $gallery_image) }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf @method('PUT')
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label" for="gallery_category_id">{{ __('Category') }}</label>
                <select id="gallery_category_id" name="gallery_category_id" class="form-select" required>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(old('gallery_category_id', $gallery_image->gallery_category_id) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $gallery_image->sort_order) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="heading">{{ __('Heading') }}</label>
                <input id="heading" name="heading" type="text" class="form-control" value="{{ old('heading', $gallery_image->heading) }}" required>
            </div>
            <div class="col-12">
                <img src="{{ \App\Support\Media::url($gallery_image->image_path) }}" alt="" class="rounded border mb-2" style="max-height: 200px;">
                <label class="form-label" for="image">{{ __('Replace image (optional)') }}</label>
                <input id="image" name="image" type="file" class="form-control" accept="image/*">
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Update') }}</button>
            <a class="btn btn-link" href="{{ route('admin.gallery-images.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

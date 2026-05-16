@extends('layouts.admin')

@section('title', __('Edit service'))
@section('heading', __('Edit service'))

@section('content')
    <form method="post" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body row g-3">
            <div class="col-12">
                <label class="form-label" for="title">{{ __('Title') }}</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $service->title) }}" required>
            </div>
            <div class="col-12 mb-2">
                <label class="form-label">{{ __('Description') }}</label>
                <input id="description" name="description" type="hidden" value="{{ old('description', $service->description) }}">
                <div id="quill-editor" class="bg-white border rounded" style="max-height: 200px;"></div>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', $service->sort_order) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="is_active">{{ __('Active') }}</label>
                <select id="is_active" name="is_active" class="form-select">
                    <option value="1" @selected(old('is_active', $service->is_active ? '1' : '0') === '1')>{{ __('Yes') }}</option>
                    <option value="0" @selected(old('is_active', $service->is_active ? '1' : '0') === '0')>{{ __('No') }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label" for="images">{{ __('Add images') }}</label>
                <input id="images" name="images[]" type="file" class="form-control" accept="image/*" multiple>
                <div class="form-text">{{ __('Upload new images to append to the service carousel.') }}</div>
            </div>

            @if($service->images->isNotEmpty())
                <div class="col-12">
                    <h2 class="h6 text-uppercase text-body-secondary mb-3">{{ __('Existing images') }}</h2>
                    <div class="row g-3">
                        @foreach($service->images as $image)
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm">
                                    <img src="{{ \App\Support\Media::url($image->image_path) }}" class="card-img-top" alt="{{ $service->title }}">
                                    <div class="card-body p-2 text-center">
                                        <form method="post" action="{{ route('admin.services.images.destroy', [$service, $image]) }}" onsubmit="return confirm('{{ __('Delete image?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger w-100" type="submit">{{ __('Remove') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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

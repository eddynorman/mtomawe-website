@extends('layouts.admin')

@php
    use App\Support\SocialBrandIcons;
    $iconClass = old('icon_class', SocialBrandIcons::classNames()[0]);
    if (! SocialBrandIcons::isAllowed($iconClass)) {
        $iconClass = SocialBrandIcons::classNames()[0];
    }
@endphp

@section('title', __('New social link'))
@section('heading', __('New social link'))

@section('content')
    <form method="post" action="{{ route('admin.social-links.store') }}" class="card border-0 shadow-sm">
        @csrf
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label" for="label">{{ __('Label') }}</label>
                <input id="label" name="label" type="text" class="form-control" value="{{ old('label') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="sort_order">{{ __('Order') }}</label>
                <input id="sort_order" name="sort_order" type="number" class="form-control" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="icon_class">{{ __('Icon') }}</label>
                <select id="icon_class" name="icon_class" class="form-select form-select-lg social-brand-icon-select" required aria-label="{{ __('Social network icon') }}">
                    @foreach(SocialBrandIcons::all() as $row)
                        <option value="{{ $row['class'] }}" @selected($iconClass === $row['class']) title="{{ $row['label'] }}"><span class="me-1"><i class="{{ $row['class'] }}"></i></span>{{ $row['label'] }}</option>
                    @endforeach
                </select>
                <div class="form-text">{{ __('Choose a brand icon; the list shows symbols only. Hover an option for its name.') }}</div>
            </div>
            <div class="col-12">
                <label class="form-label" for="url">{{ __('URL') }}</label>
                <input id="url" name="url" type="url" class="form-control" value="{{ old('url') }}" required>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
            <a class="btn btn-link" href="{{ route('admin.social-links.index') }}">{{ __('Cancel') }}</a>
        </div>
    </form>
@endsection

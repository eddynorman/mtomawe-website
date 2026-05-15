@extends('layouts.admin')

@php
    use App\Support\SiteColors;
    use App\Support\SiteFontStacks;
    use App\Support\SiteSettingKeys;

    $baseStacks = SiteFontStacks::baseStacks();
    $headingStacks = SiteFontStacks::headingStacks();

    $fontBase = old(SiteSettingKeys::FONT_FAMILY_BASE, $values->get(SiteSettingKeys::FONT_FAMILY_BASE, SiteFontStacks::defaultBaseStack()));
    if (! array_key_exists($fontBase, $baseStacks)) {
        $fontBase = SiteFontStacks::defaultBaseStack();
    }

    $fontHeading = old(SiteSettingKeys::FONT_FAMILY_HEADING, $values->get(SiteSettingKeys::FONT_FAMILY_HEADING, SiteFontStacks::defaultHeadingStack()));
    if (! array_key_exists($fontHeading, $headingStacks)) {
        $fontHeading = SiteFontStacks::defaultHeadingStack();
    }
@endphp

@section('title', __('Look & feel'))
@section('heading', __('Site settings'))

@section('content')
    <form method="post" action="{{ route('admin.settings.update') }}" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body row g-3">
            <div class="col-12">
                <h2 class="h6 text-uppercase text-body-secondary">{{ __('Branding & contact') }}</h2>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="site_name">{{ __('Site name') }}</label>
                <input id="site_name" name="{{ SiteSettingKeys::SITE_NAME }}" type="text" class="form-control" value="{{ old(SiteSettingKeys::SITE_NAME, $values->get(SiteSettingKeys::SITE_NAME)) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="email">{{ __('Public email') }}</label>
                <input id="email" name="{{ SiteSettingKeys::EMAIL }}" type="email" class="form-control" value="{{ old(SiteSettingKeys::EMAIL, $values->get(SiteSettingKeys::EMAIL)) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="address">{{ __('Address line') }}</label>
                <textarea id="address" name="{{ SiteSettingKeys::ADDRESS_LINE }}" class="form-control" rows="2">{{ old(SiteSettingKeys::ADDRESS_LINE, $values->get(SiteSettingKeys::ADDRESS_LINE)) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="phone">{{ __('Phone') }}</label>
                <input id="phone" name="{{ SiteSettingKeys::PHONE }}" type="text" class="form-control" value="{{ old(SiteSettingKeys::PHONE, $values->get(SiteSettingKeys::PHONE)) }}">
            </div>
            <div class="col-12">
                <label class="form-label" for="maps">{{ __('Google Maps link') }}</label>
                <input id="maps" name="{{ SiteSettingKeys::GOOGLE_MAPS_URL }}" type="url" class="form-control" value="{{ old(SiteSettingKeys::GOOGLE_MAPS_URL, $values->get(SiteSettingKeys::GOOGLE_MAPS_URL)) }}" placeholder="https://maps.google.com/...">
                <div class="form-text">{{ __('Paste a share / directions URL so visitors can open your exact pin.') }}</div>
            </div>

            <div class="col-12 mt-3">
                <h2 class="h6 text-uppercase text-body-secondary">{{ __('Theme') }}</h2>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="primary">{{ __('Primary colour') }}</label>
                <input id="primary" name="{{ SiteSettingKeys::PRIMARY_COLOR }}" type="color" class="form-control form-control-color" value="{{ old(SiteSettingKeys::PRIMARY_COLOR, SiteColors::normalizeHex($values->get(SiteSettingKeys::PRIMARY_COLOR), '#2d6a4f')) }}" title="{{ __('Primary') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="secondary">{{ __('Secondary colour') }}</label>
                <input id="secondary" name="{{ SiteSettingKeys::SECONDARY_COLOR }}" type="color" class="form-control form-control-color" value="{{ old(SiteSettingKeys::SECONDARY_COLOR, SiteColors::normalizeHex($values->get(SiteSettingKeys::SECONDARY_COLOR), '#52796f')) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="bodyc">{{ __('Body text') }}</label>
                <input id="bodyc" name="{{ SiteSettingKeys::BODY_TEXT_COLOR }}" type="color" class="form-control form-control-color" value="{{ old(SiteSettingKeys::BODY_TEXT_COLOR, SiteColors::normalizeHex($values->get(SiteSettingKeys::BODY_TEXT_COLOR), '#1b4332')) }}">
            </div>
            <div class="col-md-3">
                <label class="form-label" for="headc">{{ __('Headings') }}</label>
                <input id="headc" name="{{ SiteSettingKeys::HEADING_COLOR }}" type="color" class="form-control form-control-color" value="{{ old(SiteSettingKeys::HEADING_COLOR, SiteColors::normalizeHex($values->get(SiteSettingKeys::HEADING_COLOR), '#0d2818')) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label" for="ffbase">{{ __('Body font') }}</label>
                <select id="ffbase" name="{{ SiteSettingKeys::FONT_FAMILY_BASE }}" class="form-select" required>
                    @foreach($baseStacks as $stack => $label)
                        <option value="{{ $stack }}" @selected($fontBase === $stack)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="ffhead">{{ __('Heading font') }}</label>
                <select id="ffhead" name="{{ SiteSettingKeys::FONT_FAMILY_HEADING }}" class="form-select" required>
                    @foreach($headingStacks as $stack => $label)
                        <option value="{{ $stack }}" @selected($fontHeading === $stack)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="fs">{{ __('Base font size (px)') }}</label>
                <input id="fs" name="{{ SiteSettingKeys::FONT_SIZE_BASE_PX }}" type="number" min="12" max="28" class="form-control" value="{{ old(SiteSettingKeys::FONT_SIZE_BASE_PX, $values->get(SiteSettingKeys::FONT_SIZE_BASE_PX, '17')) }}" required>
            </div>
        </div>
        <div class="card-footer bg-white border-0">
            <button type="submit" class="btn btn-success">{{ __('Save settings') }}</button>
        </div>
    </form>
@endsection

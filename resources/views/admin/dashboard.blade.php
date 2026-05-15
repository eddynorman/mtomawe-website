@extends('layouts.admin')

@section('title', __('Dashboard'))
@section('heading', __('Welcome'))

@section('content')
    <p class="text-body-secondary mb-4">{{ __('Choose a section from the left to update your website. Changes appear on the public site immediately after saving.') }}</p>
    <div class="row g-3">
        <div class="col-md-6 col-xl-4">
            <a class="text-decoration-none" href="{{ route('admin.settings.edit') }}">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h6 text-success"><i class="fa-solid fa-palette me-2" aria-hidden="true"></i>{{ __('Look & feel') }}</h2>
                        <p class="small text-body-secondary mb-0">{{ __('Colours, fonts, contact details, and map link.') }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a class="text-decoration-none" href="{{ route('admin.carousel-slides.index') }}">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h6 text-success"><i class="fa-solid fa-images me-2" aria-hidden="true"></i>{{ __('Carousel') }}</h2>
                        <p class="small text-body-secondary mb-0">{{ __('Hero images on the home page.') }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a class="text-decoration-none" href="{{ route('admin.contact-messages.index') }}">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="h6 text-success"><i class="fa-solid fa-inbox me-2" aria-hidden="true"></i>{{ __('Messages') }}</h2>
                        <p class="small text-body-secondary mb-0">{{ __('Visitor enquiries from the contact form.') }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', __('Carousel'))
@section('heading', __('Carousel slides'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-body-secondary mb-0">{{ __('Images appear on the home page carousel in sort order.') }}</p>
        <a class="btn btn-success" href="{{ route('admin.carousel-slides.create') }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('Add slide') }}</a>
    </div>
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light">
                <tr>
                    <th></th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Order') }}</th>
                    <th>{{ __('Active') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($slides as $slide)
                    <tr>
                        <td style="width: 72px;"><img src="{{ \App\Support\Media::url($slide->image_path) }}" alt="" class="rounded" style="width: 64px; height: 48px; object-fit: cover;"></td>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->sort_order }}</td>
                        <td>@if($slide->is_active)<span class="badge text-bg-success">{{ __('Yes') }}</span>@else<span class="badge text-bg-secondary">{{ __('No') }}</span>@endif</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.carousel-slides.edit', $slide) }}">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.carousel-slides.destroy', $slide) }}" method="post" class="d-inline" onsubmit="return confirm('{{ __('Delete this slide?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $slides->links() }}</div>
@endsection

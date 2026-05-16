@extends('layouts.admin')

@section('title', __('Services'))
@section('heading', __('Services'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="text-body-secondary mb-0">{{ __('Manage the website services visitors see in the public services page.') }}</p>
        <a class="btn btn-success" href="{{ route('admin.services.create') }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('Add service') }}</a>
    </div>
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>{{ __('Title') }}</th><th>{{ __('Active') }}</th><th>{{ __('Images') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->title }}</td>
                        <td>{!! $service->is_active ? '<span class="badge text-bg-success">'.__('Yes').'</span>' : '<span class="badge text-bg-secondary">'.__('No').'</span>' !!}</td>
                        <td>{{ $service->images_count }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.services.edit', $service) }}">{{ __('Edit') }}</a>
                            <form class="d-inline" method="post" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('{{ __('Delete?') }}');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $services->links() }}
@endsection

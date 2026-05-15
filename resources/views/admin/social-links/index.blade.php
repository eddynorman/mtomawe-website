@extends('layouts.admin')

@section('title', __('Social links'))
@section('heading', __('Social links'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="text-body-secondary mb-0">{{ __('We use Font Awesome brand icons for social links.') }}</p>
        <a class="btn btn-success" href="{{ route('admin.social-links.create') }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('Add') }}</a>
    </div>
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>{{ __('Label') }}</th><th>{{ __('Icon class') }}</th><th>{{ __('URL') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>{{ $link->label }}</td>
                        <td><i class="{{ $link->icon_class }}"></i></td>
                        <td class="small text-truncate" style="max-width: 220px;"><a href="{{ $link->url }}" target="_blank" rel="noopener">{{ $link->url }}</a></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.social-links.edit', $link) }}">{{ __('Edit') }}</a>
                            <form class="d-inline" method="post" action="{{ route('admin.social-links.destroy', $link) }}" onsubmit="return confirm('{{ __('Delete?') }}');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $links->links() }}
@endsection

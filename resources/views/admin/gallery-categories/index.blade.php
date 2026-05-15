@extends('layouts.admin')

@section('title', __('Gallery categories'))
@section('heading', __('Gallery categories'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="text-body-secondary mb-0">{{ __('Categories appear as tabs on the public gallery page.') }}</p>
        <a class="btn btn-success" href="{{ route('admin.gallery-categories.create') }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('Add') }}</a>
    </div>
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>{{ __('Name') }}</th><th>{{ __('Slug') }}</th><th>{{ __('Order') }}</th><th></th></tr></thead>
            <tbody>
                @foreach($categories as $cat)
                    <tr>
                        <td>{{ $cat->name }}</td>
                        <td><code>{{ $cat->slug }}</code></td>
                        <td>{{ $cat->sort_order }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.gallery-categories.edit', $cat) }}">{{ __('Edit') }}</a>
                            <form class="d-inline" method="post" action="{{ route('admin.gallery-categories.destroy', $cat) }}" onsubmit="return confirm('{{ __('Delete category and all its images?') }}');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
@endsection

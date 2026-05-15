@extends('layouts.admin')

@section('title', __('Page text'))
@section('heading', __('Editable page sections'))

@section('content')
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>{{ __('Label') }}</th>
                    <th>{{ __('Slug') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($blocks as $block)
                    <tr>
                        <td>{{ $block->label }}</td>
                        <td><code>{{ $block->slug }}</code></td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-success" href="{{ route('admin.content-blocks.edit', $block) }}">{{ __('Edit') }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

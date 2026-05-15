@extends('layouts.admin')

@section('title', __('Messages'))
@section('heading', __('Contact messages'))

@section('content')
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light">
                <tr><th>{{ __('From') }}</th><th>{{ __('Email') }}</th><th>{{ __('Received') }}</th><th>{{ __('Status') }}</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                    <tr class="@if($msg->read_at === null) table-warning @endif">
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td class="small">{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                        <td>@if($msg->read_at)<span class="badge text-bg-secondary">{{ __('Read') }}</span>@else<span class="badge text-bg-danger">{{ __('New') }}</span>@endif</td>
                        <td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.contact-messages.show', $msg) }}">{{ __('Open') }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $messages->links() }}
@endsection

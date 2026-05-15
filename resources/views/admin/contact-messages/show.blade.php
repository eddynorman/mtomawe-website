@extends('layouts.admin')

@section('title', __('Message'))
@section('heading', __('Message from').' '.$message->name)

@section('content')
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body row g-3">
            <div class="col-md-4"><strong>{{ __('Phone') }}</strong><br>{{ $message->phone }}</div>
            <div class="col-md-4"><strong>{{ __('Email') }}</strong><br><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></div>
            <div class="col-md-4"><strong>{{ __('Received') }}</strong><br>{{ $message->created_at->format('Y-m-d H:i') }}</div>
            <div class="col-12">
                <strong>{{ __('Message') }}</strong>
                <p class="mt-2 mb-0" style="white-space: pre-wrap;">{{ $message->message }}</p>
            </div>
        </div>
    </div>
    <form method="post" action="{{ route('admin.contact-messages.unread', $message) }}" class="d-inline">
        @csrf @method('PATCH')
        <button type="submit" class="btn btn-outline-secondary">{{ __('Mark unread') }}</button>
    </form>
    <form method="post" action="{{ route('admin.contact-messages.destroy', $message) }}" class="d-inline ms-2" onsubmit="return confirm('{{ __('Delete message?') }}');">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-outline-danger">{{ __('Delete') }}</button>
    </form>
    <a class="btn btn-link" href="{{ route('admin.contact-messages.index') }}">{{ __('Back to inbox') }}</a>
@endsection

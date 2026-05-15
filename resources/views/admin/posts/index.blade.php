@extends('layouts.admin')

@section('title', __('Posts'))
@section('heading', __('Posts & announcements'))

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <p class="text-body-secondary mb-0">{{ __('Rich HTML posts appear on the public news page when published.') }}</p>
        <a class="btn btn-success" href="{{ route('admin.posts.create') }}"><i class="fa-solid fa-plus me-1" aria-hidden="true"></i>{{ __('New post') }}</a>
    </div>
    <div class="table-responsive card border-0 shadow-sm">
        <table class="table mb-0">
            <thead class="table-light">
                <tr><th>{{ __('Title') }}</th><th>{{ __('Published') }}</th><th>{{ __('Status') }}</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td class="small">{{ $post->published_at?->format('Y-m-d H:i') ?? '—' }}</td>
                        <td>@if($post->is_published)<span class="badge text-bg-success">{{ __('Live') }}</span>@else<span class="badge text-bg-secondary">{{ __('Draft') }}</span>@endif</td>
                        <td class="text-end">
                            @if($post->is_published && $post->published_at && $post->published_at->lte(now()))
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('posts.show', $post) }}" target="_blank" rel="noopener">{{ __('View') }}</a>
                            @endif
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.posts.edit', $post) }}">{{ __('Edit') }}</a>
                            <form class="d-inline" method="post" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('{{ __('Delete post?') }}');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $posts->links() }}
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

/**
 * Public-facing news and announcements list + detail view.
 */
class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()
            ->published()
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('public.posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        abort_unless($post->is_published && $post->published_at && $post->published_at->lte(now()), 404);

        return view('public.posts.show', compact('post'));
    }
}

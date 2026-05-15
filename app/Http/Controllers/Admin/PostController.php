<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * CRUD for news / announcements with rich HTML bodies and optional scheduling via published_at.
 */
class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()->orderByDesc('published_at')->orderByDesc('id')->paginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        Post::query()->create(array_merge($this->validated($request), [
            'user_id' => Auth::id(),
        ]));

        return redirect()->route('admin.posts.index')->with('status', __('Post created.'));
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->update($this->validated($request, $post));

        return redirect()->route('admin.posts.index')->with('status', __('Post updated.'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', __('Post deleted.'));
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Post $post = null): array
    {
        $slugRule = Rule::unique('posts', 'slug');
        if ($post) {
            $slugRule->ignore($post->id);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', $slugRule],
            'excerpt' => ['nullable', 'string', 'max:2000'],
            'body_html' => ['required', 'string', 'max:200000'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes'],
        ]);

        $data['is_published'] = $request->has('is_published');
        $data['slug'] = Str::slug($data['slug']);

        $data['published_at'] = ! empty($data['published_at']) ? $data['published_at'] : null;

        return $data;
    }
}

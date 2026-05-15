<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Support\SocialBrandIcons;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * CRUD for footer social icons (Font Awesome class + outbound URL).
 */
class SocialLinkController extends Controller
{
    public function index(): View
    {
        $links = SocialLink::query()->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->paginate(30);

        return view('admin.social-links.index', compact('links'));
    }

    public function create(): View
    {
        return view('admin.social-links.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:80'],
            'icon_class' => ['required', 'string', Rule::in(SocialBrandIcons::classNames())],
            'url' => ['required', 'url', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        SocialLink::query()->create([
            'label' => $data['label'],
            'icon_class' => $data['icon_class'],
            'url' => $data['url'],
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.social-links.index')->with('status', __('Link added.'));
    }

    public function edit(SocialLink $social_link): View
    {
        return view('admin.social-links.edit', compact('social_link'));
    }

    public function update(Request $request, SocialLink $social_link): RedirectResponse
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:80'],
            'icon_class' => ['required', 'string', Rule::in(SocialBrandIcons::classNames())],
            'url' => ['required', 'url', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $social_link->update([
            ...$data,
            'sort_order' => $data['sort_order'] ?? $social_link->sort_order,
        ]);

        return redirect()->route('admin.social-links.index')->with('status', __('Link updated.'));
    }

    public function destroy(SocialLink $social_link): RedirectResponse
    {
        $social_link->delete($social_link->id);

        return redirect()->route('admin.social-links.index')->with('status', __('Link removed.'));
    }
}

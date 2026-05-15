<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * CRUD for gallery category tabs shown on the public gallery page.
 */
class GalleryCategoryController extends Controller
{
    public function index(): View
    {
        $categories = GalleryCategory::query()->orderBy('sort_order')->orderBy('id')->paginate(30);

        return view('admin.gallery-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.gallery-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:120', 'alpha_dash', 'unique:gallery_categories,slug'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $slug = $data['slug'] ?? Str::slug($data['name']);

        GalleryCategory::query()->create([
            'name' => $data['name'],
            'slug' => $slug,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('status', __('Category created.'));
    }

    public function edit(GalleryCategory $gallery_category): View
    {
        return view('admin.gallery-categories.edit', ['category' => $gallery_category]);
    }

    public function update(Request $request, GalleryCategory $gallery_category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:120', 'alpha_dash', 'unique:gallery_categories,slug,'.$gallery_category->id],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $gallery_category->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'sort_order' => $data['sort_order'] ?? $gallery_category->sort_order,
        ]);

        return redirect()->route('admin.gallery-categories.index')->with('status', __('Category updated.'));
    }

    public function destroy(GalleryCategory $gallery_category): RedirectResponse
    {
        $gallery_category->delete();

        return redirect()->route('admin.gallery-categories.index')->with('status', __('Category deleted.'));
    }
}

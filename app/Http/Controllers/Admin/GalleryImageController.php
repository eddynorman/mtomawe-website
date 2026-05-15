<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD for individual gallery images (category assignment, heading, upload).
 */
class GalleryImageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = GalleryCategory::query()->orderBy('sort_order')->get();
        $categoryId = $request->filled('category_id') ? $request->integer('category_id') : null;

        $images = GalleryImage::query()
            ->when($categoryId, fn ($q) => $q->where('gallery_category_id', $categoryId))
            ->with('category')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(24)
            ->withQueryString();

        return view('admin.gallery-images.index', compact('images', 'categories', 'categoryId'));
    }

    public function create(Request $request): View
    {
        $categories = GalleryCategory::query()->orderBy('sort_order')->get();
        $selectedCategoryId = $request->filled('gallery_category_id')
            ? $request->integer('gallery_category_id')
            : $categories->first()?->id;

        return view('admin.gallery-images.create', compact('categories', 'selectedCategoryId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'heading' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:6144'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        GalleryImage::query()->create([
            'gallery_category_id' => $data['gallery_category_id'],
            'heading' => $data['heading'],
            'image_path' => $path,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()->route('admin.gallery-images.index')->with('status', __('Image added.'));
    }

    public function edit(GalleryImage $gallery_image): View
    {
        $categories = GalleryCategory::query()->orderBy('sort_order')->get();

        return view('admin.gallery-images.edit', compact('gallery_image', 'categories'));
    }

    public function update(Request $request, GalleryImage $gallery_image): RedirectResponse
    {
        $data = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'heading' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:6144'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery_image->update([
            'gallery_category_id' => $data['gallery_category_id'],
            'heading' => $data['heading'],
            'image_path' => $data['image_path'] ?? $gallery_image->image_path,
            'sort_order' => $data['sort_order'] ?? $gallery_image->sort_order,
        ]);

        return redirect()->route('admin.gallery-images.index')->with('status', __('Image updated.'));
    }

    public function destroy(GalleryImage $gallery_image): RedirectResponse
    {
        $gallery_image->delete();

        return redirect()->route('admin.gallery-images.index')->with('status', __('Image removed.'));
    }
}

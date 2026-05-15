<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD for landing-page hero carousel slides (image upload + ordering).
 */
class CarouselSlideController extends Controller
{
    public function index(): View
    {
        $slides = CarouselSlide::query()->orderBy('sort_order')->orderBy('id')->paginate(20);

        return view('admin.carousel.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['required', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['sometimes'],
        ]);

        $path = $request->file('image')->store('carousel', 'public');

        CarouselSlide::query()->create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'image_path' => $path,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.carousel-slides.index')->with('status', __('Slide created.'));
    }

    public function edit(CarouselSlide $carousel_slide): View
    {
        return view('admin.carousel.edit', ['slide' => $carousel_slide]);
    }

    public function update(Request $request, CarouselSlide $carousel_slide): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['sometimes'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('carousel', 'public');
        }

        $carousel_slide->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'image_path' => $data['image_path'] ?? $carousel_slide->image_path,
            'sort_order' => $data['sort_order'] ?? $carousel_slide->sort_order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.carousel-slides.index')->with('status', __('Slide updated.'));
    }

    public function destroy(CarouselSlide $carousel_slide): RedirectResponse
    {
        $carousel_slide->delete();

        return redirect()->route('admin.carousel-slides.index')->with('status', __('Slide removed.'));
    }
}

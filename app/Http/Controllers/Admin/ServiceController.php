<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * CRUD for service offerings and carousel images attached to each service.
 */
class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $services = Service::query()
            ->withCount('images')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:6144'],
        ]);

        $service = Service::query()->create([
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title']),
            'description' => $data['description'] ?? '',
            'is_active' => $data['is_active'] ?? true,
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        $this->storeImages($request, $service);

        return redirect()->route('admin.services.index')->with('status', __('Service added.'));
    }

    public function edit(Service $service): View
    {
        $service->load('images');

        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:6144'],
        ]);

        $service->update([
            'title' => $data['title'],
            'slug' => $this->generateSlug($data['title'], $service->id),
            'description' => $data['description'] ?? '',
            'is_active' => $data['is_active'] ?? false,
            'sort_order' => $data['sort_order'] ?? $service->sort_order,
        ]);

        $this->storeImages($request, $service);

        return redirect()->route('admin.services.index')->with('status', __('Service updated.'));
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', __('Service removed.'));
    }

    public function destroyImage(Service $service, ServiceImage $service_image): RedirectResponse
    {
        if ($service_image->service_id !== $service->id) {
            abort(404);
        }

        $service_image->delete();

        return redirect()->route('admin.services.edit', $service)->with('status', __('Image removed.'));
    }

    private function storeImages(Request $request, Service $service): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $imageFile) {
            if (! $imageFile->isValid()) {
                continue;
            }

            $path = $imageFile->store('services', 'public');

            ServiceImage::query()->create([
                'service_id' => $service->id,
                'image_path' => $path,
                'sort_order' => 0,
            ]);
        }
    }

    private function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'service';
        $slug = $baseSlug;
        $index = 1;

        while (Service::query()
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug.'-'.++$index;
        }

        return $slug;
    }
}

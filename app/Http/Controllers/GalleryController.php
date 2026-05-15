<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Public gallery: filter images by category tab; defaults to the first category by sort order.
 */
class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = GalleryCategory::query()
            ->with(['images' => fn ($q) => $q->orderBy('sort_order')->orderBy('id')])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $slug = $request->query('category');
        $active = $slug
            ? $categories->firstWhere('slug', $slug)
            : $categories->first();

        return view('public.gallery', compact('categories', 'active'));
    }
}

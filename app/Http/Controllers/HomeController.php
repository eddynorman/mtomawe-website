<?php

namespace App\Http\Controllers;

use App\Models\CarouselSlide;
use App\Models\Service;
use App\Support\ContentSlugs;
use Illuminate\View\View;

/**
 * Renders the public landing page: hero carousel plus CMS-driven about / mission / vision sections.
 */
class HomeController extends Controller
{
    public function index(): View
    {
        $slides = CarouselSlide::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $sectionSlugs = ContentSlugs::landingSections();

        $featuredServices = Service::query()
            ->active()
            ->with('images')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('public.home', compact('slides', 'sectionSlugs', 'featuredServices'));
    }
}

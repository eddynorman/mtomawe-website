<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->active()
            ->with('images')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('public.services', compact('services'));
    }
}

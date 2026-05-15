<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Displays the enquiry form and persists {@see ContactMessage} rows for staff review in admin.
 */
class ContactController extends Controller
{
    public function create(): View
    {
        return view('public.contact');
    }

    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::query()->create($request->validated());

        return redirect()
            ->route('contact.create')
            ->with('status', __('Thank you — we have received your message and will respond soon.'));
    }
}

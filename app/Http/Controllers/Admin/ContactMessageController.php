<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Inbox for visitor contact submissions with read / unread workflow.
 */
class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()
            ->orderByRaw('read_at is null desc')
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contact_message): View
    {
        if ($contact_message->read_at === null) {
            $contact_message->forceFill(['read_at' => now()])->save();
        }

        return view('admin.contact-messages.show', ['message' => $contact_message]);
    }

    public function markUnread(ContactMessage $contact_message): RedirectResponse
    {
        $contact_message->update(['read_at' => null]);

        return redirect()->route('admin.contact-messages.index')->with('status', __('Marked as unread.'));
    }

    public function destroy(ContactMessage $contact_message): RedirectResponse
    {
        $contact_message->delete();

        return redirect()->route('admin.contact-messages.index')->with('status', __('Message deleted.'));
    }
}

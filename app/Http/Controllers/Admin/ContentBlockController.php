<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Lists and edits rich HTML {@see ContentBlock} records (About, Mission, Vision, footer copy).
 */
class ContentBlockController extends Controller
{
    public function index(): View
    {
        $blocks = ContentBlock::query()->orderBy('slug')->get();

        return view('admin.content-blocks.index', compact('blocks'));
    }

    public function edit(ContentBlock $content_block): View
    {
        return view('admin.content-blocks.edit', ['contentBlock' => $content_block]);
    }

    public function update(Request $request, ContentBlock $content_block): RedirectResponse
    {
        $request->validate([
            'body_html' => ['nullable', 'string', 'max:100000'],
        ]);

        $content_block->update([
            'body_html' => $request->input('body_html'),
        ]);

        return redirect()
            ->route('admin.content-blocks.index')
            ->with('status', __('Content saved.'));
    }
}

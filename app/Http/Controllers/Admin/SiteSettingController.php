<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteSettingsService;
use App\Support\SiteColors;
use App\Support\SiteFontStacks;
use App\Support\SiteSettingKeys;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/**
 * Global business + appearance settings (maps link, colours, typography) edited as one structured form.
 */
class SiteSettingController extends Controller
{
    public function edit(SiteSettingsService $settings): View
    {
        $values = $settings->all();

        return view('admin.settings.edit', compact('values'));
    }

    public function update(Request $request, SiteSettingsService $settings): RedirectResponse
    {
        $data = $request->validate([
            SiteSettingKeys::SITE_NAME => ['required', 'string', 'max:120'],
            SiteSettingKeys::ADDRESS_LINE => ['nullable', 'string', 'max:500'],
            SiteSettingKeys::PHONE => ['nullable', 'string', 'max:64'],
            SiteSettingKeys::EMAIL => ['nullable', 'email', 'max:255'],
            SiteSettingKeys::GOOGLE_MAPS_URL => ['nullable', 'url', 'max:2000'],
            SiteSettingKeys::PRIMARY_COLOR => ['required', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/'],
            SiteSettingKeys::SECONDARY_COLOR => ['required', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/'],
            SiteSettingKeys::BODY_TEXT_COLOR => ['required', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/'],
            SiteSettingKeys::HEADING_COLOR => ['required', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/'],
            SiteSettingKeys::SOCIAL_ICON_COLOR => ['nullable', 'regex:/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$/'],
            SiteSettingKeys::FONT_FAMILY_BASE => ['required', 'string', Rule::in(array_keys(SiteFontStacks::baseStacks()))],
            SiteSettingKeys::FONT_FAMILY_HEADING => ['required', 'string', Rule::in(array_keys(SiteFontStacks::headingStacks()))],
            SiteSettingKeys::FONT_SIZE_BASE_PX => ['required', 'integer', 'min:12', 'max:28'],
            SiteSettingKeys::META_DESCRIPTION => ['nullable', 'string', 'max:300'],
            'logo' => ['nullable', 'image', 'max:4096'],
        ]);

        $data[SiteSettingKeys::PRIMARY_COLOR] = SiteColors::normalizeHex($data[SiteSettingKeys::PRIMARY_COLOR], '#2d6a4f');
        $data[SiteSettingKeys::SECONDARY_COLOR] = SiteColors::normalizeHex($data[SiteSettingKeys::SECONDARY_COLOR], '#52796f');
        $data[SiteSettingKeys::BODY_TEXT_COLOR] = SiteColors::normalizeHex($data[SiteSettingKeys::BODY_TEXT_COLOR], '#1b4332');
        $data[SiteSettingKeys::HEADING_COLOR] = SiteColors::normalizeHex($data[SiteSettingKeys::HEADING_COLOR], '#0d2818');
        $data[SiteSettingKeys::SOCIAL_ICON_COLOR] = SiteColors::normalizeHex($data[SiteSettingKeys::SOCIAL_ICON_COLOR], $data[SiteSettingKeys::PRIMARY_COLOR]);

        foreach ($data as $key => $value) {
            if ($key === 'logo') {
                continue;
            }
            $settings->set($key, is_int($value) ? (string) $value : (string) $value);
        }

        if ($request->hasFile('logo')) {
            $settings->set(SiteSettingKeys::SITE_LOGO_PATH, $request->file('logo')->store('branding', 'public'));
        }

        return redirect()->route('admin.settings.edit')->with('status', __('Settings saved.'));
    }
}

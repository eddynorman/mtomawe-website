<?php

namespace App\Services;

use App\Models\ContentBlock;
use App\Models\SiteSetting;
use App\Support\SiteColors;
use App\Support\SiteFontStacks;
use App\Support\SiteSettingKeys;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Reads and writes {@see SiteSetting} rows with a small in-request cache layer for performance on public pages.
 */
class SiteSettingsService
{
    /**
     * @var Collection<string, string>|null
     */
    private ?Collection $cache = null;

    /**
     * All settings as key => value (strings).
     *
     * @return Collection<string, string>
     */
    public function all(): Collection
    {
        if ($this->cache === null) {
            $this->cache = SiteSetting::query()
                ->pluck('value', 'key')
                ->map(fn (?string $v) => $v ?? '');
        }

        return $this->cache;
    }

    public function get(string $key, ?string $default = null): ?string
    {
        $v = $this->all()->get($key);

        return $v !== null && $v !== '' ? $v : $default;
    }

    /**
     * Persist a value and bust the static request cache so subsequent reads see fresh data.
     */
    public function set(string $key, ?string $value): void
    {
        SiteSetting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        $this->cache = null;
        Cache::forget('site_settings_public');
    }

    /**
     * Bulk upsert used by the admin settings form.
     *
     * @param  array<string, string|null>  $pairs
     */
    public function setMany(array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * CSS variables + typography for injection into the public layout <style> block.
     *
     * @return array<string, string>
     */
    public function themeVariables(): array
    {
        $baseFont = $this->get(SiteSettingKeys::FONT_FAMILY_BASE, SiteFontStacks::defaultBaseStack());
        $headingFont = $this->get(SiteSettingKeys::FONT_FAMILY_HEADING, SiteFontStacks::defaultHeadingStack());

        if (! array_key_exists($baseFont, SiteFontStacks::baseStacks())) {
            $baseFont = SiteFontStacks::defaultBaseStack();
        }
        if (! array_key_exists($headingFont, SiteFontStacks::headingStacks())) {
            $headingFont = SiteFontStacks::defaultHeadingStack();
        }

        return [
            'primary' => SiteColors::normalizeHex($this->get(SiteSettingKeys::PRIMARY_COLOR), '#2d6a4f'),
            'secondary' => SiteColors::normalizeHex($this->get(SiteSettingKeys::SECONDARY_COLOR), '#52796f'),
            'body' => SiteColors::normalizeHex($this->get(SiteSettingKeys::BODY_TEXT_COLOR), '#1b4332'),
            'heading' => SiteColors::normalizeHex($this->get(SiteSettingKeys::HEADING_COLOR), '#0d2818'),
            'social_icon' => SiteColors::normalizeHex($this->get(SiteSettingKeys::SOCIAL_ICON_COLOR), $this->get(SiteSettingKeys::PRIMARY_COLOR, '#2d6a4f')),
            'font_base' => $baseFont,
            'font_heading' => $headingFont,
            'font_size_px' => $this->get(SiteSettingKeys::FONT_SIZE_BASE_PX, '17'),
        ];
    }

    /**
     * Load all {@see ContentBlock} rows keyed by slug for Blade consumption.
     *
     * @return Collection<string, ContentBlock>
     */
    public function contentBlocksKeyed(): Collection
    {
        return ContentBlock::query()->get()->keyBy('slug');
    }
}

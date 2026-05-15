<?php

namespace App\View\Composers;

use App\Models\SocialLink;
use App\Services\SiteSettingsService;
use App\Support\SiteSettingKeys;
use Illuminate\View\View;

/**
 * Shares branding, theme CSS variables, and footer social links with every public-facing layout.
 */
class PublicLayoutComposer
{
    public function __construct(
        private readonly SiteSettingsService $settings
    ) {}

    public function compose(View $view): void
    {
        $t = $this->settings->themeVariables();

        $view->with('siteName', $this->settings->get(SiteSettingKeys::SITE_NAME, config('app.name')));
        $view->with('siteAddress', $this->settings->get(SiteSettingKeys::ADDRESS_LINE, ''));
        $view->with('sitePhone', $this->settings->get(SiteSettingKeys::PHONE, ''));
        $view->with('siteEmail', $this->settings->get(SiteSettingKeys::EMAIL, ''));
        $view->with('googleMapsUrl', $this->settings->get(SiteSettingKeys::GOOGLE_MAPS_URL, '#'));
        $view->with('theme', $t);
        $view->with('contentBlocks', $this->settings->contentBlocksKeyed());
        $view->with('socialLinks', SocialLink::query()->orderBy('sort_order')->get());
    }
}

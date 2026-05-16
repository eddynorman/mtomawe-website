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

        $siteName = $this->settings->get(SiteSettingKeys::SITE_NAME, config('app.name'));

        $view->with('siteName', $siteName);
        $view->with('logoPath', $this->settings->get(SiteSettingKeys::SITE_LOGO_PATH, ''));
        $view->with('siteDescription', $this->settings->get(SiteSettingKeys::META_DESCRIPTION, __('The online home for your zoo with a clean visitor experience, strong branding, and modern content management.')));
        $view->with('siteAddress', $this->settings->get(SiteSettingKeys::ADDRESS_LINE, ''));
        $view->with('sitePhone', $this->settings->get(SiteSettingKeys::PHONE, ''));
        $view->with('siteEmail', $this->settings->get(SiteSettingKeys::EMAIL, ''));
        $view->with('googleMapsUrl', $this->settings->get(SiteSettingKeys::GOOGLE_MAPS_URL, '#'));
        $view->with('theme', $t);
        $view->with('contentBlocks', $this->settings->contentBlocksKeyed());
        $view->with('socialLinks', SocialLink::query()->orderBy('sort_order', 'asc')->get());
    }
}

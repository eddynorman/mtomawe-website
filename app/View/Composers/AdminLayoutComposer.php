<?php

namespace App\View\Composers;

use App\Models\ContactMessage;
use App\Services\SiteSettingsService;
use App\Support\SiteSettingKeys;
use Illuminate\View\View;

/**
 * Shares admin chrome data: site name for the navbar and unread enquiry counts for the badge.
 */
class AdminLayoutComposer
{
    public function __construct(
        private readonly SiteSettingsService $settings
    ) {}

    public function compose(View $view): void
    {
        $view->with('adminSiteName', $this->settings->get(SiteSettingKeys::SITE_NAME, config('app.name')));
        $view->with('logoPath', $this->settings->get(SiteSettingKeys::SITE_LOGO_PATH, ''));
        $view->with(
            'unreadContactCount',
            ContactMessage::query()->whereNull('read_at')->count()
        );
    }
}

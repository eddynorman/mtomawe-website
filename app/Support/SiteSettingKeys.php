<?php

namespace App\Support;

use App\Models\SiteSetting;

/**
 * Keys stored in the {@see SiteSetting} table so typos are avoided across seeders and forms.
 */
final class SiteSettingKeys
{
    public const SITE_NAME = 'site_name';

    public const ADDRESS_LINE = 'address_line';

    public const PHONE = 'phone';

    public const EMAIL = 'email';

    public const GOOGLE_MAPS_URL = 'google_maps_url';

    public const PRIMARY_COLOR = 'primary_color';

    public const SECONDARY_COLOR = 'secondary_color';

    public const BODY_TEXT_COLOR = 'body_text_color';

    public const HEADING_COLOR = 'heading_color';

    public const FONT_FAMILY_BASE = 'font_family_base';

    public const FONT_FAMILY_HEADING = 'font_family_heading';

    public const FONT_SIZE_BASE_PX = 'font_size_base_px';

    public const SOCIAL_ICON_COLOR = 'social_icon_color';

    public const SITE_LOGO_PATH = 'site_logo_path';

    public const META_DESCRIPTION = 'meta_description';
}

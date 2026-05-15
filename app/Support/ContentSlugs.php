<?php

namespace App\Support;

/**
 * Canonical slugs for {@see \App\Models\ContentBlock} rows used on the landing page and footer.
 */
final class ContentSlugs
{
    public const ABOUT_US = 'about_us';

    public const MISSION = 'mission';

    public const VISION = 'vision';

    public const FOOTER_TAGLINE = 'footer_tagline';

    public const FOOTER_NOTE = 'footer_note';

    /**
     * @return list<string>
     */
    public static function landingSections(): array
    {
        return [
            self::ABOUT_US,
            self::MISSION,
            self::VISION,
        ];
    }
}

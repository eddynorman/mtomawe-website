<?php

namespace App\Support;

/**
 * Curated Font Awesome 6 brand icons for social footer links (fa-brands fa-*).
 *
 * @phpstan-type IconRow array{class: string, glyph: string, label: string}
 */
final class SocialBrandIcons
{
    /**
     * @return list<IconRow>
     */
    public static function all(): array
    {
        return [
            ['class' => 'fa-brands fa-facebook-f', 'glyph' => "\u{f39e}", 'label' => 'Facebook'],
            ['class' => 'fa-brands fa-instagram', 'glyph' => "\u{f16d}", 'label' => 'Instagram'],
            ['class' => 'fa-brands fa-x-twitter', 'glyph' => "\u{e61b}", 'label' => 'X (Twitter)'],
            ['class' => 'fa-brands fa-youtube', 'glyph' => "\u{f167}", 'label' => 'YouTube'],
            ['class' => 'fa-brands fa-linkedin-in', 'glyph' => "\u{f0e1}", 'label' => 'LinkedIn'],
            ['class' => 'fa-brands fa-tiktok', 'glyph' => "\u{e07b}", 'label' => 'TikTok'],
            ['class' => 'fa-brands fa-pinterest', 'glyph' => "\u{f0d2}", 'label' => 'Pinterest'],
            ['class' => 'fa-brands fa-snapchat', 'glyph' => "\u{f2ab}", 'label' => 'Snapchat'],
            ['class' => 'fa-brands fa-whatsapp', 'glyph' => "\u{f232}", 'label' => 'WhatsApp'],
            ['class' => 'fa-brands fa-telegram', 'glyph' => "\u{f2c6}", 'label' => 'Telegram'],
            ['class' => 'fa-brands fa-discord', 'glyph' => "\u{f392}", 'label' => 'Discord'],
            ['class' => 'fa-brands fa-github', 'glyph' => "\u{f09b}", 'label' => 'GitHub'],
            ['class' => 'fa-brands fa-mastodon', 'glyph' => "\u{f4f6}", 'label' => 'Mastodon'],
            ['class' => 'fa-brands fa-threads', 'glyph' => "\u{e618}", 'label' => 'Threads'],
            ['class' => 'fa-brands fa-bluesky', 'glyph' => "\u{e671}", 'label' => 'Bluesky'],
            ['class' => 'fa-brands fa-line', 'glyph' => "\u{f3c0}", 'label' => 'LINE'],
        ];
    }

    /**
     * @return list<string>
     */
    public static function classNames(): array
    {
        return array_map(fn (array $row): string => $row['class'], self::all());
    }

    public static function isAllowed(string $class): bool
    {
        return in_array($class, self::classNames(), true);
    }
}

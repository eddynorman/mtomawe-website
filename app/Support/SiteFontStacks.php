<?php

namespace App\Support;

/**
 * Allowed font-family stacks for site typography (body + headings).
 *
 * Keys are the exact CSS values stored in {@see SiteSettingKeys}.
 *
 * @return array<string, string>
 */
final class SiteFontStacks
{
    /**
     * @return array<string, string> CSS stack => short label for the admin select
     */
    public static function baseStacks(): array
    {
        return [
            "'Segoe UI', system-ui, -apple-system, sans-serif" => __('System UI (Segoe)'),
            "system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif" => __('System UI (Apple first)'),
            "Georgia, 'Times New Roman', serif" => __('Georgia'),
            "Georgia, 'Times New Roman', Times, serif" => __('Georgia + Times'),
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => __('Palatino'),
            "Verdana, Geneva, sans-serif" => __('Verdana'),
            "'Trebuchet MS', 'Lucida Grande', sans-serif" => __('Trebuchet MS'),
            "Tahoma, Geneva, Verdana, sans-serif" => __('Tahoma'),
            "'Courier New', Courier, monospace" => __('Courier'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function headingStacks(): array
    {
        return [
            "Georgia, 'Times New Roman', serif" => __('Georgia'),
            "Georgia, 'Times New Roman', Times, serif" => __('Georgia + Times'),
            "'Times New Roman', Times, serif" => __('Times New Roman'),
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => __('Palatino'),
            "'Segoe UI', system-ui, -apple-system, sans-serif" => __('Segoe (sans headings)'),
            "Baskerville, 'Times New Roman', Times, serif" => __('Baskerville'),
            "Verdana, Geneva, sans-serif" => __('Verdana'),
        ];
    }

    public static function defaultBaseStack(): string
    {
        return array_key_first(self::baseStacks()) ?? "'Segoe UI', system-ui, -apple-system, sans-serif";
    }

    public static function defaultHeadingStack(): string
    {
        return array_key_first(self::headingStacks()) ?? "Georgia, 'Times New Roman', serif";
    }
}

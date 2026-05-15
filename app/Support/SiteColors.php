<?php

namespace App\Support;

/**
 * Normalizes colour values from HTML pickers and legacy data for CSS and validation.
 */
final class SiteColors
{
    public static function normalizeHex(?string $value, string $fallback = '#000000'): string
    {
        if ($value === null) {
            return $fallback;
        }

        $v = strtolower(trim($value));
        if ($v === '') {
            return $fallback;
        }

        if (preg_match('/^#([0-9a-f]{3})$/', $v, $m)) {
            $h = $m[1];

            return '#'.$h[0].$h[0].$h[1].$h[1].$h[2].$h[2];
        }

        if (preg_match('/^#([0-9a-f]{6})[0-9a-f]{0,2}$/', $v, $m)) {
            return '#'.$m[1];
        }

        return $fallback;
    }
}

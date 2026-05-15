<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Resolves stored media paths for both bundled public assets and uploaded files on the public disk.
 */
final class Media
{
    /**
     * Build a URL for an image path saved in the database.
     *
     * Uses root-relative paths so assets load on the same host and port as the current request
     * (avoids broken images when APP_URL does not match how the app is opened, e.g. 127.0.0.1 vs localhost).
     *
     * @param  string|null  $path  Relative to /public (e.g. images/seed/…) or public-disk path (e.g. gallery/…).
     */
    public static function url(?string $path): string
    {
        if ($path === null || $path === '') {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (Str::startsWith($path, 'images/')) {
            return '/'.$path;
        }

        return '/storage/'.$path;
    }
}

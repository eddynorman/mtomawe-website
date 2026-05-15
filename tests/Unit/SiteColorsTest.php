<?php

namespace Tests\Unit;

use App\Support\SiteColors;
use PHPUnit\Framework\TestCase;

class SiteColorsTest extends TestCase
{
    public function test_expands_three_digit_hex(): void
    {
        $this->assertSame('#112233', SiteColors::normalizeHex('#123', '#000000'));
    }

    public function test_strips_alpha_from_eight_digit_hex(): void
    {
        $this->assertSame('#2d6a4f', SiteColors::normalizeHex('#2d6a4fff', '#000000'));
    }

    public function test_returns_fallback_for_invalid(): void
    {
        $this->assertSame('#abcdef', SiteColors::normalizeHex('not-a-color', '#abcdef'));
    }
}

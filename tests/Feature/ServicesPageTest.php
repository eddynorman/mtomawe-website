<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_page_is_displayed(): void
    {
        Service::factory()->create([
            'title' => 'Wildlife Tours',
            'description' => '<p>Expert guided experiences.</p>',
            'is_active' => true,
        ]);

        $response = $this->get('/services');

        $response->assertOk();
        $response->assertSeeText('Wildlife Tours');
        $response->assertSeeText('Expert guided experiences.');
    }

    public function test_sitemap_is_generated(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml');
        $this->assertStringContainsString('<urlset', $response->getContent());
        $this->assertStringContainsString('<loc>'.route('home').'</loc>', $response->getContent());
    }
}

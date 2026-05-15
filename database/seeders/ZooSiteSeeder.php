<?php

namespace Database\Seeders;

use App\Models\CarouselSlide;
use App\Models\ContentBlock;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\User;
use App\Support\ContentSlugs;
use App\Support\SiteSettingKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Seeds the zoo demo dataset: theme settings, CMS copy, carousel, gallery, posts, social links, and an admin user.
 */
class ZooSiteSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('SEED_ADMIN_PASSWORD', 'password');

        User::query()->updateOrCreate(
            ['email' => 'admin@mtomawe-zoo.test'],
            [
                'name' => 'Mtomawe Admin',
                'password' => Hash::make($password),
            ]
        );

        $settings = [
            SiteSettingKeys::SITE_NAME => 'Mtomawe Zoo & Gardens',
            SiteSettingKeys::ADDRESS_LINE => 'Mtomawe, along the river — update this line with your exact postal address.',
            SiteSettingKeys::PHONE => '+254 700 000000',
            SiteSettingKeys::EMAIL => 'hello@mtomawe-zoo.test',
            SiteSettingKeys::GOOGLE_MAPS_URL => 'https://www.google.com/maps/search/?api=1&query=Mtomawe+Zoo+and+Gardens',
            SiteSettingKeys::PRIMARY_COLOR => '#2d6a4f',
            SiteSettingKeys::SECONDARY_COLOR => '#52796f',
            SiteSettingKeys::BODY_TEXT_COLOR => '#1b4332',
            SiteSettingKeys::HEADING_COLOR => '#0d2818',
            SiteSettingKeys::FONT_FAMILY_BASE => "'Segoe UI', system-ui, -apple-system, sans-serif",
            SiteSettingKeys::FONT_FAMILY_HEADING => "Georgia, 'Times New Roman', serif",
            SiteSettingKeys::FONT_SIZE_BASE_PX => '17',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $blocks = [
            [
                'slug' => ContentSlugs::ABOUT_US,
                'label' => 'About us (home page)',
                'body_html' => '<p><strong>Mtomawe Zoo &amp; Gardens</strong> welcomes families, schools, and visitors to explore curated habitats, riverside walks, and seasonal botanical displays.</p><p>Replace this copy anytime from the admin panel — formatting is preserved.</p>',
            ],
            [
                'slug' => ContentSlugs::MISSION,
                'label' => 'Mission',
                'body_html' => '<p>To conserve local biodiversity, educate the public with memorable experiences, and operate a sustainable attraction that benefits the community.</p>',
            ],
            [
                'slug' => ContentSlugs::VISION,
                'label' => 'Vision',
                'body_html' => '<p>A leading nature destination where wildlife thrives, guests leave inspired, and every visit supports long-term stewardship of the land and river corridor.</p>',
            ],
            [
                'slug' => ContentSlugs::FOOTER_TAGLINE,
                'label' => 'Footer tagline',
                'body_html' => '<p class="mb-0 small">Nature. Education. Community.</p>',
            ],
            [
                'slug' => ContentSlugs::FOOTER_NOTE,
                'label' => 'Footer legal / hours note',
                'body_html' => '<p class="small mb-0">Hours and ticketing information can be edited here. © '.date('Y').' Mtomawe Zoo &amp; Gardens.</p>',
            ],
        ];

        foreach ($blocks as $block) {
            ContentBlock::query()->updateOrCreate(
                ['slug' => $block['slug']],
                ['label' => $block['label'], 'body_html' => $block['body_html']]
            );
        }

        SocialLink::query()->delete();
        SocialLink::query()->create([
            'label' => 'Facebook',
            'icon_class' => 'fa-brands fa-facebook-f',
            'url' => 'https://facebook.com/',
            'sort_order' => 0,
        ]);
        SocialLink::query()->create([
            'label' => 'Instagram',
            'icon_class' => 'fa-brands fa-instagram',
            'url' => 'https://instagram.com/',
            'sort_order' => 1,
        ]);

        CarouselSlide::query()->delete();
        $slides = [
            ['title' => 'Riverside trails', 'description' => 'Stroll shaded paths along the water and spot birds at dawn.', 'image_path' => 'images/seed/carousel-riverside.svg', 'sort_order' => 0],
            ['title' => 'Rocky outlooks', 'description' => 'Scenic overlooks inspired by the escarpments near Mtomawe.', 'image_path' => 'images/seed/carousel-rocks.svg', 'sort_order' => 1],
            ['title' => 'Wild encounters', 'description' => 'Ethical habitats designed for animal welfare and learning.', 'image_path' => 'images/seed/carousel-wildlife.svg', 'sort_order' => 2],
        ];
        foreach ($slides as $row) {
            CarouselSlide::query()->create($row + ['is_active' => true]);
        }

        GalleryCategory::query()->delete();
        $catGardens = GalleryCategory::query()->create(['name' => 'Gardens', 'slug' => 'gardens', 'sort_order' => 0]);
        $catRiver = GalleryCategory::query()->create(['name' => 'River & wetlands', 'slug' => 'river', 'sort_order' => 1]);
        $catWildlife = GalleryCategory::query()->create(['name' => 'Wildlife', 'slug' => 'wildlife', 'sort_order' => 2]);

        $images = [
            [$catGardens->id, 'Shaded pathways', 'images/seed/gallery-gardens.svg', 0],
            [$catRiver->id, 'River bend boardwalk', 'images/seed/gallery-river.svg', 0],
            [$catWildlife->id, 'Canopy lookout', 'images/seed/gallery-canopy.svg', 0],
        ];
        foreach ($images as [$cid, $heading, $path, $order]) {
            GalleryImage::query()->create([
                'gallery_category_id' => $cid,
                'heading' => $heading,
                'image_path' => $path,
                'sort_order' => $order,
            ]);
        }

        Post::query()->delete();
        $admin = User::query()->where('email', 'admin@mtomawe-zoo.test')->first();
        Post::query()->create([
            'user_id' => $admin?->id,
            'title' => 'Welcome to our new website',
            'slug' => 'welcome-to-our-new-website',
            'excerpt' => 'We are excited to share news, events, and conservation updates here.',
            'body_html' => '<p>This is a sample announcement with <strong>rich text</strong>. Edit or delete it from the admin posts screen.</p><ul><li>Share opening hours</li><li>Highlight school programmes</li><li>Celebrate new arrivals in the gardens</li></ul>',
            'published_at' => now()->subDay(),
            'is_published' => true,
        ]);
        Post::query()->create([
            'user_id' => $admin?->id,
            'title' => 'Photography tips for visitors',
            'slug' => 'photography-tips-for-visitors',
            'excerpt' => 'Get the best shots while respecting wildlife and other guests.',
            'body_html' => '<p>Soft morning light along the river makes for stunning photographs. Please disable flash near animal habitats.</p>',
            'published_at' => now()->subHours(6),
            'is_published' => true,
        ]);
    }
}

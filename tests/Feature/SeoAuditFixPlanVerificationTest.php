<?php

namespace Tests\Feature;

use App\Models\OdooPage;
use App\Models\Post;
use App\Models\Product;
use App\Models\RedirectRule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoAuditFixPlanVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function test_product_schema_includes_offers_and_deduplicated_images(): void
    {
        $product = Product::create([
            'title' => 'Diesel Generator 500 kVA',
            'slug' => 'diesel-generator-500-kva',
            'summary' => 'Heavy duty 500 kVA silent diesel generator for commercial hire.',
            'content' => '<p>High-efficiency unit <img src="/storage/media/rental-generator.webp"></p>',
            'status' => 'published',
            'is_indexable' => true,
            'featured_image' => 'storage/media/rental-generator.webp',
        ]);

        $response = $this->get(route('fleet.show', $product->slug));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('"@type": "Product"', $html);
        $this->assertStringContainsString('"offers": {', $html);
        $this->assertStringContainsString('"@type": "Offer"', $html);
        $this->assertStringContainsString('"priceCurrency": "AED"', $html);
        $this->assertStringContainsString('"availability": "https://schema.org/InStock"', $html);
        $this->assertStringContainsString('http://purl.org/goodrelations/v1#LeaseOut', $html);

        // Verify images array is present and without duplicate consecutive URLs
        preg_match('/"image":\s*\[(.*?)\]/s', $html, $imageMatches);
        $this->assertNotEmpty($imageMatches[1] ?? null);
        $images = json_decode('['.$imageMatches[1].']', true);
        $this->assertIsArray($images);
        $this->assertCount(count(array_unique($images)), $images, 'Schema image array must be strictly de-duplicated');
    }

    public function test_consolidated_duplicate_blog_pairs_redirect_301_and_drop_from_sitemap(): void
    {
        // 1. Create winner and loser posts
        $winner = Post::create([
            'user_id' => $this->admin->id,
            'title' => 'Rental Chiller vs Portable AC for Commercial Buildings in the UAE',
            'slug' => 'rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae',
            'content' => '<p>Canonical comprehensive guide.</p>',
            'status' => 'published',
            'is_indexable' => true,
            'published_at' => now(),
        ]);

        $loser = Post::create([
            'user_id' => $this->admin->id,
            'title' => 'Rental Chiller vs Portable AC for Commercial Buildings',
            'slug' => 'rental-chiller-vs-portable-ac-for-commercial-buildings',
            'content' => '<p>Duplicate variant.</p>',
            'status' => 'draft',
            'is_indexable' => false,
            'published_at' => now(),
        ]);

        RedirectRule::create([
            'source_url' => '/rental-chiller-vs-portable-ac-for-commercial-buildings',
            'target_url' => '/rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae',
            'status_code' => 301,
            'match_type' => 'exact',
            'is_active' => true,
        ]);
        RedirectRule::clearCache();

        // 2. Accessing loser URL returns HTTP 301 to winner
        $redirectResponse = $this->get('/rental-chiller-vs-portable-ac-for-commercial-buildings');
        $redirectResponse->assertStatus(301);
        $redirectResponse->assertRedirect('/rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae');

        // 3. Sitemap includes winner but excludes loser
        $sitemapResponse = $this->get('/sitemap-posts.xml');
        $sitemapResponse->assertStatus(200);
        $sitemapContent = $sitemapResponse->getContent();

        $this->assertStringContainsString('rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae', $sitemapContent);
        $this->assertStringNotContainsString('rental-chiller-vs-portable-ac-for-commercial-buildings<', $sitemapContent);
    }

    public function test_service_pairs_render_prominent_differentiation_callouts(): void
    {
        $maintenance = Service::create([
            'title' => 'Generator Maintenance UAE',
            'slug' => 'generator-maintenance-uae',
            'content' => '<p>Intro paragraph.</p><div data-diff="generator-amc"><a href="/service/generator-amc-uae">Explore Generator AMC Packages in UAE</a></div><p>Body.</p>',
            'status' => 'published',
        ]);

        $amc = Service::create([
            'title' => 'Generator AMC in UAE',
            'slug' => 'generator-amc-uae',
            'content' => '<p>Intro paragraph.</p><div data-diff="generator-maintenance"><a href="/service/generator-maintenance-uae">View Generator Maintenance & Repairs</a></div><p>Body.</p>',
            'status' => 'published',
        ]);

        $mResponse = $this->get(route('service.show', $maintenance->slug));
        $mResponse->assertStatus(200);
        $mResponse->assertSee('data-diff="generator-amc"', false);
        $mResponse->assertSee('/service/generator-amc-uae');

        $amcResponse = $this->get(route('service.show', $amc->slug));
        $amcResponse->assertStatus(200);
        $amcResponse->assertSee('data-diff="generator-maintenance"', false);
        $amcResponse->assertSee('/service/generator-maintenance-uae');
    }

    public function test_odoo_page_noindex_and_excluded_from_sitemap_when_not_indexable(): void
    {
        $odoo = OdooPage::create([
            'is_indexable' => false,
            'meta_title' => 'Odoo ERP Implementation Partner',
        ]);

        $response = $this->get(route('odoo.index'));
        $response->assertStatus(200);
        $response->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        $sitemapResponse = $this->get('/sitemap-pages.xml');
        $sitemapResponse->assertStatus(200);
        $this->assertStringNotContainsString('/odoo', $sitemapResponse->getContent());
    }

    public function test_organization_schema_has_english_language_only(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertStringContainsString('"availableLanguage": [', $html);
        $this->assertStringContainsString('"English"', $html);
        $this->assertStringNotContainsString('"Arabic"', $html);
        $this->assertStringNotContainsString('b-1.jpg', $html);
    }
}

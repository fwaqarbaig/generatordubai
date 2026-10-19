<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_page_loads_with_empty_query(): void
    {
        $response = $this->get(route('search'));

        $response->assertStatus(200);
        $response->assertSee('Find Rental Power & Cooling Solutions', false);
        $response->assertSee('Search diesel generators');
        $response->assertSee('name="q"', false);
    }

    public function test_header_contains_interactive_search_input_and_phone_hotline(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        // Ensure search input exists and has type="text", name="q", and placeholder
        $response->assertSee('name="q"', false);
        $response->assertSee('placeholder="Search fleet, services..."', false);
        // Ensure phone hotline button is properly rendered with phone number
        $response->assertSee('+971 56 921 3754');
        $response->assertSee('tel:+971569213754');
    }

    public function test_search_finds_matching_products_and_generators(): void
    {
        Product::create([
            'title' => '500 kVA Cummins Heavy Duty Diesel Generator',
            'slug' => '500-kva-generator-rental',
            'badge' => '500 kVA',
            'category' => 'Generator',
            'status' => 'published',
            'summary' => 'Prime power rating 500 kVA / 400 kW diesel generator.',
            'content' => 'High performance soundproof generator for UAE rental.',
        ]);

        $response = $this->get(route('search', ['q' => '500 kVA']));

        $response->assertStatus(200);
        $response->assertSee('500 kVA Cummins Heavy Duty Diesel Generator');
        $response->assertSee(route('fleet.show', '500-kva-generator-rental'));
    }

    public function test_search_finds_matching_services(): void
    {
        Service::create([
            'title' => 'Emergency Rental Cooling Solutions UAE',
            'slug' => 'rental-cooling',
            'hero_badge' => 'Chillers & AC',
            'status' => 'published',
            'summary' => 'Turnkey industrial cooling and temporary air conditioning.',
            'content' => 'Comprehensive cooling solutions for UAE climate.',
        ]);

        $response = $this->get(route('search', ['q' => 'Cooling Solutions']));

        $response->assertStatus(200);
        $response->assertSee('Emergency Rental Cooling Solutions UAE');
        $response->assertSee(route('service.show', 'rental-cooling'));
    }

    public function test_search_finds_matching_blog_posts(): void
    {
        $user = User::factory()->create();

        Post::create([
            'user_id' => $user->id,
            'title' => 'Generator Sizing Guide for Dubai Construction Sites',
            'slug' => 'generator-sizing-guide-dubai',
            'status' => 'published',
            'excerpt' => 'How to size generators from 50 to 1250 kVA.',
            'content' => 'Technical sizing calculations for construction power in Dubai.',
            'published_at' => now(),
        ]);

        $response = $this->get(route('search', ['q' => 'Sizing Guide']));

        $response->assertStatus(200);
        $response->assertSee('Generator Sizing Guide for Dubai Construction Sites');
        $response->assertSee(route('post.show', 'generator-sizing-guide-dubai'));
    }
}

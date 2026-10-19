<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YoastSeoScoreCalculatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_calculator_computes_good_score_for_complete_seo_data(): void
    {
        $calculator = app(YoastSeoScoreCalculator::class);

        $result = $calculator->calculate(
            keyword: 'rental generator in uae',
            title: 'Rental Generator in UAE | 20 kVA - 1500 kVA Power Hire',
            description: 'Reliable rental generator in UAE from 20 kVA to 1500 kVA. Fast emergency 24/7 delivery across Dubai, Abu Dhabi & Sharjah. Call +971 56 996 0090.',
            slug: 'rental-generator-in-uae',
            content: '<h2>Industrial Power Generation</h2><p>Our rental generator in UAE provides prime power for construction sites and critical operations.</p><h3>High Reliability</h3><p>Soundproof diesel units engineered for extreme desert climate conditions and heavy workloads with continuous maintenance support.</p>'
        );

        $this->assertGreaterThanOrEqual(80, $result['seo_score']);
        $this->assertEquals('good', $result['rating']);
        $this->assertNotEmpty($result['checks']);
    }

    public function test_calculator_flags_missing_keyword_and_thin_content(): void
    {
        $calculator = app(YoastSeoScoreCalculator::class);

        $result = $calculator->calculate(
            keyword: '',
            title: 'Short',
            description: '',
            slug: 'short',
            content: ''
        );

        $this->assertLessThan(50, $result['seo_score']);
        $this->assertEquals('poor', $result['rating']);
    }

    public function test_has_yoast_seo_trait_auto_calculates_on_saving(): void
    {
        $service = Service::create([
            'title' => 'Emergency Temporary Cooling UAE',
            'slug' => 'emergency-temporary-cooling-uae',
            'summary' => 'Emergency cooling across Dubai',
            'content' => '<h2>Rapid Chilled Air</h2><p>Emergency temporary cooling UAE for industrial facilities experiencing HVAC outages.</p><h3>Fast Mobilization</h3><p>Heavy duty packaged units delivered within two hours across the Emirates with certified technicians.</p>',
            'status' => 'published',
            'order' => 1,
            'focus_keyword' => 'emergency temporary cooling uae',
            'meta_title' => 'Emergency Temporary Cooling UAE | 24/7 Fast Response',
            'meta_description' => 'Fast emergency temporary cooling UAE for plants and commercial facilities. Instant delivery across Dubai and Abu Dhabi. Call +971 56 996 0090.',
            'seo_score' => 0, // Unset, should auto-calculate!
        ]);

        $this->assertGreaterThanOrEqual(80, $service->seo_score);
        $this->assertEquals('good', $service->seo_rating);
    }

    public function test_recalculate_seo_scores_artisan_command(): void
    {
        Service::create([
            'title' => 'Rental Chiller UAE',
            'slug' => 'rental-chiller-uae',
            'summary' => 'Chiller units for rent',
            'content' => '<h2>Industrial Chillers</h2><p>Rental chiller UAE units from 50 to 500 tons for process and comfort cooling applications.</p>',
            'status' => 'published',
            'order' => 1,
            'focus_keyword' => 'rental chiller uae',
            'meta_title' => 'Rental Chiller UAE | High-Efficiency Water & Air Chillers',
            'meta_description' => 'Rent industrial water-cooled and air-cooled chillers across UAE with 24/7 technical monitoring and maintenance. Call +971 56 996 0090.',
            'seo_score' => 0,
        ]);

        $this->artisan('seo:recalculate-scores', ['--model' => 'services'])
            ->assertExitCode(0);
    }
}

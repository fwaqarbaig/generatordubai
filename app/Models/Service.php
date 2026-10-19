<?php

namespace App\Models;

use App\Models\Traits\HasFeaturedImageSeo;
use App\Models\Traits\HasYoastSeo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    use HasFeaturedImageSeo;
    use HasYoastSeo;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'hero_badge',
        'icon',
        'summary',
        'content',
        'features',
        'benefits',
        'benchmarks',
        'featured_image',
        'status',
        'order',
        'is_featured',
        'focus_keyword',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'is_indexable',
        'seo_score',
        'readability_score',
        'schema_markup',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'benefits' => 'array',
            'benchmarks' => 'array',
            'is_featured' => 'boolean',
            'is_indexable' => 'boolean',
            'order' => 'integer',
            'seo_score' => 'integer',
            'readability_score' => 'integer',
        ];
    }

    /**
     * Determine if this service belongs to cooling/HVAC/chillers.
     */
    public function isCooling(): bool
    {
        $coolingSlugs = [
            'rental-cooling', 'rental-chiller-in-uae', 'rental-ac-in-uae',
            'packaged-ac-units-rental-uae', 'wild-air-in-uae',
            'temporary-cooling-in-uae', 'industrial-chiller-rental-uae',
            'chiller-maintenance',
        ];

        return $this->category === 'cooling' ||
               in_array($this->slug, $coolingSlugs) ||
               str_contains($this->slug, 'chiller') ||
               str_contains($this->slug, 'cooling') ||
               str_contains($this->slug, 'ac-');
    }

    /**
     * Determine if this service belongs to generators / power.
     */
    public function isPower(): bool
    {
        $powerSlugs = [
            'rental-generator-in-uae', 'honda-generator-rental-uae',
            'caterpillar-generator-rental-uae', 'cummins-generator-rental-uae',
            'rental-power', 'power-plant',
        ];

        return $this->category === 'generator' ||
               $this->category === 'power' ||
               in_array($this->slug, $powerSlugs) ||
               str_contains($this->slug, 'generator') ||
               str_contains($this->slug, 'power');
    }

    /**
     * Determine if this service belongs to buy/sell, portacabins, containers, caravans.
     */
    public function isTrading(): bool
    {
        $tradingSlugs = [
            'portacabin-for-sale-in-uae', 'used-container-in-uae',
            'used-caravan-in-uae', 'used-chiller-in-uae',
            'used-chiller-ac-buyer-in-uae', 'buy-sell',
        ];

        return $this->category === 'buy-sell' ||
               $this->category === 'trading' ||
               in_array($this->slug, $tradingSlugs) ||
               str_contains($this->slug, 'portacabin') ||
               str_contains($this->slug, 'container') ||
               str_contains($this->slug, 'caravan') ||
               str_contains($this->slug, 'used-');
    }

    /**
     * Get effective hero badge with standard default.
     */
    public function getEffectiveHeroBadgeAttribute(): string
    {
        if ($this->hero_badge) {
            return $this->hero_badge;
        }

        if ($this->isCooling()) {
            return '50 TR to 1500 TR Modular Chiller Fleet • 52°C Desert Tropicalized • 2-Hour Rapid Dispatch';
        }

        if ($this->isTrading()) {
            return 'Modular Site Infrastructure • Heavy-Duty Steel Chassis • Turnkey Buy & Sell in UAE';
        }

        return 'UAE Commercial Power Hub • ISO 8528 Certified Diesel Gensets • 24/7 Rapid Dispatch';
    }

    /**
     * Get effective benchmarks array with lab defaults.
     */
    public function getEffectiveBenchmarksAttribute(): array
    {
        $defaults = [
            'standard' => 'ISO 8528-1:2018 / DEWA & ADDC Compliant',
            'evaluation' => 'Free Site Assessment & kVA Sizing',
            'guarantee' => '99.98% Power Uptime & Rapid Replacement SLA',
            'turnaround' => '2-Hour Emergency Mobilization Across 7 Emirates',
            'support' => '24/7 On-Site Mechanical & Electrical Support',
        ];

        return array_merge($defaults, is_array($this->benchmarks) ? $this->benchmarks : []);
    }

    /**
     * Scope for published services.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for featured services.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope ordered by custom order index.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Featured image URL accessor.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (! $this->featured_image) {
            return null;
        }

        if (str_starts_with($this->featured_image, 'http')) {
            return $this->featured_image;
        }

        if (str_starts_with($this->featured_image, '/storage/')) {
            return asset(ltrim($this->featured_image, '/'));
        }

        if (str_starts_with($this->featured_image, 'storage/')) {
            return asset($this->featured_image);
        }

        return asset('storage/'.ltrim($this->featured_image, '/'));
    }

    /**
     * SEO Title fallback.
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: ($this->title.' - '.config('app.name', 'Rental Power UAE'));
    }

    /**
     * SEO Description fallback.
     */
    public function getSeoDescriptionAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
        }

        if ($this->summary) {
            return Str::limit(strip_tags($this->summary), 160);
        }

        return Str::limit(strip_tags($this->content ?? ''), 160);
    }

    /**
     * SEO Image fallback.
     */
    public function getSeoImageAttribute(): string
    {
        $image = $this->og_image ?: $this->featured_image;

        if (! $image) {
            return asset('storage/media/rental-generator.webp');
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, '/storage/')) {
            return asset(ltrim($image, '/'));
        }

        if (str_starts_with($image, 'storage/')) {
            return asset($image);
        }

        return asset('storage/'.ltrim($image, '/'));
    }

    /**
     * Automatically generate unique slug.
     */
    public static function createUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    /**
     * Extract structured FAQs from service content for Schema.org JSON-LD.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    public function getFaqsAttribute(): array
    {
        if (empty($this->content)) {
            return [];
        }

        $faqs = [];

        // 1. Try matching <details><summary>Question</summary><div>Answer</div></details>
        if (preg_match_all('/<details[^>]*>\s*<summary[^>]*>(.*?)<\/summary>\s*<div[^>]*>(.*?)<\/div>\s*<\/details>/is', $this->content, $detailMatches)) {
            foreach ($detailMatches[1] as $index => $rawQuestion) {
                // Remove arrows like ▼ or icons
                $cleanQ = preg_replace('/[▼▲►▼]/u', '', strip_tags($rawQuestion));
                $cleanQ = trim($cleanQ);
                $cleanA = trim(strip_tags($detailMatches[2][$index] ?? ''));
                if ($cleanQ !== '' && $cleanA !== '') {
                    $faqs[] = [
                        'question' => $cleanQ,
                        'answer' => $cleanA,
                    ];
                }
            }
        }

        // 2. Fallback or additional: <h3/h4>Question?</h3/h4><p>Answer</p>
        if (empty($faqs)) {
            preg_match_all('/<h[34][^>]*>([^<]*\?[^<]*)<\/h[34]>\s*<p[^>]*>(.*?)<\/p>/is', $this->content, $headingMatches);
            if (! empty($headingMatches[1])) {
                foreach ($headingMatches[1] as $index => $question) {
                    $q = trim(strip_tags($question));
                    $a = trim(strip_tags($headingMatches[2][$index] ?? ''));
                    if ($q !== '' && $a !== '') {
                        $faqs[] = [
                            'question' => $q,
                            'answer' => $a,
                        ];
                    }
                }
            }
        }

        return $faqs;
    }
}

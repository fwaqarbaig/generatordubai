<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

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
     * Get effective hero badge with standard default.
     */
    public function getEffectiveHeroBadgeAttribute(): string
    {
        return $this->hero_badge ?: 'UAE Commercial Power Hub • ISO 8528 Certified Diesel Gensets';
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
        return $this->meta_title ?: ($this->title.' - Generator Dubai');
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
    public function getSeoImageAttribute(): ?string
    {
        return $this->og_image ?: $this->featured_image_url;
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

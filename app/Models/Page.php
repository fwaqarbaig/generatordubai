<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'template',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'is_indexable',
        'focus_keyword',
        'seo_score',
        'readability_score',
        'schema_markup',
    ];

    protected function casts(): array
    {
        return [
            'is_indexable' => 'boolean',
            'seo_score' => 'integer',
            'readability_score' => 'integer',
        ];
    }

    /**
     * Author relationship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Generator Dubai Engineering Team',
            'email' => 'hello@generatordubai.com',
        ]);
    }

    /**
     * Scope for published pages.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
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
        return $this->meta_title ?: $this->title;
    }

    /**
     * SEO Description fallback.
     */
    public function getSeoDescriptionAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
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
}

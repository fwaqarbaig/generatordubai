<?php

namespace App\Models;

use App\Models\Traits\HasFeaturedImageSeo;
use App\Models\Traits\HasYoastSeo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use HasFeaturedImageSeo;
    use HasYoastSeo;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
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
            'published_at' => 'datetime',
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
            'name' => 'Rental Power Engineering Team',
            'email' => 'sales@rentalpower.ae',
        ]);
    }

    /**
     * Post categories.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Post tags.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope for published posts.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for searching posts.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('excerpt', 'like', "%{$term}%")
                ->orWhere('content', 'like', "%{$term}%");
        });
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
     * Estimated reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->content ?? ''));

        return max(1, (int) ceil($words / 200));
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

        if ($this->excerpt) {
            return Str::limit(strip_tags($this->excerpt), 160);
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
}

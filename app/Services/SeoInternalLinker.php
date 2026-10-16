<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class SeoInternalLinker
{
    /**
     * Map a blog post to its most relevant commercial power service.
     */
    public function matchServiceForPost(Post $post): ?Service
    {
        $services = Service::published()->get();

        if ($services->isEmpty()) {
            return null;
        }

        $categoriesText = $post->relationLoaded('categories')
            ? $post->categories->pluck('name')->join(' ')
            : $post->categories()->pluck('name')->join(' ');

        $haystack = strtolower(
            $post->title.' '.
            $post->slug.' '.
            $categoriesText.' '.
            Str::limit(strip_tags((string) $post->content), 300)
        );

        if (str_contains($haystack, 'portacabin') || str_contains($haystack, 'cabin') || str_contains($haystack, 'site office')) {
            $service = $services->firstWhere('slug', 'portacabin');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'ats') || str_contains($haystack, 'switch') || str_contains($haystack, 'distribution') || str_contains($haystack, 'cables') || str_contains($haystack, 'wiring')) {
            $service = $services->firstWhere('slug', 'we-offer');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'plant') || str_contains($haystack, 'synchronized') || str_contains($haystack, 'multi-megawatt') || str_contains($haystack, 'mw') || str_contains($haystack, 'grid')) {
            $service = $services->firstWhere('slug', 'power-plant');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'amc') || str_contains($haystack, 'contract') || str_contains($haystack, 'preventive')) {
            $service = $services->firstWhere('slug', 'amc-generator');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'repair') || str_contains($haystack, 'overhaul') || str_contains($haystack, 'maintenance') || str_contains($haystack, 'breakdown') || str_contains($haystack, 'cooling') || str_contains($haystack, '50c')) {
            $service = $services->firstWhere('slug', 'maintenance');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'used') || str_contains($haystack, 'refurbished') || str_contains($haystack, 'buy') || str_contains($haystack, 'sell')) {
            $service = $services->firstWhere('slug', 'used-refurbished-generators');
            if ($service) {
                return $service;
            }
        }

        if (str_contains($haystack, 'sales') || str_contains($haystack, 'purchase') || str_contains($haystack, 'new generator')) {
            $service = $services->firstWhere('slug', 'new-generators');
            if ($service) {
                return $service;
            }
        }

        return $services->firstWhere('slug', 'rental-power') ?? $services->first();
    }

    /**
     * Get related technical articles for a specific power service.
     *
     * @return Collection<int, Post>
     */
    public function getRelatedPostsForService(Service $service, int $limit = 3): Collection
    {
        $keywords = match ($service->slug) {
            'portacabin' => ['portacabin', 'cabin', 'site office', 'wiring'],
            'we-offer' => ['ats', 'switch', 'distribution', 'electrical'],
            'power-plant' => ['power plant', 'synchronized', 'prime', 'standby', 'mw'],
            'amc-generator' => ['amc', 'maintenance', 'preventive', 'oil'],
            'maintenance' => ['maintenance', 'repair', '50c', 'high ambient', 'cooling'],
            'used-refurbished-generators' => ['used', 'refurbished', 'fuel', 'sizing'],
            'new-generators' => ['kva', 'sizing', 'prime', 'standby'],
            default => ['generator', 'rental', 'diesel', 'fuel', 'sizing'],
        };

        $query = Post::published()
            ->with(['user', 'categories'])
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('title', 'like', "%{$kw}%");
                }
            })
            ->latest('published_at');

        $posts = $query->take($limit)->get();

        if ($posts->count() < $limit) {
            $missing = $limit - $posts->count();
            $fallbackPosts = Post::published()
                ->whereNotIn('id', $posts->pluck('id'))
                ->with(['user', 'categories'])
                ->latest('published_at')
                ->take($missing)
                ->get();

            $posts = $posts->merge($fallbackPosts);
        }

        return $posts;
    }
}

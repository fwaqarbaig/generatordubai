<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Excluded slugs for internal redirects or dedicated system routes.
     */
    protected const EXCLUDED_PAGE_SLUGS = [
        'home',
        'services',
        'about',
        'about-us',
        'contact',
        'contact-us',
        'fleet',
        'products',
        'used-generators',
        'used-refurbished-generators',
        'industries',
        'locations',
    ];

    /**
     * Master XML sitemap containing all indexable pages, services, categories, and articles.
     */
    public function index(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_master_xml'), 3600, function (): string {
            $entries = array_merge(
                $this->getPagesEntries(),
                $this->getProductsEntries(),
                $this->getServicesEntries(),
                $this->getCategoriesEntries(),
                $this->getPostsEntries()
            );

            return $this->buildUrlsetXml($entries);
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Master XML sitemap index referencing specialized sub-sitemaps.
     */
    public function sitemapIndex(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_index_xml'), 3600, function (): string {
            $sitemaps = [
                [
                    'loc' => $this->formatSitemapUrl(route('sitemap.pages')),
                    'lastmod' => now()->toAtomString(),
                ],
                [
                    'loc' => $this->formatSitemapUrl(route('sitemap.products')),
                    'lastmod' => Product::where('status', 'published')->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                ],
                [
                    'loc' => $this->formatSitemapUrl(route('sitemap.services')),
                    'lastmod' => Service::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                ],
                [
                    'loc' => $this->formatSitemapUrl(route('sitemap.categories')),
                    'lastmod' => Category::latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                ],
                [
                    'loc' => $this->formatSitemapUrl(route('sitemap.posts')),
                    'lastmod' => Post::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
                ],
            ];

            return $this->buildIndexXml($sitemaps);
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dedicated XML sitemap for diesel generator fleet products.
     */
    public function products(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_products_xml'), 3600, function (): string {
            return $this->buildUrlsetXml($this->getProductsEntries());
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dedicated XML sitemap for blog posts and technical articles.
     */
    public function posts(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_posts_xml'), 3600, function (): string {
            return $this->buildUrlsetXml($this->getPostsEntries());
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dedicated XML sitemap for static and CMS pages.
     */
    public function pages(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_pages_xml'), 3600, function (): string {
            return $this->buildUrlsetXml($this->getPagesEntries());
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dedicated XML sitemap for blog categories with active content.
     */
    public function categories(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_categories_xml'), 3600, function (): string {
            return $this->buildUrlsetXml($this->getCategoriesEntries());
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dedicated XML sitemap for commercial generator power services.
     */
    public function services(): Response
    {
        $xml = Cache::remember($this->getCacheKey('sitemap_services_xml'), 3600, function (): string {
            return $this->buildUrlsetXml($this->getServicesEntries());
        });

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
        ]);
    }

    /**
     * Dynamic robots.txt response.
     */
    public function robots(): Response
    {
        $sitemapUrl = $this->formatSitemapUrl(route('sitemap'));
        $sitemapIndexUrl = $this->formatSitemapUrl(route('sitemap.index'));
        $sitemapPagesUrl = $this->formatSitemapUrl(route('sitemap.pages'));
        $sitemapProductsUrl = $this->formatSitemapUrl(route('sitemap.products'));
        $sitemapServicesUrl = $this->formatSitemapUrl(route('sitemap.services'));
        $sitemapPostsUrl = $this->formatSitemapUrl(route('sitemap.posts'));
        $sitemapCategoriesUrl = $this->formatSitemapUrl(route('sitemap.categories'));

        $content = <<<ROBOTS
# robots.txt for Generator Dubai
# Website: https://generatordubai.com

User-agent: *
Allow: /
Allow: /images/
Allow: /storage/
Allow: /build/
Allow: /css/
Allow: /js/
Disallow: /admin
Disallow: /admin/
Disallow: /login
Disallow: /login/
Disallow: /register
Disallow: /register/
Disallow: /password/
Disallow: /api/
Disallow: /storage/framework/

# Sitemaps
Sitemap: {$sitemapUrl}
Sitemap: {$sitemapIndexUrl}
Sitemap: {$sitemapPagesUrl}
Sitemap: {$sitemapProductsUrl}
Sitemap: {$sitemapServicesUrl}
Sitemap: {$sitemapPostsUrl}
Sitemap: {$sitemapCategoriesUrl}
ROBOTS;

        return response(trim($content)."\n", 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
        ]);
    }

    /**
     * Compile page entries for sitemaps.
     */
    protected function getPagesEntries(): array
    {
        $pages = Page::where('status', 'published')
            ->where('is_indexable', true)
            ->whereNotIn('slug', self::EXCLUDED_PAGE_SLUGS)
            ->latest('updated_at')
            ->get();

        $entries = [];

        // Core High-Priority Landing Pages
        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('home')),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0',
            'image' => [
                'loc' => $this->formatSitemapUrl('/images/logo.png'),
                'title' => 'Generator Dubai - Generator Rental & Commercial Power Dubai',
            ],
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('fleet.index')),
            'lastmod' => Product::where('status', 'published')->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.95',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('service.index')),
            'lastmod' => Service::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('page.used-generators')),
            'lastmod' => now()->subDays(2)->toAtomString(),
            'changefreq' => 'weekly',
            'priority' => '0.85',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('page.industries')),
            'lastmod' => now()->subDays(2)->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.85',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('locations.index')),
            'lastmod' => now()->subDays(2)->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.85',
        ];

        // UAE Regional Depot Landing Pages (dynamically resolved from locations.json to guarantee 200 OK)
        $locationsPath = storage_path('locations.json');
        $cities = file_exists($locationsPath)
            ? array_column(json_decode(file_get_contents($locationsPath), true) ?: [], 'slug')
            : ['dubai', 'abu-dhabi', 'sharjah', 'ajman', 'ras-al-khaimah', 'fujairah', 'umm-al-quwain', 'oman'];

        foreach ($cities as $city) {
            $entries[] = [
                'loc' => $this->formatSitemapUrl(route('locations.show', $city)),
                'lastmod' => now()->subDays(2)->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('about')),
            'lastmod' => now()->subDays(3)->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('contact')),
            'lastmod' => now()->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('blog.index')),
            'lastmod' => Post::published()->latest('updated_at')->first()?->updated_at?->toAtomString() ?? now()->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '0.8',
        ];

        $entries[] = [
            'loc' => $this->formatSitemapUrl(route('odoo.index')),
            'lastmod' => now()->subDays(5)->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.3',
        ];

        // Standalone CMS Pages
        foreach ($pages as $page) {
            $entry = [
                'loc' => $this->formatSitemapUrl('/'.$page->slug),
                'lastmod' => $page->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];

            if ($page->featured_image) {
                $imgUrl = str_starts_with($page->featured_image, 'http')
                    ? $page->featured_image
                    : asset('storage/'.$page->featured_image);

                $entry['image'] = [
                    'loc' => $this->formatSitemapUrl($imgUrl),
                    'title' => $page->title,
                ];
            }

            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * Compile generator fleet / product entries for sitemaps.
     */
    protected function getProductsEntries(): array
    {
        $products = Product::where('status', 'published')
            ->latest('updated_at')
            ->get();

        $entries = [];
        foreach ($products as $product) {
            $entry = [
                'loc' => $this->formatSitemapUrl(route('fleet.show', $product->slug)),
                'lastmod' => $product->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];

            if ($product->featured_image_url) {
                $entry['image'] = [
                    'loc' => $this->formatSitemapUrl($product->featured_image_url),
                    'title' => $product->title.' - Generator Dubai Fleet',
                ];
            }

            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * Compile commercial service entries for sitemaps.
     */
    protected function getServicesEntries(): array
    {
        $services = Service::published()->latest('updated_at')->get();

        $entries = [];
        foreach ($services as $service) {
            $entry = [
                'loc' => $this->formatSitemapUrl(route('service.show', $service->slug)),
                'lastmod' => $service->updated_at?->toAtomString() ?? now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];

            if ($service->image_url) {
                $entry['image'] = [
                    'loc' => $this->formatSitemapUrl($service->image_url),
                    'title' => $service->title.' - Generator Dubai',
                ];
            }

            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * Compile published blog posts entries for sitemaps.
     */
    protected function getPostsEntries(): array
    {
        $posts = Post::published()
            ->where('is_indexable', true)
            ->latest('updated_at')
            ->get();

        $entries = [];
        foreach ($posts as $post) {
            $entry = [
                'loc' => $this->formatSitemapUrl(route('post.show', $post->slug)),
                'lastmod' => ($post->updated_at ?? $post->published_at ?? now())->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];

            if ($post->featured_image_url) {
                $entry['image'] = [
                    'loc' => $this->formatSitemapUrl($post->featured_image_url),
                    'title' => $post->title,
                ];
            }

            $entries[] = $entry;
        }

        return $entries;
    }

    /**
     * Compile active category entries for sitemaps.
     */
    protected function getCategoriesEntries(): array
    {
        $categories = Category::has('publishedPosts')
            ->with(['publishedPosts' => fn ($q) => $q->latest('updated_at')->take(1)])
            ->get();

        $entries = [];
        foreach ($categories as $category) {
            $latestPost = $category->publishedPosts->first();
            $lastmod = $latestPost?->updated_at?->toAtomString() ?? $category->updated_at?->toAtomString() ?? now()->toAtomString();

            $entries[] = [
                'loc' => $this->formatSitemapUrl(route('category.show', $category->slug)),
                'lastmod' => $lastmod,
                'changefreq' => 'weekly',
                'priority' => '0.6',
            ];
        }

        return $entries;
    }

    /**
     * Build valid XML urlset string with optional Google image extensions.
     */
    protected function buildUrlsetXml(array $entries): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">'."\n";

        foreach ($entries as $entry) {
            $loc = $this->formatSitemapUrl($entry['loc']);
            $xml .= "  <url>\n";
            $xml .= '    <loc>'.htmlspecialchars($loc, ENT_XML1, 'UTF-8')."</loc>\n";
            $xml .= "    <lastmod>{$entry['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$entry['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$entry['priority']}</priority>\n";

            if (! empty($entry['image']) && ! empty($entry['image']['loc'])) {
                $imageLoc = $this->formatSitemapUrl($entry['image']['loc']);
                $xml .= "    <image:image>\n";
                $xml .= '      <image:loc>'.htmlspecialchars($imageLoc, ENT_XML1, 'UTF-8')."</image:loc>\n";
                if (! empty($entry['image']['title'])) {
                    $xml .= '      <image:title>'.htmlspecialchars($entry['image']['title'], ENT_XML1, 'UTF-8')."</image:title>\n";
                }
                $xml .= "    </image:image>\n";
            }

            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Build valid XML sitemapindex string.
     */
    protected function buildIndexXml(array $sitemaps): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        foreach ($sitemaps as $sitemap) {
            $loc = $this->formatSitemapUrl($sitemap['loc']);
            $xml .= "  <sitemap>\n";
            $xml .= '    <loc>'.htmlspecialchars($loc, ENT_XML1, 'UTF-8')."</loc>\n";
            $xml .= "    <lastmod>{$sitemap['lastmod']}</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }

        $xml .= '</sitemapindex>';

        return $xml;
    }

    /**
     * Resolve the canonical base URL for public sitemaps.
     */
    protected function getBaseUrl(): string
    {
        if (app()->environment('testing')) {
            return rtrim(url('/'), '/');
        }

        $appUrl = config('app.url');
        if (! empty($appUrl) && ! str_contains($appUrl, 'localhost') && ! str_contains($appUrl, '127.0.0.1')) {
            return rtrim($appUrl, '/');
        }

        return 'https://generatordubai.com';
    }

    /**
     * Format a path or URL into a canonical sitemap URL.
     */
    protected function formatSitemapUrl(string $urlOrPath): string
    {
        $baseUrl = $this->getBaseUrl();

        if (preg_match('#^https?://#i', $urlOrPath)) {
            $parsed = parse_url($urlOrPath);
            $host = strtolower($parsed['host'] ?? '');

            $appHost = strtolower(parse_url(config('app.url') ?? '', PHP_URL_HOST) ?? '');
            $isLocalOrAppHost = in_array($host, ['localhost', '127.0.0.1', 'generatordubai.com', 'www.generatordubai.com', $appHost], true)
                || str_ends_with($host, '.test')
                || str_ends_with($host, '.local')
                || empty($host);

            if ($isLocalOrAppHost) {
                $path = $parsed['path'] ?? '';
                $path = preg_replace('#/+#', '/', $path);
                $cleanPath = ltrim($path, '/');
                $fullUrl = $cleanPath === '' ? rtrim($baseUrl, '/') : rtrim($baseUrl, '/').'/'.$cleanPath;

                if (! empty($parsed['query'])) {
                    $fullUrl .= '?'.$parsed['query'];
                }

                return $fullUrl;
            }

            return $urlOrPath;
        }

        $cleanPath = preg_replace('#/+#', '/', $urlOrPath);
        $cleanPath = ltrim($cleanPath, '/');

        return $cleanPath === '' ? rtrim($baseUrl, '/') : rtrim($baseUrl, '/').'/'.$cleanPath;
    }

    /**
     * Generate an environment- and domain-scoped cache key to prevent cross-environment cache leakage.
     */
    protected function getCacheKey(string $key): string
    {
        return $key.'_'.md5($this->getBaseUrl());
    }
}

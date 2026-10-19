<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Media;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\RedirectRule;
use App\Models\Service;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImportRentalPowerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rentalpower:import
                            {--url=https://rentalpower.ae : The WordPress website URL}
                            {--truncate : Truncate existing content tables before import}
                            {--download-images : Download all media files to local storage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all data, posts, pages, products, services, media, and menus from rentalpower.ae';

    /**
     * Category mapping cache: WP Cat ID => Laravel Cat ID.
     */
    protected array $categoryMap = [];

    /**
     * WP Page ID => Full hierarchical path / slug mapping.
     */
    protected array $pagePathMap = [];

    /**
     * Replacement map of remote image URLs to local storage URLs.
     */
    protected array $mediaUrlMap = [];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $baseUrl = rtrim($this->option('url'), '/');
        $this->info('=============================================================');
        $this->info("   Rental Power UAE Comprehensive Importer ({$baseUrl})");
        $this->info("=============================================================\n");

        $adminUser = User::where('role', 'admin')->first() ?? User::first();
        $authorId = $adminUser ? $adminUser->id : 1;

        if ($this->option('truncate')) {
            $this->warn('Truncating existing content tables (posts, pages, products, services, categories, menu_items)...');
            MenuItem::query()->delete();
            Product::query()->delete();
            Service::query()->delete();
            Post::query()->delete();
            Page::query()->delete();
            Category::query()->delete();
            Tag::query()->delete();
            RedirectRule::query()->delete();
            if ($this->option('download-images')) {
                Media::query()->delete();
            }
            $this->info('Tables truncated successfully.');
        }

        // 1. Import Categories
        $this->importCategories($baseUrl);

        // 2. Import Media Attachments
        if ($this->option('download-images')) {
            $this->importMediaAttachments($baseUrl, $authorId);
        }

        // 3. Import Pages, Products & Services
        $this->importPagesAndCatalog($baseUrl, $authorId);

        // 4. Import Blog Posts
        $this->importPosts($baseUrl, $authorId);

        // 5. Setup Navigation Menus
        $this->setupNavigationMenus();

        // 6. Setup Redirect & Canonical Rules
        $this->setupRedirectRules($baseUrl);

        $this->info("\n=============================================================");
        $this->info('   Rental Power UAE Migration Completed Successfully!       ');
        $this->info("=============================================================\n");

        $this->table(
            ['Entity', 'Count in Laravel'],
            [
                ['Categories', Category::count()],
                ['Pages', Page::count()],
                ['Products', Product::count()],
                ['Services', Service::count()],
                ['Blog Posts', Post::count()],
                ['Media Files', Media::count()],
                ['Menu Items', MenuItem::count()],
                ['Redirect Rules', RedirectRule::count()],
            ]
        );

        return Command::SUCCESS;
    }

    /**
     * Import all WordPress categories.
     */
    protected function importCategories(string $baseUrl): void
    {
        $this->info('--> 1. Fetching Categories...');
        $resp = $this->fetchApi("{$baseUrl}/wp-json/wp/v2/categories", ['per_page' => 100]);

        if (empty($resp) || ! is_array($resp)) {
            $this->warn('No categories found or API error.');

            return;
        }

        foreach ($resp as $c) {
            $name = html_entity_decode($c['name'] ?? 'Category '.$c['id']);
            $slug = Str::slug($c['slug'] ?? $name);

            $category = Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => Str::limit($name, 250, ''),
                    'description' => $c['description'] ?: null,
                ]
            );

            $this->categoryMap[$c['id']] = $category->id;
            $this->line("   [Category] {$name} (ID: {$category->id}, Slug: {$slug})");
        }

        $this->info('   Total Categories: '.count($this->categoryMap));
    }

    /**
     * Import and download all media attachments.
     */
    protected function importMediaAttachments(string $baseUrl, int $authorId): void
    {
        $this->info('--> 2. Fetching & Downloading Media Attachments (242 items)...');
        $page = 1;
        $totalMedia = 0;

        $targetDir = storage_path('app/public/media');
        $publicDir = public_path('storage/media');

        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true, true);
        }
        if (! File::exists($publicDir)) {
            File::makeDirectory($publicDir, 0755, true, true);
        }

        while (true) {
            $items = $this->fetchApi("{$baseUrl}/wp-json/wp/v2/media", [
                'per_page' => 100,
                'page' => $page,
            ]);

            if (empty($items) || ! is_array($items) || isset($items['code'])) {
                break;
            }

            foreach ($items as $m) {
                $sourceUrl = $m['source_url'] ?? null;
                if (! $sourceUrl) {
                    continue;
                }

                $title = html_entity_decode($m['title']['rendered'] ?? 'Media '.$m['id']);
                $alt = $m['alt_text'] ?? $title;
                $mime = $m['mime_type'] ?? 'image/jpeg';

                $localPath = $this->downloadAndSaveMedia($sourceUrl, $targetDir, $publicDir);
                if ($localPath) {
                    $fileName = basename($localPath);
                    $relativeStoragePath = 'media/'.$fileName;

                    // URL mapping for content rewriting
                    $this->mediaUrlMap[$sourceUrl] = asset('storage/'.$relativeStoragePath);
                    // Also map without protocol
                    $cleanHost = preg_replace('#^https?://#', '', $sourceUrl);
                    $this->mediaUrlMap['https://'.$cleanHost] = asset('storage/'.$relativeStoragePath);
                    $this->mediaUrlMap['http://'.$cleanHost] = asset('storage/'.$relativeStoragePath);

                    Media::firstOrCreate(
                        ['file_path' => $relativeStoragePath],
                        [
                            'name' => Str::limit($title, 250, ''),
                            'file_name' => $fileName,
                            'disk' => 'public',
                            'mime_type' => $mime,
                            'size' => File::exists($localPath) ? File::size($localPath) : 0,
                            'user_id' => $authorId,
                        ]
                    );
                    $totalMedia++;
                }
            }

            $this->line("   Downloaded {$totalMedia} media files so far...");
            $page++;
        }

        $this->info("   Media Download Completed! Total: {$totalMedia} files.");
    }

    /**
     * Download a media file and save to both storage/app/public and public/storage.
     */
    protected function downloadAndSaveMedia(string $url, string $targetDir, string $publicDir): ?string
    {
        try {
            $parsed = parse_url($url);
            $fileName = basename($parsed['path'] ?? 'img_'.uniqid().'.jpg');
            // Clean filename
            $fileName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $fileName);

            $localFile = $targetDir.'/'.$fileName;
            $publicFile = $publicDir.'/'.$fileName;

            if (File::exists($localFile) && File::size($localFile) > 0) {
                if (! File::exists($publicFile)) {
                    @File::copy($localFile, $publicFile);
                }

                return $localFile;
            }

            $resp = Http::timeout(25)->withoutVerifying()->withHeaders(['User-Agent' => 'Mozilla/5.0'])->get($url);
            if ($resp->successful() && strlen($resp->body()) > 0) {
                File::put($localFile, $resp->body());
                @File::put($publicFile, $resp->body());

                return $localFile;
            }
        } catch (\Throwable $e) {
            // Log notice and continue
        }

        return null;
    }

    /**
     * Import Pages, Products, and Services.
     */
    protected function importPagesAndCatalog(string $baseUrl, int $authorId): void
    {
        $this->info('--> 3. Fetching & Importing Pages, Products, and Services...');
        $resp = $this->fetchApi("{$baseUrl}/wp-json/wp/v2/pages", [
            'per_page' => 100,
            '_embed' => 1,
        ]);

        if (empty($resp) || ! is_array($resp)) {
            $this->error('Failed to fetch pages.');

            return;
        }

        // Build hierarchical path map first
        $pagesById = [];
        foreach ($resp as $p) {
            $pagesById[$p['id']] = $p;
        }

        foreach ($resp as $p) {
            $pathSegments = [$p['slug']];
            $curr = $p;
            while (! empty($curr['parent']) && isset($pagesById[$curr['parent']])) {
                $curr = $pagesById[$curr['parent']];
                array_unshift($pathSegments, $curr['slug']);
            }
            $this->pagePathMap[$p['id']] = implode('/', $pathSegments);
        }

        $order = 1;
        foreach ($resp as $p) {
            $rawTitle = html_entity_decode($p['title']['rendered'] ?? 'Page '.$p['id']);
            $title = Str::limit(trim($rawTitle), 250, '');
            $slug = $p['slug'];
            $fullPath = $this->pagePathMap[$p['id']] ?? $slug;
            $content = $this->rewriteContentUrls($p['content']['rendered'] ?? '');
            $status = ($p['status'] ?? 'publish') === 'publish' ? 'published' : 'draft';

            // Extract featured image
            $featuredImage = null;
            if (! empty($p['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                $featuredImage = $p['_embedded']['wp:featuredmedia'][0]['source_url'];
            } elseif (! empty($p['yoast_head_json']['og_image'][0]['url'])) {
                $featuredImage = $p['yoast_head_json']['og_image'][0]['url'];
            }
            if ($featuredImage && isset($this->mediaUrlMap[$featuredImage])) {
                $featuredImage = $this->mediaUrlMap[$featuredImage];
            }

            // Extract Yoast SEO metadata
            $yoast = $p['yoast_head_json'] ?? [];
            $metaTitle = html_entity_decode($yoast['title'] ?? $title);
            $metaDesc = html_entity_decode($yoast['description'] ?? '');
            $canonicalUrl = $yoast['canonical'] ?? $p['link'] ?? null;
            $ogTitle = html_entity_decode($yoast['og_title'] ?? $metaTitle);
            $ogDesc = html_entity_decode($yoast['og_description'] ?? $metaDesc);
            $ogImage = $yoast['og_image'][0]['url'] ?? $featuredImage;
            if ($ogImage && isset($this->mediaUrlMap[$ogImage])) {
                $ogImage = $this->mediaUrlMap[$ogImage];
            }

            // 1. Create/Update Page record
            // Use fullPath for nested pages or primary slug for top-level pages
            $primaryPageSlug = in_array($slug, ['home', 'about', 'contact-us', 'services', 'products']) ? $slug : $fullPath;

            Page::updateOrCreate(
                ['slug' => $primaryPageSlug],
                [
                    'user_id' => $authorId,
                    'title' => $title,
                    'content' => $content,
                    'featured_image' => $featuredImage,
                    'template' => $slug === 'contact-us' ? 'contact' : 'default',
                    'status' => $status,
                    'meta_title' => Str::limit($metaTitle, 250, ''),
                    'meta_description' => $metaDesc ?: null,
                    'canonical_url' => $canonicalUrl,
                    'og_title' => Str::limit($ogTitle, 250, ''),
                    'og_description' => $ogDesc ?: null,
                    'og_image' => $ogImage,
                    'is_indexable' => true,
                ]
            );

            // Also keep single-slug Page record if fullPath is nested, ensuring /{slug} fallback works
            if ($primaryPageSlug !== $slug) {
                Page::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'user_id' => $authorId,
                        'title' => $title,
                        'content' => $content,
                        'featured_image' => $featuredImage,
                        'template' => 'default',
                        'status' => $status,
                        'meta_title' => Str::limit($metaTitle, 250, ''),
                        'meta_description' => $metaDesc ?: null,
                        'canonical_url' => $canonicalUrl,
                        'og_title' => Str::limit($ogTitle, 250, ''),
                        'og_description' => $ogDesc ?: null,
                        'og_image' => $ogImage,
                        'is_indexable' => true,
                    ]
                );
            }

            $summary = Str::limit(trim(strip_tags($content)), 280, '');

            // 2. Identify if it is a Product (under products parent)
            $isProduct = str_starts_with($fullPath, 'products/') && $slug !== 'products';
            if ($isProduct) {
                Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'slug' => $slug,
                        'tagline' => 'Turnkey Rental Power & Cooling Solutions Across UAE',
                        'badge' => str_contains($slug, 'generator') ? 'Power Genset' : 'Chiller / Cooling',
                        'category' => str_contains($slug, 'generator') ? 'Diesel Generators' : 'Industrial Chillers',
                        'summary' => $summary,
                        'content' => $content,
                        'featured_image' => $featuredImage,
                        'status' => $status,
                        'order' => $order++,
                        'is_featured' => true,
                        'meta_title' => Str::limit($metaTitle, 250, ''),
                        'meta_description' => $metaDesc ?: null,
                        'canonical_url' => $canonicalUrl,
                        'og_title' => Str::limit($ogTitle, 250, ''),
                        'og_description' => $ogDesc ?: null,
                        'og_image' => $ogImage,
                        'is_indexable' => true,
                    ]
                );
                $this->line("   [Product] {$title} (Slug: {$slug})");
            }

            // 3. Identify if it is a Service (under services parent or standalone chiller/generator service)
            $isService = (str_starts_with($fullPath, 'services/') && ! in_array($slug, ['services', 'cooling', 'generator', 'buy-sell']))
                || in_array($slug, ['chiller-maintenance', 'industrial-chiller-rental-uae', 'caterpillar-generator-rental-uae', 'cummins-generator-rental-uae', 'honda-generator-rental-uae']);

            if ($isService) {
                $icon = match (true) {
                    str_contains($slug, 'chiller') || str_contains($slug, 'cooling') => 'snowflake',
                    str_contains($slug, 'generator') => 'zap',
                    str_contains($slug, 'cabin') || str_contains($slug, 'container') => 'home',
                    default => 'shield-check',
                };

                Service::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'slug' => $slug,
                        'tagline' => 'Professional Engineering Support & Rapid 24/7 Deployment in UAE',
                        'icon' => $icon,
                        'summary' => $summary,
                        'content' => $content,
                        'featured_image' => $featuredImage,
                        'status' => $status,
                        'order' => $order++,
                        'is_featured' => true,
                        'meta_title' => Str::limit($metaTitle, 250, ''),
                        'meta_description' => $metaDesc ?: null,
                        'canonical_url' => $canonicalUrl,
                        'og_title' => Str::limit($ogTitle, 250, ''),
                        'og_description' => $ogDesc ?: null,
                        'og_image' => $ogImage,
                        'is_indexable' => true,
                    ]
                );
                $this->line("   [Service] {$title} (Slug: {$slug})");
            }

            $this->line("   [Page] {$title} (Path: /{$fullPath})");
        }

        $this->info('   Total Pages Processed: '.count($resp));
    }

    /**
     * Import Blog Posts.
     */
    protected function importPosts(string $baseUrl, int $authorId): void
    {
        $this->info('--> 4. Fetching & Importing Blog Posts...');
        $resp = $this->fetchApi("{$baseUrl}/wp-json/wp/v2/posts", [
            'per_page' => 100,
            '_embed' => 1,
        ]);

        if (empty($resp) || ! is_array($resp)) {
            $this->warn('No blog posts found.');

            return;
        }

        foreach ($resp as $p) {
            $rawTitle = html_entity_decode($p['title']['rendered'] ?? 'Post '.$p['id']);
            $title = Str::limit(trim($rawTitle), 250, '');
            $slug = $p['slug'];
            $content = $this->rewriteContentUrls($p['content']['rendered'] ?? '');
            $excerpt = strip_tags(html_entity_decode($p['excerpt']['rendered'] ?? ''));
            $status = ($p['status'] ?? 'publish') === 'publish' ? 'published' : 'draft';
            $publishedAt = ! empty($p['date']) ? Carbon::parse($p['date']) : now();

            // Featured image
            $featuredImage = null;
            if (! empty($p['_embedded']['wp:featuredmedia'][0]['source_url'])) {
                $featuredImage = $p['_embedded']['wp:featuredmedia'][0]['source_url'];
            } elseif (! empty($p['yoast_head_json']['og_image'][0]['url'])) {
                $featuredImage = $p['yoast_head_json']['og_image'][0]['url'];
            }
            if ($featuredImage && isset($this->mediaUrlMap[$featuredImage])) {
                $featuredImage = $this->mediaUrlMap[$featuredImage];
            }

            // Yoast SEO metadata
            $yoast = $p['yoast_head_json'] ?? [];
            $metaTitle = html_entity_decode($yoast['title'] ?? $title);
            $metaDesc = html_entity_decode($yoast['description'] ?? Str::limit($excerpt, 160, ''));
            $canonicalUrl = $yoast['canonical'] ?? $p['link'] ?? null;
            $ogTitle = html_entity_decode($yoast['og_title'] ?? $metaTitle);
            $ogDesc = html_entity_decode($yoast['og_description'] ?? $metaDesc);
            $ogImage = $yoast['og_image'][0]['url'] ?? $featuredImage;
            if ($ogImage && isset($this->mediaUrlMap[$ogImage])) {
                $ogImage = $this->mediaUrlMap[$ogImage];
            }

            $post = Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'user_id' => $authorId,
                    'title' => $title,
                    'excerpt' => Str::limit($excerpt, 500, ''),
                    'content' => $content,
                    'featured_image' => $featuredImage,
                    'status' => $status,
                    'published_at' => $publishedAt,
                    'meta_title' => Str::limit($metaTitle, 250, ''),
                    'meta_description' => $metaDesc ?: null,
                    'canonical_url' => $canonicalUrl,
                    'og_title' => Str::limit($ogTitle, 250, ''),
                    'og_description' => $ogDesc ?: null,
                    'og_image' => $ogImage,
                    'is_indexable' => true,
                ]
            );

            // Sync categories
            if (! empty($p['categories']) && is_array($p['categories'])) {
                $catIds = [];
                foreach ($p['categories'] as $wpCatId) {
                    if (isset($this->categoryMap[$wpCatId])) {
                        $catIds[] = $this->categoryMap[$wpCatId];
                    }
                }
                if (! empty($catIds)) {
                    $post->categories()->sync($catIds);
                }
            }

            $this->line("   [Post] {$title} (Slug: /{$slug}/)");
        }

        $this->info('   Total Posts Processed: '.count($resp));
    }

    /**
     * Rewrite remote WordPress URLs to local paths.
     */
    protected function rewriteContentUrls(string $content): string
    {
        if (empty($content)) {
            return '';
        }

        // Replace known media URLs
        foreach ($this->mediaUrlMap as $remoteUrl => $localUrl) {
            $content = str_replace($remoteUrl, $localUrl, $content);
        }

        // Replace general upload paths
        $content = preg_replace(
            '#https?://(?:www\.)?rentalpower\.ae/wp-content/uploads/([^"\'>\s]+)#i',
            '/storage/media/$1',
            $content
        );

        // Normalize internal domain links to relative paths
        $content = preg_replace(
            '#https?://(?:www\.)?rentalpower\.ae/#i',
            '/',
            $content
        );

        return $content;
    }

    /**
     * Setup Header and Footer Navigation Menus.
     */
    protected function setupNavigationMenus(): void
    {
        $this->info('--> 5. Setting Up Header & Footer Menus...');

        // Clear existing menu items
        MenuItem::query()->delete();

        // Top level items
        $home = MenuItem::create([
            'title' => 'Home',
            'url' => '/',
            'route_name' => 'home',
            'location' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);

        // Services dropdown
        $services = MenuItem::create([
            'title' => 'Services',
            'url' => '/services',
            'route_name' => 'service.index',
            'location' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);

        $coolingParent = MenuItem::create([
            'title' => 'Rental Cooling',
            'url' => '/services/cooling',
            'parent_id' => $services->id,
            'location' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create(['title' => 'Rental Chiller in UAE', 'url' => '/services/cooling/rental-chiller-in-uae', 'parent_id' => $coolingParent->id, 'location' => 'header', 'order' => 1, 'is_active' => true]);
        MenuItem::create(['title' => 'Rental AC in UAE', 'url' => '/services/cooling/rental-ac-in-uae', 'parent_id' => $coolingParent->id, 'location' => 'header', 'order' => 2, 'is_active' => true]);
        MenuItem::create(['title' => 'Package AC Rental in UAE', 'url' => '/services/cooling/packaged-ac-units-rental-uae', 'parent_id' => $coolingParent->id, 'location' => 'header', 'order' => 3, 'is_active' => true]);
        MenuItem::create(['title' => 'Wild Air in UAE', 'url' => '/services/cooling/wild-air-in-uae', 'parent_id' => $coolingParent->id, 'location' => 'header', 'order' => 4, 'is_active' => true]);
        MenuItem::create(['title' => 'Temporary Cooling in UAE', 'url' => '/services/cooling/temporary-cooling-in-uae', 'parent_id' => $coolingParent->id, 'location' => 'header', 'order' => 5, 'is_active' => true]);

        $powerParent = MenuItem::create([
            'title' => 'Rental Power',
            'url' => '/services/generator',
            'parent_id' => $services->id,
            'location' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create(['title' => 'Rental Generator in UAE', 'url' => '/services/generator/rental-generator-in-uae', 'parent_id' => $powerParent->id, 'location' => 'header', 'order' => 1, 'is_active' => true]);

        $buySellParent = MenuItem::create([
            'title' => 'Buy & Sell',
            'url' => '/services/buy-sell',
            'parent_id' => $services->id,
            'location' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);
        MenuItem::create(['title' => 'Portacabin For Sale', 'url' => '/services/buy-sell/portacabin-for-sale-in-uae', 'parent_id' => $buySellParent->id, 'location' => 'header', 'order' => 1, 'is_active' => true]);
        MenuItem::create(['title' => 'Used Caravan', 'url' => '/services/buy-sell/used-caravan-in-uae', 'parent_id' => $buySellParent->id, 'location' => 'header', 'order' => 2, 'is_active' => true]);
        MenuItem::create(['title' => 'Used Container in UAE', 'url' => '/services/buy-sell/used-container-in-uae', 'parent_id' => $buySellParent->id, 'location' => 'header', 'order' => 3, 'is_active' => true]);
        MenuItem::create(['title' => 'Used Chiller', 'url' => '/services/buy-sell/used-chiller-in-uae', 'parent_id' => $buySellParent->id, 'location' => 'header', 'order' => 4, 'is_active' => true]);
        MenuItem::create(['title' => 'Used Chiller Buyer', 'url' => '/services/buy-sell/used-chiller-ac-buyer-in-uae', 'parent_id' => $buySellParent->id, 'location' => 'header', 'order' => 5, 'is_active' => true]);

        // Products dropdown
        $products = MenuItem::create([
            'title' => 'Products',
            'url' => '/products',
            'route_name' => 'product.index',
            'location' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);

        $genParent = MenuItem::create([
            'title' => 'Generators',
            'url' => '/services/generator',
            'parent_id' => $products->id,
            'location' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);
        MenuItem::create(['title' => 'Diesel Generator Rental', 'url' => '/products/diesel-generator', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 1, 'is_active' => true]);
        MenuItem::create(['title' => 'Silent Generator Rental', 'url' => '/products/silent-generator', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 2, 'is_active' => true]);
        MenuItem::create(['title' => 'Portable Generator Rental', 'url' => '/products/portable-generator', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 3, 'is_active' => true]);
        MenuItem::create(['title' => '100 kVA Generator Rental', 'url' => '/products/100-kva-generator-rental', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 4, 'is_active' => true]);
        MenuItem::create(['title' => '500 kVA Generator Rental', 'url' => '/products/500kva-generator-hire', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 5, 'is_active' => true]);
        MenuItem::create(['title' => '1000 kVA Generator Rental', 'url' => '/products/1000-kva-generator-rental', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 6, 'is_active' => true]);
        MenuItem::create(['title' => 'Heavy Duty Industrial Generator', 'url' => '/products/heavy-duty-industrial-generator', 'parent_id' => $genParent->id, 'location' => 'header', 'order' => 7, 'is_active' => true]);

        $chillerParent = MenuItem::create([
            'title' => 'Chillers',
            'url' => '/services/cooling/rental-chiller-in-uae',
            'parent_id' => $products->id,
            'location' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);
        MenuItem::create(['title' => 'Air Cooled Chiller Rental', 'url' => '/products/air-cooled-chiller-rental-uae', 'parent_id' => $chillerParent->id, 'location' => 'header', 'order' => 1, 'is_active' => true]);
        MenuItem::create(['title' => 'Water Cooled Chiller Rental', 'url' => '/products/water-cooled-chiller-rental-uae', 'parent_id' => $chillerParent->id, 'location' => 'header', 'order' => 2, 'is_active' => true]);
        MenuItem::create(['title' => 'Portable Chiller Rental', 'url' => '/products/portable-chiller-rental-uae', 'parent_id' => $chillerParent->id, 'location' => 'header', 'order' => 3, 'is_active' => true]);
        MenuItem::create(['title' => 'Refrigeration Unit Rental', 'url' => '/products/refrigeration-unit-rental-uae', 'parent_id' => $chillerParent->id, 'location' => 'header', 'order' => 4, 'is_active' => true]);

        // Main navigation pages
        MenuItem::create(['title' => 'About Us', 'url' => '/about', 'route_name' => 'about', 'location' => 'header', 'order' => 4, 'is_active' => true]);
        MenuItem::create(['title' => 'Blog', 'url' => '/category/blog', 'route_name' => 'blog.index', 'location' => 'header', 'order' => 5, 'is_active' => true]);
        MenuItem::create(['title' => 'Contact', 'url' => '/contact-us', 'route_name' => 'contact', 'location' => 'header', 'order' => 6, 'is_active' => true]);

        // Footer Menu
        MenuItem::create(['title' => 'Home', 'url' => '/', 'location' => 'footer', 'order' => 1, 'is_active' => true]);
        MenuItem::create(['title' => 'About Us', 'url' => '/about', 'location' => 'footer', 'order' => 2, 'is_active' => true]);
        MenuItem::create(['title' => 'Services', 'url' => '/services', 'location' => 'footer', 'order' => 3, 'is_active' => true]);
        MenuItem::create(['title' => 'Products', 'url' => '/products', 'location' => 'footer', 'order' => 4, 'is_active' => true]);
        MenuItem::create(['title' => 'Contact Us', 'url' => '/contact-us', 'location' => 'footer', 'order' => 5, 'is_active' => true]);

        $this->info('   Navigation Menus Created Successfully!');
    }

    /**
     * Setup Redirect and Canonical Rules.
     */
    protected function setupRedirectRules(string $baseUrl): void
    {
        $this->info('--> 6. Setting Up Redirect and Canonical Rules...');

        $redirects = [
            ['source_url' => '/home', 'target_url' => '/', 'status_code' => 301, 'description' => 'WordPress default /home to root'],
            ['source_url' => '/about', 'target_url' => '/about-us', 'status_code' => 301, 'description' => 'WordPress /about to canonical /about-us'],
            ['source_url' => '/contact', 'target_url' => '/contact-us', 'status_code' => 301, 'description' => 'Alias /contact to canonical /contact-us'],
            ['source_url' => '/products', 'target_url' => '/fleet', 'status_code' => 301, 'description' => 'WordPress /products to canonical /fleet'],
        ];

        foreach ($redirects as $r) {
            RedirectRule::updateOrCreate(
                ['source_url' => $r['source_url']],
                array_merge($r, [
                    'match_type' => 'exact',
                    'query_param_option' => 'pass',
                    'group' => 'WordPress Canonical',
                    'is_active' => true,
                    'order' => 1,
                ])
            );
        }

        $this->info('   Redirect Rules Configured.');
    }

    /**
     * Helper to fetch JSON from WordPress API.
     */
    protected function fetchApi(string $url, array $params = []): ?array
    {
        try {
            $resp = Http::timeout(30)
                ->withoutVerifying()
                ->withHeaders(['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'])
                ->get($url, $params);

            if ($resp->successful()) {
                return $resp->json();
            }
        } catch (\Throwable $e) {
            $this->error("HTTP request error for {$url}: {$e->getMessage()}");
        }

        return null;
    }
}

<?php

use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OdooController as AdminOdooController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RedirectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OdooController;
use App\Http\Controllers\Frontend\PageController as FrontendPageController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::redirect('/about', '/about-us', 301);

// Official Odoo UAE Partner Landing Page
Route::get('/odoo', [OdooController::class, 'index'])->name('odoo.index');

// Fleet & Products Routes (Canonical is /fleet)
Route::get('/fleet', [FrontendProductController::class, 'index'])->name('fleet.index');
Route::get('/fleet/{slug}', [FrontendProductController::class, 'show'])->name('fleet.show');
Route::redirect('/products', '/fleet', 301)->name('product.index');
Route::get('/product/{slug}', fn (string $slug) => redirect('/fleet/'.$slug, 301))->name('product.show');
Route::get('/products/{slug}', fn (string $slug) => redirect('/fleet/'.$slug, 301));

// Services Routes (Canonical is /services for index and /service/{slug} for detail)
Route::get('/services', [FrontendServiceController::class, 'index'])->name('service.index');
Route::get('/service/{slug}', [FrontendServiceController::class, 'show'])->name('service.show');
Route::get('/services/{slug}', fn (string $slug) => redirect('/service/'.$slug, 301));

// Generator Dubai Specialized Pages
Route::get('/industries', [FrontendPageController::class, 'industries'])->name('page.industries');
Route::get('/used-refurbished-generators', [FrontendPageController::class, 'usedGenerators'])->name('page.used-generators');
Route::redirect('/used-generators', '/used-refurbished-generators', 301);
Route::get('/locations', [FrontendPageController::class, 'locations'])->name('locations.index');
Route::redirect('/locations/al-ain', '/locations/abu-dhabi', 301);
Route::get('/locations/{city}', [FrontendPageController::class, 'locationDetail'])->name('locations.show');

// Blog & Content Routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/post/{slug}', [BlogController::class, 'show'])->name('post.show');
Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category.show');
Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag.show');
Route::get('/author/{slug}', [BlogController::class, 'author'])->name('author.show');
Route::get('/page/{slug}', [FrontendPageController::class, 'show'])->where('slug', '.*')->name('page.show');

// Contact (Canonical is /contact-us)
Route::get('/contact-us', [ContactController::class, 'show'])->name('contact');
Route::redirect('/contact', '/contact-us', 301);
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit')->middleware('throttle:10,1');
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:10,1');

// XML Sitemaps (Master Unified Sitemap, Sitemap Index, & Section Sitemaps)
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap-index.xml', [SitemapController::class, 'sitemapIndex'])->name('sitemap.index');
Route::get('/sitemap-products.xml', [SitemapController::class, 'products'])->name('sitemap.products');
Route::get('/product-sitemap.xml', [SitemapController::class, 'products']);
Route::get('/sitemap-posts.xml', [SitemapController::class, 'posts'])->name('sitemap.posts');
Route::get('/post-sitemap.xml', [SitemapController::class, 'posts']);
Route::get('/sitemap-pages.xml', [SitemapController::class, 'pages'])->name('sitemap.pages');
Route::get('/page-sitemap.xml', [SitemapController::class, 'pages']);
Route::get('/sitemap-categories.xml', [SitemapController::class, 'categories'])->name('sitemap.categories');
Route::get('/category-sitemap.xml', [SitemapController::class, 'categories']);
Route::get('/sitemap-services.xml', [SitemapController::class, 'services'])->name('sitemap.services');
Route::get('/service-sitemap.xml', [SitemapController::class, 'services']);

// Robots.txt
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:10,1');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:10,1');
});

// Google Two-Factor Authentication Flow
Route::get('/login/two-factor', [TwoFactorController::class, 'showChallenge'])->name('login.two-factor');
Route::post('/login/two-factor', [TwoFactorController::class, 'verifyChallenge'])->middleware('throttle:10,1');
Route::get('/login/two-factor-setup', [TwoFactorController::class, 'showSetup'])->name('login.two-factor.setup');
Route::post('/login/two-factor-setup', [TwoFactorController::class, 'confirmSetup'])->middleware('throttle:10,1');
Route::post('/login/two-factor/cancel', [TwoFactorController::class, 'cancel'])->name('login.two-factor.cancel');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'two_factor', 'content.manager'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Quick Draft
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/quick-draft', [DashboardController::class, 'quickDraft'])->name('quick-draft');

    // Odoo Partner Page Management (New)
    Route::get('/odoo', [AdminOdooController::class, 'edit'])->name('odoo.edit');
    Route::put('/odoo', [AdminOdooController::class, 'update'])->name('odoo.update');

    // Products Management (New)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Services Management (New)
    Route::patch('/services/{service}/quick-seo', [AdminServiceController::class, 'quickSeo'])->name('services.quick-seo');
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Leads & Client Inquiries (New)
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/toggle-read', [InquiryController::class, 'toggleRead'])->name('inquiries.toggle-read');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

    // Posts Management
    Route::patch('/posts/{post}/quick-seo', [PostController::class, 'quickSeo'])->name('posts.quick-seo');
    Route::resource('posts', PostController::class)->except(['show']);

    // Categories Management
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);

    // Tags Management
    Route::resource('tags', TagController::class)->except(['create', 'show', 'edit']);

    // Pages Management
    Route::patch('/pages/{page}/quick-seo', [AdminPageController::class, 'quickSeo'])->name('pages.quick-seo');
    Route::resource('pages', AdminPageController::class)->except(['show']);

    // Navigation Menus Management
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::patch('/menus/{menu}/toggle-active', [MenuController::class, 'toggleActive'])->name('menus.toggle-active');
    Route::post('/menus/{menu}/move-up', [MenuController::class, 'moveUp'])->name('menus.move-up');
    Route::post('/menus/{menu}/move-down', [MenuController::class, 'moveDown'])->name('menus.move-down');
    Route::post('/menus/reset-defaults', [MenuController::class, 'resetDefaults'])->name('menus.reset-defaults');

    // 301 & URL Redirection Management (WordPress-style, High Performance)
    Route::get('/redirects', [RedirectController::class, 'index'])->name('redirects.index');
    Route::post('/redirects', [RedirectController::class, 'store'])->name('redirects.store');
    Route::put('/redirects/{redirect}', [RedirectController::class, 'update'])->name('redirects.update');
    Route::delete('/redirects/{redirect}', [RedirectController::class, 'destroy'])->name('redirects.destroy');
    Route::patch('/redirects/{redirect}/toggle', [RedirectController::class, 'toggle'])->name('redirects.toggle');
    Route::post('/redirects/{redirect}/reset-hits', [RedirectController::class, 'resetHits'])->name('redirects.reset-hits');
    Route::post('/redirects/bulk', [RedirectController::class, 'bulk'])->name('redirects.bulk');
    Route::post('/redirects/test', [RedirectController::class, 'test'])->name('redirects.test');
    Route::get('/redirects/export', [RedirectController::class, 'exportCsv'])->name('redirects.export');
    Route::post('/redirects/import', [RedirectController::class, 'importCsv'])->name('redirects.import');
    Route::post('/redirects/seed-defaults', [RedirectController::class, 'seedDefaults'])->name('redirects.seed-defaults');

    // Media Library
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::put('/media/{medium}', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');
    Route::get('/media-modal-list', [MediaController::class, 'modalList'])->name('media.modal-list');

    // User Profile & Two-Factor Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/two-factor/recovery-codes', [ProfileController::class, 'regenerateRecoveryCodes'])->name('profile.two-factor.recovery-codes');
    Route::post('/profile/two-factor/reset', [ProfileController::class, 'resetTwoFactor'])->name('profile.two-factor.reset');

    // System Cache Management
    Route::post('/cache/clear', [CacheController::class, 'clear'])->name('cache.clear');

    // Administrator Only: User Management
    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});

/*
|--------------------------------------------------------------------------
| Storage File Serving & Fallback Sync
|--------------------------------------------------------------------------
| Serves media files and syncs uploads between storage/app/public and public/storage
| ensuring uploaded images never 404 or 403 across shared hosting environments.
*/
Route::get('/storage/{path}', function (string $path) {
    // 1. Direct check in public/storage
    $publicFile = public_path('storage/'.$path);
    if (file_exists($publicFile) && ! is_dir($publicFile)) {
        return response()->file($publicFile);
    }

    // 2. Check in storage/app/public
    $appPublicFile = storage_path('app/public/'.$path);
    if (file_exists($appPublicFile) && ! is_dir($appPublicFile)) {
        $targetDir = dirname($publicFile);
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        @copy($appPublicFile, $publicFile);

        return response()->file($appPublicFile);
    }

    abort(404);
})->where('path', '.*');

/*
|--------------------------------------------------------------------------
| Dynamic Slug Resolution (Matching WordPress Permalinks)
|--------------------------------------------------------------------------
*/
Route::get('/{slug}', function (string $slug) {
    // 0. Canonical 301 redirects for aliases & root permalinks
    $canonicalPermalinks = [
        'about-us' => route('about'),
        'contact-us' => route('contact'),
        'fleet' => route('fleet.index'),
        'services' => route('service.index'),
        'industries' => route('page.industries'),
        'used-refurbished-generators' => route('page.used-generators'),
        'used-generators' => route('page.used-generators'),
        'locations' => route('locations.index'),
        'home' => route('home'),
    ];

    if (isset($canonicalPermalinks[$slug])) {
        return redirect($canonicalPermalinks[$slug], 301);
    }

    // 1. Check if it matches a Generator Fleet Model / Product -> 301 redirect to canonical /fleet/{slug}
    if (Product::where('slug', $slug)->where('status', 'published')->exists()) {
        return redirect()->route('fleet.show', $slug, 301);
    }

    // 2. Check if it matches a Service -> 301 redirect to canonical /service/{slug}
    if (Service::where('slug', $slug)->where('status', 'published')->exists()) {
        return redirect()->route('service.show', $slug, 301);
    }

    // 3. Check if it matches a Blog Post -> 301 redirect to canonical /post/{slug}
    if (Post::where('slug', $slug)->where('status', 'published')->exists()) {
        return redirect()->route('post.show', $slug, 301);
    }

    // 4. Check if it matches a CMS Page -> renders canonical /{slug}
    if (Page::where('slug', $slug)->where('status', 'published')->exists()) {
        return app(FrontendPageController::class)->show($slug);
    }

    // 5. If logged-in admin, allow draft redirect / preview
    if (auth()->check() && auth()->user()->canManageContent()) {
        if (Product::where('slug', $slug)->exists()) {
            return redirect()->route('fleet.show', $slug);
        }
        if (Service::where('slug', $slug)->exists()) {
            return redirect()->route('service.show', $slug);
        }
        if (Post::where('slug', $slug)->exists()) {
            return redirect()->route('post.show', $slug);
        }
        if (Page::where('slug', $slug)->exists()) {
            return app(FrontendPageController::class)->show($slug);
        }
    }

    abort(404);
})->where('slug', '[a-zA-Z0-9\-_]+');

<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$urls = [
    '/' => 200,
    '/about-us' => 200,
    '/about' => 301,
    '/fleet' => 200,
    '/products' => 301,
    '/fleet/50-kva' => 200,
    '/product/50-kva' => 301,
    '/fleet/500-kva' => 200,
    '/fleet/1000-kva' => 200,
    '/services' => 200,
    '/service/rental-power' => 200,
    '/services/rental-power' => 301,
    '/service/power-plant' => 200,
    '/service/amc-generator' => 200,
    '/service/portacabin' => 200,
    '/industries' => 200,
    '/used-refurbished-generators' => 200,
    '/used-generators' => 301,
    '/locations' => 200,
    '/locations/dubai' => 200,
    '/locations/abu-dhabi' => 200,
    '/locations/sharjah' => 200,
    '/locations/ajman' => 200,
    '/locations/ras-al-khaimah' => 200,
    '/locations/fujairah' => 200,
    '/locations/umm-al-quwain' => 200,
    '/contact-us' => 200,
    '/contact' => 301,
    '/blog' => 200,
    '/post/generator-sizing-guide-dubai-construction-kva' => 200,
    '/post/prime-vs-standby-generator-power-uae-iso8528' => 200,
    '/category/rental-power' => 200,
    '/tag/diesel-generators' => 200,
    '/author/1' => 301,
    '/robots.txt' => 200,
    '/sitemap.xml' => 200,
    '/sitemap-index.xml' => 200,
    '/sitemap-products.xml' => 200,
    '/sitemap-services.xml' => 200,
    '/sitemap-posts.xml' => 200,
    '/sitemap-pages.xml' => 200,
    '/sitemap-categories.xml' => 200,
];

echo "Comprehensive Generator Dubai Route Verification\n";
echo "--------------------------------------------------------\n";
$allPass = true;

foreach ($urls as $uri => $expectedStatus) {
    $request = Request::create($uri, 'GET');
    try {
        $response = $kernel->handle($request);
        $status = $response->getStatusCode();
        $isOk = ($status === $expectedStatus);
        echo sprintf("[%s] %s -> HTTP %d (Expected: %d)\n", $isOk ? 'PASS' : 'FAIL', $uri, $status, $expectedStatus);
        if (! $isOk) {
            $allPass = false;
        }
    } catch (Throwable $e) {
        echo sprintf("[ERROR] %s -> %s in %s:%d\n", $uri, $e->getMessage(), $e->getFile(), $e->getLine());
        $allPass = false;
    }
}

echo "--------------------------------------------------------\n";
echo $allPass ? "ALL 42 ROUTES PASSED COMPREHENSIVE VERIFICATION!\n" : "SOME ROUTES FAILED VERIFICATION.\n";

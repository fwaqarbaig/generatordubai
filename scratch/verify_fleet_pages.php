<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

echo "=== VERIFYING ALL 20 FLEET PAGES & SCHEMA OUTPUT ===\n\n";

$products = Product::all();
$allPassed = true;

foreach ($products as $p) {
    $request = Request::create('/fleet/'.$p->slug, 'GET');
    $response = $app->handle($request);
    $status = $response->getStatusCode();
    $content = $response->getContent();

    $wc = str_word_count(strip_tags($content));
    $hasSchema = str_contains($content, '"@type": "Product"') || str_contains($content, '"@type":"Product"');
    $hasContent = str_contains($content, '1. Comprehensive Engineering Profile');

    // Check schema images count
    preg_match('/"image":\s*(\[[^\]]+\])/s', $content, $imgMatch);
    $imgCount = 0;
    if (! empty($imgMatch[1])) {
        $imgList = json_decode($imgMatch[1], true);
        $imgCount = is_array($imgList) ? count($imgList) : 0;
    }

    $pass = ($status === 200 && $wc > 2000 && $hasSchema && $imgCount >= 2);
    if (! $pass) {
        $allPassed = false;
    }

    $statusIcon = $pass ? '✓ PASS' : '✗ FAIL';
    echo "{$statusIcon} | Slug: {$p->slug} | HTTP {$status} | Page Words: {$wc} | Schema Imgs: {$imgCount}\n";
}

echo "\nVerification status: ".($allPassed ? 'ALL 20 PAGES PASSED PERFECTLY!' : 'SOME CHECKS FAILED')."\n";

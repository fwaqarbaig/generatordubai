<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

echo "=== VERIFYING SERVICES SCHEMA & IMAGES ===\n";
$sampleServices = ['rental-chiller-in-uae', 'rental-generator-in-uae', 'used-generators-uae', 'portacabin-for-sale-in-uae'];

foreach ($sampleServices as $slug) {
    $req = Request::create("/service/{$slug}", 'GET');
    $res = $app->handle($req);
    $html = $res->getContent();

    // Check schema
    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $schemaMatches);
    $schemaJson = json_decode($schemaMatches[1] ?? '{}', true);

    $hasImage = ! empty($schemaJson['image']);
    $imgCount = is_array($schemaJson['image']) ? count($schemaJson['image']) : ($hasImage ? 1 : 0);

    // Count img tags in HTML
    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $imgTags);

    echo "Service '{$slug}' -> Status: ".$res->getStatusCode().
         ' | Schema @type: '.($schemaJson['@type'] ?? 'N/A').
         " | Schema Images: {$imgCount}".
         ' | Total HTML Images: '.count($imgTags[0])."\n";

    if ($imgCount > 0) {
        echo '   Schema Image 1: '.(is_array($schemaJson['image']) ? $schemaJson['image'][0] : $schemaJson['image'])."\n";
    }
}

echo "\n=== VERIFYING POSTS SCHEMA & IMAGES ===\n";
$samplePosts = Post::take(4)->get();

foreach ($samplePosts as $p) {
    $req = Request::create("/{$p->slug}", 'GET');
    $res = $app->handle($req);
    $html = $res->getContent();

    // Check schema
    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $schemaMatches);
    $schemaJson = json_decode($schemaMatches[1] ?? '{}', true);

    $hasImage = ! empty($schemaJson['image']);
    $imgCount = is_array($schemaJson['image']) ? count($schemaJson['image']) : ($hasImage ? 1 : 0);

    // Count img tags in HTML
    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $imgTags);

    echo "Post '{$p->slug}' -> Status: ".$res->getStatusCode().
         ' | Schema @type: '.($schemaJson['@type'] ?? 'N/A').
         " | Schema Images: {$imgCount}".
         ' | Total HTML Images: '.count($imgTags[0])."\n";

    if ($imgCount > 0) {
        echo '   Schema Image 1: '.(is_array($schemaJson['image']) ? $schemaJson['image'][0] : $schemaJson['image'])."\n";
    }
}

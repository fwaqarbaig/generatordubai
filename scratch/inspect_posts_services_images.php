<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

echo "=== INSPECTING SERVICES IMAGES ===\n";
$services = Service::all();
$serviceStats = [
    'total' => $services->count(),
    'has_featured_image' => 0,
    'featured_file_exists' => 0,
    'missing_featured' => [],
    'broken_featured' => [],
    'images_in_content_count' => [],
];

foreach ($services as $svc) {
    $hasFeat = ! empty($svc->featured_image);
    $exists = false;
    if ($hasFeat) {
        $serviceStats['has_featured_image']++;
        $rel = ltrim(str_replace('/storage/', '', $svc->featured_image), '/');
        $fullPath = public_path('storage/'.$rel);
        if (file_exists($fullPath) || file_exists(public_path($svc->featured_image))) {
            $exists = true;
            $serviceStats['featured_file_exists']++;
        } else {
            $serviceStats['broken_featured'][] = [$svc->id, $svc->title, $svc->featured_image];
        }
    } else {
        $serviceStats['missing_featured'][] = [$svc->id, $svc->title, $svc->slug];
    }

    // Check images in content
    preg_match_all('/<img[^>]+>/i', $svc->content ?? '', $imgMatches);
    $contentImgCount = count($imgMatches[0]);
    if ($contentImgCount < 2) {
        $serviceStats['images_in_content_count'][] = [$svc->id, $svc->title, $contentImgCount];
    }
}

echo "Total Services: {$serviceStats['total']}\n";
echo "With featured_image: {$serviceStats['has_featured_image']}\n";
echo "Featured file exists on disk: {$serviceStats['featured_file_exists']}\n";
echo 'Missing featured_image count: '.count($serviceStats['missing_featured'])."\n";
echo 'Broken featured_image count: '.count($serviceStats['broken_featured'])."\n";
echo 'Services with < 2 images in content: '.count($serviceStats['images_in_content_count'])."\n\n";

if (! empty($serviceStats['missing_featured'])) {
    echo "Services missing featured_image:\n";
    foreach ($serviceStats['missing_featured'] as [$id, $title, $slug]) {
        echo " - [ID {$id}] {$title} ({$slug})\n";
    }
}

echo "\n=== INSPECTING POSTS IMAGES ===\n";
$posts = Post::all();
$postStats = [
    'total' => $posts->count(),
    'has_featured_image' => 0,
    'featured_file_exists' => 0,
    'missing_featured' => [],
    'broken_featured' => [],
    'images_in_content_count' => [],
];

foreach ($posts as $p) {
    $hasFeat = ! empty($p->featured_image);
    $exists = false;
    if ($hasFeat) {
        $postStats['has_featured_image']++;
        $rel = ltrim(str_replace('/storage/', '', $p->featured_image), '/');
        $fullPath = public_path('storage/'.$rel);
        if (file_exists($fullPath) || file_exists(public_path($p->featured_image))) {
            $exists = true;
            $postStats['featured_file_exists']++;
        } else {
            $postStats['broken_featured'][] = [$p->id, $p->title, $p->featured_image];
        }
    } else {
        $postStats['missing_featured'][] = [$p->id, $p->title, $p->slug];
    }

    // Check images in content
    preg_match_all('/<img[^>]+>/i', $p->content ?? '', $imgMatches);
    $contentImgCount = count($imgMatches[0]);
    if ($contentImgCount < 1) {
        $postStats['images_in_content_count'][] = [$p->id, $p->title, $contentImgCount];
    }
}

echo "Total Posts: {$postStats['total']}\n";
echo "With featured_image: {$postStats['has_featured_image']}\n";
echo "Featured file exists on disk: {$postStats['featured_file_exists']}\n";
echo 'Missing featured_image count: '.count($postStats['missing_featured'])."\n";
echo 'Broken featured_image count: '.count($postStats['broken_featured'])."\n";
echo 'Posts with 0 images in content: '.count($postStats['images_in_content_count'])."\n";

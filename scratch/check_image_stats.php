<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Schema;

echo "=== POSTS TABLE COLUMNS ===\n";
echo json_encode(Schema::getColumnListing('posts'), JSON_PRETTY_PRINT)."\n\n";

echo "=== SERVICES TABLE COLUMNS ===\n";
echo json_encode(Schema::getColumnListing('services'), JSON_PRETTY_PRINT)."\n\n";

// Count posts with and without featured_image
$totalPosts = Post::count();
$postsWithImage = Post::whereNotNull('featured_image')->where('featured_image', '!=', '')->count();
echo "Posts Total: {$totalPosts}, With featured_image: {$postsWithImage}\n";

// Count services with and without featured_image
$totalServices = Service::count();
$servicesWithImage = Service::whereNotNull('featured_image')->where('featured_image', '!=', '')->count();
echo "Services Total: {$totalServices}, With featured_image: {$servicesWithImage}\n";

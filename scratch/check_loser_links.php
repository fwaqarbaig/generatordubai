<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;

$loserSlugs = [
    'rental-chiller-vs-portable-ac-for-commercial-buildings',
    'temporary-cooling-services-in-dubai',
    'how-to-prepare-construction-site-before-rental-generator-delivery',
    'how-to-estimate-generator-diesel-fuel-costs',
];

foreach ($loserSlugs as $slug) {
    echo "Checking references for: {$slug}\n";
    $models = [
        'Post' => Post::where('content', 'like', "%{$slug}%")->pluck('slug', 'id'),
        'Service' => Service::where('content', 'like', "%{$slug}%")->pluck('slug', 'id'),
        'Product' => Product::where('content', 'like', "%{$slug}%")->pluck('slug', 'id'),
        'Page' => Page::where('content', 'like', "%{$slug}%")->pluck('slug', 'id'),
    ];

    foreach ($models as $type => $matches) {
        if ($matches->count() > 0) {
            echo "  Found in {$type}: ".json_encode($matches)."\n";
        }
    }
}

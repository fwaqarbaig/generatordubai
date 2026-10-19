<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

$slugs = [
    'how-to-choose-rental-generator-for-a-factory-expansion-in-sharjah',
    'how-to-choose-temporary-cooling-for-a-manufacturing-plant-in-sharjah',
    'how-to-choose-temporary-cooling-for-a-hotel-renovation-in-dubai',
    'how-to-choose-temporary-cooling-equipment-uae-summer-conditions',
];

foreach ($slugs as $s) {
    $p = Post::where('slug', $s)->first();
    if ($p) {
        echo "FOUND: [{$p->id}] {$p->slug} | TITLE: {$p->title}\n";
    } else {
        echo "NOT FOUND: {$s}\n";
    }
}

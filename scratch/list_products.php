<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;

$products = Product::all();
echo 'Total Products: '.$products->count()."\n\n";

foreach ($products as $p) {
    $wc = str_word_count(strip_tags($p->content ?? ''));
    echo "ID: {$p->id} | Slug: {$p->slug} | Category: {$p->category} | Title: {$p->title}\n";
    echo "  Featured Image: {$p->featured_image} | Content Word Count: {$wc}\n";
}

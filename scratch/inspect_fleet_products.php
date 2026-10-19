<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Schema;

echo "=== PRODUCTS TABLE SCHEMA ===\n";
echo json_encode(Schema::getColumnListing('products'), JSON_PRETTY_PRINT)."\n\n";

$products = Product::all();
echo 'Total Products in Fleet: '.$products->count()."\n\n";

foreach ($products as $p) {
    $wordCount = str_word_count(strip_tags($p->description ?? $p->content ?? ''));
    echo "ID {$p->id} | {$p->title} | slug: '{$p->slug}' | kva: '{$p->kva}' | words: {$wordCount} | img: '{$p->featured_image}'\n";
}

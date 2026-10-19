<?php

use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo "=== SERVICES ===\n";
foreach (Service::all(['id', 'slug', 'title']) as $s) {
    echo "ID: {$s->id} | {$s->slug} | {$s->title}\n";
}

echo "\n=== FLEET / PRODUCTS ===\n";
foreach (Product::all(['id', 'slug', 'title']) as $p) {
    echo "ID: {$p->id} | {$p->slug} | {$p->title}\n";
}

echo "\n=== PAGES ===\n";
foreach (Page::all(['id', 'slug', 'title']) as $pg) {
    echo "ID: {$pg->id} | {$pg->slug} | {$pg->title}\n";
}

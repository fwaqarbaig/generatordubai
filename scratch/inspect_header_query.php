<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use Illuminate\Contracts\Console\Kernel;

$items = MenuItem::with(['activeChildren.activeChildren.activeChildren'])
    ->header()
    ->root()
    ->active()
    ->ordered()
    ->get();

echo 'Header Root Items count: '.$items->count()."\n";
foreach ($items as $item) {
    echo "- ID: {$item->id} | {$item->title} | order: {$item->order} | children: ".$item->activeChildren->count()."\n";
    foreach ($item->activeChildren as $child) {
        echo "   -- ID: {$child->id} | {$child->title} | children: ".$child->activeChildren->count()."\n";
        foreach ($child->activeChildren as $sub) {
            echo "      --- ID: {$sub->id} | {$sub->title}\n";
        }
    }
}

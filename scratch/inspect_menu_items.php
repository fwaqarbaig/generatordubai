<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use Illuminate\Contracts\Console\Kernel;

function printMenu($items, $indent = 0)
{
    foreach ($items as $item) {
        echo str_repeat('  ', $indent)."- ID: {$item->id} | {$item->title} | URL: {$item->url} | Route: {$item->route_name} | Location: {$item->menu_location} | Parent: {$item->parent_id}\n";
        if ($item->children && $item->children->count()) {
            printMenu($item->children, $indent + 1);
        }
    }
}

$rootItems = MenuItem::whereNull('parent_id')->ordered()->get();
echo "--- ALL ROOT MENU ITEMS ---\n";
printMenu($rootItems);

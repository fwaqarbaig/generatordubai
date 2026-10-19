<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

function getPostCategory(Post $p): string
{
    $text = strtolower($p->title.' '.$p->slug.' '.($p->categories->first()?->name ?? ''));
    if (str_contains($text, 'cabin') || str_contains($text, 'portacabin')) {
        return 'portacabins';
    }
    if (str_contains($text, 'chiller') || str_contains($text, 'chilled') || str_contains($text, 'cool') || str_contains($text, ' ac') || str_contains($text, 'hvac') || str_contains($text, 'air conditioning') || str_contains($text, 'spot cooler')) {
        return 'cooling';
    }
    if (str_contains($text, 'maint') || str_contains($text, 'servic') || str_contains($text, 'overheat') || str_contains($text, 'smoke') || str_contains($text, 'oil') || str_contains($text, 'alternator') || str_contains($text, 'crank') || str_contains($text, 'battery') || str_contains($text, 'amc') || str_contains($text, 'troubleshoot') || str_contains($text, 'load bank')) {
        return 'maintenance';
    }
    if (str_contains($text, 'used') || str_contains($text, 'refurbish') || str_contains($text, 'second-hand') || str_contains($text, 'resale') || str_contains($text, 'scrap') || str_contains($text, 'buying')) {
        return 'used_equipment';
    }

    return 'generators';
}

$counts = [];
foreach (Post::with('categories')->get() as $p) {
    $cat = getPostCategory($p);
    $counts[$cat] = ($counts[$cat] ?? 0) + 1;
}

echo json_encode($counts, JSON_PRETTY_PRINT)."\n";

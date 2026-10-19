<?php

use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$calc = new YoastSeoScoreCalculator;

echo "=== ALL 17 SERVICES SCORES ===\n";
foreach (Service::all() as $s) {
    $res = $calc->calculateForModel($s);
    echo "ID: {$s->id} | {$s->title} -> SEO: {$res['seo_score']} ({$res['rating']}) | Read: {$res['readability_score']}\n";
}

echo "\n=== ALL 11 PRODUCTS SCORES ===\n";
foreach (Product::all() as $p) {
    $res = $calc->calculateForModel($p);
    echo "ID: {$p->id} | {$p->title} -> SEO: {$res['seo_score']} ({$res['rating']}) | Read: {$res['readability_score']}\n";
}

echo "\n=== POST 998 CHECKS ===\n";
$p = Post::find(998);
$res = $calc->calculateForModel($p);
echo "Title: {$p->title}\n";
echo 'Content length: '.strlen($p->content)."\n";
echo 'Content sample: '.substr(strip_tags($p->content), 0, 200)."\n";
print_r($res['checks']);

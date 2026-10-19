<?php

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo "=== SERVICES ===\n";
foreach (Service::all(['id', 'title', 'seo_score', 'focus_keyword']) as $s) {
    echo "ID: {$s->id} | Score: {$s->seo_score} | KW: {$s->focus_keyword} | Title: {$s->title}\n";
}

echo "\n=== POSTS ===\n";
foreach (Post::all(['id', 'title', 'seo_score', 'focus_keyword']) as $p) {
    echo "ID: {$p->id} | Score: {$p->seo_score} | KW: {$p->focus_keyword} | Title: {$p->title}\n";
}

echo "\n=== PRODUCTS ===\n";
foreach (Product::all(['id', 'title', 'seo_score', 'focus_keyword']) as $pr) {
    echo "ID: {$pr->id} | Score: {$pr->seo_score} | KW: {$pr->focus_keyword} | Title: {$pr->title}\n";
}

echo "\n=== PAGES ===\n";
foreach (Page::all(['id', 'title', 'seo_score', 'focus_keyword']) as $pg) {
    echo "ID: {$pg->id} | Score: {$pg->seo_score} | KW: {$pg->focus_keyword} | Title: {$pg->title}\n";
}

<?php

use App\Models\Page;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo "=== SERVICES ===\n";
foreach (Service::all() as $s) {
    $wordCount = str_word_count(strip_tags($s->content));
    echo "ID: {$s->id} | Slug: {$s->slug} | Words: {$wordCount} | Title: {$s->title}\n";
}

echo "\n=== PAGES ===\n";
foreach (Page::all() as $p) {
    $wordCount = str_word_count(strip_tags($p->content));
    echo "ID: {$p->id} | Slug: {$p->slug} | Words: {$wordCount} | Title: {$p->title}\n";
}

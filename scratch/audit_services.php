<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

echo "=== SERVICES AUDIT ===\n";
foreach (Service::all() as $s) {
    $wordCount = str_word_count(strip_tags($s->content));
    echo "ID: {$s->id} | Slug: {$s->slug} | Words: {$wordCount} | Status: {$s->status} | Title: {$s->title}\n";
}

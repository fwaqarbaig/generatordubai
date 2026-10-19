<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

echo "=== SERVICES FEATURED IMAGES ===\n";
foreach (Service::whereNotNull('featured_image')->get(['id', 'title', 'featured_image']) as $s) {
    echo "ID {$s->id}: '{$s->featured_image}'\n";
}

echo "\n=== BROKEN POSTS FEATURED IMAGES ===\n";
foreach (Post::all(['id', 'title', 'featured_image']) as $p) {
    $img = $p->featured_image;
    $rel = ltrim(str_replace('/storage/', '', $img), '/');
    $p1 = public_path('storage/'.$rel);
    $p2 = public_path($img);
    if (! file_exists($p1) && ! file_exists($p2)) {
        echo "Post ID {$p->id} ({$p->title}): '{$img}' -> NOT FOUND\n";
    }
}

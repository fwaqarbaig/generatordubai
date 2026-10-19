<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

$posts = Post::with('categories')->get();
$categories = [];
foreach ($posts as $p) {
    $catName = $p->categories->first()?->name ?? 'Uncategorized';
    $categories[$catName][] = [
        'id' => $p->id,
        'title' => $p->title,
        'slug' => $p->slug,
        'featured_image' => $p->featured_image,
    ];
}

foreach ($categories as $cat => $items) {
    echo "Category: {$cat} (".count($items)." posts)\n";
    foreach (array_slice($items, 0, 3) as $it) {
        echo " - [{$it['id']}] {$it['title']} (Img: {$it['featured_image']})\n";
    }
    echo "\n";
}

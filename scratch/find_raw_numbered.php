<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::all();
$rawNumbered = [];
foreach ($posts as $p) {
    if (preg_match('/(?:<p>|<br\s*\/?>)\s*\d+\.\s+[A-Z]/', $p->content)) {
        $rawNumbered[] = [
            'id' => $p->id,
            'title' => $p->title,
            'slug' => $p->slug,
        ];
    }
}

echo 'Posts with raw numbered paragraphs: '.count($rawNumbered)."\n";
foreach ($rawNumbered as $rn) {
    echo "ID: {$rn['id']} | Slug: {$rn['slug']} | Title: {$rn['title']}\n";
}

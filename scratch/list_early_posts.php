<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::where('id', '<', 1010)->get();
foreach ($posts as $p) {
    echo "ID: {$p->id} | Slug: {$p->slug} | Title: {$p->title}\n";
}

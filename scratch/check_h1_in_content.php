<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$postsWithH1 = Post::where('content', 'like', '%<h1%')->get();
echo 'Posts with <h1> in content: '.$postsWithH1->count()."\n";
foreach ($postsWithH1 as $p) {
    echo "ID: {$p->id} | Slug: {$p->slug} | Title: {$p->title}\n";
}

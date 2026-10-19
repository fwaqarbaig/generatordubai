<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$p = Post::find(1005);
echo "=== Post 1005: {$p->title} ===\n";
echo "Slug: {$p->slug}\n";
echo "Content:\n";
echo $p->content."\n";

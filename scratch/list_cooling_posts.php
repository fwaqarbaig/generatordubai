<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

$posts = Post::published()->where('slug', 'like', '%cooling%')->get(['id', 'slug', 'title']);
foreach ($posts as $p) {
    echo "[{$p->id}] {$p->slug} -> {$p->title}\n";
}

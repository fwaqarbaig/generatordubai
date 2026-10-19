<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

foreach (Post::all(['id', 'title', 'slug', 'content']) as $p) {
    echo "ID: {$p->id} | Len: ".strlen($p->content ?? '')." | Title: {$p->title}\n";
}

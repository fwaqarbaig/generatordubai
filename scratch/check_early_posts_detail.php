<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::whereBetween('id', [988, 1009])->get();
foreach ($posts as $p) {
    $wordCount = str_word_count(strip_tags($p->content));
    $links = preg_match_all('/<a\s+[^>]*href=["\'][^"\']+["\'][^>]*>/i', $p->content, $m);
    echo "ID: {$p->id} | Words: {$wordCount} | Links: {$links} | Title: {$p->title}\n";
    if (isset($m[0])) {
        foreach (array_slice($m[0], 0, 3) as $lnk) {
            echo '   -> '.htmlspecialchars($lnk)."\n";
        }
    }
}

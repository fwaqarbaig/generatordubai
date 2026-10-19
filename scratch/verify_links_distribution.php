<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::all();
$minLinks = 999;
$maxLinks = 0;
$totalLinks = 0;
$postsWithFewLinks = [];

foreach ($posts as $p) {
    $count = preg_match_all('/<a\s+[^>]*href=["\'][^"\']+["\'][^>]*>/i', $p->content);
    $totalLinks += $count;
    if ($count < $minLinks) {
        $minLinks = $count;
    }
    if ($count > $maxLinks) {
        $maxLinks = $count;
    }
    if ($count < 3) {
        $postsWithFewLinks[] = [
            'id' => $p->id,
            'title' => $p->title,
            'slug' => $p->slug,
            'links' => $count,
        ];
    }
}

$avgLinks = round($totalLinks / $posts->count(), 1);
echo "Total posts: {$posts->count()}\n";
echo "Min links: {$minLinks}, Max links: {$maxLinks}, Avg links: {$avgLinks}\n";
echo 'Posts with < 3 links: '.count($postsWithFewLinks)."\n";
foreach ($postsWithFewLinks as $pfl) {
    echo "ID: {$pfl['id']} | Links: {$pfl['links']} | Title: {$pfl['title']}\n";
}

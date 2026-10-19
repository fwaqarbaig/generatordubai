<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::all();
echo 'Total posts: '.$posts->count()."\n";

$shortPosts = [];
foreach ($posts as $p) {
    $words = str_word_count(strip_tags($p->content));
    $links = preg_match_all('/<a\s+[^>]*href=["\'][^"\']+["\'][^>]*>/i', $p->content);
    $h2 = preg_match_all('/<h2[\s>]/i', $p->content);
    $h3 = preg_match_all('/<h3[\s>]/i', $p->content);
    $h4 = preg_match_all('/<h4[\s>]/i', $p->content);

    if ($words < 700 || $links < 4) {
        $shortPosts[] = [
            'id' => $p->id,
            'title' => $p->title,
            'slug' => $p->slug,
            'words' => $words,
            'links' => $links,
            'h2' => $h2,
            'h3' => $h3,
            'h4' => $h4,
        ];
    }
}

echo 'Posts with < 700 words or < 4 links: '.count($shortPosts)."\n";
foreach ($shortPosts as $sp) {
    echo "ID: {$sp['id']} | Words: {$sp['words']} | Links: {$sp['links']} | H2: {$sp['h2']} | H3: {$sp['h3']} | H4: {$sp['h4']} | Title: {$sp['title']}\n";
}

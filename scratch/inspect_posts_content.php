<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$posts = Post::all();
echo 'Total posts: '.$posts->count()."\n";

$badPosts = [];
foreach ($posts as $post) {
    $hasH2 = (bool) preg_match('/<h2[\s>]/i', $post->content);
    $hasH3 = (bool) preg_match('/<h3[\s>]/i', $post->content);
    $hasH1 = (bool) preg_match('/<h1[\s>]/i', $post->content);
    $linkCount = preg_match_all('/<a\s+[^>]*href=["\'][^"\']+["\'][^>]*>/i', $post->content);

    // Check if it has numbered list items pretending to be headings like "1. Confirm" or "\d+\.\s+[A-Z]"
    $hasRawNumberedHeadings = (bool) preg_match('/(?:^|<p>|<br\s*\/?>)\s*\d+\.\s+[A-Z]/m', $post->content);

    if (! $hasH2 || $hasRawNumberedHeadings || $linkCount < 2) {
        $badPosts[] = [
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'hasH2' => $hasH2,
            'hasH3' => $hasH3,
            'hasH1' => $hasH1,
            'links' => $linkCount,
            'rawNumbers' => $hasRawNumberedHeadings,
            'contentLen' => strlen($post->content),
        ];
    }
}

echo 'Posts needing formatting improvement: '.count($badPosts)."\n";
foreach ($badPosts as $bp) {
    echo "ID: {$bp['id']} | Slug: {$bp['slug']} | H2: ".($bp['hasH2'] ? 'Y' : 'N').' | H3: '.($bp['hasH3'] ? 'Y' : 'N')." | Links: {$bp['links']} | RawNumbers: ".($bp['rawNumbers'] ? 'Y' : 'N')."\n";
}

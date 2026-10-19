<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

function inspectPost($id)
{
    $p = Post::find($id);
    if (! $p) {
        return;
    }
    echo "=== POST [{$p->id}]: {$p->slug} ===\n";
    echo "Title: {$p->title}\n";
    echo "Excerpt: {$p->excerpt}\n";
    preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/i', $p->content, $m);
    echo "Headings: \n - ".implode("\n - ", array_slice($m[1], 0, 8))."\n\n";
}

inspectPost(1013);
inspectPost(988);
inspectPost(1014);
inspectPost(1012);
inspectPost(1010);
inspectPost(1057);
inspectPost(1065);

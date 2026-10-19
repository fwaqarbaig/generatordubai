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
    echo 'Length: '.strlen($p->content)."\n";
    preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/i', $p->content, $m);
    echo "Headings: \n - ".implode("\n - ", array_slice($m[1], 0, 8))."\n\n";
}

inspectPost(989);
inspectPost(1067);
inspectPost(1071);
inspectPost(1073);
inspectPost(1026);
inspectPost(1019);

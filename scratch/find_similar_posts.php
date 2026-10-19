<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

$posts = Post::published()->get();
echo 'Total published posts: '.$posts->count()."\n";

// Check titles with high similarity or identical keywords
$pairs = [];
for ($i = 0; $i < $posts->count(); $i++) {
    for ($j = $i + 1; $j < $posts->count(); $j++) {
        $p1 = $posts[$i];
        $p2 = $posts[$j];

        similar_text(strtolower($p1->title), strtolower($p2->title), $percent);
        if ($percent > 75) {
            echo 'SIMILAR ('.round($percent, 1)."%):\n";
            echo "  [{$p1->id}] {$p1->slug} (len: ".strlen($p1->content).")\n";
            echo "  [{$p2->id}] {$p2->slug} (len: ".strlen($p2->content).")\n\n";
        }
    }
}

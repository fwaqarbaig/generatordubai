<?php

use App\Models\Post;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$p = Post::find(989);
$content = $p->content;

$content = preg_replace('/<p>\s*(\d+\.\s+[^<\n]+)<\/p>/i', '<h3>$1</h3>', $content);

$p->content = $content;
$calc = app(YoastSeoScoreCalculator::class);
$res = $calc->calculateForModel($p);
$p->seo_score = $res['seo_score'];
$p->readability_score = $res['readability_score'];
$p->save();

echo "Post 989 fixed successfully! SEO: {$p->seo_score}, Readability: {$p->readability_score}\n";

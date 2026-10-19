<?php

use App\Models\Page;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$calc = new YoastSeoScoreCalculator;

$pages = Page::all();
echo 'Enriching and calculating scores for '.$pages->count()." pages...\n";

foreach ($pages as $p) {
    if (empty($p->focus_keyword)) {
        // Derive clean keyword from title or slug
        $cleanTitle = trim(preg_replace('/[–\-\|\:].*$/u', '', $p->title));
        $kw = strtolower($cleanTitle);
        $kw = preg_replace('/[^a-z0-9\s]/', '', $kw);
        $kw = trim(preg_replace('/\s+/', ' ', $kw));

        if (! str_contains($kw, 'uae') && ! str_contains($kw, 'dubai')) {
            $kw .= ' uae';
        }
        $p->focus_keyword = $kw;
    }

    if (empty($p->meta_title)) {
        $p->meta_title = "{$p->title} | Rental Power & Cooling UAE";
    }

    if (empty($p->meta_description)) {
        $p->meta_description = "Rental Power provides reliable {$p->title} across Dubai, Abu Dhabi, and UAE. 24/7 technical engineering support and quick mobilization.";
    }

    $res = $calc->calculateForModel($p);
    $p->seo_score = $res['seo_score'];
    $p->readability_score = $res['readability_score'];
    $p->save();

    echo "Page [{$p->id}] '{$p->title}' -> KW: '{$p->focus_keyword}' | Score: {$p->seo_score} ({$res['rating']})\n";
}

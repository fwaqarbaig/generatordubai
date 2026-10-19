<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Service;

$pairs = [
    ['rental-generator-in-uae', 'rental-power-in-uae'],
    ['generator-maintenance-uae', 'generator-amc-uae'],
    ['chiller-maintenance', 'chiller-amc-uae'],
    ['used-generators-uae', 'refurbished-generators-uae'],
    ['used-chiller-in-uae', 'refurbished-chillers-uae'],
];

foreach ($pairs as $p) {
    echo "====================================\n";
    foreach ($p as $slug) {
        $s = Service::where('slug', $slug)->first();
        if ($s) {
            echo "SLUG: {$s->slug} (ID: {$s->id})\n";
            echo "Title: {$s->title}\n";
            echo "Focus Keyword: {$s->focus_keyword}\n";
            echo "Tagline: {$s->tagline}\n";
            echo 'Summary: '.substr($s->summary, 0, 150)."...\n";
            echo 'Content Start: '.substr(strip_tags($s->content), 0, 200)."...\n\n";
        } else {
            echo "SLUG NOT FOUND: {$slug}\n";
        }
    }
}

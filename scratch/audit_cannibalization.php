<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

$slugs = [
    'rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae',
    'rental-chiller-vs-portable-ac-for-commercial-buildings',
    'temporary-cooling-services-in-dubai',
    'temporary-cooling-options-in-the-uae',
    'how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae',
    'how-to-prepare-construction-site-before-rental-generator-delivery',
    'how-to-calculate-rental-generator-fuel-consumption',
    'how-to-estimate-generator-diesel-fuel-costs',
    'how-to-choose-rental-generator-construction-projects-uae',
    'how-to-select-a-rental-generator-for-a-high-rise-construction-project-in-dubai',
    'what-affects-rental-generator-prices-in-dubai',
    'rental-generator-vs-buying-generator-long-term-projects-uae',
    'what-is-the-difference-between-chiller-rental-and-ac-rental',
    'what-should-you-inspect-before-buying-used-generator-uae',
    'how-to-inspect-a-used-generator-before-transporting-it-to-your-site',
    'what-should-you-inspect-before-purchasing-a-second-hand-portacabin',
];

foreach ($slugs as $s) {
    $p = Post::where('slug', $s)->first();
    if ($p) {
        echo "SLUG: {$p->slug} | ID: {$p->id} | STATUS: {$p->status} | LEN: ".strlen($p->content)." | TITLE: {$p->title}\n";
    } else {
        echo "SLUG: {$s} NOT FOUND\n";
    }
}

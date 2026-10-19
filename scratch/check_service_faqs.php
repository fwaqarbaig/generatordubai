<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Service;

function checkFaqs($slug)
{
    $s = Service::where('slug', $slug)->first();
    if (! $s) {
        return;
    }
    echo "=== FAQS for {$slug} (Count: ".count($s->faqs ?? []).") ===\n";
    foreach ($s->faqs ?? [] as $i => $faq) {
        echo ($i + 1).'. '.($faq['question'] ?? '')."\n";
    }
    echo "\n";
}

checkFaqs('generator-maintenance-uae');
checkFaqs('generator-amc-uae');
checkFaqs('chiller-maintenance');
checkFaqs('chiller-amc-uae');

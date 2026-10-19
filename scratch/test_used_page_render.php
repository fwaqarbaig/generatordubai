<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$request = Request::create('/used-refurbished-generators', 'GET');
$response = $app->handle($request);

echo 'Status Code: '.$response->getStatusCode().PHP_EOL;
$content = $response->getContent();

echo 'Page Title Found: '.(str_contains($content, 'Used & Refurbished Generators') ? 'YES' : 'NO').PHP_EOL;
echo 'FAQPage Schema Found: '.(str_contains($content, '"@type": "FAQPage"') || str_contains($content, '"@type":"FAQPage"') ? 'YES' : 'NO').PHP_EOL;
echo 'Authority Guide Section Found: '.(str_contains($content, 'technical-authority-guide') ? 'YES' : 'NO').PHP_EOL;
echo 'We Buy & Sell Used, Refurbished & Scrap: '.(str_contains($content, 'We Buy & Sell Used, Refurbished & Scrap Generators') ? 'YES' : 'NO').PHP_EOL;

// Check word count of the entire rendered page
$cleanText = strip_tags($content);
$words = str_word_count($cleanText);
echo 'Total Page Word Count: '.$words.' words'.PHP_EOL;

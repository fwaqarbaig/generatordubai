<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

// Test /services
$req1 = Request::create('/services', 'GET');
$res1 = $app->handle($req1);
echo 'Status /services: '.$res1->getStatusCode()."\n";
$html1 = $res1->getContent();
echo 'Contains authority guide: '.(str_contains($html1, 'Turnkey Rental Power, Certified Used Generators') ? 'YES' : 'NO')."\n";
echo 'Contains FAQ Schema: '.(str_contains($html1, '"@type": "FAQPage"') ? 'YES' : 'NO')."\n";

// Test /service/rental-generator-in-uae
$req2 = Request::create('/service/rental-generator-in-uae', 'GET');
$res2 = $app->handle($req2);
echo 'Status /service/rental-generator-in-uae: '.$res2->getStatusCode()."\n";
$html2 = $res2->getContent();
echo 'Contains 50-point protocol: '.(str_contains($html2, 'The 50-Point Technical Refurbishment') ? 'YES' : 'NO')."\n";
echo 'Contains comparison matrix: '.(str_contains($html2, 'Decision Criteria') ? 'YES' : 'NO')."\n";

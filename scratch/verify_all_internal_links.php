<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$urls = [
    '/locations/dubai',
    '/locations/abu-dhabi',
    '/locations/sharjah',
    '/locations/ajman',
    '/locations/ras-al-khaimah',
    '/locations/fujairah',
    '/locations/umm-al-quwain',
    '/service/perkins-generators-uae',
    '/service/cummins-generator-rental-uae',
    '/service/rental-generator-in-uae',
    '/service/rental-power-in-uae',
    '/service/silent-generator-rental-uae',
    '/service/diesel-generator-rental-uae',
    '/service/generator-maintenance-uae',
    '/service/generator-amc-uae',
    '/service/portacabin-for-sale-in-uae',
    '/service/refurbished-portacabin-uae',
    '/service/used-generators-uae',
    '/service/refurbished-generators-uae',
    '/service/used-container-in-uae',
    '/service/used-caravan-in-uae',
    '/service/rental-chiller-in-uae',
    '/service/rental-ac-in-uae',
    '/service/temporary-cooling-in-uae',
    '/service/chiller-maintenance',
    '/used-refurbished-generators',
];

$errors = 0;
foreach ($urls as $url) {
    $req = Request::create($url, 'GET');
    $res = $app->handle($req);
    $status = $res->getStatusCode();
    if ($status !== 200) {
        echo "[ERROR] {$url} returned {$status}\n";
        $errors++;
    } else {
        echo "[OK 200] {$url}\n";
    }
}

if ($errors === 0) {
    echo "\n=== ALL 26 URLS RETURNED 200 OK! ZERO BROKEN LINKS ===\n";
} else {
    echo "\n=== FOUND {$errors} ERRORS ===\n";
}

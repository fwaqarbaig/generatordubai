<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$routes = [
    '/locations/dubai',
    '/locations/abu-dhabi',
    '/locations/sharjah',
    '/service/caterpillar-generator-rental-uae',
    '/service/cummins-generator-rental-uae',
    '/service/perkins-generators-uae',
    '/service/used-generators-uae',
    '/service/refurbished-generators-uae',
    '/service/portacabin-for-sale-in-uae',
    '/service/refurbished-portacabin-uae',
    '/service/used-container-in-uae',
    '/service/used-caravan-in-uae',
    '/service/used-chiller-in-uae',
    '/service/used-chiller-ac-buyer-in-uae',
    '/locations/ajman',
    '/locations/ras-al-khaimah',
    '/locations/fujairah',
    '/locations/umm-al-quwain',
    '/contact-us',
];

$failed = 0;
foreach ($routes as $url) {
    $req = Request::create($url, 'GET');
    $res = $app->handle($req);
    $status = $res->getStatusCode();
    if ($status !== 200) {
        echo "FAIL ({$status}): {$url}\n";
        $failed++;
    } else {
        echo "OK (200): {$url}\n";
    }
}

echo "\nTotal failures: {$failed}\n";

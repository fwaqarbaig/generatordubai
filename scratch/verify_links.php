<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$routes = [
    '/fleet/50-kva-generator-rental',
    '/fleet/100-kva-generator-rental',
    '/fleet/250-kva-generator-rental',
    '/fleet/500kva-generator-hire',
    '/fleet/1000-kva-generator-rental',
    '/fleet/1250-kva-generator-rental',
    '/used-refurbished-generators',
    '/service/caterpillar-generator-rental-uae',
    '/service/cummins-generator-rental-uae',
    '/service/portacabin-for-sale-in-uae',
    '/service/used-container-in-uae',
    '/service/used-chiller-ac-buyer-in-uae',
    '/locations/dubai',
    '/locations/abu-dhabi',
    '/locations/sharjah',
    '/locations/ajman',
    '/locations/ras-al-khaimah',
    '/locations/fujairah',
    '/locations/umm-al-quwain',
    '/service/rental-chiller-in-uae',
    '/service/packaged-ac-units-rental-uae',
    '/service/wild-air-in-uae',
    '/service/rental-ac-in-uae',
    '/service/chiller-maintenance',
    '/how-to-choose-rental-generator-construction-projects-uae',
    '/contact',
    '/fleet',
    '/services',
];

foreach ($routes as $url) {
    $request = Request::create($url, 'GET');
    try {
        $response = $app->handle($request);
        $status = $response->getStatusCode();
        echo "$status : $url\n";
    } catch (Throwable $e) {
        echo "ERR : $url -> ".$e->getMessage()."\n";
    }
}

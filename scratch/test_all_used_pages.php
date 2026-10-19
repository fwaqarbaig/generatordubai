<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$routes = [
    '/used-refurbished-generators',
    '/service/used-generators-uae',
    '/service/refurbished-generators-uae',
    '/service/portacabin-for-sale-in-uae',
    '/service/refurbished-portacabin-uae',
];

foreach ($routes as $uri) {
    $req = Request::create($uri, 'GET');
    $res = $app->handle($req);
    $status = $res->getStatusCode();
    $words = str_word_count(strip_tags($res->getContent()));
    echo "Route: {$uri} -> Status: {$status} | Total Rendered Words: {$words}\n";
}

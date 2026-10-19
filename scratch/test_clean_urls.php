<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);

function testUrl($kernel, $uri)
{
    $request = Request::create($uri, 'GET');
    $response = $kernel->handle($request);
    $status = $response->getStatusCode();
    $target = $response->headers->get('Location') ?? 'N/A';
    echo "URI: {$uri} => Status: {$status}";
    if ($status === 301 || $status === 302) {
        echo " => Redirect: {$target}";
    }
    echo "\n";
    $kernel->terminate($request, $response);
}

testUrl($kernel, '/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae');
testUrl($kernel, '/post/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae');
testUrl($kernel, '/blog/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae');
testUrl($kernel, '/public/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae');
testUrl($kernel, '/public');
testUrl($kernel, '/services');
testUrl($kernel, '/fleet');

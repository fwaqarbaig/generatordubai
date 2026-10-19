<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$req = Request::create('/', 'GET');
$res = $app->handle($req);
$html = $res->getContent();

if (preg_match('/<nav class="hidden lg:flex[^>]*>(.*?)<\/nav>/s', $html, $matches)) {
    echo "NAV START (First 1500 chars):\n".substr($matches[1], 0, 1500)."\n";
}

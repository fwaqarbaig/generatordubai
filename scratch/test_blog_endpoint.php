<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$request = Request::create('/blog', 'GET');
$response = $app->handle($request);

echo 'Status Code: '.$response->getStatusCode().PHP_EOL;
$content = $response->getContent();
echo 'Title found: '.(str_contains($content, 'Blog') || str_contains($content, 'Articles') ? 'YES' : 'NO').PHP_EOL;
echo 'Content length: '.strlen($content)." bytes\n";

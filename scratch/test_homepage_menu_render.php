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
echo 'Status: '.$res->getStatusCode()."\n";
echo 'Contains Home: '.(str_contains($html, '>Home<') ? 'YES' : 'NO')."\n";
echo 'Contains About: '.(str_contains($html, '>About<') ? 'YES' : 'NO')."\n";
echo 'Contains Services: '.(str_contains($html, '>Services<') ? 'YES' : 'NO')."\n";
echo 'Contains Rental Cooling: '.(str_contains($html, 'Rental Cooling') ? 'YES' : 'NO')."\n";
echo 'Contains Rental Chiller: '.(str_contains($html, 'Rental Chiller') ? 'YES' : 'NO')."\n";
echo 'Contains Rental Power: '.(str_contains($html, 'Rental Power') ? 'YES' : 'NO')."\n";
echo 'Contains Maintenance: '.(str_contains($html, 'Maintenance') ? 'YES' : 'NO')."\n";
echo 'Contains New Generators: '.(str_contains($html, 'New Generators') ? 'YES' : 'NO')."\n";
echo 'Contains Used & Refurbished: '.(str_contains($html, 'Used & Refurbished') ? 'YES' : 'NO')."\n";
echo 'Contains Contacts: '.(str_contains($html, 'Contacts') ? 'YES' : 'NO')."\n";

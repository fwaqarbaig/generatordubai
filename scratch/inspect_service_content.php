<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$s65 = Service::find(65);
echo "=== Service 65: {$s65->title} ===\n";
echo substr(strip_tags($s65->content), 0, 300)."\n\n";

$s41 = Service::find(41);
echo "=== Service 41: {$s41->title} ===\n";
echo substr(strip_tags($s41->content), 0, 300)."\n\n";

<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$cummins = Service::where('slug', 'like', '%cummins%')->orWhere('title', 'like', '%cummins%')->get(['id', 'title', 'slug', 'status']);
echo "Cummins Services:\n".json_encode($cummins->toArray(), JSON_PRETTY_PRINT)."\n";

$menu = MenuItem::where('title', 'like', '%cummins%')->get(['id', 'title', 'url']);
echo "Cummins Menu Items:\n".json_encode($menu->toArray(), JSON_PRETTY_PRINT)."\n";

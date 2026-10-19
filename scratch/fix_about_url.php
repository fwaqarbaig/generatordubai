<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use Illuminate\Contracts\Console\Kernel;

$about = MenuItem::where('title', 'About')->first();
if ($about) {
    $about->url = '/about-us';
    $about->save();
    echo "Updated About URL to /about-us\n";
}

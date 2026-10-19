<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$services = Service::all(['id', 'title', 'slug', 'featured_image']);
foreach ($services as $s) {
    echo "ID {$s->id} | {$s->title} | {$s->slug} | Current Img: {$s->featured_image}\n";
}

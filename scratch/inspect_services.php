<?php

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$columns = Schema::getColumnListing('services');
echo 'Columns: '.implode(', ', $columns)."\n\n";

$services = Service::select('id', 'slug', 'title')->get();
foreach ($services as $s) {
    echo "ID: {$s->id} | Slug: {$s->slug} | Title: {$s->title}\n";
}

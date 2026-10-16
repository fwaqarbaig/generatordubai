<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Tables in DB with 'media' or 'image':\n";
$tables = ['media', 'images', 'uploads', 'products', 'services', 'posts', 'pages', 'categories'];
foreach ($tables as $t) {
    if (Schema::hasTable($t)) {
        $cols = Schema::getColumnListing($t);
        echo "Table $t columns: ".implode(', ', $cols)."\n";
    }
}

if (Schema::hasTable('media')) {
    $media = DB::table('media')->get();
    echo "\nMedia records count: ".count($media)."\n";
    foreach ($media as $m) {
        echo "ID: {$m->id} | Name: ".($m->name ?? '').' | Path: '.($m->path ?? $m->file_path ?? $m->url ?? '')."\n";
    }
}

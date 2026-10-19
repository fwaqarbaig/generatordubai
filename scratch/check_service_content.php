<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$services = Service::whereIn('id', [41, 65, 66, 68])->get(['id', 'title', 'slug', 'content']);
foreach ($services as $s) {
    echo $s->id.': '.$s->title.' ('.$s->slug.') - Word count: '.str_word_count(strip_tags($s->content)).PHP_EOL;
}

<?php

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$service = Service::find(47);
echo "Title: {$service->title}\n";
echo 'Content length: '.strlen($service->content)." chars\n";
echo 'Content word count: '.str_word_count(strip_tags($service->content))." words\n";
echo "Preview first 500 chars:\n".substr($service->content, 0, 500)."\n";

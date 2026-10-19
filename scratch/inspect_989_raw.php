<?php

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$p = Post::find(989);
preg_match_all('/(?:<p>|<br\s*\/?>)\s*\d+\.\s+[^\n<]{5,80}/', $p->content, $matches);
print_r($matches[0]);

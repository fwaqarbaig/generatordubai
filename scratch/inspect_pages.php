<?php

use App\Models\Page;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$pages = Page::take(15)->get();
foreach ($pages as $p) {
    $cLen = strlen($p->content ?? '');
    echo "ID: {$p->id} | Slug: {$p->slug} | Content: {$cLen} bytes | MetaTitle: '{$p->meta_title}' | MetaDesc: '{$p->meta_description}'\n";
}

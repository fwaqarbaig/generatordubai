<?php

use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

echo "=== CHECKING POSTS FOR RTL ===\n";
foreach (Post::all(['id', 'title', 'content']) as $p) {
    if (stripos($p->content, 'rtl') !== false || stripos($p->content, 'text-align: right') !== false) {
        echo "Post [{$p->id}] '{$p->title}' has RTL or text-align: right!\n";
    }
}

echo "=== CHECKING SERVICES FOR RTL ===\n";
foreach (Service::all(['id', 'title', 'content']) as $s) {
    if (stripos($s->content, 'rtl') !== false || stripos($s->content, 'text-align: right') !== false) {
        echo "Service [{$s->id}] '{$s->title}' has RTL or text-align: right!\n";
    }
}

echo "=== CHECKING PAGES FOR RTL ===\n";
foreach (Page::all(['id', 'title', 'content']) as $pg) {
    if (stripos($pg->content, 'rtl') !== false || stripos($pg->content, 'text-align: right') !== false) {
        echo "Page [{$pg->id}] '{$pg->title}' has RTL or text-align: right!\n";
    }
}
echo "Done checking.\n";

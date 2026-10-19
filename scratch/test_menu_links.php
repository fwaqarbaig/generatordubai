<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\MenuItem;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

$menuItems = MenuItem::where('location', 'header')->get();
echo 'Testing '.$menuItems->count()." menu URLs:\n";

$failed = 0;
foreach ($menuItems as $item) {
    $url = $item->url;
    // Strip query or hash
    $cleanPath = parse_url($url, PHP_URL_PATH);
    if (! $cleanPath || $cleanPath === '#') {
        continue;
    }

    $req = Request::create($cleanPath, 'GET');
    try {
        $res = $app->handle($req);
        $status = $res->getStatusCode();
        if ($status !== 200) {
            echo "FAIL ({$status}): {$item->title} -> {$cleanPath}\n";
            $failed++;
        } else {
            echo "OK (200): {$item->title} -> {$cleanPath}\n";
        }
    } catch (Throwable $e) {
        echo "ERR: {$item->title} -> {$cleanPath} ({$e->getMessage()})\n";
        $failed++;
    }
}

echo "\nTotal failures: {$failed}\n";

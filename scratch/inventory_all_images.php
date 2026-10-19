<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$directories = [
    public_path('images'),
    public_path('storage/media'),
    public_path('storage'),
    storage_path('app/public/media'),
];

$allImages = [];

foreach ($directories as $dir) {
    if (! is_dir($dir)) {
        continue;
    }
    $files = scandir($dir);
    foreach ($files as $f) {
        if ($f === '.' || $f === '..') {
            continue;
        }
        $path = $dir.'/'.$f;
        if (is_file($path)) {
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'])) {
                $allImages[] = [
                    'filename' => $f,
                    'dir' => $dir,
                    'path' => $path,
                    'size' => filesize($path),
                ];
            }
        }
    }
}

echo 'Total images found on disk: '.count($allImages)."\n";
echo json_encode(array_slice($allImages, 0, 30), JSON_PRETTY_PRINT)."\n";

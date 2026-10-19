<?php

$dir = 'd:/CMS/power/public/storage/media';
$files = scandir($dir);
$realMedia = [];
foreach ($files as $f) {
    if ($f === '.' || $f === '..') {
        continue;
    }
    $realMedia[] = $f;
}

echo 'Total files in public/storage/media: '.count($realMedia)."\n";

// Let's check the 20 posts
$brokenPosts = [
    'rty.jpg',
    'Server_room_cooling_system_protecting_IT_equipment.jpg',
    'jl.jpg',
    'nm.jpg',
    'concrete-curing-tank-temperature-controller-with-heating-cooling-elements.jpeg',
    'tttt.jpg',
    'grt.jpg',
    'c.jpg',
    'pprr.jpg',
    'pow.jpg',
    'rpe.jpg',
    'pota-serv.jpg',
    'diesel-generator-for-rent.webp',
    'tc-in-uae.jpg',
    'portable-ac-for-rent.webp',
    'industrial-generator.webp',
    'Power-Generation-Equipment-Rental.jpg',
    'Diesel-Generator-Rental.jpg',
];

foreach ($brokenPosts as $bp) {
    $found = false;
    foreach ($realMedia as $rm) {
        if (strcasecmp($rm, $bp) === 0) {
            echo "Match found (case): '{$bp}' matches '{$rm}'\n";
            $found = true;
            break;
        }
    }
    if (! $found) {
        // search partial
        $partial = [];
        $base = pathinfo($bp, PATHINFO_FILENAME);
        foreach ($realMedia as $rm) {
            if (stripos($rm, substr($base, 0, 5)) !== false) {
                $partial[] = $rm;
            }
        }
        echo "Missing '{$bp}', similar files: ".implode(', ', array_slice($partial, 0, 5))."\n";
    }
}

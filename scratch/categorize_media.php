<?php

$dir = 'd:/CMS/power/public/storage/media';
$files = scandir($dir);
$images = [];
foreach ($files as $f) {
    if ($f === '.' || $f === '..') {
        continue;
    }
    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
        $images[] = $f;
    }
}

echo 'Total images: '.count($images)."\n\n";

$keywords = ['gen', 'power', 'chiller', 'cool', 'ac', 'porta', 'cabin', 'maint', 'used', 'diesel', 'silent'];
$categorized = [];

foreach ($images as $img) {
    $lower = strtolower($img);
    $matched = false;
    foreach ($keywords as $kw) {
        if (str_contains($lower, $kw)) {
            $categorized[$kw][] = $img;
            $matched = true;
        }
    }
    if (! $matched) {
        $categorized['other'][] = $img;
    }
}

foreach ($categorized as $cat => $list) {
    echo "=== Category: {$cat} (".count($list).") ===\n";
    echo implode(', ', array_slice($list, 0, 10))."\n\n";
}

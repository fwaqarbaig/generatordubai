<?php

$testFiles = [
    'packaged-ac-units-for-rent.jpg',
    'portacbin-in-dubai-service.webp',
    'used-con.jpg',
    '2.jpg',
    'used-chiller-buyer.jpg',
    'used-chiller.jpg',
    'tc-in-uae.jpg',
    'generator-rental-uae.jpg',
    'b-1.jpg',
    'portable-ac-for-rent.webp',
    'wild-air.jpg',
    'honda.jpg',
    '19.jpg',
    'cummins.jpg',
    'service4.jpg',
    'ultimate.jpg',
];

foreach ($testFiles as $f) {
    $p = 'd:/CMS/power/public/storage/media/'.$f;
    echo $f.': '.(file_exists($p) ? 'EXISTS ('.filesize($p).' bytes)' : 'NOT FOUND')."\n";
}

<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

require_once __DIR__.'/populate_fleet_2000w.php';

$sampleData = [
    'title' => '50 kVA Generator Rental UAE',
    'kva' => '50',
    'kw' => '40',
    'amps' => '72',
    'engine' => 'Perkins 1103A-33TG1',
    'cyl' => '3-Cylinder In-line',
    'disp' => '3.3',
    'f25' => '3.1',
    'f50' => '5.7',
    'f75' => '8.2',
    'f100' => '11.0',
    'tank' => '180',
    'sound7m' => '65 dBA',
    'sound1m' => '74 dBA',
    'cables' => '4x16mm² SWA',
    'breaker' => '100A 4-Pole MCCB',
    'applications' => '<div class="p-4 bg-white rounded-xl border border-slate-200"><h4 class="font-bold text-slate-900">Construction</h4><p class="text-xs text-slate-600">Sample text</p></div>',
    'img1' => 'storage/media/100kva-generator-rental.webp',
    'img2' => 'storage/media/diesel-generator-canopy.webp',
    'alt1' => '50 kVA Generator',
    'alt2' => 'Acoustic canopy',
    'cap1' => '50 kVA generator in soundproof canopy',
    'cap2' => 'Acoustic enclosure interior',
    'related_slug' => '100-kva-generator-rental',
    'related_name' => '100 kVA Generator',
];

$genHtml = generateGeneratorContent($sampleData);
$genWc = str_word_count(strip_tags($genHtml));
echo 'Word count for Generator template: '.$genWc."\n";

$sampleChiller = [
    'title' => 'Air Cooled Chiller Rental in UAE',
    'tr' => '200',
    'kw_th' => '703',
    'flow_m3' => '121',
    'flow_gpm' => '533',
    'refrigerant' => 'R-134a',
    'compressor' => 'Twin-Screw Semi-Hermetic with VFD',
    'temp_range' => '+5°C to +15°C',
    'elec_kw' => '185',
    'amps' => '315',
    'gen_kva' => '350 kVA',
    'sound' => '72 dBA @ 10m',
    'connections' => '4-inch PN16 flanged with Bauer couplings',
    'applications' => '<div class="p-4 bg-white rounded-xl border border-slate-200"><h4 class="font-bold text-slate-900">Process</h4><p class="text-xs text-slate-600">Sample text</p></div>',
    'img1' => 'storage/media/air-cooled-chiller.webp',
    'img2' => 'storage/media/industrial-chiller.webp',
    'alt1' => 'Air cooled chiller',
    'alt2' => 'Chiller piping skid',
    'cap1' => '200 TR air cooled chiller',
    'cap2' => 'Hydronic circulation skid',
    'related_slug' => 'water-cooled-chiller-rental-uae',
    'related_name' => 'Water Cooled Chiller Rental',
];

$chillerHtml = generateChillerContent($sampleChiller);
$chillerWc = str_word_count(strip_tags($chillerHtml));
echo 'Word count for Chiller template: '.$chillerWc."\n";

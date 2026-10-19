<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

echo "=== TESTING IMAGE ENRICHMENT LOGIC ON SAMPLE POSTS ===\n";

$pools = [
    'cooling' => [
        'storage/media/rental-chiller-service-uae.webp',
        'storage/media/air-cooled-chiller.webp',
        'storage/media/air-cooled-chiller-1.webp',
        'storage/media/industrial-chiller.webp',
        'storage/media/industrial-chiller-1.webp',
        'storage/media/chiller-rental-in-uae.webp',
        'storage/media/chiller-rental-service.webp',
        'storage/media/water-cooled-chiller-for-rent-in-uae.webp',
        'storage/media/Packaged-ac-unit-rental-in-uae.webp',
        'storage/media/portable-ac-for-rent.webp',
        'storage/media/Commercial-AC-Rental-UAE.png',
        'storage/media/Spot-Cooler-Rental-UAE.png',
        'storage/media/Chiller-Rental-for-Events-in-UAE.webp',
        'storage/media/District-Cooling-HVAC-Rental-Support-in-UAE.webp',
        'storage/media/tc-in-uae.jpg',
        'storage/media/wild-air.jpg',
    ],
    'generators' => [
        'storage/media/Power-Generator-Rental.jpg',
        'storage/media/rental-generator.webp',
        'storage/media/rental-power.webp',
        'storage/media/100kva-generator-rental.webp',
        'storage/media/500kva-generator-rental.webp',
        'storage/media/1000kva-generator-rental.webp',
        'storage/media/Diesel-Generator.webp',
        'storage/media/Silent-Generator.webp',
        'storage/media/gen-constr.jpg',
        'storage/media/Portable-generator.webp',
        'storage/media/cummins-500kw-generator-rental.webp',
        'storage/media/generator-rental-uae.jpg',
    ],
    'maintenance' => [
        'storage/media/generator-maintenance-in-uae.webp',
        'storage/media/maintenance-and-amc-service-in-dubai.webp',
        'storage/media/rental-gen-service.jpg',
        'storage/media/service4.jpg',
        'storage/media/Why-Heat-Is-a-Bigger-Problem.jpg',
        'storage/media/Silent-generator.jpg',
        'storage/media/b-1.jpg',
        'storage/media/ultimate.jpg',
    ],
    'used_equipment' => [
        'storage/media/Power-Generator-Rental.jpg',
        'storage/media/500kva-generator-rental.webp',
        'storage/media/1000kva-generator-rental.webp',
        'storage/media/Diesel-Generator.webp',
        'storage/media/used-chiller.jpg',
        'storage/media/used-chiller-buyer.jpg',
        'storage/media/used-con.jpg',
    ],
    'portacabins' => [
        'storage/media/portacabin-for-sale-in-uae.jpg',
        'storage/media/Refurbished-portacabin-for-sale-in-uae.webp',
        'storage/media/Used-Portacabin-for-sale-in-uae.webp',
        'storage/media/New-Portacabin-in-uae.webp',
        'storage/media/portable-office-cabin.webp',
        'storage/media/Portacabin-Toilet-Ablution-Units.webp',
        'storage/media/Labour-Portable-Accommodation-Cabins.webp',
        'storage/media/Prefabricated-Cabins.webp',
        'storage/media/Security-Cabins.webp',
        'storage/media/portacabin-buyer-in-uae.jpg',
        'storage/media/used-porat-in-dubai.jpg',
        'storage/media/used-poratacabin-in-uae.jpg',
    ],
];

function getPostCategory(Post $p): string
{
    $title = strtolower($p->title.' '.$p->slug);
    if (str_contains($title, 'cabin') || str_contains($title, 'portacabin')) {
        return 'portacabins';
    }
    if (str_contains($title, 'cool') || str_contains($title, 'chiller') || str_contains($title, ' ac') || str_contains($title, 'hvac')) {
        return 'cooling';
    }
    if (str_contains($title, 'maint') || str_contains($title, 'servic') || str_contains($title, 'overheat') || str_contains($title, 'smoke') || str_contains($title, 'oil') || str_contains($title, 'alternator') || str_contains($title, 'crank') || str_contains($title, 'battery')) {
        return 'maintenance';
    }
    if (str_contains($title, 'used') || str_contains($title, 'refurbish') || str_contains($title, 'second-hand') || str_contains($title, 'resale')) {
        return 'used_equipment';
    }

    return 'generators';
}

$samplePosts = Post::take(5)->get();
foreach ($samplePosts as $p) {
    $topic = getPostCategory($p);
    echo "Post [{$p->id}] '{$p->title}' -> Category: {$topic}\n";
}

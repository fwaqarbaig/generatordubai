<?php

$pools = [
    'generators' => [
        'Power-Generator-Rental.jpg',
        'rental-generator.webp',
        'rental-power.webp',
        '100kva-generator-rental.webp',
        '500kva-generator-rental.webp',
        '1000kva-generator-rental.webp',
        'Diesel-Generator.webp',
        'Silent-Generator.webp',
        'gen-constr.jpg',
        'Portable-generator.webp',
        'cummins-500kw-generator-rental.webp',
        'generator-rental-uae.jpg',
    ],
    'cooling' => [
        'rental-chiller-service-uae.webp',
        'air-cooled-chiller.webp',
        'air-cooled-chiller-1.webp',
        'industrial-chiller.webp',
        'industrial-chiller-1.webp',
        'chiller-rental-in-uae.webp',
        'chiller-rental-service.webp',
        'Chiller-Rental-for-Events-in-UAE.webp',
        'water-cooled-chiller-for-rent-in-uae.webp',
        'portable-chiller.webp',
        'Packaged-ac-unit-rental-in-uae.webp',
        'packaged-ac-units-for-rent.jpg',
        'portable-ac-for-rent.webp',
        'Commercial-AC-Rental-UAE.png',
        'Split-AC-Rental-UAE.png',
        'Spot-Cooler-Rental-UAE.png',
        'District-Cooling-HVAC-Rental-Support-in-UAE.webp',
        'Server_room_cooling_system_protecting_IT_equipment.jpg',
        'tc-in-uae.jpg',
        'wild-air.jpg',
    ],
    'maintenance' => [
        'generator-maintenance-in-uae.webp',
        'maintenance-and-amc-service-in-dubai.webp',
        'rental-gen-service.jpg',
        'service4.jpg',
        'Why-Heat-Is-a-Bigger-Problem.jpg',
        'Silent-generator.jpg',
        'b-1.jpg',
        'ultimate.jpg',
    ],
    'used_equipment' => [
        'Power-Generator-Rental.jpg',
        '500kva-generator-rental.webp',
        '1000kva-generator-rental.webp',
        'used-chiller.jpg',
        'used-chiller-buyer.jpg',
        'used-con.jpg',
        'Diesel-Generator.webp',
    ],
    'portacabins' => [
        'portacabin-for-sale-in-uae.jpg',
        'Refurbished-portacabin-for-sale-in-uae.webp',
        'Used-Portacabin-for-sale-in-uae.webp',
        'New-Portacabin-in-uae.webp',
        'portable-office-cabin.webp',
        'Portacabin-Toilet-Ablution-Units.webp',
        'Labour-Portable-Accommodation-Cabins.webp',
        'Prefabricated-Cabins.webp',
        'Security-Cabins.webp',
        'portacabin-buyer-in-uae.jpg',
        'used-porat-in-dubai.jpg',
        'used-poratacabin-in-uae.jpg',
    ],
];

$missing = [];
foreach ($pools as $cat => $files) {
    foreach ($files as $f) {
        $p = 'd:/CMS/power/public/storage/media/'.$f;
        if (! file_exists($p)) {
            $missing[] = "{$cat}: {$f}";
        }
    }
}

if (empty($missing)) {
    echo 'SUCCESS: ALL '.array_sum(array_map('count', $pools))." POOL IMAGES EXIST ON DISK!\n";
} else {
    echo "MISSING FILES:\n".implode("\n", $missing)."\n";
}

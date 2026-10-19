<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;

require_once __DIR__.'/populate_fleet_2000w.php';

echo "====================================================================\n";
echo "EXECUTING 2,000-WORD AUTHORITY POPULATION FOR ALL 20 FLEET PRODUCTS\n";
echo "====================================================================\n\n";

$generatorFleet = [
    '50-kva-generator-rental' => [
        'title' => '50 kVA Generator Rental in UAE',
        'kva' => '50',
        'kw' => '40',
        'amps' => '72',
        'engine' => 'Perkins 1103A-33TG1 Tier-1 Diesel',
        'cyl' => '3-Cylinder In-line',
        'disp' => '3.3',
        'f25' => '3.1',
        'f50' => '5.7',
        'f75' => '8.2',
        'f100' => '11.7',
        'tank' => '180',
        'sound7m' => '65 dBA',
        'sound1m' => '74 dBA',
        'cables' => '4x16mm² SWA or 4x25mm² flexible single-core HO7RN-F',
        'breaker' => '100A 4-Pole MCCB',
        'oil_cap' => '8.3 Litres',
        'coolant_cap' => '10.2 Litres',
        'dimensions' => '2,250 x 1,000 x 1,350 mm',
        'weight' => '1,120 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Site Offices & Contractor Compounds</h4>
                <p class="text-xs text-slate-600">Powers multi-cabin site offices, split air conditioners, plotting workstations, and IT servers across construction zones in Dubai and Sharjah.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Night Roadworks & Mobile Mast Lighting</h4>
                <p class="text-xs text-slate-600">Continuous 12-hour fuel runtime powering highway asphalt paving crews, mastic heaters, and mobile floodlight arrays on RTA highway projects.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Residential Villa Standby Backup</h4>
                <p class="text-xs text-slate-600">Compact whisper-quiet power module for luxury estates in Palm Jumeirah and Emirates Hills during scheduled utility cable renewals.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Retail Pop-Up & Outdoor Hospitality</h4>
                <p class="text-xs text-slate-600">Powers food trucks, outdoor festival kitchens, espresso machines, and display lighting with low noise emission and zero exhaust smoke.</p>
            </div>',
        'img1' => 'storage/media/Silent-Generator.webp',
        'img2' => 'storage/media/generator-acoustic.webp',
        'alt1' => '50 kVA soundproof diesel generator rental in Dubai UAE',
        'alt2' => 'Acoustic canopy and Perkins engine interior of 50 kVA generator',
        'cap1' => 'Compact 50 kVA silent generator deployed for residential construction backup in Dubai.',
        'cap2' => 'Sound-attenuated enclosure with Perkins 1103A engine maintaining 65 dBA noise profile.',
        'related_slug' => '100-kva-generator-rental',
        'related_name' => '100 kVA Generator Hire',
        'secondary_slug' => 'portable-generator',
        'secondary_name' => 'Portable Generator Fleet',
    ],

    '100-kva-generator-rental' => [
        'title' => '100 kVA Generator Rental in UAE',
        'kva' => '100',
        'kw' => '80',
        'amps' => '144',
        'engine' => 'Perkins 1104A-44TAG2 Turbocharged Diesel',
        'cyl' => '4-Cylinder In-line',
        'disp' => '4.4',
        'f25' => '5.8',
        'f50' => '11.2',
        'f75' => '16.5',
        'f100' => '21.8',
        'tank' => '250',
        'sound7m' => '67 dBA',
        'sound1m' => '76 dBA',
        'cables' => '4x35mm² SWA or 4x50mm² flexible single-core HO7RN-F',
        'breaker' => '160A 4-Pole MCCB',
        'oil_cap' => '8.0 Litres',
        'coolant_cap' => '13.0 Litres',
        'dimensions' => '2,800 x 1,120 x 1,600 mm',
        'weight' => '1,650 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Commercial Dewatering Pump Stations</h4>
                <p class="text-xs text-slate-600">Supplies sustained 3-phase power for multiple 6-inch submersible dewatering pumps operating 24/7 on coastal excavation sites in Dubai Maritime City.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Mid-Size Construction Compounds</h4>
                <p class="text-xs text-slate-600">Simultaneously runs tower passenger hoists, rebar cutting/bending workshops, and primary site engineering offices across Sharjah and Ajman.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Commercial Cold Storage Backup</h4>
                <p class="text-xs text-slate-600">Emergency backup power for meat and produce walk-in chillers in Ras Al Khor, preventing spoilage during grid maintenance outages.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Outdoor Corporate & Concert Staging</h4>
                <p class="text-xs text-slate-600">Whisper-quiet acoustic performance powering high-output LED video walls, line-array audio amplifiers, and VIP hospitality climate control.</p>
            </div>',
        'img1' => 'storage/media/100kva-generator-rental.webp',
        'img2' => 'storage/media/diesel-generator-for-rent.webp',
        'alt1' => '100 kVA silent diesel generator hire in UAE',
        'alt2' => 'Weatherproof canopy and internal controls of 100 kVA Perkins generator',
        'cap1' => '100 kVA sound-attenuated diesel generator powering construction dewatering in Dubai.',
        'cap2' => 'Deep Sea control module and Stamford alternator within weather-sealed acoustic canopy.',
        'related_slug' => '150-kva-generator-rental',
        'related_name' => '150 kVA Generator Hire',
        'secondary_slug' => 'silent-generator',
        'secondary_name' => 'Silent Generator Fleet',
    ],

    '150-kva-generator-rental' => [
        'title' => '150 kVA Generator Rental in UAE',
        'kva' => '150',
        'kw' => '120',
        'amps' => '216',
        'engine' => 'Cummins 6BTA5.9-G2 Heavy-Duty Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '5.9',
        'f25' => '8.5',
        'f50' => '16.5',
        'f75' => '24.5',
        'f100' => '32.5',
        'tank' => '350',
        'sound7m' => '68 dBA',
        'sound1m' => '77 dBA',
        'cables' => '4x70mm² SWA or 4x95mm² flexible single-core HO7RN-F',
        'breaker' => '250A 4-Pole MCCB',
        'oil_cap' => '16.4 Litres',
        'coolant_cap' => '24.0 Litres',
        'dimensions' => '3,200 x 1,180 x 1,750 mm',
        'weight' => '2,150 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Concrete Batching & Pumping</h4>
                <p class="text-xs text-slate-600">Delivers high motor starting torque for stationary concrete pumps and aggregate conveyor drives on fast-track commercial developments.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Manufacturing Workshops</h4>
                <p class="text-xs text-slate-600">Powers CNC machining centers, overhead bridge cranes, and heavy welding arrays in Mussafah Industrial Area and Sajaa Sharjah.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Temporary Healthcare & Clinic Support</h4>
                <p class="text-xs text-slate-600">Supplies clean, regulated emergency electrical backup for outpatient clinics, testing labs, and sensitive diagnostic medical equipment.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Cold Storage Logistics Depots</h4>
                <p class="text-xs text-slate-600">Provides continuous prime power to multi-temp refrigerated storage warehouses in Dubai South and Khalifa Industrial Zone (KIZAD).</p>
            </div>',
        'img1' => 'storage/media/Diesel-Generator.webp',
        'img2' => 'storage/media/industrial-generator.webp',
        'alt1' => '150 kVA industrial Cummins diesel generator rental UAE',
        'alt2' => 'Heavy duty acoustic enclosure of 150 kVA generator unit',
        'cap1' => '150 kVA Cummins diesel generator configured for continuous prime power on industrial site.',
        'cap2' => 'Tropical radiator and brushless alternator engineered for 50°C UAE summer climates.',
        'related_slug' => '200-kva-generator-rental',
        'related_name' => '200 kVA Generator Hire',
        'secondary_slug' => '50-kva-generator-rental',
        'secondary_name' => '50 kVA Generator Hire',
    ],

    '200-kva-generator-rental' => [
        'title' => '200 kVA Generator Rental in UAE',
        'kva' => '200',
        'kw' => '160',
        'amps' => '288',
        'engine' => 'Perkins 1106A-70TAG3 ATAAC Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '7.0',
        'f25' => '11.2',
        'f50' => '21.8',
        'f75' => '32.5',
        'f100' => '43.5',
        'tank' => '450',
        'sound7m' => '69 dBA',
        'sound1m' => '78 dBA',
        'cables' => '4x95mm² SWA or 4x120mm² flexible single-core HO7RN-F',
        'breaker' => '350A 4-Pole MCCB',
        'oil_cap' => '18.0 Litres',
        'coolant_cap' => '27.5 Litres',
        'dimensions' => '3,550 x 1,220 x 1,850 mm',
        'weight' => '2,580 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Construction Tower Crane Operations</h4>
                <p class="text-xs text-slate-600">Sustains high starting current surges from 8-to-12 ton construction tower cranes and exterior construction hoists in Downtown Dubai.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Temporary Commercial Chillers (50 TR)</h4>
                <p class="text-xs text-slate-600">Directly powers 50 TR air-cooled rental chillers and primary hydronic pumping skids for commercial building emergency cooling.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Precast Yard Steam & Curing Rigs</h4>
                <p class="text-xs text-slate-600">Supplies heavy industrial power for precast concrete heating, hydraulic tensioning jacks, and plant lighting in Abu Dhabi.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Marine Vessel Shore-to-Ship Power</h4>
                <p class="text-xs text-slate-600">Powers shipboard HVAC, bilge pumps, and navigation electronics during drydock servicing in Dubai Maritime City and Hamriyah Port.</p>
            </div>',
        'img1' => 'storage/media/industrial-generator.webp',
        'img2' => 'storage/media/Silent-Generator.webp',
        'alt1' => '200 kVA silent diesel generator rental in Abu Dhabi UAE',
        'alt2' => 'Perkins 1106A engine and soundproof acoustic canopy of 200 kVA generator',
        'cap1' => '200 kVA soundproof generator mobilizing on heavy construction project in Abu Dhabi.',
        'cap2' => 'Perkins 6-cylinder turbocharged engine integrated with heavy-duty 50°C tropical radiator.',
        'related_slug' => '250-kva-generator-rental',
        'related_name' => '250 kVA Generator Hire',
        'secondary_slug' => '100-kva-generator-rental',
        'secondary_name' => '100 kVA Generator Hire',
    ],

    '250-kva-generator-rental' => [
        'title' => '250 kVA Generator Rental in UAE',
        'kva' => '250',
        'kw' => '200',
        'amps' => '360',
        'engine' => 'Cummins 6CTA8.3-G2 Heavy-Duty Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '8.3',
        'f25' => '14.2',
        'f50' => '27.5',
        'f75' => '41.0',
        'f100' => '54.5',
        'tank' => '550',
        'sound7m' => '70 dBA',
        'sound1m' => '79 dBA',
        'cables' => '4x150mm² SWA or 2 runs of 4x70mm² flexible single-core HO7RN-F',
        'breaker' => '400A 4-Pole MCCB',
        'oil_cap' => '23.8 Litres',
        'coolant_cap' => '34.0 Litres',
        'dimensions' => '3,800 x 1,280 x 1,950 mm',
        'weight' => '2,920 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Mega Infrastructure Batching Plants</h4>
                <p class="text-xs text-slate-600">Drives twin-shaft concrete mixers, aggregate chillers, cement silos, and pneumatic screw feeders on highway projects.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Quarry & Crushing Plants</h4>
                <p class="text-xs text-slate-600">Continuous heavy-duty operation powering vibrating screens, jaw crushers, and discharge conveyor belts in Ras Al Khaimah and Fujairah.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Temporary Process Cooling (75 TR)</h4>
                <p class="text-xs text-slate-600">Powers 75 TR air-cooled chillers and secondary air handling units for pharmaceutical cleanrooms and data center emergency cooling.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Oilfield Base Camp Electrification</h4>
                <p class="text-xs text-slate-600">Supplies prime electricity for 300-man accommodation camps, mess halls, water desalination units, and sewage treatment skids.</p>
            </div>',
        'img1' => 'storage/media/Diesel-Generator.webp',
        'img2' => 'storage/media/generator-acoustic.webp',
        'alt1' => '250 kVA Cummins prime diesel generator hire UAE',
        'alt2' => 'Acoustic canopy and Cummins 6CTA engine of 250 kVA generator unit',
        'cap1' => '250 kVA Cummins diesel generator deployed for industrial infrastructure in Sharjah.',
        'cap2' => 'Heavy-gauge galvanized enclosure lined with high-density mineral rockwool acoustic insulation.',
        'related_slug' => '300-kva-generator-rental',
        'related_name' => '300 kVA Generator Hire',
        'secondary_slug' => 'heavy-duty-industrial-generator',
        'secondary_name' => 'Industrial Generator Fleet',
    ],

    '300-kva-generator-rental' => [
        'title' => '300 kVA Generator Rental in UAE',
        'kva' => '300',
        'kw' => '240',
        'amps' => '433',
        'engine' => 'Perkins 1506A-E88TAG4 Electronic Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '8.8',
        'f25' => '17.1',
        'f50' => '33.2',
        'f75' => '49.5',
        'f100' => '65.8',
        'tank' => '650',
        'sound7m' => '71 dBA',
        'sound1m' => '80 dBA',
        'cables' => '4x185mm² SWA or 2 runs of 4x95mm² flexible single-core HO7RN-F',
        'breaker' => '500A 4-Pole MCCB',
        'oil_cap' => '41.0 Litres',
        'coolant_cap' => '43.2 Litres',
        'dimensions' => '4,050 x 1,350 x 2,050 mm',
        'weight' => '3,380 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Deepwater Marine & Port Berthing</h4>
                <p class="text-xs text-slate-600">Supplies continuous 400V 3-phase cold ironing power to commercial cargo barges, tugboats, and dredgers in JAFZA and Port Khalid.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Asphalt & Bitumen Plants</h4>
                <p class="text-xs text-slate-600">Provides high baseload electrical power for asphalt rotary drum dryers, heated bitumen storage tanks, and baghouse dust filters.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Luxury Hotel & Resort Standby Power</h4>
                <p class="text-xs text-slate-600">Automatic Mains Failure (AMF) emergency power supporting guest elevators, water booster pumps, and kitchen cold storage in Dubai.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">International Sports & Mega Events</h4>
                <p class="text-xs text-slate-600">Isochronous prime electrical power for broadcast TV transmission trucks, stadium floodlighting towers, and VIP hospitality zones.</p>
            </div>',
        'img1' => 'storage/media/industrial-generator.webp',
        'img2' => 'storage/media/diesel-generator-for-rent.webp',
        'alt1' => '300 kVA electronic diesel generator rental in Dubai UAE',
        'alt2' => 'Perkins 1506A electronic engine and heavy duty canopy of 300 kVA generator',
        'cap1' => '300 kVA Perkins silent generator delivering high-torque prime power for marine berthing.',
        'cap2' => 'Electronic fuel injection and high-efficiency ATAAC cooling maintaining peak fuel economy.',
        'related_slug' => '350-kva-generator-rental',
        'related_name' => '350 kVA Generator Hire',
        'secondary_slug' => 'silent-generator',
        'secondary_name' => 'Silent Generator Fleet',
    ],

    '350-kva-generator-rental' => [
        'title' => '350 kVA Generator Rental in UAE',
        'kva' => '350',
        'kw' => '280',
        'amps' => '505',
        'engine' => 'Perkins 1506A-E88TAG5 Heavy-Duty Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '8.8',
        'f25' => '19.8',
        'f50' => '38.5',
        'f75' => '57.5',
        'f100' => '76.5',
        'tank' => '750',
        'sound7m' => '71 dBA',
        'sound1m' => '80 dBA',
        'cables' => '4x240mm² SWA or 2 runs of 4x120mm² flexible single-core HO7RN-F',
        'breaker' => '630A 4-Pole MCCB',
        'oil_cap' => '41.0 Litres',
        'coolant_cap' => '43.2 Litres',
        'dimensions' => '4,150 x 1,380 x 2,100 mm',
        'weight' => '3,650 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Chiller Powering (100 TR)</h4>
                <p class="text-xs text-slate-600">Direct prime power supply for 100 TR air-cooled chillers, secondary hydronic circulation pumps, and modular air handling units.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Major Wastewater Lift Stations</h4>
                <p class="text-xs text-slate-600">Guarantees continuous 24/7 pumping power for heavy municipal sewage lift stations during municipal electrical feeder upgrades.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Steel Fabrication & Pipe Coating</h4>
                <p class="text-xs text-slate-600">Supplies multi-operator welding banks, induction pre-heating coils, and blast-cleaning compressor arrays in Hamriyah Free Zone.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Civil Tunneling & Metro Upgrades</h4>
                <p class="text-xs text-slate-600">Provides rugged, vibration-resistant power for underground ventilation fans, muck skip hoists, and tunnel emergency drainage.</p>
            </div>',
        'img1' => 'storage/media/Diesel-Generator.webp',
        'img2' => 'storage/media/1000kva-generator-rental.webp',
        'alt1' => '350 kVA heavy industrial diesel generator rental UAE',
        'alt2' => 'Perkins 1506A powertrain and Stamford alternator inside 350 kVA soundproof canopy',
        'cap1' => '350 kVA heavy duty generator powering 100 TR industrial chiller plant in Dubai South.',
        'cap2' => 'Deep Sea digital telemetry controller with motorized 630A 4-pole circuit breaker.',
        'related_slug' => '500kva-generator-hire',
        'related_name' => '500 kVA Generator Hire',
        'secondary_slug' => '200-kva-generator-rental',
        'secondary_name' => '200 kVA Generator Hire',
    ],

    '500kva-generator-hire' => [
        'title' => '500 kVA Generator Rental in UAE',
        'kva' => '500',
        'kw' => '400',
        'amps' => '722',
        'engine' => 'Cummins QSX15-G8 / Perkins 2506A-E15TAG1',
        'cyl' => '6-Cylinder Heavy-Duty In-line',
        'disp' => '15.0',
        'f25' => '28.5',
        'f50' => '54.0',
        'f75' => '80.5',
        'f100' => '107.0',
        'tank' => '1000',
        'sound7m' => '72 dBA',
        'sound1m' => '81 dBA',
        'cables' => '2 runs of 4x185mm² or 3 runs of 4x120mm² flexible single-core HO7RN-F',
        'breaker' => '800A 4-Pole MCCB / ACB',
        'oil_cap' => '62.0 Litres',
        'coolant_cap' => '58.0 Litres',
        'dimensions' => '4,900 x 1,650 x 2,350 mm',
        'weight' => '5,450 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Large-Scale Chiller Powering (150-200 TR)</h4>
                <p class="text-xs text-slate-600">Primary electrical source for heavy 150 TR to 200 TR air-cooled chillers operating in district cooling emergency bypass modes.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Mega Tower Construction Compounds</h4>
                <p class="text-xs text-slate-600">Simultaneously powers dual high-speed tower cranes, twin alimak construction hoists, and site dewatering pumps on landmark projects.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Oil & Gas Drilling Base Camps</h4>
                <p class="text-xs text-slate-600">Continuous prime baseload power for onshore exploration rigs, mud pumping circuits, and desert accommodation facilities in Abu Dhabi.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Data Center Emergency Backup</h4>
                <p class="text-xs text-slate-600">Class G3 transient response powering enterprise IT server rooms, UPS rectifiers, and precision cooling CRAC units.</p>
            </div>',
        'img1' => 'storage/media/500kva-generator-rental.webp',
        'img2' => 'storage/media/cummins-500kw-generator-rental.webp',
        'alt1' => '500 kVA Cummins diesel generator hire in Dubai Abu Dhabi',
        'alt2' => 'Heavy duty 500 kVA generator unit with Cummins QSX15 engine',
        'cap1' => '500 kVA Cummins generator mobilized for district cooling emergency backup in Dubai.',
        'cap2' => '15-Litre Cummins QSX15 engine featuring XPI high-pressure common rail fuel injection.',
        'related_slug' => '600-kva-generator-rental',
        'related_name' => '600 kVA Generator Hire',
        'secondary_slug' => '1000-kva-generator-rental',
        'secondary_name' => '1000 kVA Generator Hire',
    ],

    '600-kva-generator-rental' => [
        'title' => '600 kVA Generator Rental in UAE',
        'kva' => '600',
        'kw' => '480',
        'amps' => '866',
        'engine' => 'Perkins 2806A-E18TAG1A Heavy Industrial Diesel',
        'cyl' => '6-Cylinder Heavy-Duty In-line',
        'disp' => '18.1',
        'f25' => '34.0',
        'f50' => '64.5',
        'f75' => '96.0',
        'f100' => '128.0',
        'tank' => '1200',
        'sound7m' => '73 dBA',
        'sound1m' => '82 dBA',
        'cables' => '2 runs of 4x240mm² or 3 runs of 4x150mm² flexible single-core HO7RN-F',
        'breaker' => '1000A 4-Pole Air Circuit Breaker (ACB)',
        'oil_cap' => '68.0 Litres',
        'coolant_cap' => '61.0 Litres',
        'dimensions' => '5,200 x 1,750 x 2,450 mm',
        'weight' => '6,120 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Steel Rolling Mills & Heavy Foundries</h4>
                <p class="text-xs text-slate-600">Absorbs sudden harmonic and inductive impact loads from scrap induction melting furnaces and heavy hydraulic extrusion presses.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Port Container Gantry Crane Commissioning</h4>
                <p class="text-xs text-slate-600">Supplies regulated variable frequency power during shipyard testing of automated ship-to-shore (STS) container gantry cranes.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Precast Concrete Complexes</h4>
                <p class="text-xs text-slate-600">Continuous prime electricity for high-output batching plants, planetary mixers, and gantry transport cranes in ICAD Abu Dhabi.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Multi-Megawatt Synchronized Fleets</h4>
                <p class="text-xs text-slate-600">Integrates with DSE 8610 load-sharing controllers to form scalable 1.8 MVA to 3.6 MVA modular central power stations.</p>
            </div>',
        'img1' => 'storage/media/industrial-generator.webp',
        'img2' => 'storage/media/500kva-generator-rental.webp',
        'alt1' => '600 kVA Perkins heavy industrial generator rental UAE',
        'alt2' => 'Perkins 2806A 18-litre engine and heavy canopy of 600 kVA generator',
        'cap1' => '600 kVA heavy industrial generator delivering prime baseload for manufacturing in Sajaa.',
        'cap2' => 'Heavy-duty 18.1-Litre Perkins diesel engine equipped with oversized 50°C tropical radiator.',
        'related_slug' => '800-kva-generator-rental',
        'related_name' => '800 kVA Generator Hire',
        'secondary_slug' => '500kva-generator-hire',
        'secondary_name' => '500 kVA Generator Hire',
    ],

    '800-kva-generator-rental' => [
        'title' => '800 kVA Generator Rental in UAE',
        'kva' => '800',
        'kw' => '640',
        'amps' => '1155',
        'engine' => 'Perkins 2806A-E18TAG2 / Cummins QSK23',
        'cyl' => '6-Cylinder Heavy Industrial',
        'disp' => '18.1',
        'f25' => '45.0',
        'f50' => '85.0',
        'f75' => '126.0',
        'f100' => '168.0',
        'tank' => '1500',
        'sound7m' => '74 dBA',
        'sound1m' => '83 dBA',
        'cables' => '3 runs of 4x240mm² or 4 runs of 4x185mm² flexible single-core HO7RN-F',
        'breaker' => '1250A 4-Pole Air Circuit Breaker (ACB)',
        'oil_cap' => '68.0 Litres',
        'coolant_cap' => '61.0 Litres',
        'dimensions' => '5,600 x 1,850 x 2,550 mm',
        'weight' => '7,250 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Major Infrastructure Tunnel Boring (TBM)</h4>
                <p class="text-xs text-slate-600">Supplies high starting kVAR for underground excavation cutterheads, slurry circulation pumps, and hydraulic jacks.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Airport Terminal Expansion Projects</h4>
                <p class="text-xs text-slate-600">Critical continuous utility power for baggage handling systems, passenger boarding bridges, and apron lighting during grid tie-ins.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Petrochemical Turnaround Overhauls</h4>
                <p class="text-xs text-slate-600">Powers flare gas recovery blowers, nitrogen generation skids, and temporary site refinery sub-stations during turnaround shutdowns.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">District Cooling Emergency Backup (300 TR)</h4>
                <p class="text-xs text-slate-600">Directly energizes 300 TR process chillers and primary condenser cooling towers in commercial master developments.</p>
            </div>',
        'img1' => 'storage/media/industrial-generator.webp',
        'img2' => 'storage/media/1000kva-generator-rental.webp',
        'alt1' => '800 kVA prime diesel generator rental in Dubai Abu Dhabi',
        'alt2' => 'Industrial acoustic enclosure and motorized ACB panel of 800 kVA generator',
        'cap1' => '800 kVA prime diesel generator providing continuous power for infrastructure in Dubai.',
        'cap2' => 'Heavy-duty Stamford alternator and Deep Sea digital load-sharing controller.',
        'related_slug' => '1000-kva-generator-rental',
        'related_name' => '1000 kVA Generator Hire',
        'secondary_slug' => '600-kva-generator-rental',
        'secondary_name' => '600 kVA Generator Hire',
    ],

    '1000-kva-generator-rental' => [
        'title' => '1000 kVA Generator Rental in UAE',
        'kva' => '1000',
        'kw' => '800',
        'amps' => '1443',
        'engine' => 'Cummins QST30-G4 / Perkins 4008TAG2A',
        'cyl' => 'V12 / 8-Cylinder Heavy-Duty',
        'disp' => '30.5',
        'f25' => '56.0',
        'f50' => '106.0',
        'f75' => '158.0',
        'f100' => '210.0',
        'tank' => '1800',
        'sound7m' => '75 dBA',
        'sound1m' => '84 dBA',
        'cables' => '4 runs of 4x240mm² flexible single-core HO7RN-F with Powersafe connectors',
        'breaker' => '1600A 4-Pole Air Circuit Breaker (ACB)',
        'oil_cap' => '153.0 Litres',
        'coolant_cap' => '149.0 Litres',
        'dimensions' => '6,200 x 2,150 x 2,650 mm',
        'weight' => '9,850 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Multi-Megawatt Industrial Power Plants</h4>
                <p class="text-xs text-slate-600">Synchronized via DSE 8610 controllers into 5 MVA to 20 MVA temporary electrical utilities for new industrial free zones.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Offshore & Coastal Dredging Reclamation</h4>
                <p class="text-xs text-slate-600">Supplies high-voltage transformer step-up skids (400V to 11kV) powering heavy cutter suction dredgers in coastal waters.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">District Cooling Mega Plants (500 TR)</h4>
                <p class="text-xs text-slate-600">Continuous power source for large 500 TR centrifugal chillers and multi-cell cooling towers during utility transformer overhauls.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">ADNOC Oilfield Exploration Clusters</h4>
                <p class="text-xs text-slate-600">Baseload power for remote oilwell artificial lift systems, gas gathering compressors, and central processing facilities.</p>
            </div>',
        'img1' => 'storage/media/1000kva-generator-rental.webp',
        'img2' => 'storage/media/cummins-500kw-generator-rental.webp',
        'alt1' => '1000 kVA Cummins V12 prime power generator rental UAE',
        'alt2' => 'Heavy containerized acoustic enclosure of 1000 kVA generator unit',
        'cap1' => '1000 kVA Cummins V12 power module powering 500 TR district cooling plant in Abu Dhabi.',
        'cap2' => 'Motorized 1600A Air Circuit Breaker with digital Deep Sea synchronization interface.',
        'related_slug' => '1250-kva-generator-rental',
        'related_name' => '1250 kVA Generator Hire',
        'secondary_slug' => '500kva-generator-hire',
        'secondary_name' => '500 kVA Generator Hire',
    ],

    '1250-kva-generator-rental' => [
        'title' => '1250 kVA Generator Rental in UAE',
        'kva' => '1250',
        'kw' => '1000',
        'amps' => '1804',
        'engine' => 'Cummins KTA50-G3 / Perkins 4012-46TWG2A',
        'cyl' => 'V16 / V12 Heavy Industrial Diesel',
        'disp' => '50.3',
        'f25' => '70.0',
        'f50' => '132.0',
        'f75' => '196.0',
        'f100' => '262.0',
        'tank' => '2200',
        'sound7m' => '76 dBA',
        'sound1m' => '85 dBA',
        'cables' => '5 runs of 4x240mm² flexible single-core HO7RN-F with Powersafe busbar clamps',
        'breaker' => '2000A 4-Pole Air Circuit Breaker (ACB)',
        'oil_cap' => '204.0 Litres',
        'coolant_cap' => '196.0 Litres',
        'dimensions' => '6,800 x 2,250 x 2,800 mm',
        'weight' => '12,400 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">DEWA / ADDC Grid Substation Overhauls</h4>
                <p class="text-xs text-slate-600">Supplies temporary utility injection power during scheduled 132kV/11kV transformer maintenance in commercial metropolitan areas.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Large Petrochemical Refineries</h4>
                <p class="text-xs text-slate-600">Baseload power for catalytic cracking units, heavy compressor trains, and nitrogen plants during planned turnarounds.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial District Cooling (750 TR)</h4>
                <p class="text-xs text-slate-600">Energizes massive 750 TR centrifugal process chillers, high-flow condenser pumps, and cooling tower fan arrays.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Shipbuilding Drydocks & Offshore Rigs</h4>
                <p class="text-xs text-slate-600">Continuous 1 MW electrical baseload powering hydraulic syncrolift elevators and heavy marine shipyard machinery.</p>
            </div>',
        'img1' => 'storage/media/industrial-generator.webp',
        'img2' => 'storage/media/1000kva-generator-rental.webp',
        'alt1' => '1250 kVA Cummins 1 Megawatt industrial diesel generator hire UAE',
        'alt2' => 'Cummins KTA50 50-litre V16 engine and Stamford alternator within 1250 kVA unit',
        'cap1' => '1250 kVA 1 MW power generation module supporting grid substation maintenance in Dubai.',
        'cap2' => 'Heavy-duty 50-Litre Cummins V16 powertrain with dual turbochargers and 2000A ACB.',
        'related_slug' => '1000-kva-generator-rental',
        'related_name' => '1000 kVA Generator Hire',
        'secondary_slug' => 'heavy-duty-industrial-generator',
        'secondary_name' => 'Industrial Generator Fleet',
    ],

    'portable-generator' => [
        'title' => 'Portable Generator Rental in UAE',
        'kva' => '30',
        'kw' => '24',
        'amps' => '43',
        'engine' => 'Perkins 404D-22G / Kubota V2203',
        'cyl' => '4-Cylinder Naturally Aspirated',
        'disp' => '2.2',
        'f25' => '2.1',
        'f50' => '3.9',
        'f75' => '5.6',
        'f100' => '7.5',
        'tank' => '100',
        'sound7m' => '62 dBA',
        'sound1m' => '70 dBA',
        'cables' => '5-core 16mm² flexible cable with 32A/63A industrial CEE-form sockets',
        'breaker' => '63A 4-Pole MCB / ELCB',
        'oil_cap' => '10.6 Litres',
        'coolant_cap' => '9.3 Litres',
        'dimensions' => '1,850 x 850 x 1,180 mm',
        'weight' => '780 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Highway Night Road Repair & Line Marking</h4>
                <p class="text-xs text-slate-600">Trailer-mounted portable generator powering asphalt thermal heaters, pavement groovers, and mobile floodlight masts.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Telecom Tower Cell-Site Maintenance</h4>
                <p class="text-xs text-slate-600">Supplies clean emergency power to cellular base transceiver stations (BTS) and battery rectifiers during utility outages.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Outdoor Hospitality & Food Trucks</h4>
                <p class="text-xs text-slate-600">Whisper-quiet ultra-silent acoustic canopy powering catering concession trailers, commercial espresso machines, and display lighting.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Luxury Yacht & Marine Berth Power</h4>
                <p class="text-xs text-slate-600">Provides temporary shore power for private yachts undergoing hull polishing and cabin interior electrical renovations.</p>
            </div>',
        'img1' => 'storage/media/Portable-generator.webp',
        'img2' => 'storage/media/pota-geeee.jpg',
        'alt1' => 'Portable compact silent diesel generator rental in UAE',
        'alt2' => 'Mobile road trailer mounted portable generator with industrial socket outlets',
        'cap1' => 'Trailer-mounted portable silent generator deployed for municipal road repairs in Dubai.',
        'cap2' => 'Integrated CEE industrial plug-and-play outlets with earth leakage circuit breaker.',
        'related_slug' => '50-kva-generator-rental',
        'related_name' => '50 kVA Generator Hire',
        'secondary_slug' => 'silent-generator',
        'secondary_name' => 'Silent Generator Fleet',
    ],

    'heavy-duty-industrial-generator' => [
        'title' => 'Heavy Duty Industrial Generator Rental in UAE',
        'kva' => '1250',
        'kw' => '1000',
        'amps' => '1804',
        'engine' => 'Cummins KTA50-G8 / Perkins 4016 Heavy Industrial Powertrain',
        'cyl' => 'V16 Heavy Duty Industrial Diesel',
        'disp' => '50.3',
        'f25' => '72.0',
        'f50' => '135.0',
        'f75' => '200.0',
        'f100' => '268.0',
        'tank' => '2500',
        'sound7m' => '75 dBA',
        'sound1m' => '84 dBA',
        'cables' => 'Heavy multi-run 240mm² single-core cables with busbar lugs',
        'breaker' => '2000A - 3200A Motorized Air Circuit Breaker (ACB)',
        'oil_cap' => '204.0 Litres',
        'coolant_cap' => '196.0 Litres',
        'dimensions' => '6,800 x 2,300 x 2,850 mm',
        'weight' => '12,800 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Oilfield Onshore Drilling & Gas Compression</h4>
                <p class="text-xs text-slate-600">Supplies high-torque continuous prime power for deep drilling mud pumps, top drives, and production separator heaters in Abu Dhabi.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Maritime Dredging & Island Reclamation</h4>
                <p class="text-xs text-slate-600">Powers high-capacity slurry booster pumping stations and hydraulic winches on offshore land reclamation projects.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Smelting & Cement Manufacturing</h4>
                <p class="text-xs text-slate-600">Provides robust baseload power withstand against high harmonic distortion and rapid step-load applications.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Multi-Megawatt Utility Microgrids</h4>
                <p class="text-xs text-slate-600">Synchronizes multiple containerized generators into independent power stations delivering 10 MVA to 50 MVA across remote developments.</p>
            </div>',
        'img1' => 'storage/media/gen-constr.jpg',
        'img2' => 'storage/media/industrial-generator.webp',
        'alt1' => 'Heavy duty containerized industrial generator rental in UAE',
        'alt2' => '20ft ISO containerized heavy industrial power generator module',
        'cap1' => 'Heavy-duty 1.25 MVA containerized diesel generator deployed on oilfield site in Abu Dhabi.',
        'cap2' => 'Industrial V16 powertrain with 2000A ACB and automated synchronizing switchgear.',
        'related_slug' => '1000-kva-generator-rental',
        'related_name' => '1000 kVA Generator Hire',
        'secondary_slug' => '1250-kva-generator-rental',
        'secondary_name' => '1250 kVA Generator Hire',
    ],

    'silent-generator' => [
        'title' => 'Silent Generator Rental in UAE (Sound-Attenuated Canopies)',
        'kva' => '250',
        'kw' => '200',
        'amps' => '360',
        'engine' => 'Perkins 1106A-70TAG4 / Cummins 6CTA Low-Noise Diesel',
        'cyl' => '6-Cylinder In-line',
        'disp' => '7.0',
        'f25' => '14.5',
        'f50' => '28.0',
        'f75' => '41.5',
        'f100' => '55.0',
        'tank' => '600',
        'sound7m' => '64 dBA',
        'sound1m' => '73 dBA',
        'cables' => '4x150mm² flexible single-core HO7RN-F',
        'breaker' => '400A 4-Pole MCCB',
        'oil_cap' => '19.5 Litres',
        'coolant_cap' => '32.0 Litres',
        'dimensions' => '3,850 x 1,300 x 2,000 mm',
        'weight' => '3,100 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Media Productions & Film Sets</h4>
                <p class="text-xs text-slate-600">Ultra-silent acoustic dampening delivering clean electrical sine wave power for high-definition film lighting and live sound recording.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Luxury Residential & Diplomatic Enclaves</h4>
                <p class="text-xs text-slate-600">Complies strictly with residential night noise ordinances (< 65 dBA) in Emirates Hills, Al Barari, and Saadiyat Island.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Hospitals & Emergency Medical Facilities</h4>
                <p class="text-xs text-slate-600">Supplies vibration-free emergency standby backup power adjacent to patient wards and operating theater wings.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Night Construction in Urban Centers</h4>
                <p class="text-xs text-slate-600">Allows construction contractors in Downtown Dubai and DIFC to execute night concrete pours without noise violation fines.</p>
            </div>',
        'img1' => 'storage/media/Silent-generator.jpg',
        'img2' => 'storage/media/generator-acoustic.webp',
        'alt1' => 'Silent soundproof acoustic generator hire in Dubai UAE',
        'alt2' => 'Acoustic baffle louvers and mineral rockwool sound insulation of silent generator',
        'cap1' => 'Ultra-silent acoustic generator operating seamlessly on filming production in Dubai.',
        'cap2' => 'Multi-stage residential exhaust silencer attenuating sound pressure to 64 dBA at 7 meters.',
        'related_slug' => '250-kva-generator-rental',
        'related_name' => '250 kVA Generator Hire',
        'secondary_slug' => '50-kva-generator-rental',
        'secondary_name' => '50 kVA Generator Hire',
    ],

    'diesel-generator' => [
        'title' => 'Diesel Generator Rental in UAE (Continuous Prime Power Fleet)',
        'kva' => '500',
        'kw' => '400',
        'amps' => '722',
        'engine' => 'Perkins 2506A-E15TAG2 / Cummins QSX15 Heavy Diesel',
        'cyl' => '6-Cylinder Heavy-Duty In-line',
        'disp' => '15.0',
        'f25' => '29.0',
        'f50' => '55.0',
        'f75' => '81.5',
        'f100' => '108.5',
        'tank' => '1100',
        'sound7m' => '70 dBA',
        'sound1m' => '79 dBA',
        'cables' => '2 runs of 4x185mm² flexible single-core HO7RN-F',
        'breaker' => '800A 4-Pole MCCB',
        'oil_cap' => '62.0 Litres',
        'coolant_cap' => '58.0 Litres',
        'dimensions' => '4,900 x 1,650 x 2,350 mm',
        'weight' => '5,450 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Continuous Commercial Baseload Power</h4>
                <p class="text-xs text-slate-600">Supplies prime electricity for off-grid commercial warehouse hubs, agricultural greenhouses, and water bottling plants in Al Ain.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Civil Engineering Infrastructure Projects</h4>
                <p class="text-xs text-slate-600">Powers heavy earthmoving workshops, tower cranes, and site illumination on major highway interchange developments.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Air Conditioning & Chiller Support</h4>
                <p class="text-xs text-slate-600">Provides continuous 400V 3-phase power to industrial 150 TR chillers and packaged air handling units during summer heat peaks.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Utility Power Outage Mitigation</h4>
                <p class="text-xs text-slate-600">Fast-dispatch emergency generator fleet restoring full commercial production within 2 hours of regional grid failure.</p>
            </div>',
        'img1' => 'storage/media/diesel-generator.jpg',
        'img2' => 'storage/media/diesel-generator-for-rent.webp',
        'alt1' => 'Commercial prime diesel generator rental in UAE',
        'alt2' => 'Cummins diesel engine and heavy-duty radiator within canopy',
        'cap1' => '500 kVA continuous prime diesel generator powering commercial industrial plant in UAE.',
        'cap2' => 'Electronic fuel injection system delivering optimal fuel economy under 24/7 prime duty.',
        'related_slug' => '500kva-generator-hire',
        'related_name' => '500 kVA Generator Hire',
        'secondary_slug' => 'silent-generator',
        'secondary_name' => 'Silent Generator Fleet',
    ],
];

$chillerFleet = [
    'air-cooled-chiller-rental-uae' => [
        'title' => 'Air Cooled Chiller Rental in UAE',
        'tr' => '250',
        'kw_th' => '880',
        'flow_m3' => '151',
        'flow_gpm' => '665',
        'refrigerant' => 'R-134a Eco-Friendly Non-Ozone Depleting',
        'compressor' => 'Semi-Hermetic Twin-Screw Compressors with Variable Frequency Drives (VFD)',
        'temp_range' => '+5°C to +15°C Chilled Water (Down to -8°C with Glycol Brine)',
        'elec_kw' => '235',
        'amps' => '405',
        'gen_kva' => '500 kVA',
        'sound' => '72 dBA @ 10 meters',
        'connections' => '6-inch PN16 flanged with quick Bauer / Camlock couplers',
        'dimensions' => '5,800 x 2,300 x 2,550 mm',
        'weight' => '6,850 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Commercial District Cooling Supplementation</h4>
                <p class="text-xs text-slate-600">Supplements high-rise commercial towers in Business Bay and Downtown Dubai during summer peak thermal surges or ETS valve overhauls.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Concrete Batching Plant Ice-Water Cooling</h4>
                <p class="text-xs text-slate-600">Circulates chilled water at +4°C to batching plant mixing drums to meet strict CIRIA concrete pour temperature limits (&lt; 32°C).</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Plastic & Chemical Processing</h4>
                <p class="text-xs text-slate-600">Rapid mold cooling for injection molding lines and reactor cooling jackets in JAFZA and Sajaa Industrial Area.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Air-Conditioned Mega Event Marquees</h4>
                <p class="text-xs text-slate-600">Powers high-static chilled water Air Handling Units (AHUs) delivering 100% fresh, dehumidified conditioned air to exhibition domes.</p>
            </div>',
        'img1' => 'storage/media/14.jpg',
        'img2' => 'storage/media/air-cooled-chiller.webp',
        'alt1' => 'Air cooled rental chiller in Dubai UAE for commercial cooling',
        'alt2' => 'Microchannel condenser coils and twin screw compressors on air cooled chiller',
        'cap1' => '250 TR air-cooled rental chiller operating at 50°C ambient for district cooling support in Dubai.',
        'cap2' => 'V-bank condenser coils treated with Blygold PoluAl anti-corrosion coating for coastal endurance.',
        'related_slug' => 'water-cooled-chiller-rental-uae',
        'related_name' => 'Water Cooled Chiller Rental',
        'secondary_slug' => 'portable-chiller-rental-uae',
        'secondary_name' => 'Portable Chiller Rental',
    ],

    'water-cooled-chiller-rental-uae' => [
        'title' => 'Water Cooled Chiller Rental in UAE',
        'tr' => '500',
        'kw_th' => '1758',
        'flow_m3' => '302',
        'flow_gpm' => '1330',
        'refrigerant' => 'R-134a / R-513A Low Global Warming Potential',
        'compressor' => 'Multi-Stage Semi-Hermetic Centrifugal / Screw Compressors',
        'temp_range' => '+4°C to +12°C Chilled Water (Ultra-High Efficiency COP > 5.8)',
        'elec_kw' => '320',
        'amps' => '550',
        'gen_kva' => '750 kVA',
        'sound' => '70 dBA @ 10 meters',
        'connections' => '8-inch PN16 flanged headers with Victaulic grooved mechanical fittings',
        'dimensions' => '6,400 x 2,400 x 2,750 mm',
        'weight' => '10,500 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Mega Petrochemical Refineries & Gas Plants</h4>
                <p class="text-xs text-slate-600">Supplies high-efficiency continuous process cooling for hydrocarbon condenser trains and gas fractionation towers in Ruwais.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">District Cooling Central Plant Expansion</h4>
                <p class="text-xs text-slate-600">Provides seasonal baseload chilled water to utility networks (Empower, Tabreed) during permanent chiller overhauls.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Enterprise Hyperscale Data Centers</h4>
                <p class="text-xs text-slate-600">High-reliability thermal protection for server halls with continuous chilled water loop stability and N+1 pump redundancy.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Pharmaceutical Sterile Manufacturing</h4>
                <p class="text-xs text-slate-600">Strict temperature and humidity stabilization for sterile cleanroom HVAC suites and bio-reactor processing.</p>
            </div>',
        'img1' => 'storage/media/uae-water-cooled.jpg',
        'img2' => 'storage/media/water-cooled-chiller-for-rent-in-uae.webp',
        'alt1' => '500 TR water cooled process chiller rental in Abu Dhabi UAE',
        'alt2' => 'Shell and tube heat exchangers and centrifugal compressor on water cooled chiller',
        'cap1' => '500 TR water-cooled process chiller providing ultra-high-efficiency thermal cooling in Abu Dhabi.',
        'cap2' => 'Dual shell-and-tube evaporator and condenser vessels with bronze tubesheets and Victaulic connections.',
        'related_slug' => 'air-cooled-chiller-rental-uae',
        'related_name' => 'Air Cooled Chiller Rental',
        'secondary_slug' => 'refrigeration-unit-rental-uae',
        'secondary_name' => 'Refrigeration Unit Rental',
    ],

    'portable-chiller-rental-uae' => [
        'title' => 'Portable Chiller Rental in UAE',
        'tr' => '50',
        'kw_th' => '175',
        'flow_m3' => '30',
        'flow_gpm' => '132',
        'refrigerant' => 'R-410A Eco-Friendly High-Pressure Refrigerant',
        'compressor' => 'Digital Scroll / Compact Twin-Screw Compressors with Inverter Control',
        'temp_range' => '0°C to +15°C Chilled Water (Down to -5°C with Glycol Solution)',
        'elec_kw' => '52',
        'amps' => '92',
        'gen_kva' => '125 kVA',
        'sound' => '65 dBA @ 10 meters (Whisper-Quiet)',
        'connections' => '3-inch Camlock rapid quick-connect couplers',
        'dimensions' => '2,850 x 1,450 x 1,850 mm',
        'weight' => '1,820 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Server Room Emergency Spot Cooling</h4>
                <p class="text-xs text-slate-600">Rapid deployment within 2 hours to prevent server rack thermal shutdown during primary HVAC failure in Dubai.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Hospital MRI & Medical Equipment Cooling</h4>
                <p class="text-xs text-slate-600">Supplies precise chilled water to superconducting MRI magnets, CT scanners, and radiotherapy linear accelerators.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Industrial Laser & CNC Spindle Cooling</h4>
                <p class="text-xs text-slate-600">Eliminates thermal expansion and maintains micrometer-level machining tolerances in precision metal fabrication shops.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Food & Beverage Craft Fermentation</h4>
                <p class="text-xs text-slate-600">Accurate glycol jacket cooling for fermentation tanks, dairy batch pasteurizers, and bakery dough mixing bowls.</p>
            </div>',
        'img1' => 'storage/media/pot.jpg',
        'img2' => 'storage/media/portable-chiller.webp',
        'alt1' => 'Portable mobile emergency chiller rental in Dubai UAE',
        'alt2' => 'Trailer mounted compact chiller skid with quick Camlock hose connections',
        'cap1' => 'Mobile portable chiller skid positioned for emergency data center cooling in Dubai.',
        'cap2' => 'Integrated hydronic pump, expansion vessel, and microchannel condenser within compact skid.',
        'related_slug' => 'air-cooled-chiller-rental-uae',
        'related_name' => 'Air Cooled Chiller Rental',
        'secondary_slug' => 'refrigeration-unit-rental-uae',
        'secondary_name' => 'Refrigeration Unit Rental',
    ],

    'refrigeration-unit-rental-uae' => [
        'title' => 'Refrigeration Unit Rental in UAE',
        'tr' => '40',
        'kw_th' => '140',
        'flow_m3' => '24',
        'flow_gpm' => '106',
        'refrigerant' => 'R-404A / R-448A Low-GWP Commercial Refrigerant',
        'compressor' => 'Bitzer Two-Stage Semi-Hermetic Reciprocating / Screw with Economizer',
        'temp_range' => 'Deep Freeze (-25°C to -18°C) or Medium Cold Storage (+1°C to +4°C)',
        'elec_kw' => '65',
        'amps' => '118',
        'gen_kva' => '150 kVA',
        'sound' => '66 dBA @ 7 meters',
        'connections' => 'Insulated flexible refrigerant lines & heavy-duty quick Camlock fluid couplings',
        'dimensions' => '3,600 x 1,800 x 2,100 mm',
        'weight' => '2,650 kg',
        'applications' => '
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Food Logistics & Frozen Meat Distribution</h4>
                <p class="text-xs text-slate-600">Powers modular walk-in deep freezers (-22°C) for import/export meat, poultry, and seafood logistics hubs in Dubai Industrial City.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Pharmaceutical Vaccine & Plasma Cold Chain</h4>
                <p class="text-xs text-slate-600">Maintains validated GDP-compliant -20°C storage environments for temperature-sensitive biologics and vaccines in Abu Dhabi.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Airline Flight Kitchen Cold Stores</h4>
                <p class="text-xs text-slate-600">Supplements high-throughput blast chillers and holding freezers during peak holiday travel catering surges.</p>
            </div>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-1.5">
                <h4 class="font-bold text-slate-900 text-sm">Supermarket & Hypermarket Remodeling</h4>
                <p class="text-xs text-slate-600">Provides temporary external refrigeration containers during store refrigeration system retrofits and expansions.</p>
            </div>',
        'img1' => 'storage/media/tempraray-ac-in-uae.jpg',
        'img2' => 'storage/media/industrial-chiller.webp',
        'alt1' => 'Commercial walk-in refrigeration unit rental in UAE for cold storage',
        'alt2' => 'Bitzer low-temperature refrigeration condensing unit with electric defrost',
        'cap1' => 'Low-temperature modular refrigeration unit maintaining -22°C deep freeze in Dubai.',
        'cap2' => 'Two-stage Bitzer refrigeration compressors equipped with economizer subcooling circuits.',
        'related_slug' => 'portable-chiller-rental-uae',
        'related_name' => 'Portable Chiller Rental',
        'secondary_slug' => 'air-cooled-chiller-rental-uae',
        'secondary_name' => 'Air Cooled Chiller Rental',
    ],
];

// Update the 16 Generator Fleet Products
foreach ($generatorFleet as $slug => $data) {
    $product = Product::where('slug', $slug)->first();
    if (! $product) {
        echo "[WARNING] Product not found for slug: {$slug}\n";

        continue;
    }

    $content = generateGeneratorContent($data);
    $wordCount = str_word_count(strip_tags($content));

    $product->content = $content;
    $product->save();

    echo "[SUCCESS] Updated '{$product->title}' ({$slug}) -> Word Count: {$wordCount}\n";
}

// Update the 4 Chiller Fleet Products
foreach ($chillerFleet as $slug => $data) {
    $product = Product::where('slug', $slug)->first();
    if (! $product) {
        echo "[WARNING] Product not found for slug: {$slug}\n";

        continue;
    }

    $content = generateChillerContent($data);
    $wordCount = str_word_count(strip_tags($content));

    $product->content = $content;
    $product->save();

    echo "[SUCCESS] Updated '{$product->title}' ({$slug}) -> Word Count: {$wordCount}\n";
}

echo "\n====================================================================\n";
echo "FLEET CONTENT POPULATION COMPLETE FOR ALL 20 PRODUCTS!\n";
echo "====================================================================\n";

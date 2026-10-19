<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

echo "=== UPDATING ALL 29 SERVICES WITH TOPIC-SPECIFIC FEATURED AND CONTENT IMAGES ===\n";

$serviceImageMap = [
    40 => [ // Packaged AC Units Rental UAE
        'featured' => 'storage/media/packaged-ac-units-for-rent.jpg',
        'img1' => ['storage/media/Packaged-ac-unit-rental-in-uae.webp', 'High-Capacity Packaged Air Conditioning Unit on Site', 'Industrial rooftop packaged AC rental installation in Dubai industrial facility.'],
        'img2' => ['storage/media/tc-in-uae.jpg', 'Temporary Ducting and Packaged Cooling System', 'Flexible duct distribution connected to commercial packaged air conditioning unit.'],
    ],
    41 => [ // Portacabin for Sale in UAE
        'featured' => 'storage/media/portacabin-for-sale-in-uae.jpg',
        'img1' => ['storage/media/portable-office-cabin.webp', 'Modular Site Office Portacabin in UAE', 'Certified prefabricated site office cabin with steel skid frame and PU sandwich panel insulation.'],
        'img2' => ['storage/media/Refurbished-portacabin-for-sale-in-uae.webp', 'Refurbished Executive Portacabin Interior & Exterior', 'Heavy-duty refurbished executive site office ready for immediate transport across UAE.'],
    ],
    42 => [ // Used Container in UAE
        'featured' => 'storage/media/used-con.jpg',
        'img1' => ['storage/media/Security-Cabins.webp', 'Modified Shipping Container & Site Security Office', 'Custom converted ISO 20ft shipping container with insulated interior and secure steel doors.'],
        'img2' => ['storage/media/portacabin-buyer-in-uae.jpg', 'Used Dry Cargo Container Storage Yard', 'Wind and watertight (WWT) certified ISO shipping container in our Dubai depot.'],
    ],
    43 => [ // Used Caravan in UAE
        'featured' => 'storage/media/Labour-Portable-Accommodation-Cabins.webp',
        'img1' => ['storage/media/Portacabin-Toilet-Ablution-Units.webp', 'Mobile Worker Accommodation Caravan & Ablution Unit', 'Turnkey mobile campsite accommodation unit equipped with heavy-duty air conditioning.'],
        'img2' => ['storage/media/used-poratacabin-in-uae.jpg', 'Heavy-Duty Towable Site Caravan', 'Skid and wheeled mobile accommodation caravan engineered for remote desert project deployment.'],
    ],
    44 => [ // Used Chiller & AC Buyer in UAE
        'featured' => 'storage/media/used-chiller-buyer.jpg',
        'img1' => ['storage/media/used-chiller.jpg', 'Decommissioned Industrial Chiller Appraisal & Buyback', 'Commercial refrigeration plant appraisal for instant cash buyback in Sharjah.'],
        'img2' => ['storage/media/Packaged-ac-unit-rental-in-uae.webp', 'Surplus Commercial HVAC Decommissioning', 'Heavy crane lifting and extraction of decommissioned central AC and chiller equipment.'],
    ],
    45 => [ // Used Chiller in UAE
        'featured' => 'storage/media/used-chiller.jpg',
        'img1' => ['storage/media/industrial-chiller-1.webp', 'Certified Used Industrial Chiller Inspection', 'Used screw chiller undergoing pressure testing and heat exchanger tube inspection.'],
        'img2' => ['storage/media/used-chiller-buyer.jpg', 'Commercial Used Chiller Plant for Sale', 'Pre-owned air-cooled chiller package with refurbished compressor and electrical panels.'],
    ],
    46 => [ // Temporary Cooling in UAE
        'featured' => 'storage/media/tc-in-uae.jpg',
        'img1' => ['storage/media/rental-chiller-service-uae.webp', 'Emergency Temporary Cooling Installation', 'Modular rental chiller connected with quick-connect camlock water hoses.'],
        'img2' => ['storage/media/portable-ac-for-rent.webp', 'Portable Industrial Air Conditioning Units', 'High-ambient portable air conditioner providing targeted airflow in high-temperature facility.'],
    ],
    47 => [ // Rental Generator in UAE
        'featured' => 'storage/media/generator-rental-uae.jpg',
        'img1' => ['storage/media/Power-Generator-Rental.jpg', 'Heavy Diesel Generator Rental on Jobsite', 'Prime-rated Cummins and Perkins generator rental providing continuous power in Abu Dhabi.'],
        'img2' => ['storage/media/1000kva-generator-rental.webp', 'Synchronized 1000 kVA Generator Setup', 'Multi-megawatt synchronized diesel generator plant with Deep Sea automatic load sharing.'],
    ],
    48 => [ // Rental Chiller in UAE
        'featured' => 'storage/media/chiller-rental-in-uae.webp',
        'img1' => ['storage/media/air-cooled-chiller.webp', 'Air-Cooled Rental Chiller in Operation', 'High-efficiency air-cooled screw chiller package delivering chilled water to commercial tower.'],
        'img2' => ['storage/media/water-cooled-chiller-for-rent-in-uae.webp', 'Heavy Industrial Water-Cooled Chiller', 'Continuous process cooling chiller installation with dedicated cooling tower and circulation pumps.'],
    ],
    49 => [ // Rental AC in UAE
        'featured' => 'storage/media/portable-ac-for-rent.webp',
        'img1' => ['storage/media/Commercial-AC-Rental-UAE.png', 'Commercial Floor-Standing AC Units for Rent', 'High-capacity temporary split and packaged air conditioner deployed for warehouse cooling.'],
        'img2' => ['storage/media/Spot-Cooler-Rental-UAE.png', 'Industrial Spot Cooler Portable Air Conditioner', 'Flexible spot cooler providing targeted cold air streams to factory assembly lines.'],
    ],
    50 => [ // Wild Air in UAE
        'featured' => 'storage/media/wild-air.jpg',
        'img1' => ['storage/media/District-Cooling-HVAC-Rental-Support-in-UAE.webp', 'Wild Air Pre-Commissioning AHU Setup', 'Temporary air handling units (AHU) providing building drying and humidity control.'],
        'img2' => ['storage/media/air-cooled-chiller-1.webp', 'Chilled Water Wild Air Piping & Flanges', 'Rapid temporary water piping and booster pumps supporting wild air cooling cycle.'],
    ],
    51 => [ // Honda Generator Rental UAE
        'featured' => 'storage/media/honda.jpg',
        'img1' => ['storage/media/Portable-generator.webp', 'Portable Inverter Generator for Sensitive Electronics', 'Compact ultra-quiet Honda generator providing clean sine-wave electricity on remote site.'],
        'img2' => ['storage/media/100kva-generator-rental.webp', 'Mobile Soundproof Generator Trailer', 'Towable compact generator set ready for film production, events, and light construction.'],
    ],
    52 => [ // Caterpillar Generator Rental UAE
        'featured' => 'storage/media/19.jpg',
        'img1' => ['storage/media/Power-Generator-Rental.jpg', 'Heavy Caterpillar Diesel Generator Power Set', 'Industrial Cat generator powering heavy civil construction plant and tower cranes.'],
        'img2' => ['storage/media/1000kva-generator-rental.webp', '1000 kVA Heavy Duty CAT Generator Installation', 'Containerized Caterpillar power module with integrated sound attenuation and fuel tank.'],
    ],
    53 => [ // Cummins Generator Rental UAE
        'featured' => 'storage/media/cummins.jpg',
        'img1' => ['storage/media/cummins-500kw-generator-rental.webp', 'Cummins 500 kW Heavy Duty Power Genset', 'Prime-rated Cummins power generation system with electronic governor and Stamford alternator.'],
        'img2' => ['storage/media/1000kva-generator-rental.webp', 'Synchronized Multi-Unit Cummins Power Station', 'Grid-backup synchronized Cummins generators installed at industrial facility in Dubai.'],
    ],
    54 => [ // Chiller Maintenance & Overhaul UAE
        'featured' => 'storage/media/maintenance-and-amc-service-in-dubai.webp',
        'img1' => ['storage/media/service4.jpg', 'Chiller Condenser Coil & Tube Overhaul', 'Certified HVAC technician descaling heat exchanger tubes and testing refrigerant circuits.'],
        'img2' => ['storage/media/ultimate.jpg', 'Industrial Compressor Overhaul & Oil Analysis', 'Rebuilding semi-hermetic screw compressor with genuine OEM bearings and seals.'],
    ],
    55 => [ // Industrial Chiller Rental UAE
        'featured' => 'storage/media/industrial-chiller.webp',
        'img1' => ['storage/media/industrial-chiller-1.webp', 'Heavy Process Cooling Industrial Chiller', 'Multi-ton industrial chiller skid designed for extreme 52°C ambient UAE desert conditions.'],
        'img2' => ['storage/media/water-cooled-chiller-for-rent-in-uae.webp', 'Continuous Water-Cooled Process Chiller', 'Turnkey industrial chilled water plant connected to manufacturing heat exchangers.'],
    ],
    56 => [ // Rental Cooling Solutions UAE
        'featured' => 'storage/media/rental-chiller-service-uae.webp',
        'img1' => ['storage/media/industrial-chiller.webp', 'Commercial & Industrial Rental Cooling Fleet', 'Complete modular chiller package with integrated circulation pumps and buffer tank.'],
        'img2' => ['storage/media/Chiller-Rental-for-Events-in-UAE.webp', 'Event & Facility Rental Chiller Mobilization', 'Sound-attenuated rental chiller setup supporting high-profile corporate event in Dubai.'],
    ],
    57 => [ // Air Cooled Chiller Rental UAE
        'featured' => 'storage/media/air-cooled-chiller.webp',
        'img1' => ['storage/media/air-cooled-chiller-1.webp', 'Modular Air-Cooled Scroll Chiller', 'Compact modular chiller installation with Blygold anti-corrosion condenser coil treatment.'],
        'img2' => ['storage/media/chiller-rental-service.webp', 'High-Ambient Screw Air-Cooled Chiller', 'Dual-circuit air-cooled chiller package operating at 100% capacity in extreme heat.'],
    ],
    58 => [ // Rental Power in UAE
        'featured' => 'storage/media/rental-power.webp',
        'img1' => ['storage/media/500kva-generator-rental.webp', 'Turnkey Rental Power Logistics & Cabling', 'Rapid dispatch of 500 kVA silent diesel generators with certified rubber distribution cables.'],
        'img2' => ['storage/media/rental-generator.webp', 'Industrial Temporary Power Generation Hub', 'Multi-megawatt power distribution board and transformer setup on construction site.'],
    ],
    59 => [ // Silent Generator Rental UAE
        'featured' => 'storage/media/Silent-Generator.webp',
        'img1' => ['storage/media/Silent-generator.jpg', 'Acoustic Soundproof Generator Canopy', 'Sound-attenuated enclosure delivering 65 dBA at 7 meters for hospital and residential zone use.'],
        'img2' => ['storage/media/100kva-generator-rental.webp', 'Super-Silent Compact Generator in Urban Area', 'Low-noise 100 kVA diesel generator powering commercial building during grid maintenance.'],
    ],
    60 => [ // Diesel Generator Rental UAE
        'featured' => 'storage/media/Diesel-Generator.webp',
        'img1' => ['storage/media/diesel-generator-for-rent.webp', 'Prime Heavy Diesel Generator Set', 'Heavy-duty industrial diesel generator built on robust crane-liftable steel skid.'],
        'img2' => ['storage/media/Power-Generator-Rental.jpg', 'Continuous Duty Diesel Power Unit on Site', '24/7 continuous duty diesel power generator operating under severe quarry dust conditions.'],
    ],
    61 => [ // Generator Maintenance UAE
        'featured' => 'storage/media/generator-maintenance-in-uae.webp',
        'img1' => ['storage/media/rental-gen-service.jpg', '50-Point Generator Preventive Maintenance Service', 'Certified mechanical engineer replacing Fleetguard filters and testing diesel engine telemetry.'],
        'img2' => ['storage/media/service4.jpg', 'Resistive Load Bank & Megger Insulation Test', 'Load testing generator to 100% capacity and checking winding insulation resistance.'],
    ],
    62 => [ // Generator AMC in UAE
        'featured' => 'storage/media/maintenance-and-amc-service-in-dubai.png',
        'img1' => ['storage/media/generator-maintenance-in-uae.webp', 'Annual Maintenance Contract Scheduled Inspection', 'Regular bi-monthly oil sampling, battery conductance check, and fuel polishing.'],
        'img2' => ['storage/media/Why-Heat-Is-a-Bigger-Problem.jpg', 'Radiator Descaling & Cooling Maintenance', 'High-pressure chemical radiator cleaning preventing engine overheating during Dubai summer.'],
    ],
    63 => [ // Chiller AMC in UAE
        'featured' => 'storage/media/chiller-rental-service.webp',
        'img1' => ['storage/media/air-cooled-chiller.webp', 'Comprehensive Chiller AMC Maintenance Inspection', 'Refrigerant leak detection, oil acid testing, and microchannel coil flushing.'],
        'img2' => ['storage/media/maintenance-and-amc-service-in-dubai.png', 'Preventive HVAC Contract Field Service', 'Quarterly vibration analysis and electrical contactor overhaul on central chiller plant.'],
    ],
    64 => [ // Perkins Generators UAE
        'featured' => 'storage/media/Power-Generator-Rental.jpg',
        'img1' => ['storage/media/rental-generator.webp', 'Genuine Perkins Powered Industrial Generator', 'Fuel-efficient Perkins 1100 and 2000 series engine generator with Stamford alternator.'],
        'img2' => ['storage/media/500kva-generator-rental.webp', 'Perkins 500 kVA Prime Standby Genset', 'Soundproof Perkins generator providing emergency standby power for shopping mall.'],
    ],
    65 => [ // Used Generators UAE
        'featured' => 'storage/media/500kva-generator-rental.webp',
        'img1' => ['storage/media/Power-Generator-Rental.jpg', 'Certified Used Industrial Diesel Generator', 'Pre-owned diesel generator undergoing complete compression testing and diagnostic scanning.'],
        'img2' => ['storage/media/1000kva-generator-rental.webp', 'Certified 1000 kVA Used Generator for Sale', 'Fully load-tested used Caterpillar power set ready for immediate dispatch across UAE.'],
    ],
    66 => [ // Refurbished Generators UAE
        'featured' => 'storage/media/1000kva-generator-rental.webp',
        'img1' => ['storage/media/Diesel-Generator.webp', 'Zero-Hour Refurbished Diesel Generator Set', 'Factory-refurbished generator with rebuilt cylinders, new AVR, and Deep Sea digital controller.'],
        'img2' => ['storage/media/500kva-generator-rental.webp', 'Refurbished Generator 4-Hour Load Bank Trial', 'Resistive load bank verification certifying full power output before client delivery.'],
    ],
    67 => [ // Refurbished Chillers UAE
        'featured' => 'storage/media/air-cooled-chiller-1.webp',
        'img1' => ['storage/media/industrial-chiller.webp', 'Zero-Hour Refurbished Industrial Chiller Unit', 'Completely overhauled screw chiller with new expansion valves and Blygold coated coils.'],
        'img2' => ['storage/media/chiller-rental-in-uae.webp', 'Refurbished Air-Cooled Chiller Testing', 'Factory pressure testing and electrical calibration on reconditioned chiller package.'],
    ],
    68 => [ // Refurbished Portacabin UAE
        'featured' => 'storage/media/Refurbished-portacabin-for-sale-in-uae.webp',
        'img1' => ['storage/media/Used-Portacabin-for-sale-in-uae.webp', 'Grade-A Refurbished Site Office Portacabin', 'Rebuilt prefabricated cabin with new PU sandwich panels and DEWA-compliant wiring.'],
        'img2' => ['storage/media/New-Portacabin-in-uae.webp', 'Executive Modular Accommodation Unit', 'Fitted with commercial vinyl flooring, split air conditioning, and LED lighting.'],
    ],
];

foreach ($serviceImageMap as $id => $data) {
    $svc = Service::find($id);
    if (! $svc) {
        echo "Service ID {$id} not found!\n";

        continue;
    }

    $svc->featured_image = $data['featured'];
    $svc->og_image = $data['featured'];

    // Check if images are already in content
    $content = $svc->content ?? '';
    preg_match_all('/<img[^>]+>/i', $content, $existingImgs);
    $imgCount = count($existingImgs[0]);

    if ($imgCount < 2) {
        // Create 2 beautiful, responsive figure blocks
        [$src1, $alt1, $cap1] = $data['img1'];
        [$src2, $alt2, $cap2] = $data['img2'];

        $fig1 = <<<HTML
<figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
    <img src="/{$src1}" alt="{$alt1}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
    <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
        {$cap1}
    </figcaption>
</figure>
HTML;

        $fig2 = <<<HTML
<figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
    <img src="/{$src2}" alt="{$alt2}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
    <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
        {$cap2}
    </figcaption>
</figure>
HTML;

        // Insert fig1 after first section or H2, and fig2 near the middle or before final section
        if (str_contains($content, '</h2>')) {
            $parts = explode('</h2>', $content, 2);
            $content = $parts[0].'</h2>'."\n".$fig1."\n".$parts[1];

            // Insert fig2 before the last section
            if (str_contains($content, '</section>')) {
                $lastSecPos = strrpos($content, '</section>');
                $content = substr_replace($content, "\n".$fig2."\n</section>", $lastSecPos, strlen('</section>'));
            } else {
                $content .= "\n".$fig2;
            }
        } else {
            $content = $fig1."\n".$content."\n".$fig2;
        }

        $svc->content = $content;
    }

    $svc->save();
    echo "Updated Service ID {$id}: '{$svc->title}' -> Featured: {$svc->featured_image} (Content has >= 2 images)\n";
}

echo "=== ALL 29 SERVICES SUCCESSFULLY UPDATED WITH IMAGES ===\n";

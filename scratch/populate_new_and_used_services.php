<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$services = [
    [
        'slug' => 'perkins-generators-uae',
        'title' => 'Perkins Generators UAE',
        'focus_keyword' => 'perkins generators uae',
        'tagline' => 'New & Rental Perkins Diesel Generators (10 kVA to 2500 kVA) Across UAE',
        'hero_badge' => 'Genuine Perkins Power • UK Engineered • 50°C Rated',
        'summary' => 'Genuine Perkins diesel generator sales, rental, and service across Dubai, Abu Dhabi, and Sharjah ranging from 10 kVA to 2500 kVA. Built with genuine Perkins engines (400, 1100, 1200, 2000, 4000 series), Leroy Somer alternators, and Deep Sea controls.',
        'meta_title' => 'Perkins Generators UAE | 10–2500 kVA Diesel Gensets Dubai & Abu Dhabi',
        'meta_description' => 'Genuine Perkins generators in UAE: 10 kVA to 2500 kVA new & rental diesel generators across Dubai, Abu Dhabi & Sharjah. UK engineered with genuine parts & 24/7 warranty.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Perkins</strong> is one of the world's most trusted diesel engine brands, renowned across the Arabian Gulf for rugged durability, high thermal tolerance, and low lifecycle operating costs. <strong>Rental Power UAE</strong> supplies genuine <strong>Perkins generators in the UAE</strong> for turnkey rental, new equipment sales, and certified maintenance across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Genuine Perkins Engine Series Architecture</h2>
    <ul>
        <li><strong>Perkins 400 Series (10 kVA – 40 kVA):</strong> Compact, ultra-quiet 3-cylinder and 4-cylinder engines ideal for telecom towers, mobile security cabins, and residential backup.</li>
        <li><strong>Perkins 1100 Series (50 kVA – 250 kVA):</strong> The standard workhorse of the UAE construction sector, powering tower cranes, dewatering pumps, and batching plants with exceptional fuel economy.</li>
        <li><strong>Perkins 2000 & 4000 Series (350 kVA – 2500 kVA):</strong> Heavy 6-cylinder in-line, V12, and V16 electronic turbocharged engines designed for hospital standby, shopping malls, and multi-megawatt industrial power plants.</li>
    </ul>

    <h2>2. Frequently Asked Questions (Perkins UAE)</h2>

    <h3>Are your Perkins generators genuine UK-engineered units?</h3>
    <p>
        Yes. All Perkins engines supplied by Rental Power UAE are genuine OEM units paired with world-class Leroy Somer or Stamford alternators and Deep Sea digital controllers.
    </p>

    <h2>Inquire About Perkins Generators</h2>
    <p>
        Contact our generator sales and rental division today at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">inquiry form</a> for instant spec sheets and commercial quotations.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'used-generators-uae',
        'title' => 'Used Generators UAE',
        'focus_keyword' => 'used generators uae',
        'tagline' => 'Certified Pre-Owned Industrial Diesel Generators for Sale Across Dubai & UAE',
        'hero_badge' => 'Certified Used Generators • 40%–60% CAPEX Savings',
        'summary' => 'High-quality inspected used diesel generators for sale across Dubai, Abu Dhabi, and Sharjah ranging from 30 kVA to 2000 kVA. Verified running hours, full load bank test certification, and turnkey installation warranty for Caterpillar, Cummins, and Perkins.',
        'meta_title' => 'Used Generators UAE | Certified Used Diesel Gensets Dubai & Sharjah',
        'meta_description' => 'Certified used generators for sale in UAE: 30 kVA to 2000 kVA pre-owned diesel generators across Dubai & Sharjah. Load bank tested with warranty & instant commissioning.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Investing in brand-new diesel generation often entails prohibitive capital expenditures and factory lead times exceeding 16 to 24 weeks. <strong>Rental Power UAE</strong> provides certified <strong>used generators in the UAE</strong>, offering thoroughly audited pre-owned diesel power modules from <strong>30 kVA to 2000 kVA</strong> at <strong>40% to 60% savings</strong> compared to new machinery across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Rigorous Technical Verification for Pre-Owned Gensets</h2>
    <ul>
        <li><strong>Authentic Running Hour Verification:</strong> Electronic ECM audit and physical mechanical verification to ensure odometer accuracy.</li>
        <li><strong>Full-Load Resistive Load Bank Testing:</strong> Every unit is tested under 100% continuous load for 4 hours, logging oil pressure, coolant temperature, and frequency stability.</li>
        <li><strong>Alternator Insulation Megger Audit:</strong> 1000V DC winding resistance test proving insulation integrity above 10 Megohms.</li>
        <li><strong>Turnkey Decommissioning & Delivery:</strong> We manage crane rigging, low-bed transport, and site commissioning.</li>
    </ul>

    <h2>Buy or Sell Used Generators</h2>
    <p>
        Explore our <a href="/used-refurbished-generators">used and refurbished generator inventory</a> or contact our asset trading desk at <strong>+971 56 921 3754</strong>.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'refurbished-generators-uae',
        'title' => 'Refurbished Generators UAE',
        'focus_keyword' => 'refurbished generators uae',
        'tagline' => 'Factory-Rebuilt Zero-Hour Certified Refurbished Diesel Generators in UAE',
        'hero_badge' => '50-Point Technical Refurbishment • Like-New Performance',
        'summary' => 'Certified refurbished diesel generators across Dubai, Abu Dhabi, and Sharjah. Completely overhauled engines, fresh acoustic canopy refinishing, new Deep Sea digital controllers, and full load bank certification with comprehensive warranty.',
        'meta_title' => 'Refurbished Generators UAE | Factory Rebuilt Gensets Dubai & Abu Dhabi',
        'meta_description' => 'Certified refurbished generators in UAE: zero-hour rebuilt diesel generators with new DSE controllers, load bank testing & workshop warranty across Dubai & Abu Dhabi.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        A refurbished generator from <strong>Rental Power UAE</strong> is not simply a cleaned used machine—it is a completely rebuilt power asset restored to factory-original operating tolerances. We supply certified <strong>refurbished generators in the UAE</strong> ranging from <strong>50 kVA to 1500 kVA</strong> with comprehensive workshop warranties across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. The 50-Point Refurbishment Benchmark</h2>
    <ul>
        <li><strong>Complete Engine Teardown & Rebuild:</strong> Cylinder honing, new piston rings, main and rod bearing replacement, valve reseating, and injector overhaul.</li>
        <li><strong>Control Panel Modernization:</strong> Retrofitting obsolete analog panels with genuine Deep Sea DSE 7320 or DSE 8610 digital synchronizing modules.</li>
        <li><strong>Canopy Stripping & Polyurethane Recoating:</strong> Sandblasting to bare metal, applying zinc anti-corrosion primer, and finishing with durable polyurethane paint.</li>
    </ul>

    <h2>Inquire About Refurbished Generators</h2>
    <p>
        Call Rental Power UAE at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">quotation form</a> for immediate stock lists and pricing.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'refurbished-chillers-uae',
        'title' => 'Refurbished Chillers UAE',
        'focus_keyword' => 'refurbished chillers uae',
        'tagline' => 'Certified Overhauled Industrial Screw & Centrifugal Chillers for Sale in UAE',
        'hero_badge' => 'Overhauled HVAC Chillers • Factory Tested with Warranty',
        'summary' => 'Certified refurbished industrial chillers across Dubai, Abu Dhabi, and Sharjah ranging from 50 TR to 500 TR. Rebuilt screw compressors, new microchannel condenser coils, fresh microprocessor controls, and performance testing under UAE 50°C heat.',
        'meta_title' => 'Refurbished Chillers UAE | Overhauled Industrial Chillers Dubai',
        'meta_description' => 'Certified refurbished chillers for sale in UAE: 50 TR to 500 TR overhauled air-cooled & water-cooled chillers across Dubai & Abu Dhabi. Rebuilt compressors with warranty.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Rental Power UAE</strong> supplies certified <strong>refurbished chillers in the UAE</strong>, offering factory-overhauled air-cooled screw and water-cooled centrifugal chillers ranging from <strong>50 TR to 500 TR</strong> at significant capital savings across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Comprehensive Chiller Rebuilding Scope</h2>
    <ul>
        <li><strong>Compressor Overhaul:</strong> Precision bearing replacement, rotor re-alignment, and new mechanical seals on Carrier 06N, York semi-hermetic, and Trane helical rotary screw compressors.</li>
        <li><strong>Eddy Current NDT Tube Testing:</strong> Non-destructive testing confirming 100% copper tube integrity.</li>
        <li><strong>Pressure Testing & Dehydration:</strong> Nitrogen pressure testing at 350 PSI and deep vacuum dehydration before virgin refrigerant charging.</li>
    </ul>

    <h2>Inquire About Refurbished Chillers</h2>
    <p>
        Contact our industrial HVAC sales desk at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">online inquiry form</a>.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'refurbished-portacabin-uae',
        'title' => 'Refurbished Portacabin UAE',
        'focus_keyword' => 'refurbished portacabin uae',
        'tagline' => 'High-Grade Refurbished Modular Site Offices & Accommodation Cabins in UAE',
        'hero_badge' => 'Turnkey Refurbished Cabins • PU Insulated • 50°C Ready',
        'summary' => 'High-grade refurbished portacabins for sale and rent across Dubai, Abu Dhabi, and Sharjah. Offering reconditioned executive site offices, labor accommodation units, sanitary ablution blocks, and security guard cabins with new ACs and fresh electrical wiring.',
        'meta_title' => 'Refurbished Portacabin UAE | Reconditioned Site Office Cabins Dubai',
        'meta_description' => 'Refurbished portacabins for sale in UAE: executive site offices, labor cabins & ablution blocks across Dubai, Abu Dhabi & Sharjah. New ACs, wiring & fresh paint.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Rental Power UAE</strong> provides premium <strong>refurbished portacabins in the UAE</strong>, transforming pre-owned modular structures into turnkey, like-new site offices, staff accommodation units, and sanitary blocks across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. The Modular Refurbishment Standard</h2>
    <ul>
        <li><strong>Structural Steel Chassis Reconditioning:</strong> Sandblasted, reinforced, and coated with heavy-duty anti-rust bitumen undercoating.</li>
        <li><strong>High-Density PU Panel Upgrades:</strong> 50mm to 100mm polyurethane sandwich panels delivering superior thermal insulation against 50°C UAE desert heat.</li>
        <li><strong>New Electrical & Plumbing Fit-Out:</strong> Recertified load centers, LED lighting, durable vinyl flooring, and brand-new split air conditioners.</li>
    </ul>

    <h2>Buy Refurbished Portacabins</h2>
    <p>
        Explore our <a href="/service/portacabin-for-sale-in-uae">portacabin sales inventory</a> or call <strong>+971 56 921 3754</strong> for immediate site office delivery.
    </p>
</div>
HTML,
    ],
];

foreach ($services as $svcData) {
    $service = Service::firstOrNew(['slug' => $svcData['slug']]);
    $service->title = $svcData['title'];
    $service->focus_keyword = $svcData['focus_keyword'];
    $service->tagline = $svcData['tagline'];
    $service->hero_badge = $svcData['hero_badge'];
    $service->summary = $svcData['summary'];
    $service->content = $svcData['content'];
    $service->meta_title = $svcData['meta_title'];
    $service->meta_description = $svcData['meta_description'];
    $service->meta_keywords = "{$svcData['title']}, used generators uae, refurbished generators dubai, portacabin for sale uae";
    $service->status = 'published';
    $service->is_featured = true;
    $service->is_indexable = true;
    $service->save();

    $words = str_word_count(strip_tags($service->content));
    echo "Saved service: {$service->slug} | Words: {$words}\n";
}

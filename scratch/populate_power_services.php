<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$powerServices = [
    [
        'slug' => 'rental-power-in-uae',
        'title' => 'Rental Power in UAE',
        'focus_keyword' => 'rental power in uae',
        'tagline' => 'Turnkey Rental Power Solutions & Multi-Megawatt Temporary Power Plants Across UAE',
        'hero_badge' => 'Prime & Standby Power • 20 kVA to 50 MW Synchronized Plants',
        'summary' => 'Turnkey rental power in UAE across Dubai, Abu Dhabi, and Sharjah. Supplying prime and standby diesel generators, synchronizing panels, step-up transformers (11kV/33kV), and multi-megawatt temporary power stations with 24/7 technical monitoring.',
        'meta_title' => 'Rental Power in UAE | 20 kVA to 50 MW Generator Power Dubai & Abu Dhabi',
        'meta_description' => 'Turnkey rental power in UAE: 20 kVA to 50 MW diesel generator rental, high-voltage substations & synchronizing plants across Dubai & Abu Dhabi. 24/7 rapid dispatch.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Rental Power UAE</strong> is the leading turnkey provider of <strong>rental power in the UAE</strong>, engineering, mobilizing, and operating temporary electrical generation packages scaling from <strong>20 kVA portable units up to 50 MW synchronized power stations</strong>. From massive infrastructure projects in <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a> and oilfield operations across <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a> to manufacturing plants in <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>, our power generation fleet guarantees 99.99% operational uptime under demanding 50°C desert conditions.
    </p>

    <h2>1. The Turnkey Rental Power Fleet Spectrum</h2>
    <p>
        Unplanned power outages and grid interconnection delays severely jeopardize construction schedules, industrial manufacturing, and critical civic operations. Rental Power UAE maintains one of the largest and most technically advanced generator hire fleets in the Middle East:
    </p>
    <ul>
        <li><strong>Low-Voltage Fleet (20 kVA – 1250 kVA @ 400V 3Ph 50Hz):</strong> Soundproof, skid-mounted, and containerized diesel generator sets powered by tier-one engines (<a href="/service/cummins-generator-rental-uae">Cummins</a>, <a href="/service/perkins-generators-uae">Perkins</a>, and <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a>). Perfect for tower cranes, concrete pumps, and temporary site offices.</li>
        <li><strong>Multi-Megawatt Synchronized Mini-Grids (2 MW – 50 MW):</strong> Modular 1,000 kVA and 1,250 kVA generators paralleled through digital load-sharing controllers (Deep Sea DSE 8610 and ComAp InteliGen), featuring automatic demand-start/stop to slash fuel burn during off-peak hours.</li>
        <li><strong>Medium & High Voltage Power Packages (11 kV & 33 kV):</strong> Step-up transformers and containerized switchgear configured for direct connection to regional utility distribution networks (DEWA, ADDC, SEWA) during primary substation shutdowns.</li>
    </ul>

    <h3>Rental Power Fleet Capacity & Performance Matrix</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Capacity Rating</th>
                    <th class="p-3 border border-slate-800">Prime kW Output</th>
                    <th class="p-3 border border-slate-800">Engine Make</th>
                    <th class="p-3 border border-slate-800">Fuel Burn @ 75% Load</th>
                    <th class="p-3 border border-slate-800">Acoustic Rating (dBA @ 7m)</th>
                    <th class="p-3 border border-slate-800">Direct Fleet Link</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">50 kVA Silent Genset</td>
                    <td class="p-3 text-slate-700">40 kW</td>
                    <td class="p-3 text-slate-600">Perkins 1103A</td>
                    <td class="p-3 text-slate-700">9.5 L/hr</td>
                    <td class="p-3 text-slate-600">68 dBA</td>
                    <td class="p-3"><a href="/fleet/50-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">View 50 kVA</a></td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">100 kVA Industrial Unit</td>
                    <td class="p-3 text-slate-700">80 kW</td>
                    <td class="p-3 text-slate-600">Cummins 6BT5.9</td>
                    <td class="p-3 text-slate-700">18.5 L/hr</td>
                    <td class="p-3 text-slate-600">70 dBA</td>
                    <td class="p-3"><a href="/fleet/100-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">View 100 kVA</a></td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">250 kVA Heavy Duty</td>
                    <td class="p-3 text-slate-700">200 kW</td>
                    <td class="p-3 text-slate-600">Cummins QSL9</td>
                    <td class="p-3 text-slate-700">44.0 L/hr</td>
                    <td class="p-3 text-slate-600">72 dBA</td>
                    <td class="p-3"><a href="/fleet/250-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">View 250 kVA</a></td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">500 kVA Power Module</td>
                    <td class="p-3 text-slate-700">400 kW</td>
                    <td class="p-3 text-slate-600">Cummins QSX15</td>
                    <td class="p-3 text-slate-700">85.0 L/hr</td>
                    <td class="p-3 text-slate-600">75 dBA</td>
                    <td class="p-3"><a href="/fleet/500kva-generator-hire" class="text-amber-600 hover:underline font-semibold">View 500 kVA</a></td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">1000 kVA Containerized</td>
                    <td class="p-3 text-slate-700">800 kW</td>
                    <td class="p-3 text-slate-600">Cummins KTA38</td>
                    <td class="p-3 text-slate-700">170.0 L/hr</td>
                    <td class="p-3 text-slate-600">75 dBA</td>
                    <td class="p-3"><a href="/fleet/1000-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">View 1000 kVA</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Desert Engineering: Overcoming 50°C Ambient Heat & Silica Dust</h2>
    <p>
        Operating diesel generators in the UAE environment requires specialized engineering adaptations that European and North American rental fleets simply cannot deliver without frequent failure:
    </p>
    <ul>
        <li><strong>Tropical Radiators with 52°C Ambient Limit:</strong> Oversized cooling cores with mechanical gear-driven or viscous-clutch fans prevent coolant boiling during midday summer peak hours.</li>
        <li><strong>Two-Stage Cyclonic Sand Filtration:</strong> High-efficiency pre-cleaners separate 95%+ of airborne desert sand particles before air enters primary micro-fiber filters, protecting cylinder liners from abrasive scoring.</li>
        <li><strong>Automated N+1 Synchronized Redundancy:</strong> Paralleling two or more generators ensures that if one engine requires routine oil and filter servicing, the remaining units seamlessly take over the load without a fraction of a second of site blackout.</li>
    </ul>

    <h2>3. Bulk Diesel Fuel Management & Environmental Containment</h2>
    <p>
        Continuous power requires a dependable fuel supply line. Rental Power UAE supplies:
    </p>
    <ul>
        <li><strong>Double-Walled Bunded External Tanks:</strong> 1,000-gallon to 5,000-gallon secondary containment tanks fully compliant with Dubai Municipality Environment Department regulations.</li>
        <li><strong>Automated Fuel Transfer Skids:</strong> High-flow electric transfer pumps with level-switch automation maintain constant day-tank fuel levels inside each generator canopy.</li>
        <li><strong>Dedicated Mobile Fuel Tanker Fleet:</strong> 24/7 scheduled diesel deliveries across all Emirates, guaranteeing uninterrupted power continuity for critical infrastructure.</li>
    </ul>

    <h2>4. Competitor Benchmarking: Rental Power UAE vs. Aggreko, Byrne & Jubaili</h2>
    <p>
        Contractors choose Rental Power UAE over multinational plant hire firms for several crucial operational reasons:
    </p>
    <ul>
        <li><strong>60-to-120 Minute Dispatch SLA:</strong> Strategically situated yards in Dubai, Abu Dhabi, and Sharjah ensure immediate mobilization with dedicated boom crane flatbeds.</li>
        <li><strong>All-Inclusive Engineering Quotes:</strong> Transparent pricing encompassing cabling, load bank testing, initial mobilization, and emergency on-site technician response.</li>
        <li><strong>Integrated Power & Climate Packages:</strong> Seamlessly pairing temporary power with high-tonnage <a href="/service/rental-chiller-in-uae">rental chillers</a> and <a href="/service/packaged-ac-units-rental-uae">packaged AC units</a> on a single consolidated contract.</li>
    </ul>

    <h2>5. Frequently Asked Questions (Rental Power UAE)</h2>

    <h3>How do I calculate what kVA generator my project needs?</h3>
    <p>
        Total your connected kW load, divide by the 0.8 power factor to get kVA, factor in inductive motor starting inrush currents (which draw 3x to 6x running amps for tower cranes and chillers), and add a 15% high-ambient desert safety margin. Contact our 24/7 engineering team at <strong>+971 56 921 3754</strong> for a free Single-Line Diagram (SLD) load review.
    </p>

    <h3>Are your generators compliant with local UAE utility regulations?</h3>
    <p>
        Yes. All equipment complies fully with DEWA, ADDC, SEWA regulations, and Civil Defence environmental containment codes.
    </p>

    <h3>What cable lengths and distribution equipment are provided?</h3>
    <p>
        We stock kilometers of heavy-duty flexible rubberized 4-core and single-core power cables (70mm² to 300mm²), complete with distribution boards, manual and automatic transfer switches (ATS), and earth-fault protection relays.
    </p>

    <h2>Deploy Turnkey Rental Power Across the UAE</h2>
    <p>
        Partner with the UAE's trusted temporary power generation leader. Call our 24/7 operations desk at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">rapid quotation form</a> for immediate technical sizing and commercial proposals.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'silent-generator-rental-uae',
        'title' => 'Silent Generator Rental UAE',
        'focus_keyword' => 'silent generator rental uae',
        'tagline' => 'Ultra-Quiet Soundproof Diesel Generator Hire Across Dubai, Abu Dhabi & Sharjah',
        'hero_badge' => 'Low Noise Acoustic Enclosures • 65 dBA @ 7m Rating',
        'summary' => 'Ultra-quiet silent generator rental in UAE across Dubai, Abu Dhabi, and Sharjah ranging from 20 kVA to 1250 kVA. Acoustically lined enclosures engineered for hospital backup, residential communities, film productions, and high-profile outdoor events.',
        'meta_title' => 'Silent Generator Rental UAE | Super Silent Diesel Gensets Dubai',
        'meta_description' => 'Super silent generator rental in UAE: 20 kVA to 1250 kVA ultra-quiet soundproof generators across Dubai, Abu Dhabi & Sharjah. 65 dBA rated for events, hospitals & film.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        When temporary electrical power is needed in noise-sensitive environments, standard industrial open-skid generators are completely unacceptable. <strong>Rental Power UAE</strong> provides ultra-quiet <strong>silent generator rental in the UAE</strong>, deploying acoustic-attenuated soundproof diesel generators ranging from <strong>20 kVA to 1250 kVA</strong> engineered to operate at or below <strong>65 to 68 dBA at 7 meters</strong> across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Acoustic Engineering & Soundproofing Architecture</h2>
    <p>
        Achieving ultra-low decibel ratings while sustaining heavy prime power in 50°C desert heat requires sophisticated acoustic engineering:
    </p>
    <ul>
        <li><strong>Acoustic Canopy Lining:</strong> Heavy-gauge galvanized steel canopies lined with high-density, non-flammable rockwool and perforated acoustic barriers that absorb sound energy across all frequency bands.</li>
        <li><strong>Residential Critical-Grade Silencers:</strong> Internal exhaust gas mufflers providing 35 to 40 dBA attenuation, completely eliminating engine exhaust pulsation noise.</li>
        <li><strong>Labyrinth Cooling Air Intake & Discharge:</strong> Acoustic baffled louvers that force cooling air through zig-zag chambers, trapping mechanical noise internally while allowing massive air exchange to prevent engine overheating.</li>
        <li><strong>Anti-Vibration Engine Mounts:</strong> Heavy-duty elastomer isolators between engine/alternator blocks and the steel base chassis, eliminating structural vibration transmission into surrounding buildings or paving.</li>
    </ul>

    <h3>Silent Fleet Decibel & Capacity Breakdown</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Fleet Model</th>
                    <th class="p-3 border border-slate-800">Prime Capacity</th>
                    <th class="p-3 border border-slate-800">Noise Level @ 7m</th>
                    <th class="p-3 border border-slate-800">Equivalent Noise Benchmark</th>
                    <th class="p-3 border border-slate-800">Ideal Applications</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/silent-generator" class="text-amber-600 hover:underline font-semibold">30 kVA Super Silent</a></td>
                    <td class="p-3 text-slate-700">24 kW</td>
                    <td class="p-3 text-emerald-600 font-bold">62 dBA</td>
                    <td class="p-3 text-slate-600">Quiet office conversation</td>
                    <td class="p-3 text-slate-600">Film shoots, executive broadcast villas, clinics</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/100-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">100 kVA Silent Genset</a></td>
                    <td class="p-3 text-slate-700">80 kW</td>
                    <td class="p-3 text-emerald-600 font-bold">65 dBA</td>
                    <td class="p-3 text-slate-600">Normal conversation at 1m</td>
                    <td class="p-3 text-slate-600">Hotel outdoor dining, VIP weddings, residential towers</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/250-kva-generator-rental" class="text-amber-600 hover:underline font-semibold">250 kVA Soundproof</a></td>
                    <td class="p-3 text-slate-700">200 kW</td>
                    <td class="p-3 text-slate-700 font-semibold">68 dBA</td>
                    <td class="p-3 text-slate-600">Passing passenger car</td>
                    <td class="p-3 text-slate-600">Hospital standby, school events, night construction</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/500kva-generator-hire" class="text-amber-600 hover:underline font-semibold">500 kVA Silent Power</a></td>
                    <td class="p-3 text-slate-700">400 kW</td>
                    <td class="p-3 text-slate-700 font-semibold">72 dBA</td>
                    <td class="p-3 text-slate-600">Moderate highway traffic</td>
                    <td class="p-3 text-slate-600">Shopping malls, commercial towers, concerts</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Key Applications for Silent Generator Rentals</h2>
    <ul>
        <li><strong>Film, Television & Broadcast Productions:</strong> Pristine audio recording requires generators that emit zero low-frequency rumble. Our super silent units power lighting grids and mobile production trailers without contaminating sound microphones.</li>
        <li><strong>Healthcare Facilities & Hospitals:</strong> Supplying uninterrupted emergency power during substation maintenance shutdowns without disturbing recovering patients or violating strict hospital noise limits.</li>
        <li><strong>Luxury Events & Outdoor Weddings:</strong> Providing silent prime power for stage lighting, audio systems, and temporary climate control marquees across Dubai’s premium desert resorts and golf clubs.</li>
        <li><strong>Urban Night-Time Construction:</strong> Complying with strict Dubai Municipality and Abu Dhabi Department of Municipalities and Transport (DMT) nighttime noise curfews for 24-hour civil construction operations.</li>
    </ul>

    <h2>3. Frequently Asked Questions (Silent Generators UAE)</h2>

    <h3>Can silent generators be safely used indoors or inside basements?</h3>
    <p>
        Diesel generators consume oxygen and produce carbon monoxide, requiring outdoor placement. However, our silent canopies can be positioned immediately adjacent to exterior walls, or connected to custom exhaust extensions and mechanical air ducts if installed in ventilated basement plant rooms.
    </p>

    <h3>Do silent generators run hotter than standard open generators?</h3>
    <p>
        No. Our canopies are custom-engineered with oversized radiators and high-velocity electric fans specifically tuned to maintain internal operating temperatures identical to open skid generators, even under 50°C UAE summer heat.
    </p>

    <h2>Reserve an Ultra-Quiet Silent Generator</h2>
    <p>
        Ensure clean, whisper-quiet temporary power for your next project. Contact Rental Power UAE today at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">quick quotation form</a> for immediate equipment delivery anywhere in the UAE.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'diesel-generator-rental-uae',
        'title' => 'Diesel Generator Rental UAE',
        'focus_keyword' => 'diesel generator rental uae',
        'tagline' => 'Heavy-Duty Prime & Standby Diesel Generator Hire Across Dubai, Abu Dhabi & Sharjah',
        'hero_badge' => 'Heavy Industrial Diesel Power • 20 kVA to 1250 kVA Units',
        'summary' => 'Industrial diesel generator rental across Dubai, Abu Dhabi, and Sharjah ranging from 20 kVA to 1250 kVA. Powered by Cummins, Perkins, and Caterpillar engines with 50°C tropical radiators, integrated ATS, and bulk fuel delivery.',
        'meta_title' => 'Diesel Generator Rental UAE | 20–1250 kVA Industrial Gensets Dubai',
        'meta_description' => 'Heavy-duty diesel generator rental in UAE: 20 kVA to 1250 kVA industrial diesel generators across Dubai, Abu Dhabi & Sharjah. Cummins & Perkins powered with 24/7 service.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Rental Power UAE</strong> is the Gulf's trusted source for heavy-duty <strong>diesel generator rental in the UAE</strong>, supplying industrial-grade prime and standby diesel power generation packages ranging from <strong>20 kVA to 1250 kVA</strong>. Operating across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>, our diesel generators power civil infrastructure, deep dewatering operations, manufacturing plants, and high-rise commercial towers.
    </p>

    <h2>1. Heavy-Duty Diesel Generator Capabilities</h2>
    <p>
        In harsh industrial settings, diesel remains the global standard for temporary power due to its high energy density, fuel safety (non-volatile flash point above 55°C), and rugged engine reliability under variable electrical loads.
    </p>
    <ul>
        <li><strong>World-Class Heavy Diesel Engines:</strong> Built exclusively with genuine <a href="/service/cummins-generator-rental-uae">Cummins</a>, <a href="/service/perkins-generators-uae">Perkins</a>, and <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a> turbocharged four-stroke engines engineered for 10,000+ operating hours between major overhauls.</li>
        <li><strong>Stamford & Leroy Somer Alternators:</strong> Class H insulation, IP23 weather protection, and digital automatic voltage regulators (AVR) delivering ultra-clean sine-wave electricity with &plusmn;0.5% voltage regulation.</li>
        <li><strong>Deep Sea Electronics (DSE) Digital Instrumentation:</strong> Advanced telemetry monitoring engine oil pressure, coolant temperature, fuel level, frequency, and harmonic distortion in real time.</li>
    </ul>

    <h2>2. Industrial Applications Across UAE Sectors</h2>
    <ul>
        <li><strong>Civil Construction & High-Rise Building:</strong> Powering tower cranes, passenger hoists, concrete batching plants, and worker welfare camps.</li>
        <li><strong>Continuous Groundwater Dewatering:</strong> Delivering uninterrupted 24/7 prime power for submersible dewatering pumps during deep foundation excavations across Dubai Marina and Business Bay.</li>
        <li><strong>Manufacturing & Factory Expansions:</strong> Providing bridge power during municipal electrical transformer upgrades in Sharjah Industrial Areas and JAFZA.</li>
        <li><strong>Oil & Gas Exploration:</strong> Explosion-proof spark arrestor and Chalwyn valve-equipped units meeting ADNOC onshore and offshore safety standards in Abu Dhabi's Western Region.</li>
    </ul>

    <h2>3. Frequently Asked Questions (Diesel Generator Hire)</h2>

    <h3>What fuel consumption should I budget for?</h3>
    <p>
        As an engineering benchmark, modern four-stroke diesel generators consume approximately <strong>0.24 liters per kilowatt-hour (kWh)</strong> at 75% load. For example, a 500 kVA generator operating at 400 kW prime rating and 75% load (300 kW) burns approximately 72 liters of diesel per hour.
    </p>

    <h3>Do you supply fuel delivery with the generator?</h3>
    <p>
        Yes. Rental Power UAE provides automated bulk fuel management, supplying double-walled external fuel tanks (1,000 to 3,000 gallons) and scheduled tanker deliveries across Dubai, Abu Dhabi, and Sharjah.
    </p>

    <h2>Hire a Diesel Generator in the UAE</h2>
    <p>
        Secure dependable temporary power today. Call our 24/7 engineering desk at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">quick contact form</a> for immediate dispatch and competitive hire rates.
    </p>
</div>
HTML,
    ],
];

foreach ($powerServices as $svcData) {
    $service = Service::firstOrNew(['slug' => $svcData['slug']]);
    $service->title = $svcData['title'];
    $service->focus_keyword = $svcData['focus_keyword'];
    $service->tagline = $svcData['tagline'];
    $service->hero_badge = $svcData['hero_badge'];
    $service->summary = $svcData['summary'];
    $service->content = $svcData['content'];
    $service->meta_title = $svcData['meta_title'];
    $service->meta_description = $svcData['meta_description'];
    $service->meta_keywords = "{$svcData['title']}, rental power uae, generator rental dubai, silent generator uae, diesel generator hire";
    $service->status = 'published';
    $service->is_featured = true;
    $service->is_indexable = true;
    $service->save();

    $words = str_word_count(strip_tags($service->content));
    echo "Saved power service: {$service->slug} | Words: {$words}\n";
}

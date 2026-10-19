<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$boosted = [
    // 1. Chiller Maintenance
    [
        'slug' => 'chiller-maintenance',
        'title' => 'Chiller Maintenance & Overhaul UAE',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Chillers represent the most energy-intensive mechanical equipment in any commercial facility or industrial plant in the United Arab Emirates. Operating chillers under extreme 50°C summer ambient heat accelerates oil breakdown, tube scaling, and compressor mechanical wear. <strong>Rental Power UAE</strong> provides certified <strong>chiller maintenance and overhaul services in the UAE</strong>, supporting Carrier, York (Johnson Controls), Trane, Daikin, and Dunham-Bush chillers across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Comprehensive Chiller Servicing Capabilities</h2>
    <p>
        Our factory-certified HVAC technicians perform precision overhauls on rotary screw, centrifugal, and scroll chillers according to rigorous ASHRAE and OEM technical specifications:
    </p>
    <ul>
        <li><strong>Rotary Screw & Centrifugal Compressor Rebuilding:</strong> Full teardown, dynamic rotor balancing, angular contact thrust bearing replacement, shaft seal renewal, and slide-valve capacity control recalibration.</li>
        <li><strong>Chemical & Mechanical Condenser Tube Descaling:</strong> High-pressure rotary brush tube punching and environmentally compliant chemical scale removal, restoring heat transfer efficiency and dramatically lowering compressor head pressure.</li>
        <li><strong>Eddy Current Non-Destructive Testing (NDT):</strong> Electromagnetic inspection of copper and cupronickel evaporator and condenser tube bundles to detect internal pitting, wall thinning, and micro-cracks before tube ruptures contaminate the refrigeration circuit with water.</li>
        <li><strong>Refrigerant Recovery & Reclamation:</strong> Certified recovery of R134a, R410A, and R123 refrigerants using closed-loop purification systems compliant with UAE Ministry of Climate Change and Environment guidelines.</li>
        <li><strong>Oil Spectrometry & Acid Testing:</strong> Laboratory testing of synthetic polyolester (POE) and mineral lubrication oils for moisture contamination, acid formation, and copper/iron wear particles.</li>
    </ul>

    <h2>2. Why Chiller Maintenance Is Crucial in the UAE Climate</h2>
    <p>
        In the Gulf region, hard municipal water and airborne dust quickly foul condenser tubes. Just 0.6 mm (0.024 inches) of calcium scale buildup inside condenser tubes increases compressor electrical power consumption by approximately <strong>21%</strong>, costing facility owners tens of thousands of dirhams in inflated utility bills every month.
    </p>
    <p>
        Rental Power UAE's preventive descaling and chemical passivation restore heat transfer efficiency to factory-rated COP (Coefficient of Performance), paying for the service within weeks through direct energy savings.
    </p>

    <h2>3. Temporary Chiller Bridging During Overhauls</h2>
    <p>
        Major chiller overhauls often require taking central units offline for 3 to 10 days. Rental Power UAE provides synchronized <a href="/service/rental-chiller-in-uae">rental chillers (50 TR to 1000 TR)</a> that connect to your building's chilled water headers, maintaining 100% cooling comfort for occupants while permanent overhauls are underway.
    </p>

    <h2>4. Frequently Asked Questions (Chiller Maintenance UAE)</h2>

    <h3>How frequently should commercial chillers undergo tube descaling in Dubai?</h3>
    <p>
        Water-cooled condensers in the UAE should undergo mechanical brush cleaning at least twice annually, with chemical descaling performed annually before the summer heat peak in May.
    </p>

    <h3>What compressor brands do your engineers service?</h3>
    <p>
        We service all tier-one chiller compressors including Carrier (06N, 06D, 06E), Trane (Helical Rotary, CenTraVac), York/Johnson Controls (Frick, YK, YS, YVAA), Daikin (McQuay single and dual screw), and Bitzer semi-hermetic screws.
    </p>

    <h2>Schedule Chiller Maintenance in UAE</h2>
    <p>
        Restore your chiller plant to peak thermodynamic efficiency. Call our senior HVAC engineers at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">service contact form</a> for immediate diagnostics.
    </p>
</div>
HTML,
    ],

    // 2. Chiller AMC in UAE
    [
        'slug' => 'chiller-amc-uae',
        'title' => 'Chiller AMC in UAE',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        In the Gulf climate, chiller failure is a business-critical emergency that can shut down commercial towers, data centers, and manufacturing lines within hours. <strong>Rental Power UAE</strong> delivers industry-leading <strong>Chiller AMC (Annual Maintenance Contracts) in the UAE</strong>, providing scheduled quarterly preventive maintenance, emergency leak detection, oil spectrometry, and guaranteed 24/7 priority callout coverage across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. What Our Comprehensive Chiller AMC Covers</h2>
    <p>
        Our tailored chiller service agreements eliminate unexpected HVAC repair costs and extend capital equipment lifespan by 10 to 15 years:
    </p>
    <ul>
        <li><strong>Quarterly Preventive Inspections:</strong> Calibrating electronic expansion valves (EEVs), testing compressor oil acid levels, cleaning electrical contactors, checking sensor calibrations (chilled water supply/return, condenser pressure), and auditing microprocessor safety parameters.</li>
        <li><strong>Oil Spectrometry Analysis:</strong> Laboratory spectroscopic testing of compressor lubrication oil to detect early trace metal wear (copper, iron, aluminum), moisture contamination, and acid formation before catastrophic compressor seizure occurs.</li>
        <li><strong>Condenser Coil Chemical Cleaning:</strong> Removing caked desert dust, silica sand, and salt deposits twice annually to maintain optimal condensing efficiency during peak summer.</li>
        <li><strong>Priority Emergency Dispatch SLA:</strong> Guaranteed 60-to-90-minute on-site arrival during unplanned chiller high-pressure or oil-differential alarms.</li>
        <li><strong>Emergency Standby Chiller Guarantee:</strong> If an AMC chiller suffers an irreparable compressor failure, we deploy a temporary <a href="/service/rental-chiller-in-uae">rental chiller</a> from our own fleet at preferred rates to prevent tenant disruptions.</li>
    </ul>

    <h2>2. Frequently Asked Questions (Chiller AMC)</h2>

    <h3>What brands of chillers do you maintain under AMC?</h3>
    <p>
        Our factory-trained technicians maintain all major international chiller brands including Carrier, Trane, York (Johnson Controls), Daikin, Dunham-Bush, Blue Star, and SKM.
    </p>

    <h3>Is water treatment included in the Chiller AMC?</h3>
    <p>
        We offer integrated water treatment packages including chemical dosing, scale inhibitors, and biocide monitoring for open cooling tower loops and closed chilled water loops.
    </p>

    <h2>Inquire About Chiller AMC Contracts</h2>
    <p>
        Protect your building's cooling infrastructure with guaranteed annual service agreements. Contact Rental Power UAE today at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">AMC inquiry portal</a>.
    </p>
</div>
HTML,
    ],

    // 3. Diesel Generator Rental UAE
    [
        'slug' => 'diesel-generator-rental-uae',
        'title' => 'Diesel Generator Rental UAE',
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
        <li><strong>Automated Synchronization Capability:</strong> Multi-genset digital load sharing allowing up to 32 units to parallel together for multi-megawatt mini-grids scaling to 50 MW.</li>
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

    // 4. Refurbished Chillers UAE
    [
        'slug' => 'refurbished-chillers-uae',
        'title' => 'Refurbished Chillers UAE',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Replacing commercial building chillers with new machinery often requires immense capital budgets and disruptive 20-week overseas factory delivery schedules. <strong>Rental Power UAE</strong> provides certified <strong>refurbished chillers in the UAE</strong>, offering factory-overhauled air-cooled screw and water-cooled centrifugal chillers from <strong>50 TR to 500 TR</strong> at <strong>40% to 55% lower cost</strong> across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Rigorous Industrial Chiller Refurbishment Scope</h2>
    <p>
        Every refurbished chiller that leaves our technical facility undergoes an intensive multi-stage overhaul:
    </p>
    <ul>
        <li><strong>Rotary Screw Compressor Teardown & Overhaul:</strong> Precision replacement of angular contact thrust bearings, cylindrical roller bearings, carbon shaft seals, and slide-valve pistons on Carrier 06N, Trane semi-hermetic, and York screw compressors.</li>
        <li><strong>Eddy Current Electromagnetic Tube Testing:</strong> 100% NDT inspection of copper evaporator and condenser tube bundles, confirming wall thickness and eliminating micro-cracking risks.</li>
        <li><strong>Condenser Coil Reconditioning or Replacement:</strong> Chemical ultrasonic descaling, comb straightening, and application of Blygold or ElectroFin anti-corrosion polyurethane coatings designed for coastal UAE atmospheric conditions.</li>
        <li><strong>Pressure Testing & Dehydration:</strong> Nitrogen holding test at 350 PSI for 24 hours followed by deep vacuum dehydration to 250 microns before charging with virgin R134a or R410A refrigerant.</li>
        <li><strong>Microprocessor Control Modernization:</strong> Retrofitting updated digital controllers with MODBUS/BACnet BMS integration and automated high-pressure protection logic.</li>
    </ul>

    <h2>2. Frequently Asked Questions (Refurbished Chillers UAE)</h2>

    <h3>What warranty is included with a refurbished chiller?</h3>
    <p>
        Every refurbished chiller sold by Rental Power UAE comes with a certified 6-to-12-month workshop mechanical warranty, with optional comprehensive <a href="/service/chiller-amc-uae">Chiller AMC coverage</a>.
    </p>

    <h3>How quickly can a refurbished chiller be delivered?</h3>
    <p>
        We maintain ready-to-ship stock in our Dubai and Sharjah yards, enabling delivery, crane placement, and piping connection within 48 to 72 hours from order confirmation.
    </p>

    <h2>Inquire About Refurbished Chillers</h2>
    <p>
        Restore your facility's cooling capacity with certified refurbished chillers. Contact Rental Power UAE at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">HVAC inquiry portal</a>.
    </p>
</div>
HTML,
    ],

    // 5. Refurbished Portacabin UAE
    [
        'slug' => 'refurbished-portacabin-uae',
        'title' => 'Refurbished Portacabin UAE',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Civil construction contractors and industrial facility operators in the UAE need modular site buildings that are comfortable, thermally insulated, and compliant with municipal labor welfare codes—without the exorbitant price tag of brand-new fabrication. <strong>Rental Power UAE</strong> provides premium <strong>refurbished portacabins in the UAE</strong>, reconditioning pre-owned modular cabins into like-new executive offices, labor accommodation units, and sanitary blocks across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. The Modular Cabin Refurbishment Process</h2>
    <p>
        Our carpentry and structural fabrication workshops completely restore secondary modular units:
    </p>
    <ul>
        <li><strong>Structural Steel Chassis Restoration:</strong> Heavy-gauge I-beam and channel skids are sandblasted, structurally reinforced with cross-members, and coated with anti-rust bituminous paint. Four-point crane lifting lugs are recertified for safe lifting.</li>
        <li><strong>High-Density Polyurethane (PU) Sandwich Panels:</strong> 50mm to 100mm PU injected wall and roof panels providing an exceptional thermal barrier against 50°C UAE desert sun.</li>
        <li><strong>Complete Electrical & Mechanical Rewiring:</strong> Brand-new PVC conduit wiring, certified circuit breaker load centers, energy-efficient LED light fixtures, and brand-new split air conditioners.</li>
        <li><strong>Interior Joinery & Sanitary Overhaul:</strong> Commercial vinyl flooring, thermal double-glazed sliding windows with fly-screens, solid-core doors, and fresh white ceramic washroom fittings.</li>
    </ul>

    <h2>2. Grading & Portacabin Types Available</h2>
    <ul>
        <li><strong>Executive Site Offices (20ft x 10ft / 40ft x 10ft):</strong> Partitioned manager rooms, conference spaces, and en-suite washrooms ready for immediate site mobilization.</li>
        <li><strong>Labor Camp Accommodation Blocks:</strong> Multi-occupant living quarters meeting Dubai Municipality and Ministry of Human Resources and Emiratisation (MOHRE) labor welfare codes.</li>
        <li><strong>Sanitary & Ablution Units:</strong> Heavy-duty porcelain toilets, urinals, hand-wash sinks, and electric water heaters with external plumbing manifolds.</li>
    </ul>

    <h2>3. Frequently Asked Questions (Refurbished Portacabin UAE)</h2>

    <h3>Can refurbished portacabins withstand Dubai's extreme summer heat?</h3>
    <p>
        Yes. Our refurbished units feature 50mm–100mm high-density polyurethane (PU) sandwich panels and thermal-break aluminum windows, maintaining indoor temperatures of 22°C to 24°C even during 50°C ambient heatwaves.
    </p>

    <h3>Do you handle transport and site offloading?</h3>
    <p>
        Yes. We supply dedicated crane flatbed trailers that deliver, offload, and level the cabins on your site across Dubai, Abu Dhabi, Sharjah, and all Northern Emirates.
    </p>

    <h2>Order Refurbished Portacabins in UAE</h2>
    <p>
        Get turnkey modular site accommodation delivered to your site within 48 hours. Call Rental Power UAE at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">portacabin inquiry form</a>.
    </p>
</div>
HTML,
    ],
];

foreach ($boosted as $data) {
    $service = Service::where('slug', $data['slug'])->first();
    if ($service) {
        $service->content = $data['content'];
        $service->save();
        $words = str_word_count(strip_tags($service->content));
        echo "Boosted service: {$service->slug} | Words: {$words}\n";
    }
}

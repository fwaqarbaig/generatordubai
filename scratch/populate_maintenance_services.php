<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$maintenanceServices = [
    [
        'slug' => 'generator-maintenance-uae',
        'title' => 'Generator Maintenance UAE',
        'focus_keyword' => 'generator maintenance uae',
        'tagline' => 'Certified Preventive Maintenance, Load Bank Testing & Overhauling for Industrial Diesel Generators Across UAE',
        'hero_badge' => 'Certified Generator Maintenance • 24/7 UAE Engineering Support',
        'summary' => 'Comprehensive diesel generator maintenance across Dubai, Abu Dhabi, and Sharjah. Offering 250-hour minor servicing, 1000-hour major overhauls, resistive load bank testing, oil analysis, and 24/7 emergency repair for Cummins, Perkins, Cat, and Volvo gensets.',
        'meta_title' => 'Generator Maintenance UAE | Industrial Diesel Genset Servicing Dubai',
        'meta_description' => 'Certified generator maintenance in UAE: 250h/500h/1000h preventive servicing, load banking & engine overhauls across Dubai & Abu Dhabi for Cummins, Perkins & Cat. 24/7.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        In the extreme heat and airborne silica dust of the United Arab Emirates, reliable diesel generator operation depends entirely on rigorous, preventive maintenance. <strong>Rental Power UAE</strong> provides comprehensive, certified <strong>generator maintenance in the UAE</strong>, covering preventive inspection schedules, 100% resistive load bank testing, oil spectrometry analysis, and major mechanical engine overhauls across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Comprehensive Generator Maintenance Tiers</h2>
    <p>
        Our factory-trained technicians service world-class diesel engine brands including <a href="/service/cummins-generator-rental-uae">Cummins</a>, <a href="/service/perkins-generators-uae">Perkins</a>, <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a>, Volvo Penta, FG Wilson, and MTU according to strict OEM technical standards:
    </p>
    <ul>
        <li><strong>Level A Minor Service (Every 250 Running Hours or 6 Months):</strong> Comprehensive fluid level audit, battery conductance testing, draining fuel-water separators, tensioning fan/alternator drive belts, cleaning air filter pre-cleaners, and verifying digital control panel fault codes.</li>
        <li><strong>Level B Major Service (Every 500 Running Hours or Annually):</strong> Complete engine oil drain and refill with OEM-certified 15W-40 CI-4/CK-4 lubricants, replacement of all primary and secondary lube oil filters, primary fuel filter/water separator replacement, secondary micron fuel filter replacement, and installation of new heavy-duty air filter elements.</li>
        <li><strong>Level C Advanced Overhaul (Every 1,000 to 2,000 Hours):</strong> Radiator chemical flushing and reverse-flow descaling, replacement of engine thermostats and water pump seals, valve lash clearance adjustment, fuel injector spray pattern testing, turbocharger end-float audit, and alternator Megger insulation resistance testing.</li>
        <li><strong>Full Engine Zero-Hour Rebuild:</strong> Complete mechanical teardown, crankshaft line boring, cylinder liner replacement, new piston crowns and rings, new main and con-rod bearings, camshaft rebushing, and complete head reconditioning.</li>
    </ul>

    <h3>Preventive Maintenance Inspection Schedule</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">System Component</th>
                    <th class="p-3 border border-slate-800">Weekly / Routine Check</th>
                    <th class="p-3 border border-slate-800">Level A (250 Hours)</th>
                    <th class="p-3 border border-slate-800">Level B (500 Hours)</th>
                    <th class="p-3 border border-slate-800">Level C (1,000+ Hours)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Lubrication System</td>
                    <td class="p-3 text-slate-600">Dipstick oil level check</td>
                    <td class="p-3 text-slate-600">Inspect for gasket leaks</td>
                    <td class="p-3 text-emerald-600 font-bold">Replace oil & filters</td>
                    <td class="p-3 text-slate-700">Laboratory oil spectrometry</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Fuel System</td>
                    <td class="p-3 text-slate-600">Check day tank level</td>
                    <td class="p-3 text-slate-600">Drain water separator trap</td>
                    <td class="p-3 text-emerald-600 font-bold">Replace all fuel filters</td>
                    <td class="p-3 text-slate-700">Calibrate injector pumps</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Cooling System</td>
                    <td class="p-3 text-slate-600">Visual coolant level check</td>
                    <td class="p-3 text-slate-600">Check belt tension</td>
                    <td class="p-3 text-slate-600">Chemical fin washdown</td>
                    <td class="p-3 text-emerald-600 font-bold">Flush coolant & thermostats</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Electrical & Alternator</td>
                    <td class="p-3 text-slate-600">Battery float voltage</td>
                    <td class="p-3 text-slate-600">Terminal tightening</td>
                    <td class="p-3 text-slate-600">ATS auto-start simulation</td>
                    <td class="p-3 text-emerald-600 font-bold">1000V Megger winding test</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Resistive Load Bank Testing & Wet Stacking Prevention</h2>
    <p>
        In commercial standby applications (e.g., shopping malls, commercial towers, hospitals), generators often run for months without experiencing more than 20% to 30% of their rated electrical load. This light-load operation causes a dangerous condition called <strong>"wet stacking"</strong>—where unburnt fuel, carbon particles, and lubricating oil accumulate inside the exhaust manifold, turbocharger housing, and silencer, drastically reducing power output and creating serious fire hazards.
    </p>
    <p>
        Rental Power UAE supplies mobile resistive/inductive load banks ranging from <strong>100 kW to 3,000 kW</strong>. Our engineers subject your generator to incremental stepped loading (25%, 50%, 75%, 100%, and 110% overload) for 2 to 4 continuous hours:
    </p>
    <ul>
        <li>Cleans carbon buildup and unburnt diesel from cylinder exhaust ports and valves.</li>
        <li>Verifies engine cooling performance under extreme thermal stress at full rated kW capacity.</li>
        <li>Tests alternator voltage regulation and governor frequency stability under sudden transient block loads.</li>
        <li>Provides a certified load bank compliance test certificate for insurance and Civil Defence regulatory audits.</li>
    </ul>

    <h2>3. 24/7 Emergency Breakdown Response SLA</h2>
    <p>
        When an emergency standby generator fails during a municipal utility outage, immediate response is vital:
    </p>
    <ul>
        <li><strong>Guaranteed 60-Minute Response:</strong> Dedicated mobile emergency repair vans stationed across Dubai, Abu Dhabi, and Sharjah equipped with diagnostic laptops, digital multimeters, starter motors, fuel lift pumps, and critical electrical relays.</li>
        <li><strong>Temporary Backup Replacement Guarantee:</strong> If on-site repair is not feasible within 4 hours, we instantly dispatch a replacement <a href="/service/rental-generator-in-uae">rental generator</a> from our fleet to restore facility power immediately.</li>
    </ul>

    <h2>4. Frequently Asked Questions (Generator Maintenance UAE)</h2>

    <h3>How often should standby diesel generators be serviced in the UAE?</h3>
    <p>
        Due to high ambient temperatures and pervasive airborne desert dust, generators in the UAE should receive a routine inspection every month, a minor service (Level A) every 250 running hours or 6 months, and a major comprehensive service (Level B) annually, regardless of whether operating hours have been logged.
    </p>

    <h3>What causes low oil pressure shutdowns in diesel generators?</h3>
    <p>
        Common causes include worn oil pump relief valves, oil viscosity breakdown due to extreme heat or fuel dilution, clogged oil filter elements, or worn main engine bearings. Our technicians perform immediate mechanical pressure testing to diagnose the root cause.
    </p>

    <h2>Schedule Generator Maintenance Today</h2>
    <p>
        Protect your facility from catastrophic power outages. Call Rental Power UAE's maintenance division at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">service inquiry form</a> for immediate maintenance audits and customized service contracts.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'generator-amc-uae',
        'title' => 'Generator AMC in UAE',
        'focus_keyword' => 'generator amc in uae',
        'tagline' => 'Annual Maintenance Contracts (AMC) for Industrial Diesel Generators Across Dubai & UAE',
        'hero_badge' => 'Comprehensive Generator AMC • Guaranteed 99.9% Uptime',
        'summary' => 'Comprehensive and non-comprehensive generator AMC contracts across Dubai, Abu Dhabi, and Sharjah. Offering scheduled quarterly preventive maintenance, emergency 24/7 callouts, free consumable replacements, load banking, and Civil Defence logbooks.',
        'meta_title' => 'Generator AMC in UAE | Annual Maintenance Contracts Dubai & Abu Dhabi',
        'meta_description' => 'Generator AMC in UAE: comprehensive annual maintenance contracts for diesel generators across Dubai & Abu Dhabi. Scheduled PM, 24/7 emergency response & Civil Defence logs.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Securing an <strong>Annual Maintenance Contract (AMC) for diesel generators in the UAE</strong> is the single most effective way to eliminate unexpected power blackouts, control facility maintenance budgets, and satisfy mandatory local Civil Defence regulations. <strong>Rental Power UAE</strong> manages generator AMCs for hundreds of commercial towers, healthcare clinics, manufacturing plants, and educational facilities across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. What Is Included in a Professional Generator AMC?</h2>
    <p>
        Our tailored generator service agreements eliminate guesswork and protect your capital machinery with predictable operating costs:
    </p>
    <ul>
        <li><strong>Scheduled Preventive Maintenance (Quarterly / Bi-Monthly):</strong> Systematic execution of 50-point checklists covering lubrication, cooling, fuel injection, air induction, and exhaust systems.</li>
        <li><strong>Free Consumables & Oil Changes (Comprehensive Packages):</strong> All OEM oil filters, fuel filters, air filters, and high-grade 15W-40 lubricants are supplied and replaced at zero additional billing.</li>
        <li><strong>24/7 Unlimited Emergency Callouts:</strong> Priority emergency dispatch with guaranteed technician arrival within 60 to 90 minutes anywhere in the UAE.</li>
        <li><strong>Annual Resistive Load Bank Testing:</strong> Mandatory full-load verification to eliminate wet stacking and prove standby capacity under extreme thermal conditions.</li>
        <li><strong>Civil Defence & Municipality Compliance:</strong> Maintenance of physical and digital generator logbooks verifying standby life-safety readiness.</li>
    </ul>

    <h3>Generator AMC Contract Comparison Matrix</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Feature / Service Scope</th>
                    <th class="p-3 border border-slate-800">Comprehensive AMC</th>
                    <th class="p-3 border border-slate-800">Non-Comprehensive AMC</th>
                    <th class="p-3 border border-slate-800">Ad-Hoc / Pay-As-You-Go</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Scheduled PM Visits</td>
                    <td class="p-3 text-emerald-600 font-bold">4 to 6 Visits / Year</td>
                    <td class="p-3 text-slate-700">4 Visits / Year</td>
                    <td class="p-3 text-slate-600">On-Demand Only</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Oil & Filter Replacements</td>
                    <td class="p-3 text-emerald-600 font-bold">Included 100% Free</td>
                    <td class="p-3 text-slate-600">Billed separately at discounted rate</td>
                    <td class="p-3 text-rose-600">Full retail pricing</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Emergency Callout Response</td>
                    <td class="p-3 text-emerald-600 font-bold">Priority &lt;60 Min SLA</td>
                    <td class="p-3 text-slate-700 font-semibold">&lt;90 Min SLA</td>
                    <td class="p-3 text-slate-600">Standard queue (4 &ndash; 12 hrs)</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Temporary Standby Backup Genset</td>
                    <td class="p-3 text-emerald-600 font-bold">Included if repair &gt; 4 hrs</td>
                    <td class="p-3 text-slate-600">Special discounted rental</td>
                    <td class="p-3 text-rose-600">Standard hire rate</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Frequently Asked Questions (Generator AMC UAE)</h2>

    <h3>Can an AMC be transferred if our company moves premises?</h3>
    <p>
        Yes. Our contracts are fully transferable to new locations within the UAE, and we can manage the mechanical decoupling, crane rigging, and re-commissioning at your new site.
    </p>

    <h3>What generator brands are covered under your AMC?</h3>
    <p>
        We service all tier-one diesel engines including <a href="/service/cummins-generator-rental-uae">Cummins</a>, <a href="/service/perkins-generators-uae">Perkins</a>, <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a>, Volvo Penta, FG Wilson, Doosan, Baudouin, and MTU.
    </p>

    <h2>Request a Customized Generator AMC Proposal</h2>
    <p>
        Ensure 100% standby power reliability for your facility. Call our service contracts department at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">AMC quote form</a> for an immediate site technical assessment.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'chiller-maintenance',
        'title' => 'Chiller Maintenance & Overhaul UAE',
        'focus_keyword' => 'chiller maintenance uae',
        'tagline' => 'Certified Industrial Chiller Servicing, Tube Descaling & Compressor Rebuilding Across UAE',
        'hero_badge' => 'Certified Chiller Overhaul • Air & Water-Cooled Systems',
        'summary' => 'Comprehensive chiller maintenance and overhaul services across Dubai, Abu Dhabi, and Sharjah for air-cooled screw chillers, water-cooled centrifugals, and industrial refrigeration. Offering eddy current tube testing, compressor rebuilds, and eco-refrigerant recovery.',
        'meta_title' => 'Chiller Maintenance & Overhaul UAE | Industrial Chiller Repair Dubai',
        'meta_description' => 'Certified chiller maintenance in UAE: air-cooled & water-cooled chiller servicing, tube descaling, compressor rebuilds & oil analysis across Dubai & Abu Dhabi. 24/7.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Chillers represent one of the most capital-intensive and electrically demanding assets in any commercial building or industrial facility in the United Arab Emirates. Operating chillers under extreme 50°C summer heat accelerates oil breakdown, tube scaling, and compressor mechanical wear. <strong>Rental Power UAE</strong> provides specialized <strong>chiller maintenance and overhaul services in the UAE</strong>, supporting Carrier, York (Johnson Controls), Trane, Daikin, and Dunham-Bush chillers across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Comprehensive Chiller Servicing Capabilities</h2>
    <ul>
        <li><strong>Rotary Screw & Centrifugal Compressor Rebuilding:</strong> Teardown, bearing replacement, rotor clearance realignment, mechanical shaft seal renewal, and slide-valve calibration.</li>
        <li><strong>Chemical & Mechanical Condenser Tube Descaling:</strong> High-pressure rotary brush tube punching and environmentally compliant chemical scale removal, restoring heat transfer efficiency and lowering head pressure.</li>
        <li><strong>Eddy Current Non-Destructive Testing (NDT):</strong> Electromagnetic inspection of copper and cupronickel evaporator and condenser tube bundles to detect internal pitting, wall thinning, and micro-cracks before tube ruptures contaminate the refrigeration circuit with water.</li>
        <li><strong>Refrigerant Recovery & Reclamation:</strong> Certified recovery of R134a, R410A, and R123 refrigerants using closed-loop purification systems compliant with UAE Ministry of Climate Change and Environment guidelines.</li>
    </ul>

    <h2>2. Temporary Chiller Bridging During Overhauls</h2>
    <p>
        Major chiller maintenance often requires taking central units offline for 3 to 10 days. Rental Power UAE provides synchronized <a href="/service/rental-chiller-in-uae">rental chillers</a> that seamlessly connect to your building's chilled water headers, maintaining 100% cooling comfort for occupants while permanent overhauls are underway.
    </p>

    <h2>3. Frequently Asked Questions (Chiller Maintenance UAE)</h2>

    <h3>How does scale buildup in chiller condenser tubes affect power consumption?</h3>
    <p>
        Just 0.6 mm (0.024 inches) of calcium scale buildup inside condenser tubes increases compressor electrical power consumption by approximately <strong>21%</strong>. Chemical descaling pays for itself within weeks through dramatic utility bill savings.
    </p>

    <h2>Schedule Chiller Maintenance in UAE</h2>
    <p>
        Restore your chiller plant to peak thermodynamic efficiency. Call our senior HVAC engineers at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">service contact form</a> for immediate chiller diagnostics.
    </p>
</div>
HTML,
    ],
    [
        'slug' => 'chiller-amc-uae',
        'title' => 'Chiller AMC in UAE',
        'focus_keyword' => 'chiller amc in uae',
        'tagline' => 'Annual Maintenance Contracts (AMC) for Commercial & Industrial Chillers Across UAE',
        'hero_badge' => 'Comprehensive Chiller AMC • 24/7 HVAC Reliability',
        'summary' => 'Comprehensive annual maintenance contracts for air-cooled and water-cooled chillers across Dubai, Abu Dhabi, and Sharjah. Offering scheduled quarterly servicing, oil spectroscopy, emergency leak repairs, and guaranteed response SLAs.',
        'meta_title' => 'Chiller AMC in UAE | Annual Chiller Maintenance Contracts Dubai',
        'meta_description' => 'Chiller AMC in UAE: comprehensive annual maintenance contracts for air-cooled & water-cooled chillers across Dubai & Abu Dhabi. Quarterly PM & 24/7 emergency response.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        In the Gulf climate, chiller failure is a business-critical emergency. <strong>Rental Power UAE</strong> delivers industry-leading <strong>Chiller AMC (Annual Maintenance Contracts) in the UAE</strong>, providing scheduled quarterly preventive maintenance, emergency leak detection, oil spectrometry, and guaranteed 24/7 priority callout coverage across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. What Our Chiller AMC Covers</h2>
    <ul>
        <li><strong>Quarterly Preventive Inspections:</strong> Calibrating electronic expansion valves (EEVs), testing compressor oil acid levels, cleaning electrical contactors, and auditing microprocessor safety parameters.</li>
        <li><strong>Oil Spectrometry Analysis:</strong> Laboratory spectroscopic testing of compressor lubrication oil to detect early trace metal wear (copper, iron, aluminum), moisture contamination, and acid formation before catastrophic compressor seizure.</li>
        <li><strong>Condenser Coil Chemical Cleaning:</strong> Removing caked desert dust and salt deposits twice annually to maintain optimal condensing efficiency during peak summer.</li>
        <li><strong>Priority Emergency Dispatch:</strong> Guaranteed 60-to-90-minute on-site arrival during unplanned chiller alarms.</li>
    </ul>

    <h2>2. Frequently Asked Questions (Chiller AMC)</h2>

    <h3>What brands do your technicians service?</h3>
    <p>
        Our factory-trained technicians maintain all major international chiller brands including Carrier, Trane, York (Johnson Controls), Daikin, Dunham-Bush, and Blue Star.
    </p>

    <h2>Inquire About Chiller AMC Contracts</h2>
    <p>
        Protect your building's cooling infrastructure with guaranteed annual service agreements. Contact Rental Power UAE today at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">AMC inquiry portal</a>.
    </p>
</div>
HTML,
    ],
];

foreach ($maintenanceServices as $svcData) {
    $service = Service::firstOrNew(['slug' => $svcData['slug']]);
    $service->title = $svcData['title'];
    $service->focus_keyword = $svcData['focus_keyword'];
    $service->tagline = $svcData['tagline'];
    $service->hero_badge = $svcData['hero_badge'];
    $service->summary = $svcData['summary'];
    $service->content = $svcData['content'];
    $service->meta_title = $svcData['meta_title'];
    $service->meta_description = $svcData['meta_description'];
    $service->meta_keywords = "{$svcData['title']}, generator maintenance uae, generator amc dubai, chiller maintenance uae, chiller amc dubai";
    $service->status = 'published';
    $service->is_featured = true;
    $service->is_indexable = true;
    $service->save();

    $words = str_word_count(strip_tags($service->content));
    echo "Saved maintenance service: {$service->slug} | Words: {$words}\n";
}

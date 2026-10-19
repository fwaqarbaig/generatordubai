<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

$enrichedServices = [
    // 1. Generator AMC in UAE
    [
        'slug' => 'generator-amc-uae',
        'title' => 'Generator AMC in UAE',
        'focus_keyword' => 'generator amc in uae',
        'tagline' => 'Comprehensive & Semi-Comprehensive Annual Maintenance Contracts for Diesel Generators Across UAE',
        'hero_badge' => 'Certified Generator AMC • Guaranteed 99.99% Uptime',
        'summary' => 'Comprehensive generator AMC in UAE across Dubai, Abu Dhabi, and Sharjah. Scheduled quarterly preventive maintenance, 24/7 emergency dispatch within 60 minutes, free consumables, load banking, and Civil Defence logbooks for Cummins, Perkins, and Cat gensets.',
        'meta_title' => 'Generator AMC in UAE | Annual Maintenance Contracts Dubai & Abu Dhabi',
        'meta_description' => 'Generator AMC in UAE: comprehensive annual maintenance contracts for diesel generators across Dubai & Abu Dhabi. Scheduled PM, 24/7 emergency response & Civil Defence logs.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        In the extreme desert climate of the United Arab Emirates, an emergency diesel generator is not a luxury—it is the ultimate life-safety asset that protects commercial facilities, data centers, hospitals, and residential towers from catastrophic blackouts. <strong>Rental Power UAE</strong> provides industry-leading <strong>Generator AMC (Annual Maintenance Contracts) in the UAE</strong>, delivering guaranteed 99.99% standby reliability, scheduled quarterly preventive servicing, free consumable replacements, and 24/7 emergency priority dispatch across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Comprehensive vs. Non-Comprehensive Generator AMC Plans</h2>
    <p>
        Facility managers and property developers across the UAE can select between flexible contractual structures tailored to equipment age and operational criticality:
    </p>
    <ul>
        <li><strong>Comprehensive AMC (All-Inclusive Protection):</strong> The complete turnkey solution. Includes all scheduled quarterly labor, emergency breakdown visits, routine engine oil (15W-40 CI-4), primary and secondary lube oil filters, fuel filters, water separators, heavy-duty air filter elements, coolant refills, and replacement of routine wear components (starter motor solenoids, drive belts, charging alternators) at zero additional invoice cost.</li>
        <li><strong>Non-Comprehensive / Semi-Comprehensive AMC:</strong> Covers all scheduled preventive maintenance labor, quarterly mechanical inspections, 24/7 priority emergency response, and detailed technical audit reports. Consumables and major replacement parts are billed separately at pre-negotiated, discounted commercial rates.</li>
    </ul>

    <h3>Generator AMC Service Scope Matrix</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Contract Deliverable</th>
                    <th class="p-3 border border-slate-800">Comprehensive AMC</th>
                    <th class="p-3 border border-slate-800">Non-Comprehensive AMC</th>
                    <th class="p-3 border border-slate-800">Standard Industry Baseline</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Scheduled PM Visits</td>
                    <td class="p-3 text-emerald-600 font-bold">4 Scheduled Visits (Quarterly)</td>
                    <td class="p-3 text-slate-700">4 Scheduled Visits (Quarterly)</td>
                    <td class="p-3 text-slate-600">2 to 3 Visits / Year</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Oil & Filter Consumables</td>
                    <td class="p-3 text-emerald-600 font-bold">100% Free (OEM Specified)</td>
                    <td class="p-3 text-slate-700">Discounted Billable</td>
                    <td class="p-3 text-rose-600">Full Retail Pricing</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Emergency Callout SLA</td>
                    <td class="p-3 text-emerald-600 font-bold">Priority &lt;60 Minutes On-Site</td>
                    <td class="p-3 text-slate-700 font-semibold">&lt;90 Minutes On-Site</td>
                    <td class="p-3 text-slate-600">4 to 12 Hours Queue</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Resistive Load Bank Test</td>
                    <td class="p-3 text-emerald-600 font-bold">Annual 100% Load Test Included</td>
                    <td class="p-3 text-slate-700">Discounted Option</td>
                    <td class="p-3 text-slate-600">Not Included</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Temporary Standby Backup</td>
                    <td class="p-3 text-emerald-600 font-bold">Free Standby Genset if Repair &gt; 4 hrs</td>
                    <td class="p-3 text-slate-700">Preferred Hire Rate</td>
                    <td class="p-3 text-rose-600">Full Rental Rates</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. The 50-Point Technical Inspection Protocol</h2>
    <p>
        During each scheduled AMC service visit, our certified engineers execute a meticulous 50-point audit to eliminate latent mechanical and electrical faults:
    </p>
    <ul>
        <li><strong>Lubrication Subsystem:</strong> Inspecting engine sump oil level, checking for front and rear crankshaft seal weeping, sampling oil for laboratory viscosity testing, and verifying oil pressure gauge calibration.</li>
        <li><strong>Fuel & Induction Subsystem:</strong> Checking primary fuel-water separator bowls for sediment, inspecting flexible fuel hoses for micro-cracks, testing electronic fuel solenoid shut-off actuation, and checking air restriction indicators on dual-element air filters.</li>
        <li><strong>Cooling & Radiator Subsystem:</strong> Testing coolant pH and antifreeze glycol concentration, checking radiator core fins for desert silica dust clogging, testing thermostat opening temperatures, and checking water pump weep holes for seal leakage.</li>
        <li><strong>Alternator & Electrical Subsystem:</strong> Testing starting battery specific gravity and internal cell resistance, auditing trickle-charger output voltage (27.4V float for 24V systems), and executing 1000V DC Megger insulation resistance testing on main stator and rotor windings.</li>
        <li><strong>Control Panel & ATS Simulation:</strong> Testing Deep Sea (DSE) or ComAp controller auto-mains failure (AMF) logic, verifying mains sensing voltage thresholds, and simulating a utility blackout to verify Automatic Transfer Switch (ATS) changeover within 10 to 15 seconds.</li>
    </ul>

    <h2>3. Civil Defence Compliance & Logbook Certification</h2>
    <p>
        Under UAE Fire and Life Safety Codes (UAE FLSC), commercial buildings, shopping malls, and healthcare institutions must maintain verified emergency standby power for life-safety systems (fire pumps, smoke extraction fans, emergency egress elevators, and exit lighting).
    </p>
    <p>
        Rental Power UAE provides authorized digital and physical maintenance logbooks stamped by certified engineers. Every visit, oil replacement, battery test, and load bank certification is documented to satisfy annual Civil Defence inspection audits and Dubai Municipality building safety clearances.
    </p>

    <h2>4. Competitor Benchmarking: Why Rental Power UAE AMC Outperforms Regional Providers</h2>
    <p>
        When evaluating generator maintenance contractors in Dubai and Sharjah (such as Jubaili Bros, Byrne, or local facilities management firms), Rental Power UAE delivers distinct engineering safeguards:
    </p>
    <ul>
        <li><strong>Guaranteed Temporary Power Protection:</strong> If your generator suffers a catastrophic mechanical failure (e.g., crankshaft seizure or alternator burnout), we deploy an emergency <a href="/service/rental-generator-in-uae">rental generator</a> from our own fleet to restore power within hours. General maintenance contractors who do not own a rental fleet cannot offer this life-saving backup guarantee.</li>
        <li><strong>Zero Hidden Mobilization Fees:</strong> All scheduled visits, emergency callouts, and technician transport across Dubai, Abu Dhabi, and Sharjah are completely included in the annual contract fee.</li>
        <li><strong>Dedicated Mobile Response Fleet:</strong> Our technicians operate fully equipped service vans carrying emergency spare parts (DSE controllers, fuel lift pumps, starters, AVRs, and magnetic pickups) to resolve 90%+ of faults on the first visit.</li>
    </ul>

    <h2>5. Frequently Asked Questions (Generator AMC UAE)</h2>

    <h3>What brands and capacities of diesel generators do you cover under AMC?</h3>
    <p>
        We cover all prime and standby generator capacities from 20 kVA to 3000 kVA powered by genuine <a href="/service/cummins-generator-rental-uae">Cummins</a>, <a href="/service/perkins-generators-uae">Perkins</a>, <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a>, Volvo Penta, FG Wilson, Baudouin, Doosan, and MTU engines.
    </p>

    <h3>What happens if our generator breaks down at 2:00 AM on a weekend?</h3>
    <p>
        Our operations center operates 24/7/365. AMC clients receive a direct dedicated emergency dispatch hotline. A resident duty technician is dispatched immediately, arriving on-site within 60 to 90 minutes.
    </p>

    <h3>Is load bank testing included in the AMC agreement?</h3>
    <p>
        Yes. In our Comprehensive AMC package, an annual 100% resistive load bank test is included to clear carbon deposits, prevent wet stacking, and certify full kW generator performance.
    </p>

    <h2>Secure Your Generator AMC Contract Today</h2>
    <p>
        Protect your building from devastating power blackouts and costly repair bills. Contact Rental Power UAE's service contracts department today at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">AMC proposal request form</a> for a complimentary on-site equipment audit.
    </p>
</div>
HTML,
    ],

    // 2. Perkins Generators UAE
    [
        'slug' => 'perkins-generators-uae',
        'title' => 'Perkins Generators UAE',
        'focus_keyword' => 'perkins generators uae',
        'tagline' => 'New, Certified Used & Rental Perkins Diesel Generators (10 kVA to 2500 kVA) Across UAE',
        'hero_badge' => 'Genuine Perkins Power • UK Engineered • 50°C Tropicalized',
        'summary' => 'Comprehensive Perkins diesel generator sales, rental, and service across Dubai, Abu Dhabi, and Sharjah ranging from 10 kVA to 2500 kVA. Built with genuine Perkins engines (400, 1100, 1200, 2000, 4000 series), Stamford/Leroy Somer alternators, and Deep Sea controls.',
        'meta_title' => 'Perkins Generators UAE | 10–2500 kVA Diesel Gensets Dubai & Abu Dhabi',
        'meta_description' => 'Genuine Perkins generators in UAE: 10 kVA to 2500 kVA new, rental & certified used diesel generators across Dubai, Abu Dhabi & Sharjah. UK engineered with 24/7 warranty.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        <strong>Perkins Engines Company Limited (UK)</strong> has been the gold standard of diesel engineering across the Middle East for over eight decades. In the demanding climate of the United Arab Emirates, Perkins diesel generators are celebrated by civil contractors, industrial plants, and facilities managers for their exceptional thermal resilience, low fuel consumption, and widespread spare parts availability. <strong>Rental Power UAE</strong> supplies genuine <strong>Perkins generators in the UAE</strong> for turnkey rental, certified pre-owned sales, and comprehensive maintenance across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Genuine Perkins Engine Families & Fleet Capacities</h2>
    <p>
        Our fleet utilizes exclusively authentic, factory-built Perkins engines configured with heavy-duty tropical radiators and Stamford or Leroy Somer brushless alternators:
    </p>
    <ul>
        <li><strong>Perkins 400 Series (10 kVA – 45 kVA):</strong> Ultra-compact 3-cylinder and 4-cylinder naturally aspirated and turbocharged engines. Perfect for telecommunications cell towers, remote security checkpoints, and mobile site offices. Known for whisper-quiet operation and minimal vibration.</li>
        <li><strong>Perkins 1100 Series (50 kVA – 250 kVA):</strong> The undisputed workhorse of the Gulf civil construction industry. The 1103, 1104, and 1106 engine platforms feature mechanical and common-rail electronic fuel injection, powering tower cranes, concrete pumps, and submersible dewatering setups with outstanding fuel efficiency. Explore our popular <a href="/fleet/50-kva-generator-rental">50 kVA Perkins generator</a> and <a href="/fleet/100-kva-generator-rental">100 kVA Perkins unit</a>.</li>
        <li><strong>Perkins 1200 & 1500 Series (250 kVA – 350 kVA):</strong> Heavy 6-cylinder in-line turbocharged and air-to-air charge cooled engines delivering massive low-end torque for heavy inductive industrial loads.</li>
        <li><strong>Perkins 2000 & 4000 Series (400 kVA – 2500 kVA):</strong> Massive multi-cylinder power modules (6-cylinder, V8, V12, and V16 platforms) engineered for continuous prime power in district cooling plants, multi-megawatt mini-grids, and critical hospital emergency standby. Explore our <a href="/fleet/500kva-generator-hire">500 kVA generator</a> and <a href="/fleet/1000-kva-generator-rental">1000 kVA synchronized power plants</a>.</li>
    </ul>

    <h3>Perkins Generator Fleet Specifications Table</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Genset Model</th>
                    <th class="p-3 border border-slate-800">Prime kVA / kW</th>
                    <th class="p-3 border border-slate-800">Perkins Engine Model</th>
                    <th class="p-3 border border-slate-800">Cylinder Layout</th>
                    <th class="p-3 border border-slate-800">Fuel Burn @ 75% Load</th>
                    <th class="p-3 border border-slate-800">Acoustic Sound Level</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/50-kva-generator-rental" class="text-amber-600 hover:underline">Perkins 50 kVA</a></td>
                    <td class="p-3 text-slate-700">50 kVA / 40 kW</td>
                    <td class="p-3 text-slate-600">Perkins 1103A-33TG1</td>
                    <td class="p-3 text-slate-600">3-Cylinder In-Line</td>
                    <td class="p-3 text-slate-700">9.5 L/hr</td>
                    <td class="p-3 text-slate-600">68 dBA @ 7m</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/100-kva-generator-rental" class="text-amber-600 hover:underline">Perkins 100 kVA</a></td>
                    <td class="p-3 text-slate-700">100 kVA / 80 kW</td>
                    <td class="p-3 text-slate-600">Perkins 1104A-44TAG2</td>
                    <td class="p-3 text-slate-600">4-Cylinder Turbocharged</td>
                    <td class="p-3 text-slate-700">18.5 L/hr</td>
                    <td class="p-3 text-slate-600">70 dBA @ 7m</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/250-kva-generator-rental" class="text-amber-600 hover:underline">Perkins 250 kVA</a></td>
                    <td class="p-3 text-slate-700">250 kVA / 200 kW</td>
                    <td class="p-3 text-slate-600">Perkins 1206A-E70TTAG2</td>
                    <td class="p-3 text-slate-600">6-Cylinder Electronic</td>
                    <td class="p-3 text-slate-700">43.0 L/hr</td>
                    <td class="p-3 text-slate-600">72 dBA @ 7m</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/500kva-generator-hire" class="text-amber-600 hover:underline">Perkins 500 kVA</a></td>
                    <td class="p-3 text-slate-700">500 kVA / 400 kW</td>
                    <td class="p-3 text-slate-600">Perkins 2506A-E15TAG1</td>
                    <td class="p-3 text-slate-600">6-Cylinder 15.2L Turbo</td>
                    <td class="p-3 text-slate-700">82.0 L/hr</td>
                    <td class="p-3 text-slate-600">75 dBA @ 7m</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900"><a href="/fleet/1000-kva-generator-rental" class="text-amber-600 hover:underline">Perkins 1000 kVA</a></td>
                    <td class="p-3 text-slate-700">1000 kVA / 800 kW</td>
                    <td class="p-3 text-slate-600">Perkins 4008TAG2A</td>
                    <td class="p-3 text-slate-600">8-Cylinder 30.6L Turbo</td>
                    <td class="p-3 text-slate-700">165.0 L/hr</td>
                    <td class="p-3 text-slate-600">75 dBA @ 7m</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Tropical 50°C UAE Desert Adaptation</h2>
    <p>
        Standard Perkins generators assembled for European climates utilize 43°C radiators that derate significantly when operating in Dubai’s 48°C to 50°C summer conditions.
    </p>
    <p>
        Rental Power UAE builds and retrofits all Perkins generators with:
    </p>
    <ul>
        <li><strong>Tropical Radiators (52°C Ambient Capacity):</strong> High-surface-area copper-brass and aluminum radiator cores paired with high-static pusher fans to maintain coolant temperatures below 95°C under continuous 100% electrical load.</li>
        <li><strong>Dual-Stage Heavy Dust Pre-Cleaners:</strong> Integrated cyclonic sand traps that filter out abrasive airborne quartz sand before it reaches the paper filter elements, preventing premature cylinder liner wear.</li>
        <li><strong>Acoustic Soundproof Canopies:</strong> Electrostatic powder-coated galvanized steel enclosures lined with fire-retardant rockwool, dampening noise to 68 dBA @ 7m for urban residential and commercial installations. Explore our <a href="/service/silent-generator-rental-uae">silent generator rental solutions</a>.</li>
    </ul>

    <h2>3. Genuine Perkins Spare Parts & Maintenance Support</h2>
    <p>
        Running counterfeit or grey-market filters and injectors in a Perkins engine is the leading cause of premature turbocharger burnout and injector seizure. Rental Power UAE maintains an extensive central warehouse of 100% genuine Perkins OEM parts:
    </p>
    <ul>
        <li>Oil filters (Powerpart high-efficiency spin-on canisters).</li>
        <li>Fuel filtration systems with integrated water separators.</li>
        <li>Genuine Perkins 15W-40 API CI-4 heavy-duty diesel engine oil.</li>
        <li>Complete overhaul kits (pistons, cylinder liners, valves, main/rod bearings, head gaskets).</li>
        <li>Deep Sea Electronics (DSE) digital control panels and automatic voltage regulators (AVR).</li>
    </ul>

    <h2>4. Competitor Benchmarking: Rental Power UAE vs. Jubaili Bros & Al Faris</h2>
    <p>
        Contractors and MEP engineers frequently compare Perkins generator suppliers across the UAE:
    </p>
    <ul>
        <li><strong>Faster Turnkey Delivery:</strong> Immediate dispatch from our Dubai, Abu Dhabi, and Sharjah yards within 60 to 90 minutes, backed by dedicated mobile boom cranes and resident technicians.</li>
        <li><strong>All-Inclusive Rental Terms:</strong> Quotes encompass generator hire, distribution cabling, fuel management, routine servicing, and emergency on-site breakdown response.</li>
        <li><strong>Certified Buyback & Trade-In:</strong> When your project finishes, our Buy & Sell division offers guaranteed cash buyback on client-owned Perkins gensets. See our <a href="/service/used-generators-uae">used generator division</a>.</li>
    </ul>

    <h2>5. Frequently Asked Questions (Perkins UAE)</h2>

    <h3>How can I verify that a Perkins generator in the UAE has a genuine UK engine?</h3>
    <p>
        Every genuine Perkins engine features a stamped engine serial number on the cylinder block (e.g., format like `U123456A`). Rental Power UAE provides official manufacturer certificates of origin and verifiable serial numbers with every new and refurbished unit sold or leased.
    </p>

    <h3>What fuel consumption rate can I expect from a 100 kVA Perkins generator?</h3>
    <p>
        At 75% prime electrical load (60 kW), a Perkins 1104A-44TAG2 engine consumes approximately <strong>18.5 liters of diesel per hour</strong>. At 50% load, consumption drops to approximately 12.8 L/hr.
    </p>

    <h2>Inquire About Perkins Generators Today</h2>
    <p>
        Whether you require immediate 24/7 Perkins generator hire in Dubai, certified pre-owned units in Abu Dhabi, or genuine Perkins maintenance in Sharjah, Rental Power UAE is your dedicated partner. Call our engineering headquarters at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">quotation request form</a>.
    </p>
</div>
HTML,
    ],

    // 3. Used Generators UAE
    [
        'slug' => 'used-generators-uae',
        'title' => 'Used Generators UAE',
        'focus_keyword' => 'used generators uae',
        'tagline' => 'Certified Pre-Owned Industrial Diesel Generators (30 kVA to 2000 kVA) for Sale Across UAE',
        'hero_badge' => 'Certified Used Generators • 40%–60% CAPEX Savings',
        'summary' => 'Certified used diesel generators for sale and buyback across Dubai, Abu Dhabi, and Sharjah ranging from 30 kVA to 2000 kVA. Verified running hours, full 100% load bank test certification, Megger winding audit, and turnkey delivery warranty for Cummins, Perkins, and Caterpillar.',
        'meta_title' => 'Used Generators UAE | Certified Used Diesel Gensets Dubai & Sharjah',
        'meta_description' => 'Certified used generators for sale in UAE: 30 kVA to 2000 kVA pre-owned diesel generators across Dubai & Sharjah. Load bank tested with warranty & instant commissioning.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Investing in brand-new industrial diesel generators often involves prohibitive capital expenditure (CAPEX) and lengthy international factory lead times ranging from 16 to 24 weeks. For factory owners, quarry operators, and commercial facilities managers seeking immediate standby power at a fraction of the cost, <strong>Rental Power UAE</strong> supplies certified <strong>used generators in the UAE</strong>, providing rigorously inspected pre-owned diesel power units from <strong>30 kVA to 2000 kVA</strong> at <strong>40% to 60% savings</strong> across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Why Buy a Certified Used Generator in the UAE?</h2>
    <p>
        In the Gulf market, secondary equipment transactions often carry risks of hidden mechanical failures, altered hour meters, and worn alternators. Rental Power UAE eliminates these risks through certified engineering verification:
    </p>
    <ul>
        <li><strong>Immediate 48-to-72-Hour Commissioning:</strong> While brand-new machines sit in overseas production queues, our pre-owned stock is fully audited, serviced, and ready for immediate flatbed delivery and site commissioning.</li>
        <li><strong>Massive Financial Savings:</strong> High-tier industrial diesel engines from <a href="/service/caterpillar-generator-rental-uae">Caterpillar</a>, <a href="/service/cummins-generator-rental-uae">Cummins</a>, and <a href="/service/perkins-generators-uae">Perkins</a> are engineered for 20,000 to 30,000 operating hours. Purchasing a unit with only 2,000 to 5,000 verified hours captures 85%+ of the engine's remaining operational life at nearly half the cost.</li>
        <li><strong>Guaranteed Technical Certification:</strong> Every used generator sold by Rental Power UAE comes with a certified load bank test certificate, oil analysis report, and comprehensive workshop warranty.</li>
    </ul>

    <h3>Used Generator Inspection & Verification Standards</h3>
    <div class="overflow-x-auto my-6 not-prose">
        <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-xl overflow-hidden shadow-xs">
            <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                <tr>
                    <th class="p-3 border border-slate-800">Inspection Phase</th>
                    <th class="p-3 border border-slate-800">Testing Procedure</th>
                    <th class="p-3 border border-slate-800">Pass/Fail Benchmark</th>
                    <th class="p-3 border border-slate-800">Buyer Benefit</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Hour Meter & ECM Audit</td>
                    <td class="p-3 text-slate-600">Digital diagnostic tool interrogates engine ECM</td>
                    <td class="p-3 text-slate-700">Matches mechanical odometer & maintenance logs</td>
                    <td class="p-3 text-emerald-600 font-bold">100% Genuine running hour guarantee</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Resistive Load Banking</td>
                    <td class="p-3 text-slate-600">Continuous 4-hour test at 100% rated kW load</td>
                    <td class="p-3 text-slate-700">Stable frequency &plusmn;0.5Hz, coolant &lt;95°C</td>
                    <td class="p-3 text-emerald-600 font-bold">Proves real full-capacity power output</td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="p-3 font-bold text-slate-900">Megger Insulation Test</td>
                    <td class="p-3 text-slate-600">1000V DC applied to stator and rotor windings</td>
                    <td class="p-3 text-slate-700">Insulation resistance &gt; 10 Megohms</td>
                    <td class="p-3 text-emerald-600 font-bold">Eliminates short-circuit flashover risk</td>
                </tr>
                <tr class="hover:bg-slate-50 bg-slate-50/50">
                    <td class="p-3 font-bold text-slate-900">Borescope Engine Audit</td>
                    <td class="p-3 text-slate-600">Endoscopic camera inspects cylinder liners & valves</td>
                    <td class="p-3 text-slate-700">Zero cross-hatch scoring or thermal cracking</td>
                    <td class="p-3 text-emerald-600 font-bold">Guarantees mechanical cylinder integrity</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2>2. Commercial Buyback & Equipment Disposal</h2>
    <p>
        Are you decommissioning an industrial plant, upgrading factory electrical substations, or liquidating surplus site equipment? Rental Power UAE's <strong>Buy & Sell Division</strong> offers instant cash buyback for client-owned diesel generators across Dubai, Abu Dhabi, and Sharjah:
    </p>
    <ul>
        <li><strong>On-Site Valuation Within 24 Hours:</strong> Our certified valuation engineers inspect your equipment, verify running hours, and provide an instant binding cash offer.</li>
        <li><strong>Turnkey Rigging & Transport:</strong> We manage crane decoupling, low-bed transport, and Civil Defence-compliant hazardous fluid evacuation (engine oil, coolant, diesel).</li>
        <li><strong>Multi-Asset Buyback:</strong> In addition to generators, we purchase decommissioned <a href="/service/used-chiller-in-uae">used chillers</a>, <a href="/service/portacabin-for-sale-in-uae">used portacabins</a>, and shipping containers in any condition.</li>
    </ul>

    <h2>3. Frequently Asked Questions (Used Generators UAE)</h2>

    <h3>What warranty is provided with a used generator?</h3>
    <p>
        All certified used generators sold by Rental Power UAE include a comprehensive 3-to-6-month workshop mechanical warranty, with optional extended <a href="/service/generator-amc-uae">Generator AMC contracts</a> covering routine servicing and emergency breakdown response.
    </p>

    <h3>Can you install and commission the used generator at our facility?</h3>
    <p>
        Yes. Our engineering division provides complete turnkey installation, including concrete plinth design, heavy cable routing, Automatic Transfer Switch (ATS) integration, and DEWA/ADDC utility inspection coordination.
    </p>

    <h2>Explore Available Used Generators Today</h2>
    <p>
        Browse our current inventory of certified used diesel generators or request an immediate valuation for your surplus machinery. Call our asset division at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">equipment inquiry form</a>.
    </p>
</div>
HTML,
    ],

    // 4. Refurbished Generators UAE
    [
        'slug' => 'refurbished-generators-uae',
        'title' => 'Refurbished Generators UAE',
        'focus_keyword' => 'refurbished generators uae',
        'tagline' => 'Factory-Rebuilt Zero-Hour Certified Refurbished Diesel Generators Across Dubai & UAE',
        'hero_badge' => '50-Point Factory Overhaul • Like-New Performance Guarantee',
        'summary' => 'Certified refurbished diesel generators for sale across Dubai, Abu Dhabi, and Sharjah ranging from 50 kVA to 1500 kVA. Rebuilt engines, rewound alternators, new Deep Sea digital controllers, fresh acoustic paint, and full 110% load bank certification with comprehensive warranty.',
        'meta_title' => 'Refurbished Generators UAE | Zero-Hour Rebuilt Gensets Dubai & Sharjah',
        'meta_description' => 'Certified refurbished generators in UAE: zero-hour rebuilt diesel generators with new DSE controllers, load bank testing & workshop warranty across Dubai & Abu Dhabi.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        A refurbished generator from <strong>Rental Power UAE</strong> is fundamentally distinct from a standard pre-owned machine. In our state-of-the-art regional engineering workshops, secondary power modules undergo a complete mechanical and electrical transformation—restoring every internal component to factory-original zero-hour operating specifications. We supply certified <strong>refurbished generators in the UAE</strong> ranging from <strong>50 kVA to 1500 kVA</strong> with comprehensive workshop warranties across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. The 50-Point Technical Refurbishment Protocol</h2>
    <p>
        Every generator that enters our refurbishment program is systematically dismantled, audited, re-machined, and rebuilt by factory-trained diesel engineers:
    </p>
    <ul>
        <li><strong>Complete Engine Teardown & Precision Machining:</strong> Cylinder blocks are pressure-washed, degreased, and measured for bore ovality. Cylinder liners are re-honed or replaced with OEM parts. Crankshaft journals are micro-polished, and brand-new main bearings, connecting rod bearings, piston crowns, and rings are installed.</li>
        <li><strong>Cylinder Head & Valve Train Overhaul:</strong> Cylinder heads are pressure-tested for thermal micro-cracks. Valve guides, seats, and stem seals are replaced, and valve lash clearances are precision-calibrated with digital feeler gauges.</li>
        <li><strong>Fuel Injection & Turbocharger Rebuilding:</strong> High-pressure fuel injection pumps and injectors are calibrated on computerized test benches for exact spray pattern geometry. Turbochargers receive new dynamic balance bearings, compressor wheels, and labyrinth oil seals.</li>
        <li><strong>Alternator Di-Electric Rewinding & Varnish Dipping:</strong> Stators and rotors undergo high-pressure steam cleaning, vacuum pressure impregnation (VPI) with Class H insulating varnish, and 1000V DC Megger testing to guarantee &gt;10 MΩ insulation resistance.</li>
        <li><strong>Digital Control Panel Modernization:</strong> Obsolete analog gauges are replaced with brand-new Deep Sea Electronics (DSE 7320 / DSE 8610) or ComAp digital controllers featuring automatic mains failure (AMF), remote GSM telemetry, and multi-genset synchronization capability.</li>
        <li><strong>Acoustic Canopy Stripping & Polyurethane Refinishing:</strong> Enclosures are sandblasted to bare metal, coated with heavy zinc anti-corrosion primer, lined with fresh fire-retardant rockwool sound insulation, and finished with automotive-grade polyurethane paint designed to resist Gulf ultraviolet degradation.</li>
    </ul>

    <h2>2. Certification: Full Resistive Load Banking</h2>
    <p>
        Before any refurbished generator is cleared for client sale or long-term lease, it is coupled to our stationary resistive load banks for a continuous <strong>4-hour full-load certification trial</strong>:
    </p>
    <ul>
        <li>1 hour at 25% and 50% load to seat new piston rings.</li>
        <li>2 hours at 100% continuous prime rated kW load.</li>
        <li>1 hour at 110% maximum emergency overload capacity.</li>
    </ul>
    <p>
        Oil pressure, exhaust gas temperature (EGT), jacket water temperature, and alternator voltage/frequency regulation are logged in a certified test certificate provided to the buyer.
    </p>

    <h2>3. Frequently Asked Questions (Refurbished Generators UAE)</h2>

    <h3>What is the difference between a used generator and a refurbished generator?</h3>
    <p>
        A used generator is sold in its existing operational state with routine servicing. A refurbished generator has undergone a complete mechanical teardown, with worn components replaced by new OEM parts, rewound alternators, new digital control panels, and brand-new acoustic canopy coatings, delivering performance and reliability virtually indistinguishable from a brand-new unit.
    </p>

    <h3>What warranty is included with a refurbished generator?</h3>
    <p>
        Rental Power UAE provides a standard 6-to-12-month workshop warranty on all refurbished generators, backed by our 24/7 emergency service fleet.
    </p>

    <h2>Inquire About Refurbished Generators Today</h2>
    <p>
        Gain the reliability of new machinery at 50% the capital expense. Call Rental Power UAE's engineering division at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">quotation request form</a>.
    </p>
</div>
HTML,
    ],

    // 5. Refurbished Chillers UAE
    [
        'slug' => 'refurbished-chillers-uae',
        'title' => 'Refurbished Chillers UAE',
        'focus_keyword' => 'refurbished chillers uae',
        'tagline' => 'Certified Overhauled Air-Cooled & Water-Cooled Industrial Chillers for Sale in UAE',
        'hero_badge' => 'Factory-Rebuilt HVAC Chillers • 50 TR to 500 TR Units',
        'summary' => 'Certified refurbished industrial chillers across Dubai, Abu Dhabi, and Sharjah ranging from 50 TR to 500 TR. Rebuilt screw compressors, eddy current tube tested, new microchannel condenser coils, and performance tested under UAE 50°C heat with warranty.',
        'meta_title' => 'Refurbished Chillers UAE | Overhauled Industrial Chillers Dubai & Abu Dhabi',
        'meta_description' => 'Certified refurbished chillers for sale in UAE: 50 TR to 500 TR overhauled air-cooled & water-cooled chillers across Dubai & Abu Dhabi. Rebuilt compressors with warranty.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Replacing commercial building chillers with new machinery often requires immense capital budgets and disruptive 20-week overseas factory delivery schedules. <strong>Rental Power UAE</strong> provides certified <strong>refurbished chillers in the UAE</strong>, offering factory-overhauled air-cooled screw and water-cooled centrifugal chillers from <strong>50 TR to 500 TR</strong> at <strong>40% to 55% lower cost</strong> across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. Rigorous Industrial Chiller Refurbishment Scope</h2>
    <ul>
        <li><strong>Rotary Screw Compressor Teardown & Overhaul:</strong> Precision replacement of angular contact thrust bearings, cylindrical roller bearings, carbon shaft seals, and slide-valve pistons on Carrier 06N, Trane semi-hermetic, and York screw compressors.</li>
        <li><strong>Eddy Current Electromagnetic Tube Testing:</strong> 100% NDT inspection of copper evaporator and condenser tube bundles, confirming wall thickness and eliminating micro-cracking risks.</li>
        <li><strong>Condenser Coil Reconditioning or Replacement:</strong> Chemical ultrasonic descaling, comb straightening, and application of Blygold or ElectroFin anti-corrosion polyurethane coatings.</li>
        <li><strong>Pressure Testing & Dehydration:</strong> Nitrogen holding test at 350 PSI for 24 hours followed by deep vacuum dehydration to 250 microns before charging with virgin R134a or R410A refrigerant.</li>
    </ul>

    <h2>Inquire About Refurbished Chillers</h2>
    <p>
        Restore your facility's cooling capacity with certified refurbished chillers. Contact Rental Power UAE at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">HVAC inquiry portal</a>.
    </p>
</div>
HTML,
    ],

    // 6. Refurbished Portacabin UAE
    [
        'slug' => 'refurbished-portacabin-uae',
        'title' => 'Refurbished Portacabin UAE',
        'focus_keyword' => 'refurbished portacabin uae',
        'tagline' => 'High-Grade Refurbished Modular Site Offices, Staff Accommodation & Ablution Blocks in UAE',
        'hero_badge' => 'Turnkey Refurbished Cabins • High-Density PU Insulated',
        'summary' => 'Premium refurbished portacabins for sale and rent across Dubai, Abu Dhabi, and Sharjah. Offering reconditioned executive site offices, labor camp accommodations, sanitary toilet units, and security guard cabins with fresh electrical wiring, split ACs, and weather-proof coatings.',
        'meta_title' => 'Refurbished Portacabin UAE | Reconditioned Site Office Cabins Dubai',
        'meta_description' => 'Refurbished portacabins for sale in UAE: executive site offices, labor cabins & ablution blocks across Dubai, Abu Dhabi & Sharjah. New ACs, wiring & fresh paint.',
        'content' => <<<'HTML'
<div class="space-y-8">
    <p class="text-base sm:text-lg text-slate-700 leading-relaxed font-normal">
        Civil construction contractors and industrial facility operators in the UAE need modular site buildings that are comfortable, thermally insulated, and compliant with municipal labor welfare codes—without the exorbitant price tag of brand-new fabrication. <strong>Rental Power UAE</strong> provides premium <strong>refurbished portacabins in the UAE</strong>, reconditioning pre-owned modular cabins into like-new executive offices, labor accommodation units, and sanitary blocks across <a href="/locations/dubai" class="text-amber-700 hover:text-amber-800 underline font-semibold">Dubai</a>, <a href="/locations/abu-dhabi" class="text-amber-700 hover:text-amber-800 underline font-semibold">Abu Dhabi</a>, and <a href="/locations/sharjah" class="text-amber-700 hover:text-amber-800 underline font-semibold">Sharjah</a>.
    </p>

    <h2>1. The Modular Cabin Refurbishment Process</h2>
    <ul>
        <li><strong>Structural Steel Chassis Restoration:</strong> Heavy-gauge I-beam and channel skids are sandblasted, structurally reinforced with cross-members, and coated with anti-rust bituminous paint.</li>
        <li><strong>High-Density Polyurethane (PU) Sandwich Panels:</strong> 50mm to 100mm PU injected wall and roof panels providing an exceptional thermal barrier against 50°C UAE desert sun.</li>
        <li><strong>Complete Electrical & Mechanical Rewiring:</strong> Brand-new PVC conduit wiring, certified circuit breaker load centers, energy-efficient LED light fixtures, and brand-new split air conditioners.</li>
        <li><strong>Interior Joinery & Sanitary Overhaul:</strong> Commercial vinyl flooring, thermal double-glazed sliding windows with fly-screens, solid-core doors, and fresh white ceramic washroom fittings.</li>
    </ul>

    <h2>2. Grading & Portacabin Types Available</h2>
    <ul>
        <li><strong>Executive Site Offices (20ft x 10ft / 40ft x 10ft):</strong> Partitioned manager rooms, conference spaces, and en-suite washrooms.</li>
        <li><strong>Labor Camp Accommodation Blocks:</strong> Multi-occupant living quarters meeting Dubai Municipality labor accommodation health and safety standards.</li>
        <li><strong>Sanitary & Ablution Units:</strong> Heavy-duty porcelain toilets, urinals, hand-wash sinks, and electric water heaters with external plumbing manifolds.</li>
    </ul>

    <h2>Order Refurbished Portacabins in UAE</h2>
    <p>
        Get turnkey modular site accommodation delivered to your site within 48 hours. Call Rental Power UAE at <strong>+971 56 921 3754</strong> or submit our <a href="/contact-us">portacabin inquiry form</a>.
    </p>
</div>
HTML,
    ],
];

foreach ($enrichedServices as $svcData) {
    $service = Service::firstOrNew(['slug' => $svcData['slug']]);
    $service->title = $svcData['title'];
    $service->focus_keyword = $svcData['focus_keyword'];
    $service->tagline = $svcData['tagline'];
    $service->hero_badge = $svcData['hero_badge'];
    $service->summary = $svcData['summary'];
    $service->content = $svcData['content'];
    $service->meta_title = $svcData['meta_title'];
    $service->meta_description = $svcData['meta_description'];
    $service->meta_keywords = "{$svcData['title']}, generator amc dubai, perkins generators uae, used generators dubai, refurbished portacabin uae";
    $service->status = 'published';
    $service->is_featured = true;
    $service->is_indexable = true;
    $service->save();

    $words = str_word_count(strip_tags($service->content));
    echo "Saved enriched service: {$service->slug} | Words: {$words}\n";
}

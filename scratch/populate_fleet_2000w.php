<?php

if (! isset($app)) {
    require __DIR__.'/../vendor/autoload.php';
    $app = require __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Kernel::class);
    $kernel->bootstrap();
}

use Illuminate\Contracts\Console\Kernel;

echo "=== PREPARING 2,000-WORD GENERATOR & CHILLER FLEET ENGINES ===\n";

/**
 * Generates ~2,000 to 2,200 words of authentic engineering content for generator fleet products
 */
function generateGeneratorContent(array $data): string
{
    $title = $data['title'];
    $kva = $data['kva'];
    $kw = $data['kw'];
    $amps = $data['amps'];
    $engine = $data['engine'];
    $cyl = $data['cyl'];
    $disp = $data['disp'];
    $f25 = $data['f25'];
    $f50 = $data['f50'];
    $f75 = $data['f75'];
    $f100 = $data['f100'];
    $tank = $data['tank'];
    $runtime75 = round($tank / $f75, 1);
    $sound7m = $data['sound7m'];
    $sound1m = $data['sound1m'];
    $cables = $data['cables'];
    $breaker = $data['breaker'];
    $oilCap = $data['oil_cap'] ?? '25 Litres';
    $coolantCap = $data['coolant_cap'] ?? '35 Litres';
    $dim = $data['dimensions'] ?? '3,400 x 1,200 x 1,850 mm';
    $weight = $data['weight'] ?? '2,450 kg';
    $applications = $data['applications'];
    $img1 = $data['img1'];
    $img2 = $data['img2'];
    $alt1 = $data['alt1'];
    $alt2 = $data['alt2'];
    $cap1 = $data['cap1'];
    $cap2 = $data['cap2'];
    $relatedSlug = $data['related_slug'];
    $relatedName = $data['related_name'];
    $secondarySlug = $data['secondary_slug'] ?? 'silent-generator';
    $secondaryName = $data['secondary_name'] ?? 'Silent Generator Rental';

    $kw25 = round($kw * 0.25, 1);
    $kw50 = round($kw * 0.50, 1);
    $kw75 = round($kw * 0.75, 1);
    $run25 = round($tank / $f25, 1);
    $run50 = round($tank / $f50, 1);
    $run100 = round($tank / $f100, 1);
    $daily25 = round($f25 * 24, 0);
    $daily50 = round($f50 * 24, 0);
    $daily75 = round($f75 * 24, 0);
    $daily100 = round($f100 * 24, 0);

    return <<<HTML
<div class="space-y-12">

    <!-- Section 1: Executive Engineering Profile & Sizing Blueprint -->
    <section class="space-y-4">
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-display">
            1. Comprehensive Engineering Profile: {$kva} kVA ({$kw} kW) Industrial Diesel Generator Rental in UAE
        </h2>
        <p class="text-slate-600 leading-relaxed text-base">
            The <strong>{$kva} kVA ({$kw} kW) Prime Diesel Generator</strong> stands as an indispensable workhorse in Rental Power UAE's industrial fleet, purpose-built to deliver continuous, uninterruptible electrical power across the United Arab Emirates. Engineered to withstand the relentless heat and atmospheric rigors of the Arabian Gulf—where summer ambient temperatures routinely surge past 50°C (122°F) accompanied by relative humidity exceeding 85% and heavy airborne particulate dust—this heavy-duty power generator supplies dependable prime and standby electricity for high-priority construction sites in <a href="/locations/dubai" class="text-amber-600 font-bold hover:underline">Dubai</a>, oilfield concessions in <a href="/locations/abu-dhabi" class="text-amber-600 font-bold hover:underline">Abu Dhabi</a>, manufacturing zones in <a href="/locations/sharjah" class="text-amber-600 font-bold hover:underline">Sharjah</a>, and deepwater maritime ports in Ras Al Khaimah and Fujairah.
        </p>
        <p class="text-slate-600 leading-relaxed text-base">
            Configured for <strong>400 Volts / 230 Volts, 3-Phase, 50 Hz</strong> with an industry-standard power factor of 0.8 lagging, this generator outputs a continuous prime current capacity of <strong>{$amps} Amperes per phase</strong>. Built strictly in compliance with international manufacturing benchmarks <strong>ISO 8528-1:2018</strong> (reciprocating internal combustion engine driven alternating current generating sets) and <strong>ISO 3046</strong> (fuel consumption and engine power ratings), this power module functions seamlessly as an autonomous baseload utility source or as a fast-acting Automatic Mains Failure (AMF) standby system protecting mission-critical processes.
        </p>

        <figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
            <img src="/{$img1}" alt="{$alt1}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
            <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
                {$cap1}
            </figcaption>
        </figure>
    </section>

    <!-- Section 2: Electrical Power Calculations & Sizing Methodology -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            2. Electrical Load Calculations, Inrush Currents & Sizing Blueprint
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Successful temporary power deployment hinges on rigorous engineering sizing that accounts for steady-state continuous loads and transient inductive surges. Under-sizing generators triggers severe voltage drops, frequency instability, blackouts, and electrical breaker tripping; over-sizing causes wet stacking, unburned fuel blow-by, carbon fouling of injector nozzles, and excessive fuel bills. Sizing for this {$kva} kVA machine is rooted in the three-phase electrical power governing formulas:
        </p>

        <div class="p-5 rounded-2xl bg-slate-900 text-white font-mono text-xs sm:text-sm my-4 space-y-2.5">
            <div><strong>Apparent Power Formula (S):</strong> S (kVA) = (√3 × V_line × I_line) / 1000 = (1.732 × 400V × {$amps}A) / 1000 = {$kva} kVA</div>
            <div><strong>Active Real Power Formula (P):</strong> P (kW) = S (kVA) × Power Factor (cos φ) = {$kva} kVA × 0.8 = {$kw} kW</div>
            <div><strong>Nominal Prime Current Rating:</strong> I_prime = (S × 1000) / (√3 × 400V) = ({$kva} × 1000) / 692.8 = {$amps} Amperes</div>
            <div><strong>Standby Current Capacity (1-Hour Overload):</strong> I_standby = I_prime × 1.10 = " . round($amps * 1.10, 0) . " Amperes</div>
        </div>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Motor Starting Dynamics & Locked Rotor Amperage (LRA)</h3>
        <p class="text-slate-600 leading-relaxed">
            When sizing power for inductive electric motor loads—such as construction tower cranes, high-pressure concrete boom pumps, deep well dewatering submersibles, and commercial HVAC centrifugal chillers—transient starting currents (Locked Rotor Amperage, or LRA) routinely spike 400% to 650% above nominal Full Load Amperage (FLA) during Direct-On-Line (DOL) starting. If starting methods utilize Star-Delta starters, starting inrush diminishes to approximately 200% to 250%; modern Solid-State Soft Starters and Variable Frequency Drives (VFDs) reduce inrush currents to a manageable 125% to 150% of rated FLA.
        </p>
        <p class="text-slate-600 leading-relaxed">
            To prevent severe transient voltage dips from causing control relays and contactors to chatter or drop out, our {$kva} kVA generators feature premium Stamford / Leroy Somer brushless alternators equipped with Permanent Magnet Generator (PMG) auxiliary exciter windings. The PMG system isolates the excitation field from non-linear harmonic distortion and delivers up to 300% sustained short-circuit current for a full 10 seconds, guaranteeing fault clearing capability and effortless motor acceleration without collapsing busbar voltage.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">High-Ambient Thermal Deration Curve in the UAE Climate</h3>
        <p class="text-slate-600 leading-relaxed">
            Standard OEM generator datasheets published in Europe or the United States rate prime capacity at a benign 25°C ambient temperature at sea level. In Dubai, Sharjah, and Abu Dhabi during peak summer months (June through September), temperatures regularly exceed 48°C in shaded areas and 55°C inside acoustic enclosures exposed to solar radiance. Operating un-tropicalized machinery under these extreme conditions causes premature thermal deration of 15% to 25%, resulting in sudden high coolant temperature trips.
        </p>
        <p class="text-slate-600 leading-relaxed">
            Rental Power UAE's {$kva} kVA fleet is customized specifically with <strong>50°C Heavy-Duty Tropical Radiators</strong>, oversized cores with high-static pusher cooling fans, high-temperature ethylene glycol coolant mixtures (50/50 ratio), and secondary turbocharger heat blankets. As a result, our {$kva} kVA generator operates at full continuous prime rating up to 45°C ambient with less than 2.8% deration at 50°C, providing genuine site reliability where lower-spec rental generators trip on thermal overload.
        </p>
    </section>

    <!-- Section 3: Fuel Consumption & Operational Economy Table -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            3. Fuel Consumption Economics, Operational Benchmarks & On-Site Bulk Logistics
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Fuel expenses constitute between 65% and 80% of total temporary power lifecycle costs over a multi-month project duration. Understanding your generator's specific fuel consumption (SFC) at various operating load thresholds allows project managers and site engineers to forecast operating expenditures (OPEX) with extreme precision. The table below details real-world fuel consumption rates for our {$kva} kVA generator based on clean, low-sulfur ADNOC / ENOC diesel:
        </p>

        <div class="overflow-x-auto my-6 not-prose">
            <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="p-3.5 border border-slate-800">Operating Load Profile</th>
                        <th class="p-3.5 border border-slate-800">Real Power Delivered (kW)</th>
                        <th class="p-3.5 border border-slate-800">Fuel Burn Rate (Litres/hr)</th>
                        <th class="p-3.5 border border-slate-800">Internal Tank Autonomy ({$tank}L)</th>
                        <th class="p-3.5 border border-slate-800">24-Hour Continuous Consumption</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">25% Prime Load (Idle / Nighttime)</td>
                        <td class="p-3.5 text-slate-600">{$kw25} kW</td>
                        <td class="p-3.5 text-emerald-600 font-bold">{$f25} L/hr</td>
                        <td class="p-3.5 text-slate-900 font-semibold">{$run25} Hours</td>
                        <td class="p-3.5 text-slate-600">{$daily25} Litres</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">50% Prime Load (Moderate Duty)</td>
                        <td class="p-3.5 text-slate-600">{$kw50} kW</td>
                        <td class="p-3.5 text-emerald-600 font-bold">{$f50} L/hr</td>
                        <td class="p-3.5 text-slate-900 font-semibold">{$run50} Hours</td>
                        <td class="p-3.5 text-slate-600">{$daily50} Litres</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">75% Prime Load (Optimal Efficiency Point)</td>
                        <td class="p-3.5 text-slate-600">{$kw75} kW</td>
                        <td class="p-3.5 text-amber-600 font-bold">{$f75} L/hr</td>
                        <td class="p-3.5 text-slate-900 font-semibold">{$runtime75} Hours</td>
                        <td class="p-3.5 text-slate-600">{$daily75} Litres</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">100% Full Prime Rating</td>
                        <td class="p-3.5 text-slate-600">{$kw} kW</td>
                        <td class="p-3.5 text-rose-600 font-bold">{$f100} L/hr</td>
                        <td class="p-3.5 text-slate-900 font-semibold">{$run100} Hours</td>
                        <td class="p-3.5 text-slate-600">{$daily100} Litres</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Bulk Fuel Storage Solutions & Turnkey Refueling Fleet</h3>
        <p class="text-slate-600 leading-relaxed">
            Running out of diesel during critical production shifts or night concrete pours can cause catastrophic project delays and financial losses. To insulate our clients from logistics headaches, Rental Power UAE offers two commercial hiring models:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Dry Rental Hire:</strong> We supply, position, commission, and maintain the {$kva} kVA generator; your site logistics team manages diesel fuel sourcing and refueling via approved suppliers.</li>
            <li><strong>Turnkey Wet Rental Hire:</strong> We deliver the generator paired with an external 1,000 to 5,000-litre double-walled bunded fuel tank, automatic transfer pumps, and wireless IoT fuel telemetry sensors. Our fleet of ADNOC/ENOC certified road tankers manages scheduled automated replenishment 24/7 across all seven Emirates, guaranteeing fuel levels never drop below 30% capacity.</li>
        </ul>
    </section>

    <!-- Section 4: Mechanical Engine & Alternator Specifications -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            4. Powertrain Architecture, Alternator Winding & Acoustic Canopy Engineering
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Industrial durability begins with tier-one mechanical and electrical components. Every {$kva} kVA generator in our rental fleet is built using proven global powertrains from world-leading engine manufacturers (Perkins, Cummins, Caterpillar) coupled with industrial-grade alternators:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 not-prose my-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Engine Architecture ({$engine})
                </h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li><strong>Configuration:</strong> {$cyl}, 4-Stroke Turbocharged Diesel</li>
                    <li><strong>Displacement:</strong> {$disp} Litres</li>
                    <li><strong>Aspiration:</strong> Turbocharged & Air-to-Air Charge Cooled (ATAAC)</li>
                    <li><strong>Governor System:</strong> Electronic Isochronous Governor (±0.25% steady state frequency)</li>
                    <li><strong>Fuel Filtration:</strong> Dual-stage spin-on Donaldson/Fleetguard fuel filters with high-capacity water separators</li>
                    <li><strong>Lubrication Capacity:</strong> {$oilCap} synthetic 15W-40 CI-4 engine oil with spin-on full-flow filters</li>
                    <li><strong>Cooling System:</strong> {$coolantCap} 50°C tropical radiator with mechanical heavy-duty pusher fan</li>
                </ul>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Brushless Synchronous Alternator
                </h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li><strong>Manufacturer / Class:</strong> Stamford / Leroy Somer 4-Pole Brushless</li>
                    <li><strong>Insulation Rating:</strong> Class H (180°C thermal endurance limit) with vacuum pressure impregnation (VPI)</li>
                    <li><strong>Automatic Voltage Regulator (AVR):</strong> Digital AVR sustaining ±0.5% voltage regulation from zero to full load</li>
                    <li><strong>Winding Pitch:</strong> 2/3 pitch winding preventing excessive neutral currents caused by 3rd order harmonics</li>
                    <li><strong>Ingress Protection:</strong> IP23 enclosure protection with sealed-for-life heavy-duty anti-friction bearings</li>
                    <li><strong>Circuit Protection:</strong> 4-Pole {$breaker} with adjustable thermal and magnetic trip elements</li>
                </ul>
            </div>
        </div>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Acoustic Soundproofing & Weatherproof Canopy Enclosure</h3>
        <p class="text-slate-600 leading-relaxed">
            Urban construction sites in Downtown Dubai, high-end residential enclaves in Palm Jumeirah and Emirates Hills, and commercial filming sets demand whisper-quiet sound attenuation. Our {$kva} kVA silent generators are encapsulated inside modular acoustic enclosures manufactured from electro-galvanized cold-rolled sheet steel treated with phosphate and polyester powder coating to prevent coastal salt spray corrosion.
        </p>
        <p class="text-slate-600 leading-relaxed">
            The canopy interior features high-density non-flammable mineral acoustic rockwool (50mm thickness, 60 kg/m³ density) protected behind micro-perforated galvanized retaining plates. With an internal residential exhaust silencer that attenuates high-frequency combustion noise by 28 dBA to 35 dBA, overall operational sound levels register at just <strong>{$sound7m} at 7 meters</strong> ({$sound1m} at 1 meter), fully complying with Dubai Municipality and Federal UAE environmental noise standards.
        </p>

        <figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
            <img src="/{$img2}" alt="{$alt2}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
            <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
                {$cap2}
            </figcaption>
        </figure>
    </section>

    <!-- Section 5: Control Automation & Synchronization -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            5. Digital Control Automation, Remote Telemetry & Multi-Megawatt Synchronization
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Modern temporary power demands intelligence and remote visibility. Our {$kva} kVA fleet is standardized on industry-benchmark <strong>Deep Sea Electronics (DSE 7320 / DSE 8610 MKII)</strong> digital microprocessor control units. These controllers continuously monitor over 60 electrical and mechanical parameters in real time:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Electrical Instrumentation:</strong> 3-phase true RMS voltage, line-to-line and line-to-neutral, 3-phase line currents, active power (kW), reactive power (kVAR), apparent power (kVA), power factor (cos φ), and electrical frequency (Hz).</li>
            <li><strong>Engine Telemetry:</strong> Oil pressure (bar/psi), engine coolant temperature (°C), engine speed (RPM), battery charge voltage, running hours counter, and maintenance countdown timers.</li>
            <li><strong>Protective Shutdowns:</strong> Over-speed / under-speed, low lube oil pressure, high coolant temperature, reverse power, earth leakage fault, over-current, and emergency stop activation.</li>
        </ul>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Load-Dependent Paralleling & Multi-Megawatt Scalability</h3>
        <p class="text-slate-600 leading-relaxed">
            When power demands fluctuate between day and night shifts, running a single oversized generator at low loads causes severe engine slobbering and carbon deposits. By deploying two or more {$kva} kVA generators synchronized via DSE 8610 controllers, our systems achieve <strong>Load-Dependent Start/Stop (LDSS)</strong> operation:
        </p>
        <p class="text-slate-600 leading-relaxed">
            During peak daytime production when tower cranes, chillers, and pumps run simultaneously, all synchronized generators share active and reactive loads isochronously. At night, as power demand drops below 30%, the system automatically commands secondary units to ramp down, decouple from the busbar, and enter cool-down shutdown. When morning demand surges, the secondary units automatically pre-heat, start, synchronize frequency within 50 milliseconds, and seamlessly close back onto the live bus without causing a single flicker or brownout.
        </p>
    </section>

    <!-- Section 6: Real-World Customer Applications in UAE -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            6. Primary Customer Applications & Industry Use Cases in Dubai, Abu Dhabi & Sharjah
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Drawing upon more than 15 years of fleet telemetry and specialized site operations across the UAE, the {$kva} kVA generator has proven to be the ideal power rating for numerous critical industrial and commercial applications:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 not-prose my-6 text-xs sm:text-sm">
            {$applications}
        </div>

        <p class="text-slate-600 leading-relaxed">
            Whether powering offshore drilling base camps in Abu Dhabi's Western Region (Al Dhafra), large-scale logistics fulfillment warehouses in Dubai South near Al Maktoum International Airport, or industrial metal manufacturing facilities in Sharjah's Sajaa Industrial Area, our engineering team custom-configures voltage, circuit protection, and earthing to match your exact site specifications.
        </p>
    </section>

    <!-- Section 7: Turnkey Mobilization, Cabling & 24/7 SLA -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            7. Turnkey Mobilization Logistics: Crane Rigging, SWA Cabling & 24/7 On-Site SLA
        </h2>
        <p class="text-slate-600 leading-relaxed">
            At Rental Power UAE, renting temporary power is an end-to-end electrical engineering service, not simply a machinery lease. When you commission a {$kva} kVA generator, our turnkey mobilization package includes:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Rapid Site Mobilization (Within 2 Hours):</strong> With permanent deployment yards located in Al Quoz (Dubai), Mussafah Industrial Area (Abu Dhabi), and Sajaa (Sharjah), our fleet of certified flatbed crane trucks dispatches equipment immediately upon contract confirmation.</li>
            <li><strong>Heavy-Duty Flexible Cabling:</strong> We supply certified 4-core Steel Wire Armoured (SWA) cables or heavy-duty single-core flexible rubber {$cables} (HO7RN-F rated for 90°C conductor temperature), terminated with calibrated heavy-duty crimped copper lugs or fast-mating Powersafe / Powerlock color-coded cam locks.</li>
            <li><strong>Automatic Transfer Switch (ATS) Integration:</strong> For emergency backup applications, we provide 4-pole motorized or contactor-based ATS panels with adjustable mains return delay timers (0 to 30 minutes) and automatic weekly exercise clocks.</li>
            <li><strong>Grounding & Earthing Safety Certification:</strong> Prior to energization, certified electricians drive high-conductivity copper ground rods into earth pits, test soil resistivity using calibrated earth testers, and verify earthing resistance drops strictly below 5.0 Ohms to ensure complete human and asset protection.</li>
            <li><strong>24/7 Rapid Response Maintenance SLA:</strong> In the unlikely event of an engine warning or electrical fault, our mobile field service vans—staffed by factory-trained diesel mechanics carrying genuine spare parts, belts, filters, and diagnostic tools—arrive on-site within 45 to 90 minutes anywhere in the Emirates.</li>
        </ul>
    </section>

    <!-- Section 8: Pre-Mobilization Checklist & Quality Assurance -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            8. Pre-Delivery Quality Assurance, Load Bank Certification & Oil Analysis
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Zero site downtime is our unwavering standard. Before any {$kva} kVA generator is dispatched to a customer site, it undergoes an exhaustive 35-point Quality Assurance protocol at our engineering depot:
        </p>
        <ol class="list-decimal pl-6 space-y-2 text-slate-600">
            <li><strong>Load Bank Verification:</strong> Every unit is connected to our computer-controlled resistive load bank and tested at 25%, 50%, 75%, 100%, and 110% overload for four continuous hours to verify cooling capacity and governor stability.</li>
            <li><strong>FLIR Thermal Imaging Scan:</strong> During peak full-load operation, thermographic cameras inspect busbars, cable terminal lugs, and MCCB contact points to verify zero abnormal heat rise or loose terminations.</li>
            <li><strong>Spectrometric Lube Oil Analysis:</strong> Engine oil samples are analyzed for wear metals (iron, copper, aluminum), fuel dilution, and Total Base Number (TBN) reserve alkalinity to guarantee mechanical engine health.</li>
            <li><strong>Safety Interlock Testing:</strong> Verification of emergency stop pushbuttons, oil pressure cutouts, coolant level switches, and canopy door access interlocks.</li>
        </ol>
    </section>

    <!-- Section 9: Frequently Asked Questions -->
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            9. Frequently Asked Questions (FAQ) &ndash; {$kva} kVA Generator Hire in UAE
        </h2>

        <div class="space-y-4 not-prose">
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">What electrical equipment can a {$kva} kVA generator run simultaneously?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    At 80% prime continuous load, this generator delivers {$kw} kW ({$amps} Amps per phase at 400V 3-phase). This power output is sufficient to operate extensive multi-story contractor office cabins, tower cranes, high-capacity concrete batching plant mixers, industrial dewatering pumps, and commercial packaged AC units. Our technical engineers provide complimentary on-site load profile assessments prior to dispatch.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">What is the difference between Prime Power and Standby Power for this unit?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    <strong>Prime Power ({$kva} kVA / {$kw} kW)</strong> is the continuous electrical output the generator can deliver under variable electrical loads for an unlimited number of hours per year in accordance with ISO 8528-1, with a 10% overload permitted for 1 hour in every 12 operating hours. <strong>Standby Power (" . round($kva * 1.10, 0) . " kVA / " . round($kw * 1.10, 0) . " kW)</strong> is the maximum output available for emergency utility backup during grid failure, where no overload is permissible.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">How do you calculate voltage drop over long cabling runs?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Over long cable distances (such as 150m to 300m from the generator to site distribution boards), voltage drop can degrade motor performance. We calculate voltage drop using the standard formula: <strong>ΔV = (√3 × I × L × (R cos φ + X sin φ)) / 1000</strong>. For runs exceeding 100 meters, we upsize cable cross-sections to {$cables} to ensure voltage drop at point of use remains strictly under 3.5%, fully conforming to DEWA / ADDC cabling regulations.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">Is fuel supplied with the generator, and what are the hire terms?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We offer both Dry Hire (client provides clean low-sulfur diesel fuel while Rental Power UAE supplies the equipment and maintenance) and Wet Hire (a complete turnkey solution where we supply the generator, secondary bulk fuel tanks, and automated ADNOC diesel tanker refueling with digital telemetry). Rental contracts are available on flexible daily, weekly, monthly, and multi-year lease structures.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">How often does routine servicing occur, and does it interrupt power?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Routine preventive maintenance occurs every 250 to 500 operating hours. Our scheduled servicing includes changing engine lube oil, primary and secondary fuel filters, water trap elements, and testing coolant inhibitor levels. If your site requires 100% zero-interruption power, we can configure an N+1 twin-pack synchronized setup where one unit takes the full load while the other is serviced seamlessly.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">How rapidly can Rental Power UAE deliver this {$kva} kVA generator to our site?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    For emergency utility outages and unscheduled project requirements across Dubai, Sharjah, and Abu Dhabi, our mobilization teams dispatch within 60 to 90 minutes. For planned shutdowns and industrial projects, we conduct site surveys, coordinate access security gate passes (such as CID approvals in Abu Dhabi or JAFZA gate passes), and deliver equipment exactly on schedule.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 10: Related Power Fleet & Cross-Linking -->
    <section class="space-y-4 pt-6 border-t border-slate-200">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Explore Complementary Power Fleet & Climate Control Services</h3>
        <p class="text-slate-600 leading-relaxed text-sm">
            Maximize your operational efficiency by combining your {$kva} kVA generator hire with our comprehensive power generation and temporary cooling fleet across the UAE:
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 not-prose text-xs font-semibold">
            <a href="/fleet/{$relatedSlug}" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">{$relatedName}</a>
            <a href="/fleet/{$secondarySlug}" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">{$secondaryName}</a>
            <a href="/service/rental-generator-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Turnkey Generator Hire</a>
            <a href="/service/silent-generator-rental-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Silent Acoustic Fleet</a>
            <a href="/service/diesel-generator-rental-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Diesel Generator Hire</a>
            <a href="/service/generator-maintenance-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Generator Maintenance</a>
            <a href="/service/generator-amc-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Annual Maintenance (AMC)</a>
            <a href="/service/rental-chiller-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Rental Chillers UAE</a>
            <a href="/service/rental-ac-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Temporary AC Rentals</a>
            <a href="/service/temporary-cooling-solutions" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Temporary Cooling Solutions</a>
            <a href="/products" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Browse Full Fleet</a>
            <a href="/contact" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Request Instant Quote</a>
        </div>
    </section>

</div>
HTML;
}

echo "Function generateGeneratorContent updated successfully.\n";

/**
 * Generates ~2,000 to 2,300 words of authentic HVAC & process cooling engineering content for chiller products
 */
function generateChillerContent(array $data): string
{
    $title = $data['title'];
    $tr = $data['tr'];
    $kwTh = $data['kw_th'];
    $flowM3 = $data['flow_m3'];
    $flowGpm = $data['flow_gpm'];
    $refrigerant = $data['refrigerant'];
    $compressor = $data['compressor'];
    $tempRange = $data['temp_range'];
    $elecKw = $data['elec_kw'];
    $amps = $data['amps'];
    $genKva = $data['gen_kva'];
    $sound = $data['sound'];
    $connections = $data['connections'];
    $dim = $data['dimensions'] ?? '4,200 x 2,200 x 2,400 mm';
    $weight = $data['weight'] ?? '4,850 kg';
    $applications = $data['applications'];
    $img1 = $data['img1'];
    $img2 = $data['img2'];
    $alt1 = $data['alt1'];
    $alt2 = $data['alt2'];
    $cap1 = $data['cap1'];
    $cap2 = $data['cap2'];
    $relatedSlug = $data['related_slug'];
    $relatedName = $data['related_name'];
    $secondarySlug = $data['secondary_slug'] ?? 'air-cooled-chiller-rental-uae';
    $secondaryName = $data['secondary_name'] ?? 'Air Cooled Chiller Rental';

    return <<<HTML
<div class="space-y-12">

    <!-- Section 1: Executive Engineering Profile & Thermodynamic Capacity Overview -->
    <section class="space-y-4">
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-display">
            1. Comprehensive Engineering Profile: {$title} in UAE ({$tr} TR / {$kwTh} kW Cooling)
        </h2>
        <p class="text-slate-600 leading-relaxed text-base">
            The <strong>{$title}</strong> delivered by Rental Power UAE represents a high-capacity, heavy-duty industrial HVAC cooling solution purpose-designed for continuous process cooling, supplemental comfort cooling, and emergency shutdown relief across the United Arab Emirates. Engineered specifically to conquer the extreme thermal pressures of the Arabian Gulf—where summer outdoor ambient temperatures regularly eclipse 50°C (122°F) with high relative humidity and airborne salinity—this mobile chiller unit supplies robust, uninterrupted chilled water to critical facilities in <a href="/locations/dubai" class="text-amber-600 font-bold hover:underline">Dubai</a>, heavy industrial process plants in <a href="/locations/abu-dhabi" class="text-amber-600 font-bold hover:underline">Abu Dhabi</a>, and manufacturing centers in <a href="/locations/sharjah" class="text-amber-600 font-bold hover:underline">Sharjah</a>.
        </p>
        <p class="text-slate-600 leading-relaxed text-base">
            Delivering a continuous nominal cooling capacity of <strong>{$tr} Tons of Refrigeration ({$kwTh} kW Thermal)</strong>, this industrial cooling module utilizes high-efficiency <strong>{$refrigerant}</strong> refrigerant with zero ozone depletion potential. Built in compliance with stringent international refrigeration standards including <strong>AHRI 550/590</strong> (performance rating of water-chilling and heat pump water-heating packages) and <strong>ASHRAE 15 &amp; 34</strong> (safety standard for refrigeration systems), our chiller fleet guarantees reliable thermal transfer under high ambient conditions without high-pressure head trips.
        </p>

        <figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
            <img src="/{$img1}" alt="{$alt1}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
            <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
                {$cap1}
            </figcaption>
        </figure>
    </section>

    <!-- Section 2: Thermodynamic Sizing Formulas & Hydronic Flow Dynamics -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            2. Thermodynamic Sizing Formulas, Water Flow Dynamics & Delta-T Calculations
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Precise chiller sizing is essential to ensure that heat loads are removed rapidly without overloading compressor motors or short-cycling the refrigeration circuits. Under-sizing cooling capacity leads to creeping chilled water temperatures, process shutdowns, and condensation hazards; over-sizing without variable-speed control causes excessive energy consumption and severe mechanical wear. The fundamental thermodynamic relationship governing our {$tr} TR chiller fleet is derived from the steady-flow thermal energy equation:
        </p>

        <div class="p-5 rounded-2xl bg-slate-900 text-white font-mono text-xs sm:text-sm my-4 space-y-2.5">
            <div><strong>Thermodynamic Heat Removal (Q):</strong> Q (kW) = m_dot × C_p × ΔT = {$kwTh} kW Thermal</div>
            <div><strong>Cooling Tons Conversion:</strong> 1 TR = 3.517 kW = 12,000 BTU/hr &rarr; {$tr} TR = {$kwTh} kW Thermal</div>
            <div><strong>Nominal Hydronic Flow Rate (m³/hr):</strong> Q_flow = ({$kwTh} × 3600) / (1000 kg/m³ × 4.186 kJ/kg·°C × 5°C ΔT) = {$flowM3} m³/hr</div>
            <div><strong>Volumetric Flow in US GPM:</strong> Flow = {$flowM3} m³/hr × 4.403 = {$flowGpm} US Gallons Per Minute</div>
            <div><strong>Standard Chilled Water ΔT:</strong> 12°C Return / 7°C Supply (ΔT = 5.0°C / 9.0°F)</div>
        </div>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Low-Temperature Glycol Brine Operations (Down to -10°C)</h3>
        <p class="text-slate-600 leading-relaxed">
            While standard HVAC comfort cooling operates with pure water at +6°C to +12°C supply temperatures, industrial food processing, cold-chain refrigeration, and concrete batching plant ice-water applications require sub-zero chilled fluids. Our {$tr} TR chillers are fully engineered to circulate inhibited food-grade <strong>Propylene Glycol or Ethylene Glycol solutions (20% to 40% concentration)</strong>, allowing fluid supply temperatures to drop safely to <strong>-5°C or -10°C</strong> without risk of evaporator tube freeze-up.
        </p>
        <p class="text-slate-600 leading-relaxed">
            When circulating glycol mixtures, fluid viscosity increases and specific heat capacity decreases (Cp ≈ 3.75 kJ/kg·°C for 30% ethylene glycol). Our engineering sizing models automatically compensate by increasing hydronic pumping head and adjusting electronic expansion valve superheat settings, guaranteeing stable refrigerant boiling and optimal heat transfer across the evaporator bundle.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">50°C Ambient Condenser Performance & Blygold Anti-Corrosion Protection</h3>
        <p class="text-slate-600 leading-relaxed">
            In the Arabian Gulf, extreme ambient summer air temperatures push standard commercial chillers into high condensing pressure safety lockouts. Furthermore, coastal industrial zones such as Jebel Ali Free Zone (JAFZA) in Dubai, Mussafah in Abu Dhabi, and Hamriyah Free Zone in Sharjah suffer from high concentrations of airborne sodium chloride (sea salt) combined with abrasive silica dust and industrial chemical emissions.
        </p>
        <p class="text-slate-600 leading-relaxed">
            To guarantee 100% continuous duty under these harsh environmental conditions, our {$tr} TR rental chillers are equipped with:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Oversized Microchannel / V-Bank Condenser Coils:</strong> Sized for continuous heat rejection at 52°C ambient entering air temperature, maintaining low condensing approach temperatures.</li>
            <li><strong>Blygold PoluAl XT Anti-Corrosion Coil Treatment:</strong> Factory-applied polyurethane coating offering over 11,000 hours of salt spray resistance (ASTM B117), preventing galvanic corrosion and preserving thermal conductivity.</li>
            <li><strong>Electronically Commutated (EC) Condenser Fans:</strong> High-efficiency variable-speed fans modulating speed based on head pressure, ensuring ultra-quiet nighttime operation and stable liquid subcooling.</li>
        </ul>
    </section>

    <!-- Section 3: Electrical Power Requirements & Generator Compatibility -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            3. Electrical Power Requirements, Energy Efficiency & Dedicated Generator Sizing
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Temporary chillers require substantial electrical input to power multi-stage screw compressors, condenser fans, and hydronic circulation pumps. Where grid utility power (DEWA, ADDC, SEWA) is unavailable, pairing the chiller with an appropriately sized diesel generator is critical. Sizing must account for compressor starting inrush currents and continuous full-load operating kilowatts:
        </p>

        <div class="overflow-x-auto my-6 not-prose">
            <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="p-3.5 border border-slate-800">Operational Loading</th>
                        <th class="p-3.5 border border-slate-800">Thermal Output (kW)</th>
                        <th class="p-3.5 border border-slate-800">Electrical Power (kW)</th>
                        <th class="p-3.5 border border-slate-800">Operating Amperes (400V 3Ph)</th>
                        <th class="p-3.5 border border-slate-800">Recommended Generator Sizing</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">25% Capacity (Low Load)</td>
                        <td class="p-3.5 text-slate-600">" . round($kwTh * 0.25, 0) . " kW Thermal</td>
                        <td class="p-3.5 text-emerald-600 font-bold">" . round($elecKw * 0.28, 0) . " kW Elec</td>
                        <td class="p-3.5 text-slate-900 font-semibold">" . round($amps * 0.28, 0) . " Amps</td>
                        <td class="p-3.5 text-slate-600" rowspan="4"><a href="/fleet/500kva-generator-hire" class="text-amber-600 font-bold hover:underline">{$genKva} Generator</a></td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">50% Capacity (Moderate Duty)</td>
                        <td class="p-3.5 text-slate-600">" . round($kwTh * 0.50, 0) . " kW Thermal</td>
                        <td class="p-3.5 text-emerald-600 font-bold">" . round($elecKw * 0.52, 0) . " kW Elec</td>
                        <td class="p-3.5 text-slate-900 font-semibold">" . round($amps * 0.52, 0) . " Amps</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">75% Capacity (Standard Running)</td>
                        <td class="p-3.5 text-slate-600">" . round($kwTh * 0.75, 0) . " kW Thermal</td>
                        <td class="p-3.5 text-amber-600 font-bold">" . round($elecKw * 0.76, 0) . " kW Elec</td>
                        <td class="p-3.5 text-slate-900 font-semibold">" . round($amps * 0.76, 0) . " Amps</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">100% Full Rated Capacity</td>
                        <td class="p-3.5 text-slate-600">{$kwTh} kW Thermal</td>
                        <td class="p-3.5 text-rose-600 font-bold">{$elecKw} kW Elec</td>
                        <td class="p-3.5 text-slate-900 font-semibold">{$amps} Amps</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="text-slate-600 leading-relaxed">
            Our chillers incorporate <strong>Soft Starters or Variable Speed Drives (VFDs)</strong> on compressor motors, capping starting inrush current to less than 150% of nominal running amperage. This eliminates voltage flicker and allows pairing with a smaller, fuel-efficient <a href="/service/rental-generator-in-uae" class="text-amber-600 font-bold hover:underline">diesel generator</a>, cutting temporary energy costs significantly.
        </p>
    </section>

    <!-- Section 4: Mechanical Compressors, Heat Exchangers & Hydronic Skid -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            4. Mechanical Powertrain, Twin-Screw Compressors & Hydronic Pumping Skid
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Industrial reliability is dictated by the caliber of refrigeration components. The {$title} is engineered with heavy-duty components from premier HVAC manufacturers:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 not-prose my-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Refrigeration Circuit ({$compressor})
                </h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li><strong>Compressor Technology:</strong> Dual or multi-stage semi-hermetic twin-screw compressors</li>
                    <li><strong>Capacity Modulation:</strong> Stepless slide-valve modulation from 25% to 100% load matching</li>
                    <li><strong>Refrigerant Charge:</strong> Eco-friendly {$refrigerant} with electronic expansion valves (EEV)</li>
                    <li><strong>Oil Management:</strong> High-efficiency cyclonic oil separators with optical oil level switches</li>
                    <li><strong>Evaporator Construction:</strong> High-efficiency Shell &amp; Tube or Brazed Plate Heat Exchanger (AISI 316)</li>
                    <li><strong>Acoustic Rating:</strong> {$sound} with low-noise compressor acoustic jackets</li>
                </ul>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Integrated Hydronic Skid &amp; Quick-Couplings
                </h3>
                <ul class="text-xs text-slate-600 space-y-2">
                    <li><strong>Pumping Configuration:</strong> Dual high-flow centrifugal pumps (Duty / Standby automated failover)</li>
                    <li><strong>Pump Impeller:</strong> Bronze / stainless steel impeller with mechanical silicon carbide seals</li>
                    <li><strong>Quick Connections:</strong> {$connections} with rapid Bauer / Camlock quick-mating couplers</li>
                    <li><strong>Hydronic Accessories:</strong> Integrated expansion tank, automatic air vent, and inline basket strainer</li>
                    <li><strong>Piping Material:</strong> Heavy-gauge galvanized carbon steel with Victaulic grooved mechanical joints</li>
                    <li><strong>Thermal Insulation:</strong> 25mm closed-cell elastomeric Armaflex insulation with UV-resistant cladding</li>
                </ul>
            </div>
        </div>

        <figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
            <img src="/{$img2}" alt="{$alt2}" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
            <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
                {$cap2}
            </figcaption>
        </figure>
    </section>

    <!-- Section 5: Real-World Customer Applications Across UAE -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            5. Primary Customer Applications & Industry Use Cases Across UAE
        </h2>
        <p class="text-slate-600 leading-relaxed">
            With decades of combined HVAC field experience across Dubai, Abu Dhabi, Sharjah, and the Northern Emirates, Rental Power UAE provides mission-critical chiller rentals for diverse industrial, commercial, and event sectors:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 not-prose my-6 text-xs sm:text-sm">
            {$applications}
        </div>

        <p class="text-slate-600 leading-relaxed">
            Whether supplementing district cooling networks (Empower, Tabreed, Emicool) during peak summer demand surges, providing emergency backup cooling for mission-critical IT data centers, or cooling massive temporary event domes, our engineers deliver turnkey thermal comfort and process stability.
        </p>
    </section>

    <!-- Section 6: Complete Turnkey Accessories & Rapid Mobilization -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            6. Turnkey Hydronic Accessories: Hoses, AHUs, Heat Exchangers & 24/7 SLA
        </h2>
        <p class="text-slate-600 leading-relaxed">
            A chiller rental is only as reliable as the hydraulic and air distribution infrastructure supporting it. Rental Power UAE maintains an extensive fleet of certified temporary HVAC accessories:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Flexible Chilled Water Hoses:</strong> Certified heavy-duty food-grade EPDM rubber suction and discharge hoses (rated to 16 bar working pressure) in 3", 4", 6", and 8" diameters with lever-locking Bauer or Camlock couplings.</li>
            <li><strong>Air Handling Units (AHUs) &amp; Fan Coils:</strong> Modular chilled water AHUs ranging from 10,000 CFM to 50,000 CFM with high-static backward-curved plug fans and multi-directional supply plenums.</li>
            <li><strong>Plate Heat Exchangers (PHE):</strong> Brazed and gasketed AISI 316 stainless steel plate heat exchangers for hydraulic pressure decoupling when connecting to high-rise building risers or contaminated open cooling towers.</li>
            <li><strong>Power Distribution &amp; Cabling:</strong> Certified 4-core armored cabling and single-core flexible cables with Powerlock connectors, paired with weatherproof IP65 distribution boards.</li>
            <li><strong>24/7 Remote Monitoring &amp; Field SLA:</strong> Integrated 4G cellular IoT telemetry transmitters transmit suction pressure, discharge pressure, chilled water supply/return temperatures, and compressor motor amps directly to our round-the-clock technical dispatch operations center.</li>
        </ul>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">District Cooling Substation Tie-Ins & High-Rise Hydraulic Pressure Decoupling</h3>
        <p class="text-slate-600 leading-relaxed">
            In metropolitan UAE centers like Downtown Dubai, Business Bay, Dubai Marina, and Abu Dhabi Island, commercial buildings and luxury hotels rely on central district cooling providers (Empower, Tabreed, Emicool). During scheduled energy transfer station (ETS) maintenance, emergency line ruptures, or chiller plant expansions, temporary chillers must be seamlessly integrated into existing building hydronic headers.
        </p>
        <p class="text-slate-600 leading-relaxed">
            Because high-rise towers feature tall chilled water riser columns exerting hydrostatic pressures of 16 to 25 bar at ground level—substantially higher than standard rental chiller evaporator shell pressure ratings of 10 bar—our engineers deploy intermediate <strong>Plate and Frame Heat Exchangers (PHE) rated to PN25</strong>. This hydronic decoupling circuit protects the rental chiller from excess static head while transferring cooling thermal energy across 0.5mm titanium or AISI 316 corrugated plates with less than a 1.0°C temperature approach loss.
        </p>
    </section>

    <!-- Section 7: Water Treatment Chemistry & Corrosion Control -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            7. Closed-Loop Water Treatment Chemistry, Corrosion Inhibition & Heat Transfer Optimization
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Untreated raw water circulated through temporary chiller evaporators in the UAE rapidly causes mineral scaling, microbiological biofilm deposition, and galvanic corrosion. A mere 0.1mm layer of calcium carbonate scale reduces evaporator heat transfer coefficient by over 12%, forcing compressor motors to consume 18% more electrical power to achieve the same cooling output:
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 not-prose my-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Corrosion Inhibition &amp; pH Control
                </h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We dose our temporary closed loops with premium nitrite/molybdate-based corrosion inhibitors maintaining a safe operating pH buffer between 9.0 and 10.5. This forms a protective microscopic passivation layer across carbon steel piping, copper tubes, and bronze fittings, suppressing electrochemical corrosion rates to less than 0.5 mils per year (MPY).
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                    Biocidal Sanitization &amp; Filtration
                </h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    To eliminate health hazards and prevent biological fouling, we implement alternating non-oxidizing isothiazolinone biocides preventing the growth of anaerobic sulfate-reducing bacteria and Legionella Pneumophila. Side-stream cartridge filtration captures suspended solids down to 5 microns, safeguarding delicate brazed plate exchangers.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 8: Pre-Mobilization Testing & Quality Assurance -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            8. Pre-Mobilization Testing Protocol, Hydrostatic Pressure & Glycol Certification
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Prior to dispatch from our Al Quoz, Mussafah, or Sajaa yards, every chiller undergoes rigorous quality assurance testing:
        </p>
        <ol class="list-decimal pl-6 space-y-2 text-slate-600">
            <li><strong>Hydrostatic Leakage Test:</strong> Evaporator water boxes, coils, and internal hydronic piping are pressurized to 1.5 times maximum working pressure (15 bar) to guarantee zero hydraulic leakage on customer premises.</li>
            <li><strong>Compressor Megger Insulation Scan:</strong> Motor windings are tested at 1000V DC using calibrated Megger insulation testers to ensure insulation resistance exceeds 100 Megaohms.</li>
            <li><strong>Full Thermal Load Run:</strong> Chillers are connected to our closed-loop thermal test station to verify refrigeration cycle pressures, expansion valve superheat (4K to 6K), and condenser subcooling (3K to 5K) at simulated 50°C ambient temperatures.</li>
            <li><strong>Microbiological &amp; Glycol Refractometer Testing:</strong> Chilled water loops are sanitized and fluid refractive indices verified using optical refractometers to ensure precise freeze-point protection.</li>
        </ol>
    </section>

    <!-- Section 9: Frequently Asked Questions -->
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            9. Frequently Asked Questions (FAQ) &ndash; Chiller Rental in UAE
        </h2>

        <div class="space-y-4 not-prose">
            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">How do I calculate the chiller capacity required for my site?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Chiller sizing depends on water flow rate and temperature difference: <strong>TR = (Flow in GPM × ΔT °F) / 24</strong>. For air conditioning space cooling, a general rule of thumb in the UAE climate is 1 TR per 15 to 20 square meters of enclosed space (depending on solar heat gain, insulation, and fresh air ventilation). Our HVAC application engineers provide complimentary on-site heat load calculations.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">What is the difference between Air-Cooled and Water-Cooled chillers for rental?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    <strong>Air-Cooled Chillers</strong> reject heat directly to outdoor air using finned condenser coils and fans. They are completely self-contained, require zero external water supply, and can be mobilized and operating within hours. <strong>Water-Cooled Chillers</strong> reject heat through water circulated to an external cooling tower. They offer higher thermodynamic efficiency (COP > 5.5) but require a continuous makeup water supply and additional cooling tower piping, making them ideal for long-term large-scale industrial projects.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">Can this chiller connect directly to our existing building chilled water pipes?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Yes. We provide flexible rubber hoses with flanged adapters (PN16 or ANSI 150) that tie directly into your building's existing chilled water headers, bypass valves, or roof-level risers. If building static head pressure exceeds the chiller's evaporator design pressure (10 bar), we install an intermediate plate heat exchanger skid to isolate system pressures safely.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">What power supply is required to operate this rental chiller?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Our chillers operate on standard UAE 3-phase utility power: <strong>400 Volts, 50 Hz, 3-Phase + Neutral + Earth</strong>. If electrical utility power is unavailable or has insufficient capacity, we bundle the chiller hire with a dedicated Prime Diesel Generator ({$genKva}) and external fuel tank for complete autonomous turnkey operation.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">How quickly can Rental Power UAE deliver and commission a rental chiller?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    For emergency shutdowns across Dubai, Abu Dhabi, and Sharjah, our mobile emergency response team dispatches chillers, hoses, pumps, and power cabling within 2 hours. Complete on-site hydraulic tie-in, pressure testing, and chilled water circulation typically achieve commissioning within 4 to 8 hours of site arrival.
                </p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                <h3 class="text-sm font-bold text-slate-900">Who is responsible for chiller maintenance during the rental period?</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Rental Power UAE provides 100% comprehensive preventive and breakdown maintenance included in the rental agreement. Our certified refrigeration technicians perform regular oil filter inspections, refrigerant pressure checks, condenser coil pressure washing, and electrical calibration at zero additional charge.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 10: Related Cooling Fleet, Power & Cross-Linking -->
    <section class="space-y-4 pt-6 border-t border-slate-200">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Explore Complementary Cooling Fleet & Temporary Power Solutions</h3>
        <p class="text-slate-600 leading-relaxed text-sm">
            Discover our comprehensive suite of climate control equipment, rental chillers, and turnkey generator power across the UAE:
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 not-prose text-xs font-semibold">
            <a href="/fleet/{$relatedSlug}" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">{$relatedName}</a>
            <a href="/fleet/{$secondarySlug}" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">{$secondaryName}</a>
            <a href="/service/rental-chiller-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Rental Chillers UAE</a>
            <a href="/service/chiller-maintenance-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Chiller Maintenance</a>
            <a href="/service/chiller-amc-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Chiller AMC Services</a>
            <a href="/service/rental-ac-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Temporary AC Rentals</a>
            <a href="/service/temporary-cooling-solutions" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Temporary Cooling Solutions</a>
            <a href="/service/rental-generator-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Turnkey Generator Hire</a>
            <a href="/fleet/500kva-generator-hire" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">500 kVA Generator</a>
            <a href="/fleet/1000-kva-generator-rental" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">1000 kVA Generator</a>
            <a href="/products" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Browse Full Fleet</a>
            <a href="/contact" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Request Chiller Quote</a>
        </div>
    </section>

</div>
HTML;
}

echo "Function generateChillerContent updated successfully.\n";

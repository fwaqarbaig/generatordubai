<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Service;
use Illuminate\Contracts\Console\Kernel;

echo "=== Preparing 2,000+ Word Authority Content for Used & Refurbished Services ===\n";

// -----------------------------------------------------------------------------
// SERVICE 65: Used Generators UAE & SERVICE 66: Refurbished Generators UAE
// -----------------------------------------------------------------------------
$generatorContent = <<<'HTML'
<div class="space-y-10">

    <!-- Executive Overview & Commercial Trading Proposition -->
    <section class="space-y-4">
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-display">
            Used & Refurbished Generator Buy & Sell Division Across the UAE
        </h2>
        <p class="text-slate-600 leading-relaxed text-base">
            In the rapidly expanding construction, manufacturing, and oilfield sectors of the United Arab Emirates, capital expenditure for new standby power systems often strains project budgets. Brand-new factory orders for industrial diesel generator sets require 16 to 24 weeks of overseas lead time and substantial upfront capital outlays. At <strong>Rental Power UAE</strong>, we bridge this critical operational gap through our dedicated <strong>Used & Refurbished Generator Trading Division</strong>.
        </p>
        <p class="text-slate-600 leading-relaxed text-base font-semibold text-slate-800">
            We buy used generators, scrap generators, and refurbished generators in any operating condition across Dubai, Abu Dhabi, Sharjah, and all Northern Emirates. Furthermore, we sale certified, zero-hour refurbished diesel generators backed by 50-point workshop load-bank testing and comprehensive mechanical warranties.
        </p>
        <p class="text-slate-600 leading-relaxed text-base">
            Whether your facility is decommissioning surplus standby power assets after completing a major project in <a href="/locations/dubai" class="text-amber-600 font-bold hover:underline">Dubai</a>, liquidating heavy oilfield gensets in <a href="/locations/abu-dhabi" class="text-amber-600 font-bold hover:underline">Abu Dhabi</a>, or replacing old industrial machinery in <a href="/locations/sharjah" class="text-amber-600 font-bold hover:underline">Sharjah</a>, our commercial team delivers instant on-site evaluations, guaranteed cash buyback proposals, and same-day financial settlements.
        </p>
    </section>

    <!-- Comprehensive Buy & Sell Scope -->
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Complete Commercial Scope: What Generators We Buy & What We Sell
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Our multi-acre reconditioning yards in the Sajaa Industrial Area (Sharjah) and Al Quoz (Dubai) allow us to process single portable gensets as well as multi-megawatt synchronized power stations. We categorize our generator trading operations into three distinct procurement and supply streams:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 not-prose my-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-700 flex items-center justify-center font-bold">01</div>
                <h3 class="text-lg font-bold text-slate-900">We Buy Used Generators</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We purchase low-to-medium hour running diesel generators (500 to 10,000 operating hours) directly from commercial facilities, data centers, hospitals, telecommunications towers, and civil contractors. We pay top market rates for genuine <a href="/service/perkins-generators-uae" class="text-amber-600 font-semibold hover:underline">Perkins</a>, <a href="/service/cummins-generator-rental-uae" class="text-amber-600 font-semibold hover:underline">Cummins</a>, Caterpillar, MTU, Volvo Penta, and Doosan power sets.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-700 flex items-center justify-center font-bold">02</div>
                <h3 class="text-lg font-bold text-slate-900">We Buy Scrap Generators</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We buy non-functional, seized, flood-damaged, burned, and structurally condemned generators for salvage. If your generator has a cracked engine block, blown pistons, obsolete analog controls, or burnt stator copper windings, we calculate fair valuation based on raw heavy cast-iron weight and high-grade copper scrap recovery rates.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center font-bold">03</div>
                <h3 class="text-lg font-bold text-slate-900">We Sale Refurbished Generators</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We sale fully certified, reconditioned diesel generators that perform to original OEM efficiency benchmarks at 40% to 60% below the cost of brand-new units. Every generator undergoes our rigorous 50-point mechanical and electrical overhaul, complete with load-bank certification and workshop warranty.
                </p>
            </div>
        </div>
    </section>

    <!-- Technical Valuation Framework -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            How We Value Used & Scrap Generators: The Engineering Valuation Protocol
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Unlike scrap dealers who offer arbitrary estimates, Rental Power UAE conducts rigorous, engineering-driven appraisals. When you invite our diagnostic valuation team to inspect your surplus generator, we assess five primary technical parameters:
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">1. Electronic Control Module (ECM) Telemetry & Operating History</h3>
        <p class="text-slate-600 leading-relaxed">
            On modern digital engines (such as Perkins 1100/2000 series, Cummins Quantum System, or Cat ADEM controllers), we plug in diagnostic scanners to verify true operational run-hours, historical load percentages, previous fault codes, overspeed events, and thermal trip history. Verified standby generators that have operated under low duty cycles receive prime market value.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">2. Mechanical Engine Health: Compression, Crankcase Pressure & Oil Analysis</h3>
        <p class="text-slate-600 leading-relaxed">
            Our field mechanics test cylinder compression across all banks to detect piston ring wear or cylinder bore glazing. We measure crankcase blow-by pressure and extract engine oil samples for laboratory spectrochemical analysis. Detecting trace concentrations of iron, copper, chromium, or glycol confirms the exact wear state of main bearings and crankshaft journals.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">3. Alternator Insulation Resistance & Winding Integrity (Megger Testing)</h3>
        <p class="text-slate-600 leading-relaxed">
            The electrical alternator (Stamford, Leroy Somer, Mecc Alte, or Marathon) is subjected to a 1,000V DC Megohmmeter test. We measure insulation resistance across the stator, rotor, and exciter windings against the frame. Readings exceeding 10 Megohms indicate healthy Class H insulation, whereas degraded windings are flagged for workshop vacuum pressure impregnation (VPI) or full copper rewinding.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">4. Cooling Package & Acoustic Canopy Condition</h3>
        <p class="text-slate-600 leading-relaxed">
            In the UAE’s harsh 50°C summer conditions, cooling efficiency determines generator survival. We inspect copper-brass and aluminum core radiators for external fin corrosion, scale accumulation, and coolant leaks. Sound-attenuated canopies are inspected for zinc-galvanized sheet metal integrity, rockwool acoustic insulation density, and stainless steel lock hardware.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">5. Scrap Copper & Ferrous Metal Salvage Weight</h3>
        <p class="text-slate-600 leading-relaxed">
            When a generator is mechanically dead or beyond economic repair, we assess its scrap liquidation value based on London Metal Exchange (LME) scrap copper indices and local UAE foundry cast-iron rates. A standard 500 kVA generator alternator contains approximately 250 to 350 kg of pure electrolytic copper windings, alongside 2,500 kg of heavy cast iron and structural steel, delivering substantial cash recovery for retired assets.
        </p>
    </section>

    <!-- Technical Comparison Table -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Comparison: Used Generators vs. Refurbished Generators vs. Brand-New Factory Sets
        </h2>
        <p class="text-slate-600 leading-relaxed">
            To assist project directors, facilities managers, and procurement officers in choosing the right power solution, our technical engineering team has prepared this comprehensive comparison:
        </p>

        <div class="overflow-x-auto my-6 not-prose">
            <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="p-3.5 border border-slate-800">Operational Factor</th>
                        <th class="p-3.5 border border-slate-800">Certified Used Generator</th>
                        <th class="p-3.5 border border-slate-800">Refurbished Generator (RP UAE)</th>
                        <th class="p-3.5 border border-slate-800">Brand-New Factory Genset</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Capital Cost (CAPEX)</td>
                        <td class="p-3.5 text-emerald-600 font-bold">40% &ndash; 50% Lower than New</td>
                        <td class="p-3.5 text-emerald-600 font-bold">50% &ndash; 60% Lower than New</td>
                        <td class="p-3.5 text-rose-600 font-semibold">100% Full Factory Pricing</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Procurement Lead Time</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Immediate (24 &ndash; 48 Hours)</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Immediate (48 &ndash; 72 Hours)</td>
                        <td class="p-3.5 text-rose-600 font-semibold">16 &ndash; 24 Weeks Production</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Mechanical Reconditioning</td>
                        <td class="p-3.5 text-slate-600">Serviced & Flushed Fluids</td>
                        <td class="p-3.5 text-slate-900 font-semibold">Full 50-Point Rebuild & Zero-Hour</td>
                        <td class="p-3.5 text-slate-900">Brand New from Factory</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Load Bank Verification</td>
                        <td class="p-3.5 text-slate-600">Standard Functional Run</td>
                        <td class="p-3.5 text-slate-900 font-semibold">4-Hour 100% Full Resistive Test</td>
                        <td class="p-3.5 text-slate-900">Factory Quality Control Run</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Warranty Protection</td>
                        <td class="p-3.5 text-slate-600">30-Day Startup Warranty</td>
                        <td class="p-3.5 text-emerald-600 font-bold">3 to 6-Month Comprehensive Warranty</td>
                        <td class="p-3.5 text-slate-900">12-Month Manufacturer Warranty</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Guaranteed Cash Buyback</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Yes &bull; Guaranteed Buyback Agreement</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Yes &bull; Guaranteed Buyback Agreement</td>
                        <td class="p-3.5 text-slate-500">Subject to Dealer Depreciation</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- 50-Point Refurbishment Protocol -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Our 50-Point Zero-Hour Refurbishment Protocol: How We Build Reliability
        </h2>
        <p class="text-slate-600 leading-relaxed">
            When our engineering division purchases a pre-owned diesel generator, it is transported directly to our specialized reconditioning workshop in the Sajaa Industrial Oasis. Here, our certified master diesel technicians carry out an exhaustive zero-hour restoration process:
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Phase 1: Complete Teardown & Chemical De-Greasing</h3>
        <p class="text-slate-600 leading-relaxed">
            The engine block, alternator, cooling radiator, and control cubicle are demounted from the structural skid base. The base frame is sandblasted to Swedish Standard Sa 2.5, coated with epoxy zinc primer, and finished with polyurethane industrial enamel. The engine block undergoes ultrasonic solvent cleaning to remove carbon deposits, oil sludge, and cooling jacket scale.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Phase 2: Cylinder Overhaul, Bearings & Fuel Injection Rebuild</h3>
        <p class="text-slate-600 leading-relaxed">
            Cylinder liners are honed or replaced with genuine OEM components. Main and big-end bearings are renewed to factory clearances. The fuel injection pump and fuel injectors are calibrated on high-pressure computerized test benches to achieve precise atomization patterns, eliminating exhaust smoke and optimizing specific fuel consumption (SFC).
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Phase 3: Alternator VPI Baking & Digital AVR Upgrade</h3>
        <p class="text-slate-600 leading-relaxed">
            The main stator and rotor windings are baked in thermostatically controlled ovens to eliminate moisture, re-impregnated with high-grade Class H electrical varnish, and dynamically balanced to ISO 1940 Grade G2.5 standards. Obsolete analog voltage regulators are replaced with brand-new digital automatic voltage regulators (AVR) featuring under-frequency roll-off (UFRO) and rapid transient load response.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Phase 4: Digital Controller Integration & Safety Tripping</h3>
        <p class="text-slate-600 leading-relaxed">
            We install modern digital control panels, primarily Deep Sea Electronics (DSE 7320 MKII) or ComAp InteliLite. These microprocessors provide automatic mains failure (AMF) synchronization, real-time frequency/voltage monitoring, programmable safety shutdowns for high coolant temperature, low oil pressure, and reverse power, plus optional remote GSM/Ethernet telemetry.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">Phase 5: 4-Hour Resistive Load-Bank Quality Certification</h3>
        <p class="text-slate-600 leading-relaxed">
            No refurbished generator leaves our facility without completing our rigorous load-bank trial: 1 hour at 25% load, 1 hour at 50% load, 1 hour at 75% load, 1 full hour at 100% rated prime capacity, and a 15-minute overload run at 110%. Digital sensors log cylinder exhaust temperatures, lube oil viscosity, and radiator delta-T. A signed Load Bank Test Certificate is issued with every sale.
        </p>
    </section>

    <!-- Turnkey Logistics & Decommissioning -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Turnkey Heavy Decommissioning & Crane Logistics: Zero Hassle for Sellers
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Decommissioning a 1,000 kVA or 2,000 kVA industrial generator from an operational jobsite, rooftop plant room, or basement enclosure presents significant logistical and safety challenges. When you sell a used or scrap generator to Rental Power UAE, we handle 100% of the extraction and transport operations:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Heavy Crane Rigging:</strong> Our licensed rigging crew deploys 25-ton to 100-ton mobile telescopic cranes with certified lifting spreaders, wire slings, and D-shackles to execute safe, damage-free lifts.</li>
            <li><strong>Hazardous Fluid Draining:</strong> In compliance with Dubai Municipality Environment Department and Tadweer (Abu Dhabi Waste Management) regulations, our team drains all engine lube oil, ethylene glycol coolant, and diesel fuel into approved containment drums before road transit.</li>
            <li><strong>Permitted Heavy Haulage:</strong> We dispatch low-bed and multi-axle flatbed transport trailers equipped with valid Roads and Transport Authority (RTA) and Department of Municipalities and Transport (DMT) permits for oversized loads.</li>
            <li><strong>Instant Financial Clearance:</strong> Full payment is transferred to your bank account via telegraphic wire transfer or settled in cash prior to equipment unbolting and crane lifting.</li>
        </ul>
    </section>

    <!-- Strategic Regional Presence -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Serving All Industrial Zones Across Dubai, Abu Dhabi & the Northern Emirates
        </h2>
        <p class="text-slate-600 leading-relaxed">
            With field valuation teams stationed strategically across the Emirates, we guarantee rapid 2 to 4-hour on-site inspection response times:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Dubai Metropolitan & Industrial Hubs:</strong> Jebel Ali Free Zone (JAFZA), Dubai Industrial City (DIC), Al Quoz, Ras Al Khor, and Dubai South.</li>
            <li><strong>Abu Dhabi & Western Concessions:</strong> Mussafah Industrial Area (M9 to M44), Industrial City of Abu Dhabi (ICAD I, II, III), KIZAD, Al Ain, and remote oil concessions in Al Ruwais, Habshan, and Asab.</li>
            <li><strong>Sharjah & Northern Industrial Belts:</strong> Sharjah Industrial Areas 1 through 18, Sajaa Industrial Oasis, Hamriyah Free Zone, <a href="/locations/ajman" class="text-amber-600 font-semibold hover:underline">Ajman Jurf</a>, <a href="/locations/ras-al-khaimah" class="text-amber-600 font-semibold hover:underline">Ras Al Khaimah (Al Hamra & Al Ghail)</a>, <a href="/locations/fujairah" class="text-amber-600 font-semibold hover:underline">Fujairah</a>, and <a href="/locations/umm-al-quwain" class="text-amber-600 font-semibold hover:underline">Umm Al Quwain</a>.</li>
        </ul>
    </section>

    <!-- Comprehensive Internal Linking Cross-Sell -->
    <section class="space-y-4 pt-6 border-t border-slate-200">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Explore Related Power & Infrastructure Services</h3>
        <p class="text-slate-600 leading-relaxed text-sm">
            Discover how Rental Power UAE supports your complete temporary and permanent electrical infrastructure requirements:
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 not-prose text-xs font-semibold">
            <a href="/service/rental-generator-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Rental Generator Fleet</a>
            <a href="/service/rental-power-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Turnkey Rental Power</a>
            <a href="/service/silent-generator-rental-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Silent Generators</a>
            <a href="/service/diesel-generator-rental-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Diesel Generator Hire</a>
            <a href="/service/generator-maintenance-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Generator Maintenance</a>
            <a href="/service/generator-amc-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Generator AMC Contracts</a>
            <a href="/service/portacabin-for-sale-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used Portacabins Buy & Sell</a>
            <a href="/service/refurbished-portacabin-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Refurbished Portacabins</a>
            <a href="/used-refurbished-generators" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used & Refurbished Hub</a>
        </div>
    </section>

</div>
HTML;

// -----------------------------------------------------------------------------
// SERVICE 41: Portacabin for Sale in UAE & SERVICE 68: Refurbished Portacabin UAE
// -----------------------------------------------------------------------------
$portacabinContent = <<<'HTML'
<div class="space-y-10">

    <!-- Executive Overview & Commercial Trading Scope -->
    <section class="space-y-4">
        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight font-display">
            We Buy & Sell Used, Refurbished & Scrap Portacabins Across the UAE
        </h2>
        <p class="text-slate-600 leading-relaxed text-base">
            Temporary modular buildings, prefabricated site offices, and portable cabins form the operational backbone of every civil engineering, infrastructure, and industrial project across the United Arab Emirates. However, once major construction contracts conclude or oilfield camps demobilize, contractors are faced with expensive yard storage costs, land lease penalties, and deteriorating surplus structures.
        </p>
        <p class="text-slate-600 leading-relaxed text-base font-semibold text-slate-800">
            At <strong>Rental Power UAE</strong>, we operate the country’s leading <strong>Portacabin Buy & Sell Division</strong>. We buy used and refurbished portacabins, and also scrap portacabins we buy in any structural condition across Dubai, Abu Dhabi, Sharjah, and all seven Emirates. In addition, we sale high-grade, fully certified refurbished portacabins ready for immediate jobsite deployment.
        </p>
        <p class="text-slate-600 leading-relaxed text-base">
            Whether your project requires immediate cash liquidation for 50 surplus accommodation cabins or you are searching for turnkey, Grade-A executive office cabins fitted with PU sandwich panels, certified electricals, and air conditioning at <strong>50% below new modular manufacturing prices</strong>, our commercial and engineering teams deliver fast, reliable solutions with same-day financial settlement.
        </p>
    </section>

    <!-- Comprehensive Buy & Sell Spectrum -->
    <section class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Full Portacabin Trading Spectrum: What We Buy & What We Sell
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Operating extensive storage and refurbishment facilities in the Sajaa Industrial Oasis (Sharjah) and Jebel Ali / Al Quoz (Dubai), we handle modular prefabricated structures across all categories:
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 not-prose my-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-700 flex items-center justify-center font-bold">01</div>
                <h3 class="text-lg font-bold text-slate-900">We Buy Used Portacabins</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We purchase operational, second-hand modular cabins directly from contracting companies, developers, and project joint ventures. We actively buy executive site office cabins, meeting units, supervisor offices, staff dining halls, and multi-cubicle ablution units in sizes including 10x10ft, 20x10ft, 30x10ft, 40x10ft, and 40x12ft.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-700 flex items-center justify-center font-bold">02</div>
                <h3 class="text-lg font-bold text-slate-900">We Buy Scrap Portacabins</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We buy structurally damaged, rusted, fire-impacted, decayed, water-damaged, or condemned portacabins. When structures are no longer habitable or viable for commercial reuse, we purchase them for scrap metal salvage—valuing heavy I-beam structural steel chassis, galvanized corrugated roof sheets, and aluminum window frames.
                </p>
            </div>
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 space-y-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-700 flex items-center justify-center font-bold">03</div>
                <h3 class="text-lg font-bold text-slate-900">We Sale Refurbished Portacabins</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We sale fully reconditioned, Grade-A modular cabins that look and perform like brand-new units. Refurbished portacabins feature sandblasted anti-corrosion structural frames, new 50mm–100mm PU sandwich panels, commercial vinyl floors, certified DEWA/SEWA compliant electrical distribution boards, and heavy-duty split ACs.
                </p>
            </div>
        </div>
    </section>

    <!-- Architectural & Engineering Reconditioning Standards -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Engineering & Fabrication Standards: How We Refurbish Modular Cabins
        </h2>
        <p class="text-slate-600 leading-relaxed">
            The UAE's extreme climate—featuring summer ambient temperatures exceeding 50°C, intense solar radiation, and corrosive coastal humidity—quickly destroys poorly built portacabins. Every cabin refurbished and sold by Rental Power UAE undergoes a comprehensive structural, thermal, and electrical reconstruction process:
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">1. Structural Skid Chassis Restoration & Anti-Corrosion Treatment</h3>
        <p class="text-slate-600 leading-relaxed">
            The structural foundation of any portable cabin is its steel chassis. We inspect the main I-beam runners, cross-members, and corner lifting lugs. Damaged or rusted members are cut out and replaced with heavy structural channel steel. The entire steel undercarriage is sandblasted to remove rust scale and treated with zinc-phosphate anti-corrosion primer followed by marine-grade bituminous protective paint.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">2. High-Performance Thermal Insulation: PU & Rockwool Sandwich Panels</h3>
        <p class="text-slate-600 leading-relaxed">
            Standard corrugated sheet cabins become unbearable heat traps in Dubai and Abu Dhabi. In our refurbishment line, we fit walls and ceilings with continuous high-density Polyurethane (PU) foam core or non-combustible Rockwool sandwich panels (density 40 kg/m³, thermal conductivity &lambda; &le; 0.022 W/m&middot;K). With panel thicknesses of 50mm, 75mm, or 100mm, our cabins maintain cool interior temperatures while reducing air conditioning power consumption by up to 45%.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">3. Heavy-Duty Subfloor & Commercial Grade Vinyl Flooring</h3>
        <p class="text-slate-600 leading-relaxed">
            Termite infestation and water ingress frequently rot subfloors in older cabins. We replace compromised subflooring with 18mm high-density marine plywood or fiber-cement boards bolted directly to the steel joists. Surfaces are sealed with heavy-duty commercial vinyl sheeting (2.0mm to 3.0mm thickness) with hot-welded seams, offering superior slip resistance, easy mopping, and exceptional durability under heavy work boot traffic.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">4. Certified Electrical Wiring & Distribution Boards (DEWA / SEWA Standard)</h3>
        <p class="text-slate-600 leading-relaxed">
            Safety is paramount on construction job sites. We strip out hazardous, exposed wiring and install brand-new, fire-retardant PVC surface trunking or concealed conduit. Electrical infrastructure includes an industrial main distribution board (MDB/SMDB) fitted with Schneider or ABB residual current circuit breakers (RCCB 30mA protection), British Standard 13A dual switched sockets, dedicated 20A AC isolators, and energy-efficient LED batten lights.
        </p>

        <h3 class="text-xl font-bold text-slate-800 tracking-tight mt-4">5. Climate Control & Sanitary Ablution Integration</h3>
        <p class="text-slate-600 leading-relaxed">
            Every executive cabin or site office is fitted with pre-fabricated structural cutouts and support brackets for 1.5-ton to 2.5-ton rotary/tropical split air conditioning units designed to operate in high ambient temperatures. For ablution and toilet blocks, we install UPVC drainage systems, PPR hot/cold water piping, ceramic water closets, wash basins with brass mixer taps, high-flow exhaust ventilation fans, and shatterproof mirrors.
        </p>
    </section>

    <!-- Technical Comparison Matrix -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Comparison: Used Portacabins vs. Refurbished Cabins vs. Brand-New Prefabricated Units
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Evaluate your project’s modular infrastructure investment options across cost, delivery time, structural lifespan, and buyback value:
        </p>

        <div class="overflow-x-auto my-6 not-prose">
            <table class="w-full text-left text-xs sm:text-sm border-collapse border border-slate-200 rounded-2xl shadow-xs overflow-hidden">
                <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="p-3.5 border border-slate-800">Evaluation Parameter</th>
                        <th class="p-3.5 border border-slate-800">Certified Used Portacabin</th>
                        <th class="p-3.5 border border-slate-800">Refurbished Cabin (RP UAE)</th>
                        <th class="p-3.5 border border-slate-800">Brand-New Custom Fabricated</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Procurement Price</td>
                        <td class="p-3.5 text-emerald-600 font-bold">50% &ndash; 65% Below New Price</td>
                        <td class="p-3.5 text-emerald-600 font-bold">40% &ndash; 50% Below New Price</td>
                        <td class="p-3.5 text-rose-600 font-semibold">100% Full Factory CAPEX</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Delivery Lead Time</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Immediate (24 &ndash; 48 Hours)</td>
                        <td class="p-3.5 text-emerald-600 font-bold">In-Stock Dispatch (48 Hours)</td>
                        <td class="p-3.5 text-rose-600 font-semibold">4 &ndash; 8 Weeks Factory Build</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Thermal Insulation State</td>
                        <td class="p-3.5 text-slate-600">Existing Sound Panels</td>
                        <td class="p-3.5 text-slate-900 font-semibold">Brand-New 50mm–100mm PU Panels</td>
                        <td class="p-3.5 text-slate-900">New Factory Panels</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Electrical System Condition</td>
                        <td class="p-3.5 text-slate-600">Inspected & Megger Tested</td>
                        <td class="p-3.5 text-slate-900 font-semibold">100% Rewired with DB & LED</td>
                        <td class="p-3.5 text-slate-900">Brand-New Factory Install</td>
                    </tr>
                    <tr class="hover:bg-slate-50">
                        <td class="p-3.5 font-bold text-slate-900">Expected Working Lifespan</td>
                        <td class="p-3.5 text-slate-600">3 to 5 Years</td>
                        <td class="p-3.5 text-emerald-600 font-bold">7 to 10+ Years with Maintenance</td>
                        <td class="p-3.5 text-slate-900">10 to 12 Years</td>
                    </tr>
                    <tr class="hover:bg-slate-50 bg-slate-50/50">
                        <td class="p-3.5 font-bold text-slate-900">Guaranteed Buyback Option</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Yes &bull; Contractual Cash Buyback</td>
                        <td class="p-3.5 text-emerald-600 font-bold">Yes &bull; Contractual Cash Buyback</td>
                        <td class="p-3.5 text-slate-500">Subject to Third-Party Appraisal</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Turnkey Demobilization, Crane Rigging & Transport -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Full Site Demobilization: Heavy Cranes, Flatbeds & Instant Cash Settlement
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Clearing an active construction compound or remote temporary facility at the conclusion of a project requires coordinated logistics. Demobilizing 10, 20, or 50 portacabins under strict developer deadlines demands heavy lifting gear and licensed haulage. When you sell used or scrap cabins to Rental Power UAE:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Certified Mobile Crane Operations:</strong> We deploy 25-ton to 70-ton mobile cranes equipped with certified 4-leg wire rope lifting bridles and spreader beams. Cabins are rigged and hoisted safely without structural racking or roof puncture.</li>
            <li><strong>Low-Bed & Flatbed Haulage Fleet:</strong> We operate our own dedicated transport fleet, securing oversized cargo permits from the Roads and Transport Authority (RTA) in Dubai and the Department of Municipalities and Transport (DMT) in Abu Dhabi.</li>
            <li><strong>Complete Compound Demobilization:</strong> If you have an entire site setup containing office cabins, security guard houses, steel storage containers, ablution blocks, and perimeter fencing, our demolition and removal crews clear the ground completely in days, leaving the plot ready for municipal handover.</li>
            <li><strong>Upfront Financial Clearance:</strong> 100% of the agreed valuation is settled prior to lifting. We provide instant corporate wire transfers or certified manager's cheques.</li>
        </ul>
    </section>

    <!-- Regional Coverage & Response Time -->
    <section class="space-y-4">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight font-display">
            Prompt Site Inspections Across Dubai, Abu Dhabi, Sharjah & All Emirates
        </h2>
        <p class="text-slate-600 leading-relaxed">
            Our valuation engineers travel throughout the UAE every day to inspect surplus equipment and assist contractors with urgent demobilizations:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-slate-600">
            <li><strong>Dubai:</strong> Jebel Ali Free Zone (JAFZA), Dubai Industrial City (DIC), Al Quoz, Business Bay, Dubai South, and Expo City developments.</li>
            <li><strong>Abu Dhabi:</strong> Mussafah Industrial Area, ICAD, Khalifa Industrial Zone Abu Dhabi (KIZAD), Al Falah, and oilfield sites across Al Ruwais, Madinat Zayed, and Habshan.</li>
            <li><strong>Sharjah & Northern Emirates:</strong> Sajaa Industrial Area, Sharjah Industrial Areas 1 to 18, Hamriyah Free Zone, <a href="/locations/ajman" class="text-amber-600 font-semibold hover:underline">Ajman Industrial</a>, <a href="/locations/ras-al-khaimah" class="text-amber-600 font-semibold hover:underline">Ras Al Khaimah</a>, <a href="/locations/fujairah" class="text-amber-600 font-semibold hover:underline">Fujairah port zones</a>, and <a href="/locations/umm-al-quwain" class="text-amber-600 font-semibold hover:underline">Umm Al Quwain</a>.</li>
        </ul>
    </section>

    <!-- Strategic Internal Linking -->
    <section class="space-y-4 pt-6 border-t border-slate-200">
        <h3 class="text-xl font-bold text-slate-900 tracking-tight">Explore Related Site Infrastructure & Temporary Power</h3>
        <p class="text-slate-600 leading-relaxed text-sm">
            Discover how Rental Power UAE provides complete site mobilization services across the Emirates:
        </p>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 not-prose text-xs font-semibold">
            <a href="/service/used-generators-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used Generators Buy & Sell</a>
            <a href="/service/refurbished-generators-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Refurbished Generators</a>
            <a href="/service/used-container-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used Shipping Containers</a>
            <a href="/service/used-caravan-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used Mobile Caravans</a>
            <a href="/service/rental-chiller-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Rental Chillers</a>
            <a href="/service/rental-ac-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Rental Air Conditioners</a>
            <a href="/service/temporary-cooling-in-uae" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Temporary Cooling</a>
            <a href="/service/chiller-maintenance" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Chiller Maintenance</a>
            <a href="/used-refurbished-generators" class="p-3 rounded-xl bg-slate-50 hover:bg-amber-50 border border-slate-200 hover:border-amber-300 text-slate-800 transition">Used & Refurbished Hub</a>
        </div>
    </section>

</div>
HTML;

// -----------------------------------------------------------------------------
// Update Services in Database
// -----------------------------------------------------------------------------
$servicesToUpdate = [
    65 => [
        'content' => $generatorContent,
        'meta_title' => 'Used Generators UAE | We Buy & Sale Used, Scrap & Refurbished Generators',
        'meta_description' => 'We buy used generators, scrap generators, and refurbished generators across Dubai, Abu Dhabi, and Sharjah. We also sale certified refurbished diesel generators with load-test warranties.',
        'focus_keyword' => 'used generators uae',
    ],
    66 => [
        'content' => $generatorContent,
        'meta_title' => 'Refurbished Generators UAE | Zero-Hour Certified Gensets For Sale & Buyback',
        'meta_description' => 'Certified refurbished diesel generators for sale across UAE. 50-point zero-hour overhaul, 4-hour load bank certification. We buy used and scrap generators with instant cash settlement.',
        'focus_keyword' => 'refurbished generators uae',
    ],
    41 => [
        'content' => $portacabinContent,
        'meta_title' => 'Used & Refurbished Portacabin UAE | We Buy & Sale Used, Scrap & Refurbished Cabins',
        'meta_description' => 'We buy used and refurbished portacabins, and also scrap portacabins across Dubai, Abu Dhabi & Sharjah. We sale certified refurbished modular site offices with instant crane delivery.',
        'focus_keyword' => 'used portacabin uae',
    ],
    68 => [
        'content' => $portacabinContent,
        'meta_title' => 'Refurbished Portacabin UAE | Grade-A Modular Site Offices Buy & Sale',
        'meta_description' => 'Buy certified refurbished portacabins in UAE at 50% below new cost. PU insulated, DEWA wired, split AC fitted. We also buy used and scrap portacabins with same-day cash payout.',
        'focus_keyword' => 'refurbished portacabin uae',
    ],
];

foreach ($servicesToUpdate as $id => $data) {
    $svc = Service::find($id);
    if ($svc) {
        $svc->content = $data['content'];
        $svc->meta_title = $data['meta_title'];
        $svc->meta_description = $data['meta_description'];
        $svc->focus_keyword = $data['focus_keyword'];
        $svc->save();
        $wordCount = str_word_count(strip_tags($data['content']));
        echo "Updated Service ID {$id}: '{$svc->title}' ({$svc->slug}) -> {$wordCount} words\n";
    } else {
        echo "Service ID {$id} not found!\n";
    }
}

echo "=== All Services Successfully Updated ===\n";

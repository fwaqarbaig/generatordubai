@extends('layouts.app')

@section('seo_meta')
    <title>Generator Rental in Dubai & UAE | 50 kVA to 2500 kVA Silent Power Hire</title>
    <meta name="description" content="Rent silent diesel generators across Dubai, Abu Dhabi, Sharjah & all 7 Emirates. 50 kVA to 2500 kVA fleet, 24/7 emergency dispatch within 60-120 minutes, fuel management & turnkey setup.">
    <meta name="keywords" content="generator rental dubai, generator rental uae, diesel generator hire dubai, silent generator rental, temporary power solutions dubai, 500 kva generator rental, industrial generator hire uae">
    <link rel="canonical" href="{{ route('home') }}">
    <meta property="og:title" content="Generator Rental in Dubai & UAE | Turnkey Diesel Power Hire">
    <meta property="og:description" content="50 kVA to 2500 kVA soundproof diesel generator rental, multi-megawatt synchronized power plants, and 24/7 emergency dispatch across all 7 Emirates.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('home') }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Schema.org WebSite JSON-LD with Sitelinks Searchbox -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => 'Generator Dubai',
      'url' => route('home'),
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
          '@type' => 'EntryPoint',
          'urlTemplate' => route('blog.index') . '?q={search_term_string}',
        ],
        'query-input' => 'required name=search_term_string',
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Schema.org FAQPage JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'FAQPage',
      'mainEntity' => [
        [
          '@type' => 'Question',
          'name' => 'How much does it cost to rent a generator in Dubai and the UAE?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Generator rental costs depend on required capacity (kVA/kW), rental duration (daily, weekly, or monthly), delivery distance, and whether fuel logistics are included. A 50 kVA silent unit typically starts from competitive daily or monthly rates, while large industrial generators (500-1250 kVA) are quoted on customized commercial project terms. Contact Generator Dubai for an immediate, transparent, itemized quote with zero hidden charges.',
          ],
        ],
        [
          '@type' => 'Question',
          'name' => 'How quickly can Generator Dubai deliver an emergency rental generator to my site?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'We maintain 24/7 emergency dispatch centers across Dubai, Abu Dhabi, and Sharjah. For critical power failures, transformer outages, or emergency site shutdowns, our mobile crane trailers mobilize and deliver generators to most UAE locations within 60 to 120 minutes of confirmation.',
          ],
        ],
        [
          '@type' => 'Question',
          'name' => 'What generator sizes (kVA/kW) do you have available for immediate hire?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Our active rental fleet ranges from 50 kVA (40 kW) up to 2500 kVA (2000 kW) single units, running on premium Cummins, Perkins, and Caterpillar engines. For massive power demands, we synchronize multiple containerized generators in parallel to create temporary power plants up to 20 Megawatts.',
          ],
        ],
        [
          '@type' => 'Question',
          'name' => 'Do you supply silent generators suitable for residential areas and VIP events?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Yes. Our silent generator fleet is housed in specialized acoustic, sound-attenuated steel canopies with residential-grade internal silencers that keep sound levels below 65 dBA at 7 meters, fully complying with UAE municipal environmental noise regulations.',
          ],
        ],
        [
          '@type' => 'Question',
          'name' => 'Is electrical installation, cabling, and technical setup included with the rental?',
          'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => 'Yes. Generator Dubai provides complete turnkey power solutions. Our certified electrical technicians handle delivery, offloading, positioning, armored cable connection, automatic transfer switch (ATS) installation, and comprehensive load-testing before site handover.',
          ],
        ],
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$page->schema_markup ?? null" />
@endsection

@section('content')
<div class="space-y-20 sm:space-y-28 overflow-hidden">

    <!-- ================= 1. HERO SECTION ================= -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-32 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white">
        <!-- Ambient Power Glows -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-amber-500/15 blur-[140px] rounded-full pointer-events-none"></div>
        <div class="absolute top-10 left-10 w-72 h-72 bg-sky-500/10 blur-[100px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Column: Copy & Actions -->
                <div class="lg:col-span-7 space-y-6 text-left">
                    <!-- Hero Top Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs font-bold text-amber-300 shadow-lg shadow-amber-950/40">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        <span>50 kVA - 2500 kVA Power Fleet</span>
                        <span class="text-white/40">|</span>
                        <span class="text-slate-300 font-semibold">24/7 Emergency Mobilization</span>
                    </div>

                    <!-- Main Headline -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black font-display tracking-tight leading-[1.1] text-white">
                        Turnkey Diesel Generator Rental in Dubai & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-200">Temporary Power Solutions Across UAE</span>
                    </h1>

                    <!-- Paragraph 1 & 2 -->
                    <p class="text-sm sm:text-base text-slate-300 font-normal leading-relaxed">
                        Generator Dubai is the UAE's premier provider of heavy-duty temporary power solutions, delivering fuel-efficient, sound-attenuated diesel generators from <strong>50 kVA to 2500 kVA</strong> across Dubai, Abu Dhabi, Sharjah, and all Northern Emirates. Engineered to perform reliably in extreme desert temperatures exceeding 50°C.
                    </p>
                    <p class="text-xs sm:text-sm text-slate-400 font-normal leading-relaxed hidden sm:block">
                        From rapid emergency blackout restoration to synchronized multi-megawatt temporary power plants, every generator is load-bank tested and deployed with certified electrical technicians, automatic transfer switches (ATS), external bunded fuel storage, and complete turnkey distribution.
                    </p>

                    <!-- CTAs -->
                    <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="tel:+971569213754" 
                           class="px-8 py-4 rounded-full bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-500/30 hover:scale-105 transition-all flex items-center justify-center gap-2 group">
                            <i data-lucide="phone-call" class="w-4 h-4 text-slate-950"></i>
                            <span>Call 24/7 Hotline: +971 56 921 3754</span>
                        </a>
                        <a href="#kva-selector" 
                           class="px-7 py-4 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-sm border border-white/20 backdrop-blur-md transition flex items-center justify-center gap-2">
                            <span>Browse Fleet Capacities</span>
                            <i data-lucide="arrow-down" class="w-4 h-4 text-amber-400"></i>
                        </a>
                    </div>

                    <!-- Trust Micro-Badges -->
                    <div class="pt-4 flex flex-wrap items-center gap-5 text-xs text-slate-400 font-medium">
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-amber-400"></i>
                            <span>ISO 8528 Certified Fleet</span>
                        </div>
                        <span class="text-slate-700 hidden sm:inline">&bull;</span>
                        <div class="flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4 text-emerald-400"></i>
                            <span>&lt;60 Min Emergency Dispatch</span>
                        </div>
                        <span class="text-slate-700 hidden sm:inline">&bull;</span>
                        <div class="flex items-center gap-2">
                            <i data-lucide="award" class="w-4 h-4 text-sky-400"></i>
                            <span>99.98% Power Uptime SLA</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Hero Visual Card -->
                <div class="lg:col-span-5">
                    <div class="relative rounded-3xl overflow-hidden border border-slate-800 bg-slate-900/60 shadow-2xl p-2">
                        <img src="{{ asset('storage/media/2026/09/1-y7ja6x.webp') }}" 
                             alt="Diesel Generator Rental Fleet in Dubai" 
                             width="800"
                             height="500"
                             loading="eager"
                             fetchpriority="high"
                             class="w-full h-80 sm:h-96 object-cover rounded-2xl shadow-inner">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent rounded-2xl"></div>
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-slate-900/90 backdrop-blur-md border border-slate-700/60 text-white space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold uppercase text-amber-400 tracking-wider">Heavy Power Ready</span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 font-bold border border-emerald-500/30">In Stock</span>
                            </div>
                            <h4 class="text-sm font-bold text-white">Tier-1 Cummins, Perkins & Caterpillar Gensets</h4>
                            <p class="text-xs text-slate-300">Synchronized containers up to 20MW with residential-grade super-silent sound attenuation (&lt;65 dBA).</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= 2. STATS STRIP ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 sm:-mt-14 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-xl">
            <div class="text-center p-4 border-r border-slate-100 last:border-none">
                <div class="text-3xl sm:text-4xl font-black font-display text-slate-900 tracking-tight">50-2500</div>
                <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mt-1">kVA Fleet Capacity</div>
                <p class="text-[11px] text-slate-500 mt-0.5">Single & Parallel Units</p>
            </div>
            <div class="text-center p-4 border-r border-slate-100 last:border-none">
                <div class="text-3xl sm:text-4xl font-black font-display text-slate-900 tracking-tight">&lt;60 Min</div>
                <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mt-1">Emergency Dispatch</div>
                <p class="text-[11px] text-slate-500 mt-0.5">Across All 7 Emirates</p>
            </div>
            <div class="text-center p-4 border-r border-slate-100 last:border-none">
                <div class="text-3xl sm:text-4xl font-black font-display text-slate-900 tracking-tight">99.98%</div>
                <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mt-1">Power Uptime SLA</div>
                <p class="text-[11px] text-slate-500 mt-0.5">Guaranteed Reliability</p>
            </div>
            <div class="text-center p-4">
                <div class="text-3xl sm:text-4xl font-black font-display text-slate-900 tracking-tight">7</div>
                <div class="text-xs font-bold text-amber-600 uppercase tracking-wider mt-1">Emirates Covered</div>
                <p class="text-[11px] text-slate-500 mt-0.5">Plus Cross-Border Oman</p>
            </div>
        </div>
    </section>

    <!-- ================= 3. KVA CAPACITY SELECTOR GRID ================= -->
    <section id="kva-selector" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 text-amber-700 text-xs font-extrabold uppercase tracking-wider border border-amber-500/20">
                <i data-lucide="zap" class="w-3.5 h-3.5 fill-current"></i>
                <span>Capacity Selector</span>
            </div>
            <h2 class="text-2xl sm:text-4xl font-black font-display text-slate-950 tracking-tight">
                Generator Fleet by kVA Output — Tailored for UAE Site Demands
            </h2>
            <p class="text-sm text-slate-600">
                From compact auxiliary site generators to massive synchronized multi-megawatt configurations, select the optimal kVA rating for your project:
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @php
                $kvaList = [
                    ['kva' => '50', 'kw' => '40', 'label' => '50 kVA (40 kW)', 'desc' => 'Compact power for commercial site offices, telecom masts, and temporary retail kiosks.', 'consumption' => '9.1 L/hr'],
                    ['kva' => '100', 'kw' => '80', 'label' => '100 kVA (80 kW)', 'desc' => 'Versatile three-phase power for tower cranes, concrete vibrators, and outdoor event stages.', 'consumption' => '16.5 L/hr'],
                    ['kva' => '150', 'kw' => '120', 'label' => '150 kVA (120 kW)', 'desc' => 'Steady electrical supply for medium construction sites, workshops, and commercial facilities.', 'consumption' => '24.5 L/hr'],
                    ['kva' => '200', 'kw' => '160', 'label' => '200 kVA (160 kW)', 'desc' => 'Reliable capacity for construction hoist motors, dewatering pumps, and batching plants.', 'consumption' => '31.0 L/hr'],
                    ['kva' => '250', 'kw' => '200', 'label' => '250 kVA (200 kW)', 'desc' => 'High-performance workhorse for industrial fabrication yards and large residential compounds.', 'consumption' => '38.2 L/hr'],
                    ['kva' => '300', 'kw' => '240', 'label' => '300 kVA (240 kW)', 'desc' => 'Heavy-duty power for multi-crane civil sites, camp accommodations, and event lighting rigs.', 'consumption' => '45.5 L/hr'],
                    ['kva' => '350', 'kw' => '280', 'label' => '350 kVA (280 kW)', 'desc' => 'Continuous prime power for deep foundation drilling rigs and water treatment facilities.', 'consumption' => '52.8 L/hr'],
                    ['kva' => '500', 'kw' => '400', 'label' => '500 kVA (400 kW)', 'desc' => 'Industrial-grade output supporting major infrastructure, asphalt plants, and hotel chiller backup.', 'consumption' => '74.0 L/hr'],
                    ['kva' => '600', 'kw' => '480', 'label' => '600 kVA (480 kW)', 'desc' => 'Sustained continuous power for heavy manufacturing lines, marine docks, and quarry crushers.', 'consumption' => '89.0 L/hr'],
                    ['kva' => '800', 'kw' => '640', 'label' => '800 kVA (640 kW)', 'desc' => 'High-capacity generator for large-scale industrial projects, cooling plants, and hospital backups.', 'consumption' => '118.0 L/hr'],
                    ['kva' => '1000', 'kw' => '800', 'label' => '1000 kVA (800 kW)', 'desc' => 'Containerized megawatt unit for oil & gas terminals, major developments, and data centers.', 'consumption' => '145.0 L/hr'],
                    ['kva' => '1250', 'kw' => '1000', 'label' => '1250 kVA (1000 kW)', 'desc' => 'Utility-grade synchronized power for sub-stations, refinery turnarounds, and multi-MW plants.', 'consumption' => '185.0 L/hr'],
                ];
            @endphp

            @foreach($kvaList as $item)
                <div class="group relative rounded-2xl bg-white border border-slate-200 p-6 hover:border-amber-400 hover:shadow-xl transition-all flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-amber-500/10 text-amber-800 text-xs font-black">
                                {{ $item['kva'] }} kVA
                            </span>
                            <span class="text-[11px] text-slate-500 font-semibold flex items-center gap-1">
                                <i data-lucide="fuel" class="w-3.5 h-3.5 text-amber-500"></i>
                                <span>{{ $item['consumption'] }}</span>
                            </span>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900 group-hover:text-amber-600 transition">
                            {{ $item['label'] }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $item['desc'] }}
                        </p>
                    </div>

                    <div class="pt-5 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('fleet.show', $item['kva'] . '-kva') }}" class="text-xs font-bold text-amber-600 group-hover:text-amber-700 flex items-center gap-1">
                            <span>Full Specifications</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="tel:+971569213754" class="p-2 rounded-lg bg-slate-100 hover:bg-amber-500 text-slate-700 hover:text-slate-950 transition" title="Inquire by phone">
                            <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= 4. ENGINEERED FLEET CATEGORIES ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-12 lg:p-16 border border-slate-800 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-amber-500/10 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="max-w-3xl space-y-3 mb-12">
                <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">Engineered Fleet</span>
                <h2 class="text-2xl sm:text-4xl font-black font-display tracking-tight text-white">
                    Industrial & Commercial Power Generation Systems Available for Hire
                </h2>
                <p class="text-sm text-slate-300">
                    Every job site presents distinct load profiles and environmental constraints. Explore our primary generator categories designed for precision power delivery across the UAE:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Cat 1 -->
                <div class="flex flex-col sm:flex-row gap-5 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-amber-500/50 transition">
                    <img src="{{ asset('storage/media/2026/10/2-im4l8z.jpg') }}" alt="Silent Canopy Diesel Generator" width="300" height="300" loading="lazy" class="w-full sm:w-36 h-36 object-cover rounded-xl shrink-0">
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">50 - 500 kVA</span>
                        <h3 class="text-lg font-bold text-white">Silent Canopy Diesel Generators</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Acoustic steel canopies dampening noise below 65 dBA @ 7m. Ideal for luxury film shoots, VIP events, hotels, medical centers, and residential developments where quiet operation is mandatory.
                        </p>
                    </div>
                </div>

                <!-- Cat 2 -->
                <div class="flex flex-col sm:flex-row gap-5 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-amber-500/50 transition">
                    <img src="{{ asset('storage/media/2026/10/3-ki2rou.jpg') }}" alt="Heavy-Duty Prime Power Sets" width="300" height="300" loading="lazy" class="w-full sm:w-36 h-36 object-cover rounded-xl shrink-0">
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">500 - 1250 kVA</span>
                        <h3 class="text-lg font-bold text-white">Heavy-Duty Prime & Continuous Power Sets</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Rugged skid-mounted and containerized packages designed for unrelenting 24/7 prime electrical supply. Built to handle heavy inductive motor starting currents on civil infrastructure and batching plants.
                        </p>
                    </div>
                </div>

                <!-- Cat 3 -->
                <div class="flex flex-col sm:flex-row gap-5 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-amber-500/50 transition">
                    <img src="{{ asset('storage/media/2026/10/4-s0ctda.jpg') }}" alt="Mobile Fast-Tow Trailer Gensets" width="300" height="300" loading="lazy" class="w-full sm:w-36 h-36 object-cover rounded-xl shrink-0">
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">50 - 250 kVA</span>
                        <h3 class="text-lg font-bold text-white">Mobile Fast-Tow Trailer Gensets</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Road-homologated mobile units built with heavy-duty torsion axles, trailer brakes, and integrated fuel tanks for rapid relocation between sites, linear pipeline works, and emergency recovery.
                        </p>
                    </div>
                </div>

                <!-- Cat 4 -->
                <div class="flex flex-col sm:flex-row gap-5 p-6 rounded-2xl bg-slate-900/80 border border-slate-800 hover:border-amber-500/50 transition">
                    <img src="{{ asset('storage/media/2026/10/5-5gbsbw.jpg') }}" alt="Synchronized Multi-Megawatt Containerized Plants" width="300" height="300" loading="lazy" class="w-full sm:w-36 h-36 object-cover rounded-xl shrink-0">
                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">1 MW - 20 MW</span>
                        <h3 class="text-lg font-bold text-white">Synchronized Multi-Megawatt Plants</h3>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            20ft and 40ft ISO containerized modules equipped with intelligent Deep Sea Electronics (DSE) paralleling controllers. Operating seamlessly in parallel for utilities, refineries, and data centers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 5. ISO 8528 STANDARDS: PRIME VS STANDBY ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-10">
            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Engineering Standards</span>
            <h2 class="text-2xl sm:text-3xl font-black font-display text-slate-950">
                Understanding ISO 8528 Standards: Prime Power (PRP) vs Emergency Standby (ESP)
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-md space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center">
                    <i data-lucide="zap" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-black font-display text-slate-900">Prime Rated Power (PRP)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Engineered to supply continuous, variable electrical power for unlimited operating hours per year in off-grid environments. Features a mandatory <strong>10% overload capability for 1 hour every 12 hours</strong>. The essential choice for civil construction projects, remote desert installations, and exploration camps where no municipal DEWA or SEWA grid exists.
                </p>
                <div class="text-xs font-bold text-amber-700 bg-amber-50 p-3 rounded-xl border border-amber-200">
                    &check; Mandatory 10% overload margin &bull; Unlimited running hours &bull; Continuous duty
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-md space-y-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-500/10 text-sky-600 flex items-center justify-center">
                    <i data-lucide="shield-alert" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-black font-display text-slate-900">Emergency Standby Power (ESP)</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Calibrated to deliver reliable backup power for the duration of a utility outage or scheduled transformer maintenance. Operates without overload allowance to maintain life-safety lighting, computer servers, hospital equipment, and cold storage facilities until the main power grid is safely re-energized.
                </p>
                <div class="text-xs font-bold text-sky-700 bg-sky-50 p-3 rounded-xl border border-sky-200">
                    &check; Zero-overload safety &bull; Instant ATS changeover &bull; Max uptime protection
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 6. TECHNICAL FUEL CONSUMPTION TABLE ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white border border-slate-200 shadow-xl overflow-hidden p-6 sm:p-10">
            <div class="max-w-3xl space-y-2 mb-8">
                <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600">Technical Specifications</span>
                <h2 class="text-xl sm:text-3xl font-black font-display text-slate-900">
                    Technical Comparison & Fuel Consumption Specifications
                </h2>
                <p class="text-xs text-slate-500">
                    *Fuel consumption figures are based on 75% prime load and standard ambient conditions. Actual fuel burn varies with ambient temperature, altitude, and dynamic inductive loads.
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm text-slate-600">
                    <thead class="bg-slate-100 text-slate-900 uppercase font-extrabold text-[11px] tracking-wider border-b border-slate-200">
                        <tr>
                            <th class="py-4 px-4 sm:px-6">Configuration</th>
                            <th class="py-4 px-4 sm:px-6">kVA Range</th>
                            <th class="py-4 px-4 sm:px-6">Est. Fuel Burn @ 75%</th>
                            <th class="py-4 px-4 sm:px-6">Primary Site Use Case</th>
                            <th class="py-4 px-4 sm:px-6">Standard Terms</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-900">Silent Canopy Generator</td>
                            <td class="py-4 px-4 sm:px-6 font-semibold text-amber-600">50 - 100 kVA</td>
                            <td class="py-4 px-4 sm:px-6">8.5 - 16.0 L/hr</td>
                            <td class="py-4 px-4 sm:px-6">Commercial site offices, events, retail kiosks</td>
                            <td class="py-4 px-4 sm:px-6">Daily, weekly, or monthly hire</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-900">Soundproof Prime Generator</td>
                            <td class="py-4 px-4 sm:px-6 font-semibold text-amber-600">150 - 300 kVA</td>
                            <td class="py-4 px-4 sm:px-6">24.0 - 48.0 L/hr</td>
                            <td class="py-4 px-4 sm:px-6">Tower cranes, dewatering pumps, medium civil sites</td>
                            <td class="py-4 px-4 sm:px-6">Monthly to multi-month project rental</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-900">Heavy-Duty Industrial Genset</td>
                            <td class="py-4 px-4 sm:px-6 font-semibold text-amber-600">350 - 600 kVA</td>
                            <td class="py-4 px-4 sm:px-6">55.0 - 95.0 L/hr</td>
                            <td class="py-4 px-4 sm:px-6">Concrete batching plants, manufacturing, chillers</td>
                            <td class="py-4 px-4 sm:px-6">Project-based and long-term lease</td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-4 px-4 sm:px-6 font-bold text-slate-900">Containerized Power Module</td>
                            <td class="py-4 px-4 sm:px-6 font-semibold text-amber-600">800 - 2500 kVA</td>
                            <td class="py-4 px-4 sm:px-6">125.0 - 240.0 L/hr</td>
                            <td class="py-4 px-4 sm:px-6">Data centers, oil & gas fields, utility substations</td>
                            <td class="py-4 px-4 sm:px-6">Long-term contracts & seasonal peak shaving</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-xs text-slate-500 font-medium">Need customized load profile assessment for your motors or cranes?</span>
                <a href="tel:+971569213754" class="px-6 py-2.5 rounded-full bg-slate-900 text-white font-bold text-xs hover:bg-amber-500 hover:text-slate-950 transition flex items-center gap-2">
                    <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                    <span>Speak with Sizing Engineer: +971 56 921 3754</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ================= 7. TURNKEY SERVICES & DISTRIBUTION ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Comprehensive Solutions</span>
            <h2 class="text-2xl sm:text-4xl font-black font-display text-slate-950 tracking-tight">
                Turnkey Electrical Engineering & Site Support Services
            </h2>
            <p class="text-sm text-slate-600">
                Beyond temporary generator rentals, Generator Dubai delivers full-lifecycle electrical engineering, preventative maintenance, cooling, and modular infrastructure:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Service::published()->ordered()->get() as $svc)
                <div class="group rounded-3xl bg-white border border-slate-200 p-7 hover:border-amber-400 hover:shadow-xl transition-all flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 group-hover:bg-amber-500 group-hover:text-slate-950 flex items-center justify-center transition-colors">
                            <i data-lucide="{{ $svc->icon ?: 'zap' }}" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-lg font-black font-display text-slate-900 group-hover:text-amber-600 transition">
                            {{ $svc->title }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $svc->summary }}
                        </p>
                        @if(!empty($svc->features))
                            <ul class="pt-2 space-y-1.5 text-xs text-slate-500">
                                @foreach(array_slice($svc->features, 0, 3) as $f)
                                    <li class="flex items-start gap-1.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5 text-amber-500 shrink-0 mt-0.5"></i>
                                        <span>{{ $f }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="{{ route('service.show', $svc->slug) }}" class="text-xs font-bold text-amber-600 group-hover:text-amber-700 flex items-center gap-1.5">
                            <span>Explore Solution Details</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= 8. 6-STEP ISO DEPLOYMENT LIFECYCLE ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-slate-950 text-white p-8 sm:p-14 border border-slate-800">
            <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
                <span class="text-xs font-extrabold uppercase tracking-widest text-amber-400">Deployment Lifecycle</span>
                <h2 class="text-2xl sm:text-4xl font-black font-display tracking-tight text-white">
                    Our Seamless 6-Step Engineering Deployment Process
                </h2>
                <p class="text-xs sm:text-sm text-slate-400">
                    From initial electrical audit through demobilization, our ISO-compliant process ensures safe, compliant, and zero-downtime power installation:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $steps = [
                        ['num' => '01', 'title' => 'Technical Consultation & Load Analysis', 'desc' => 'Our power engineers evaluate connected machinery, motor starting profiles (DOL/VFD), running amperages, and location constraints to specify the exact kVA requirement.'],
                        ['num' => '02', 'title' => 'Customized Engineering Proposal & SLA', 'desc' => 'You receive a transparent, itemized quotation detailing generator rating, fuel plan, distribution accessories, delivery timeline, and guaranteed maintenance service levels.'],
                        ['num' => '03', 'title' => 'On-Site Civil & Safety Audit', 'desc' => 'For complex deployments, our safety team conducts an on-site survey confirming crane access, ground load-bearing capacity, exhaust ventilation, and civil defense clearances.'],
                        ['num' => '04', 'title' => 'Rapid Mobilization & Rigging', 'desc' => 'Our heavy transport fleet delivers the generator, places it securely, lays armored copper cabling, connects distribution panels, and installs proper earth grounding rods.'],
                        ['num' => '05', 'title' => 'Commissioning & Load-Bank Testing', 'desc' => 'We perform phased load testing, verify automatic transfer switch changeover, calibrate synchronisation panels, and provide resident technician support.'],
                        ['num' => '06', 'title' => 'Safe Decommissioning & Handover', 'desc' => 'Upon project completion, our technicians safely disconnect cabling, pump out residual fuel, de-rig all equipment, and arrange timely removal without impacting daily operations.'],
                    ];
                @endphp

                @foreach($steps as $s)
                    <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 space-y-3">
                        <div class="text-xs font-black text-amber-400 tracking-wider font-mono">STEP {{ $s['num'] }}</div>
                        <h4 class="text-base font-bold text-white">{{ $s['title'] }}</h4>
                        <p class="text-xs text-slate-400 leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ================= 9. INDUSTRIES SERVED ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Sector Specialization</span>
            <h2 class="text-2xl sm:text-4xl font-black font-display text-slate-950 tracking-tight">
                Critical Sectors Powered by Generator Dubai
            </h2>
            <p class="text-sm text-slate-600">
                Delivering proven temporary power solutions across the UAE's critical commercial, industrial, and infrastructure industries:
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @php
                $industries = [
                    ['title' => 'Civil Construction', 'icon' => 'hard-hat', 'desc' => 'Tower cranes, dewatering pumps & batching plants.'],
                    ['title' => 'Emergency Grid Outages', 'icon' => 'zap-off', 'desc' => 'Blackout recovery and utility transformer bypass.'],
                    ['title' => 'Manufacturing & Plants', 'icon' => 'factory', 'desc' => 'Continuous 3-phase power for factories & warehousing.'],
                    ['title' => 'Luxury Hospitality', 'icon' => 'hotel', 'desc' => 'Super-silent generation for resorts, chillers & POS.'],
                    ['title' => 'Hospitals & Healthcare', 'icon' => 'heart-pulse', 'desc' => 'Zero-interruption standby for operating theaters.'],
                    ['title' => 'Marine Ports & Docks', 'icon' => 'anchor', 'desc' => 'Shore-to-ship power conversion & shipyard repairs.'],
                    ['title' => 'Data Centers & IT', 'icon' => 'server', 'desc' => 'Tier-III/IV clean power during switchgear overhauls.'],
                    ['title' => 'Retail & Shopping Malls', 'icon' => 'shopping-bag', 'desc' => 'Emergency chiller backup and seasonal peak shaving.'],
                    ['title' => 'Desert Explorations', 'icon' => 'compass', 'desc' => 'Heavy-duty standalone generators with extended fuel.'],
                    ['title' => 'Events & Festivals', 'icon' => 'mic', 'desc' => 'Whisper-quiet power for audio, stages & broadcast.'],
                ];
            @endphp

            @foreach($industries as $ind)
                <div class="p-5 rounded-2xl bg-white border border-slate-200 hover:border-amber-400 hover:shadow-lg transition space-y-2 text-center flex flex-col items-center justify-center">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-1">
                        <i data-lucide="{{ $ind['icon'] }}" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-xs font-bold text-slate-900">{{ $ind['title'] }}</h4>
                    <p class="text-[11px] text-slate-500 leading-tight">{{ $ind['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= 10. WHY CHOOSE GENERATOR DUBAI ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Engineering Excellence</span>
            <h2 class="text-2xl sm:text-4xl font-black font-display text-slate-950 tracking-tight">
                Why Industry Leaders Choose Generator Dubai for Critical Site Power
            </h2>
            <p class="text-sm text-slate-600">
                In demanding commercial and civil projects, power disruptions lead to massive operational losses. Here is how our power engineering leadership safeguards your continuous operations:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $pillars = [
                    ['num' => '01', 'title' => 'Tier-1 Certified Engines', 'desc' => 'Our entire fleet features premium Cummins, Perkins, and Caterpillar engines with high-ambient tropical radiators engineered for continuous operation at 55°C.'],
                    ['num' => '02', 'title' => 'Acoustically Attenuated Super-Silent Canopies', 'desc' => 'Sound-absorbing rockwool insulation, residential-grade internal mufflers, and aerodynamic acoustic baffles keep sound below 65 dBA at 7 meters.'],
                    ['num' => '03', 'title' => 'Certified 24/7 Resident Technicians', 'desc' => 'Every deployment is supervised by qualified electrical technicians managing load profiling, synchronisation, and live monitoring, available 24/7.'],
                    ['num' => '04', 'title' => 'Complete Turnkey Power Infrastructure', 'desc' => 'We supply 4-pole automatic transfer switches (ATS), digital synchronizing panels, heavy-duty armored copper cables, and IP66 distribution boards.'],
                    ['num' => '05', 'title' => 'Rapid Dispatch Across All 7 Emirates', 'desc' => 'Dedicated logistics depots in Dubai (Al Quoz & JAFZA), Abu Dhabi (Mussafah), and Sharjah guarantee on-site delivery within 1 to 2 hours.'],
                    ['num' => '06', 'title' => 'Automated Fuel Logistics & Telemetry', 'desc' => 'Integrated electronic telemetry tracks fuel burn, oil pressure, and electrical loads in real-time, coordinating scheduled bulk diesel replenishment.'],
                ];
            @endphp

            @foreach($pillars as $pil)
                <div class="p-6 rounded-3xl bg-white border border-slate-200 hover:border-amber-400 hover:shadow-lg transition space-y-3">
                    <span class="text-xs font-black text-amber-500 font-mono tracking-wider">PILLAR {{ $pil['num'] }}</span>
                    <h3 class="text-base font-extrabold text-slate-900">{{ $pil['title'] }}</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">{{ $pil['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= 11. REGIONAL COVERAGE DEPOTS ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-slate-100 border border-slate-200 p-8 sm:p-12 space-y-8">
            <div class="max-w-2xl space-y-2">
                <span class="text-xs font-extrabold uppercase tracking-wider text-amber-700">UAE Fleet Logistics</span>
                <h2 class="text-2xl sm:text-3xl font-black font-display text-slate-950">
                    Strategic Regional Depots Delivering Rapid 24/7 UAE Coverage
                </h2>
                <p class="text-xs sm:text-sm text-slate-600">
                    With heavy transport trailers stationed across strategically positioned logistics yards, we guarantee rapid emergency delivery across the Emirates:
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-2">
                    <div class="text-xs font-bold text-amber-600">DUBAI CENTRAL FLEET HUB</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Al Quoz & JAFZA</h4>
                    <p class="text-xs text-slate-500">Rapid dispatch to Dubai South, DIC, Business Bay, Downtown & DIP within 30-60 mins.</p>
                    <a href="{{ route('locations.show', 'dubai') }}" class="text-xs font-bold text-amber-600 hover:underline block pt-1">Dubai Depot Details &rarr;</a>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-2">
                    <div class="text-xs font-bold text-amber-600">ABU DHABI & MUSSAFAH</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Mussafah & ICAD</h4>
                    <p class="text-xs text-slate-500">Serving Mussafah, KIZAD, Khalifa Port, Al Dhafra & oilfield staging in 60-90 mins.</p>
                    <a href="{{ route('locations.show', 'abu-dhabi') }}" class="text-xs font-bold text-amber-600 hover:underline block pt-1">Abu Dhabi Depot &rarr;</a>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-2">
                    <div class="text-xs font-bold text-amber-600">SHARJAH & HAMRIYAH</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Hamriyah Free Zone</h4>
                    <p class="text-xs text-slate-500">Direct logistics access to Industrial Areas 1 to 18 & SAIF Zone within 45 mins.</p>
                    <a href="{{ route('locations.show', 'sharjah') }}" class="text-xs font-bold text-amber-600 hover:underline block pt-1">Sharjah Depot &rarr;</a>
                </div>
                <div class="p-5 rounded-2xl bg-white border border-slate-200 shadow-xs space-y-2">
                    <div class="text-xs font-bold text-amber-600">NORTHERN EMIRATES</div>
                    <h4 class="text-sm font-extrabold text-slate-900">Ajman, RAK & Fujairah</h4>
                    <p class="text-xs text-slate-500">Serving Ajman, Ras Al Khaimah quarries, Fujairah Port & UAQ in 60-120 mins.</p>
                    <a href="{{ route('locations.index') }}" class="text-xs font-bold text-amber-600 hover:underline block pt-1">View All Hubs &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= 11.5 LATEST ARTICLES & GUIDES ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Technical Knowledge Base</span>
                <h2 class="text-2xl sm:text-4xl font-black font-display text-slate-950 mt-3">
                    Latest Generator Engineering & Power Guides
                </h2>
                <p class="text-sm text-slate-600 mt-2 max-w-2xl">
                    In-depth engineering insights on generator sizing, ISO 8528 ratings, fuel optimization, and high-ambient power reliability in the UAE.
                </p>
            </div>
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-amber-600 hover:text-amber-700 transition">
                <span>View All Articles</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $postsToShow = isset($latestPosts) && $latestPosts->isNotEmpty() 
                    ? (isset($featuredPost) ? collect([$featuredPost])->merge($latestPosts)->take(3) : $latestPosts->take(3))
                    : \App\Models\Post::published()->latest('published_at')->take(3)->get();
            @endphp
            @foreach($postsToShow as $article)
                <article class="bg-white rounded-3xl border border-slate-200/90 shadow-xs hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                    <a href="{{ route('post.show', $article->slug) }}" class="relative aspect-video overflow-hidden bg-slate-900 block">
                        <img src="{{ $article->featured_image_url ?: asset('storage/media/2026/09/1-y7ja6x.webp') }}" 
                             alt="{{ $article->title }}" 
                             width="600"
                             height="338"
                             loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                        @if($firstCat = $article->categories->first())
                            <span class="absolute top-4 left-4 text-[10px] uppercase font-extrabold tracking-wider bg-amber-500 text-slate-950 px-2.5 py-1 rounded-full shadow-md">
                                {{ $firstCat->name }}
                            </span>
                        @endif
                    </a>
                    <div class="p-6 flex flex-col flex-grow justify-between space-y-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                                <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                                <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                                <span>&bull;</span>
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                <span>5 min read</span>
                            </div>
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-amber-600 transition line-clamp-2 leading-snug">
                                <a href="{{ route('post.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                                {{ $article->seo_description ?: $article->excerpt }}
                            </p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-500">Generator Dubai Engineering</span>
                            <a href="{{ route('post.show', $article->slug) }}" class="text-xs font-extrabold text-amber-600 hover:text-amber-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                                <span>Read Guide</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- ================= 12. FAQS ACCORDION ================= -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-3 mb-10">
            <span class="text-xs font-extrabold uppercase tracking-wider text-amber-600 bg-amber-100 px-3 py-1 rounded-full border border-amber-300">Frequently Asked Questions</span>
            <h2 class="text-2xl sm:text-3xl font-black font-display text-slate-950">
                Frequently Asked Questions About Generator Rental in Dubai & UAE
            </h2>
        </div>

        <div class="space-y-3" x-data="{ openFaq: null }">
            @php
                $faqs = [
                    ['q' => 'How much does it cost to rent a generator in Dubai and the UAE?', 'a' => 'Generator rental costs depend on required capacity (kVA/kW), rental duration (daily, weekly, or monthly), delivery distance, and whether fuel logistics are included. A 50 kVA silent unit typically starts from competitive daily or monthly rates, while large industrial generators (500-1250 kVA) are quoted on customized commercial project terms. Contact Generator Dubai for an immediate, transparent, itemized quote with zero hidden charges.'],
                    ['q' => 'How quickly can Generator Dubai deliver an emergency rental generator to my site?', 'a' => 'We maintain 24/7 emergency dispatch centers across Dubai, Abu Dhabi, and Sharjah. For critical power failures, transformer outages, or emergency site shutdowns, our mobile crane trailers mobilize and deliver generators to most UAE locations within 60 to 120 minutes of confirmation.'],
                    ['q' => 'What generator sizes (kVA/kW) do you have available for immediate hire?', 'a' => 'Our active rental fleet ranges from 50 kVA (40 kW) up to 2500 kVA (2000 kW) single units, running on premium Cummins, Perkins, and Caterpillar engines. For massive power demands, we synchronize multiple containerized generators in parallel to create temporary power plants up to 20 Megawatts.'],
                    ['q' => 'Do you supply silent generators suitable for residential areas and VIP events?', 'a' => 'Yes. Our silent generator fleet is housed in specialized acoustic, sound-attenuated steel canopies with residential-grade internal silencers that keep sound levels below 65 dBA at 7 meters, fully complying with UAE municipal environmental noise regulations.'],
                    ['q' => 'Is electrical installation, cabling, and technical setup included with the rental?', 'a' => 'Yes. Generator Dubai provides complete turnkey power solutions. Our certified electrical technicians handle delivery, offloading, positioning, armored cable connection, automatic transfer switch (ATS) installation, and comprehensive load-testing before site handover.'],
                    ['q' => 'What is the difference between "Prime Power" and "Standby Power"?', 'a' => 'Prime Power (PRP) is designed to operate as the primary continuous electrical source for unlimited hours on off-grid sites, featuring a 10% overload capacity. Standby Power (ESP) is engineered strictly for emergency backup during utility outages without overload capability.'],
                    ['q' => 'How do I determine the right generator size for my project machinery?', 'a' => 'Generator sizing requires calculating continuous running wattage and the high inductive starting surge of electric motors (tower cranes, dewatering pumps, chillers, and compressors). Direct-On-Line (DOL) motors require up to 6x full-load current to start. Our certified engineers conduct free electrical load audits to ensure you receive the exact kVA rating needed without overpaying.'],
                    ['q' => 'Who is responsible for diesel refueling during the rental period?', 'a' => 'We offer both "Dry Hire" (where you arrange fuel independently) and full "Wet Hire" service. Under our Wet Hire package, we supply double-walled external bunded fuel tanks and our dedicated mobile diesel tankers provide automatic scheduled on-site refueling so your generator never runs dry.'],
                ];
            @endphp

            @foreach($faqs as $idx => $faq)
                <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="openFaq = (openFaq === {{ $idx }} ? null : {{ $idx }})" 
                            class="w-full flex items-center justify-between p-5 text-left text-sm sm:text-base font-bold text-slate-900 hover:text-amber-600 transition">
                        <span>{{ $faq['q'] }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 shrink-0 transition-transform duration-200" :class="openFaq === {{ $idx }} ? 'rotate-180 text-amber-600' : ''"></i>
                    </button>
                    <div x-show="openFaq === {{ $idx }}" x-cloak class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        {{ $faq['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ================= 13. BOTTOM EMERGENCY CTA BANNER ================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="rounded-3xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 p-8 sm:p-12 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6 text-slate-950">
            <div class="space-y-2 text-center md:text-left">
                <span class="text-xs uppercase font-black tracking-widest text-slate-900 bg-black/10 px-3 py-1 rounded-full">Emergency Blackout Response</span>
                <h3 class="text-2xl sm:text-3xl font-black font-display tracking-tight text-slate-950">
                    Need Immediate, High-Reliability Site Power in the UAE?
                </h3>
                <p class="text-xs sm:text-sm text-slate-900 font-semibold max-w-xl">
                    24/7 emergency dispatch available across Dubai, Abu Dhabi, Sharjah, and all Emirates. Speak directly with a power engineering specialist right now.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full sm:w-auto">
                <a href="{{ route('contact') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-full bg-slate-950 hover:bg-slate-900 text-white font-extrabold text-xs text-center shadow-lg transition">
                    Request Instant Quote
                </a>
                <a href="tel:+971569213754" class="w-full sm:w-auto px-7 py-3.5 rounded-full bg-white hover:bg-slate-100 text-slate-950 font-extrabold text-xs text-center shadow-lg transition flex items-center justify-center gap-2">
                    <i data-lucide="phone-call" class="w-4 h-4 text-amber-500"></i>
                    <span>Call (+971) 56 921 3754</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection

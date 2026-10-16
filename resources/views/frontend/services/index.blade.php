@extends('layouts.app')

@section('seo_meta')
    <title>Generator Rental & Power Services in UAE | Generator Dubai</title>
    <meta name="description" content="Turnkey power services across Dubai, Abu Dhabi, Sharjah and Northern Emirates: 50–2500 kVA silent generator rental, temporary power plants, AMC contracts, used & refurbished portacabins, and 24/7 emergency repair.">
    <meta name="keywords" content="generator rental dubai, power rental uae, generator amc contracts dubai, temporary power plants uae, used portacabin buy and sell uae, scrap portacabin dubai, generator repair dubai">
    <link rel="canonical" href="{{ route('service.index') }}">
    <meta property="og:title" content="Generator Rental & Power Services in UAE | Generator Dubai">
    <meta property="og:description" content="Turnkey power solutions: 50–2500 kVA diesel generator hire, multi-MW synchronized plants, certified AMC, and used & refurbished portacabins across UAE.">
    <meta property="og:url" content="{{ route('service.index') }}">
    <meta property="og:type" content="website">

    <!-- Schema.org ItemList JSON-LD for Google Crawler Indexing -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Commercial Diesel Generator & Power Services UAE',
      'itemListElement' => $services->map(function($s, $idx) {
          return [
              '@type' => 'ListItem',
              'position' => $idx + 1,
              'name' => $s->title,
              'url' => route('service.show', $s->slug),
              'description' => $s->seo_description,
              'image' => $s->featured_image_url,
          ];
      })->values()->all(),
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-900 text-white pt-24 pb-20 overflow-hidden">
        <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(#f59e0b 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="absolute -top-36 right-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition">Home</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i>
                <span class="text-amber-400 font-semibold">Services</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/15 text-amber-400 border border-amber-500/30 mb-6 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>TURNKEY POWER & UTILITY ENGINEERING &bull; UAE WIDE</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black font-display tracking-tight leading-tight">
                    Turnkey Power & Site <span class="bg-gradient-to-r from-amber-400 via-amber-200 to-yellow-400 bg-clip-text text-transparent">Services in UAE</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-slate-300 leading-relaxed font-light">
                    From acoustic canopy 20–2500 kVA diesel generator rental and synchronized 50 MW temporary power plants to Civil Defense compliant AMC contracts, used and refurbished portacabins, and 24/7 emergency mechanical repair across all 7 Emirates.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    <a href="#services-grid" class="px-6 py-3.5 rounded-xl font-bold text-sm bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span>Explore Our Services</span>
                        <i data-lucide="arrow-down" class="w-4 h-4"></i>
                    </a>
                    <a href="tel:+971569213754" class="px-6 py-3.5 rounded-xl font-bold text-sm bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 transition flex items-center gap-2">
                        <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                        <span>24/7 Hotline: +971 56 921 3754</span>
                    </a>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="mt-16 pt-10 border-t border-slate-800 grid grid-cols-2 md:grid-cols-4 gap-6 text-slate-300">
                <div>
                    <div class="text-3xl font-black text-white font-display">20–2500 kVA</div>
                    <div class="text-xs text-slate-400 mt-1">Single Unit Fleet Range</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white font-display">99.98%</div>
                    <div class="text-xs text-slate-400 mt-1">Guaranteed Electrical Uptime</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white font-display">60–120 Min</div>
                    <div class="text-xs text-slate-400 mt-1">Emergency Dispatch SLA</div>
                </div>
                <div>
                    <div class="text-3xl font-black text-white font-display">100% Tested</div>
                    <div class="text-xs text-slate-400 mt-1">Load-Bank Certified Fleet</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section id="services-grid" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Core Power Capabilities</span>
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-2 font-display">
                Engineered for High-Ambient Desert Operations
            </h2>
            <p class="mt-4 text-slate-600 text-base">
                Every service is backed by certified electrical engineers, genuine OEM spare parts, double-walled bunded fuel systems, and round-the-clock site support across Dubai, Abu Dhabi, Sharjah, and Northern Emirates.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $svc)
                <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-amber-300 transition-all duration-300 flex flex-col justify-between p-8 group">
                    <div>
                        <!-- Featured Image Thumbnail -->
                        @if($svc->featured_image_url)
                            <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-slate-100 mb-6 border border-slate-100">
                                <img src="{{ $svc->featured_image_url }}" 
                                     alt="{{ $svc->title }} in UAE" 
                                     width="600" 
                                     height="338" 
                                     loading="lazy" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>

                        @endif

                        <!-- Icon & Tag -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 group-hover:bg-amber-500 group-hover:text-slate-950 transition-all duration-300 flex items-center justify-center shadow-inner">
                                <i data-lucide="{{ $svc->icon ?: 'zap' }}" class="w-6 h-6"></i>
                            </div>
                            @if($svc->hero_badge)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    {{ $svc->hero_badge }}
                                </span>
                            @endif
                        </div>

                        <!-- Title & Tagline -->
                        <h3 class="text-xl font-black text-slate-900 group-hover:text-amber-600 transition font-display">
                            <a href="{{ route('service.show', $svc->slug) }}">
                                {{ $svc->title }}
                            </a>
                        </h3>

                        @if($svc->tagline)
                            <p class="text-xs font-semibold text-slate-500 mt-1">{{ $svc->tagline }}</p>
                        @endif

                        <p class="text-sm text-slate-600 leading-relaxed mt-4 line-clamp-3">
                            {{ $svc->summary }}
                        </p>

                        <!-- Key Features Checklist -->
                        @if(!empty($svc->features) && is_array($svc->features))
                            <div class="mt-6 pt-6 border-t border-slate-100 space-y-2">
                                @foreach(array_slice($svc->features, 0, 3) as $feat)
                                    <div class="flex items-start gap-2 text-xs text-slate-600">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                        <span>{{ $feat }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Footer Link -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between">
                        <a href="{{ route('service.show', $svc->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-800 transition">
                            <span>View Engineering Specs</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition"></i>
                        </a>
                        <a href="{{ route('contact') }}?service={{ urlencode($svc->title) }}" class="text-xs font-semibold text-slate-400 hover:text-slate-700 transition">
                            Get Quote
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-slate-500">
                    Services data is currently being updated.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 4-Step Engineering Protocol -->
    <section class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Turnkey SLA Protocol</span>
                <h2 class="text-3xl sm:text-4xl font-black font-display tracking-tight mt-2">
                    Rapid 4-Step Mobilization Protocol
                </h2>
                <p class="mt-4 text-slate-400 text-sm">
                    How our engineering logistics division deploys temporary power and site infrastructure seamlessly across the UAE.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                    <div class="text-3xl font-black text-amber-400 font-mono mb-3">01</div>
                    <h3 class="text-base font-bold text-white mb-2 font-display">Load Profiling & SLD Audit</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Our certified engineers review site single-line diagrams, calculate inductive motor in-rush currents, and size the optimal kVA capacity with N+1 redundancy.
                    </p>
                </div>
                <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                    <div class="text-3xl font-black text-amber-400 font-mono mb-3">02</div>
                    <h3 class="text-base font-bold text-white mb-2 font-display">Rapid Fleet Mobilization</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Generators, double-walled fuel tanks, and rubberized cables depart our nearest depot (Dubai, Abu Dhabi, or Sharjah) via boom crane flatbeds in 45–90 min.
                    </p>
                </div>
                <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                    <div class="text-3xl font-black text-amber-400 font-mono mb-3">03</div>
                    <h3 class="text-base font-bold text-white mb-2 font-display">Turnkey Installation & ATS</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Certified technicians run armored copper cabling, ground earthing rods, configure Deep Sea / ComAp synchronizing controllers, and link the ATS panel.
                    </p>
                </div>
                <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                    <div class="text-3xl font-black text-amber-400 font-mono mb-3">04</div>
                    <h3 class="text-base font-bold text-white mb-2 font-display">24/7 Telemetry & Refueling</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Live IoT telemetry tracks voltage, oil pressure, and fuel levels with automated ADNOC bulk diesel replenishment and round-the-clock maintenance cover.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Dispatch CTA Banner -->
    <section class="py-16 bg-amber-500 text-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div>
                    <span class="text-xs font-black uppercase tracking-wider bg-slate-950 text-amber-400 px-3 py-1 rounded-full">
                        24/7 Rapid Emergency Response
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black font-display tracking-tight mt-3">
                        Need Emergency Generator Hire or Technical Site Power?
                    </h2>
                    <p class="text-slate-900 text-sm mt-2 max-w-2xl font-medium">
                        Speak directly with our duty electrical engineer. Fast dispatch across Dubai, Abu Dhabi, Sharjah, and Northern Emirates with guaranteed uptime.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 shrink-0">
                    <a href="tel:+971569213754" class="px-6 py-3.5 rounded-xl font-black text-sm bg-slate-950 text-white hover:bg-slate-900 shadow-xl transition flex items-center gap-2">
                        <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                        <span>Call +971 56 921 3754</span>
                    </a>
                    <a href="https://wa.me/971569213754?text=Hello+Generator+Dubai,+I+need+urgent+power+rental+pricing" target="_blank" class="px-6 py-3.5 rounded-xl font-black text-sm bg-emerald-600 hover:bg-emerald-500 text-white shadow-xl transition flex items-center gap-2">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        <span>WhatsApp Engineering</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

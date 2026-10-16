@extends('layouts.app')

@section('seo_meta')
    <title>{{ $service->seo_title }}</title>
    <meta name="description" content="{{ $service->seo_description }}">
    @if($service->meta_keywords)
        <meta name="keywords" content="{{ $service->meta_keywords }}">
    @endif
    <link rel="canonical" href="{{ $service->canonical_url ?: route('service.show', $service->slug) }}">
    <meta name="robots" content="{{ $service->is_indexable ? 'index, follow' : 'noindex, nofollow' }}">
    <meta property="og:title" content="{{ $service->og_title ?: $service->seo_title }}">

    <meta property="og:description" content="{{ $service->og_description ?: $service->seo_description }}">
    <meta property="og:type" content="service">
    <meta property="og:url" content="{{ route('service.show', $service->slug) }}">
    @if($service->seo_image)
        <meta property="og:image" content="{{ $service->seo_image }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">

    <!-- Schema.org Service JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'Service',
      'name' => $service->title,
      'serviceType' => $service->focus_keyword ?: $service->title,
      'description' => $service->seo_description,
      'image' => $service->seo_image ?: ($service->featured_image_url ?: 'https://generatordubai.com/storage/media/2026/10/05-6dnzah.jpg'),
      'provider' => [
        '@type' => 'LocalBusiness',
        'name' => 'Generator Dubai',
        'url' => 'https://generatordubai.com',
        'telephone' => '+971569213754',
        'priceRange' => '$$',
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => 'Suit 44, King Faisal Street',
          'addressLocality' => 'Sharjah',
          'addressRegion' => 'Sharjah',
          'addressCountry' => 'AE',
        ],
      ],
      'areaServed' => [
        ['@type' => 'City', 'name' => 'Dubai'],
        ['@type' => 'City', 'name' => 'Abu Dhabi'],
        ['@type' => 'City', 'name' => 'Sharjah'],
        ['@type' => 'City', 'name' => 'Ajman'],
        ['@type' => 'City', 'name' => 'Ras Al Khaimah'],
        ['@type' => 'City', 'name' => 'Fujairah'],
        ['@type' => 'City', 'name' => 'Umm Al Quwain'],
      ],
      'offers' => [
        '@type' => 'Offer',
        'availability' => 'https://schema.org/InStock',
        'price' => 'Contact for itemized quote',
        'priceCurrency' => 'AED',
        'url' => route('service.show', $service->slug),
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- BreadcrumbList Schema -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        [
          '@type' => 'ListItem',
          'position' => 1,
          'name' => 'Home',
          'item' => route('home'),
        ],
        [
          '@type' => 'ListItem',
          'position' => 2,
          'name' => 'Services',
          'item' => route('service.index'),
        ],
        [
          '@type' => 'ListItem',
          'position' => 3,
          'name' => $service->title,
          'item' => route('service.show', $service->slug),
        ],
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @if(!empty($service->faqs) && count($service->faqs) > 0)
    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'FAQPage',
      'mainEntity' => array_map(function($faq) {
          return [
              '@type' => 'Question',
              'name' => $faq['question'],
              'acceptedAnswer' => [
                  '@type' => 'Answer',
                  'text' => $faq['answer'],
              ],
          ];
      }, $service->faqs),
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    @endif

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$service->schema_markup" />
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-900 text-white pt-24 pb-20 overflow-hidden">
        <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(#f59e0b 1px, transparent 1px); background-size: 28px 28px;"></div>
        <div class="absolute -top-32 right-10 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-amber-400 transition">Home</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i>
                <a href="{{ route('service.index') }}" class="hover:text-amber-400 transition">Services</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i>
                <span class="text-amber-400 font-semibold">{{ $service->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-8">
                    @if($service->hero_badge)
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/15 text-amber-400 border border-amber-500/30 mb-6 backdrop-blur-sm">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>{{ $service->hero_badge }}</span>
                        </div>
                    @endif

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black font-display tracking-tight leading-tight">
                        {{ $service->title }}
                    </h1>

                    @if($service->tagline)
                        <p class="mt-4 text-base sm:text-lg text-amber-300/90 font-medium font-sans">
                            {{ $service->tagline }}
                        </p>
                    @endif

                    <p class="mt-6 text-sm sm:text-base text-slate-300 leading-relaxed font-light">
                        {{ $service->summary }}
                    </p>

                    <!-- 4 Value Proposition Cards (Inspired by Reference) -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-8">
                        <div class="p-3.5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-sm">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center mb-2">
                                <i data-lucide="zap" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs font-bold text-white">One Supplier</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">Power, Cables & Fuel</div>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-sm">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center mb-2">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs font-bold text-white">Itemized Quotes</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">Zero Hidden Surcharges</div>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-sm">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center mb-2">
                                <i data-lucide="wrench" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs font-bold text-white">24/7 Mechanics</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">On-Site Rapid Support</div>
                        </div>
                        <div class="p-3.5 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-sm">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center mb-2">
                                <i data-lucide="truck" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs font-bold text-white">Rapid Dispatch</div>
                            <div class="text-[11px] text-slate-400 mt-0.5">60–120 Min UAE SLA</div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="#quote-box" class="px-6 py-3.5 rounded-xl font-bold text-xs sm:text-sm bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                            <span>Request Power Sizing Quote</span>
                            <i data-lucide="arrow-down" class="w-4 h-4"></i>
                        </a>
                        <a href="tel:+971569213754" class="px-6 py-3.5 rounded-xl font-bold text-xs sm:text-sm bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 transition flex items-center gap-2">
                            <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                            <span>24/7 Hotline: +971 56 921 3754</span>
                        </a>
                        <a href="https://wa.me/971569213754?text={{ urlencode('Hello Generator Dubai, I need urgent pricing & availability for ' . $service->title) }}" target="_blank" class="px-5 py-3.5 rounded-xl font-bold text-xs sm:text-sm bg-emerald-600 hover:bg-emerald-500 text-white shadow-lg shadow-emerald-600/20 transition flex items-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>WhatsApp</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-4">
                    @if($service->featured_image_url)
                        <div class="rounded-3xl overflow-hidden border border-slate-800 shadow-2xl bg-slate-800 aspect-[4/3] relative group">
                            <img src="{{ $service->featured_image_url }}" 
                                 alt="{{ $service->title }} in UAE" 
                                 width="800"
                                 height="600"
                                 loading="eager"
                                 fetchpriority="high"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-3 left-3 right-3 p-3 rounded-2xl bg-slate-950/80 backdrop-blur-md border border-white/10 text-xs text-white flex items-center justify-between">

                                <span class="font-bold">Verified UAE Fleet</span>
                                <span class="text-amber-400 font-semibold">ISO 8528 Certified</span>
                            </div>
                        </div>
                    @else
                        <div class="p-8 rounded-3xl bg-slate-800/80 border border-slate-700/80 space-y-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                                <i data-lucide="{{ $service->icon ?: 'zap' }}" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base font-bold text-white font-display">Technical Highlights</h4>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Backed by ISO 8528 compliant diesel generator fleets, Deep Sea synchronizing controllers, double-walled fuel tanks, and 24/7 on-call engineers across all 7 Emirates.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Engine Manufacturers Bar -->
    <section class="py-6 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-6 text-slate-400 text-xs font-semibold">
                <span class="text-slate-500 uppercase tracking-widest text-[11px]">Factory Engine Partners:</span>
                <span class="hover:text-amber-400 transition">Cummins (USA/UK)</span>
                <span class="hover:text-amber-400 transition">Perkins (UK)</span>
                <span class="hover:text-amber-400 transition">Caterpillar (CAT)</span>
                <span class="hover:text-amber-400 transition">Kohler Power Systems</span>
                <span class="hover:text-amber-400 transition">Stamford & Leroy Somer Alternators</span>
                <span class="hover:text-amber-400 transition">Deep Sea Electronics (DSE)</span>
            </div>
        </div>
    </section>

    <!-- Equipment Sizing & Generator Categories (Inspired by Reference) -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Equipment Categories</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-1 font-display">
                    Commercial & Industrial Power Solutions
                </h2>
                <p class="text-sm text-slate-600 mt-2">
                    Select your equipment class for immediate mobilization across Dubai, Abu Dhabi, Sharjah, and all Northern Emirates.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 20 - 60 kVA -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-800">20 – 60 kVA</span>
                            <span class="text-[11px] text-slate-400 font-mono">16 – 48 kW</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">Portable & Compact Power</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Acoustic canopy units tailored for site offices, small retail pop-ups, security gates, and dewatering pumps.
                        </p>
                        <div class="text-[11px] text-slate-500 pt-2 border-t border-slate-200">
                            <strong>Noise:</strong> 65–68 dBA @ 7m &bull; <strong>Fuel:</strong> 5–14 L/hr
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between">
                        <a href="{{ route('fleet.show', '50-kva') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                            <span>Explore 50 kVA Model</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-slate-400">In Stock</span>
                    </div>
                </div>

                <!-- 60 - 150 kVA -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-800">60 – 150 kVA</span>
                            <span class="text-[11px] text-slate-400 font-mono">48 – 120 kW</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">Mid-Range Silent Generators</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Ideal for tower cranes, concrete vibrators, medium civil construction, hospital standby, and hospitality events.
                        </p>
                        <div class="text-[11px] text-slate-500 pt-2 border-t border-slate-200">
                            <strong>Noise:</strong> 68–70 dBA @ 7m &bull; <strong>Fuel:</strong> 14–33 L/hr
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between">
                        <a href="{{ route('fleet.show', '100-kva') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                            <span>Explore 100 kVA Model</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-slate-400">In Stock</span>
                    </div>
                </div>

                <!-- 150 - 500 kVA -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-800">150 – 500 kVA</span>
                            <span class="text-[11px] text-slate-400 font-mono">120 – 400 kW</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">Heavy-Duty Acoustic Gensets</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Built for heavy infrastructure, batching plants, commercial towers, marine drydocks, and industrial manufacturing.
                        </p>
                        <div class="text-[11px] text-slate-500 pt-2 border-t border-slate-200">
                            <strong>Noise:</strong> 70–73 dBA @ 7m &bull; <strong>Fuel:</strong> 33–105 L/hr
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between">
                        <a href="{{ route('fleet.show', '500-kva') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                            <span>Explore 500 kVA Model</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-slate-400">In Stock</span>
                    </div>
                </div>

                <!-- 500 - 1250 kVA -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-800">500 – 1250 kVA</span>
                            <span class="text-[11px] text-slate-400 font-mono">400 – 1000 kW</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">High-Capacity Containerized</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Engineered for district cooling plants, chillers, deep well dewatering, and high-voltage grid support installations.
                        </p>
                        <div class="text-[11px] text-slate-500 pt-2 border-t border-slate-200">
                            <strong>Noise:</strong> 72–75 dBA @ 7m &bull; <strong>Fuel:</strong> 105–260 L/hr
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between">
                        <a href="{{ route('fleet.show', '1000-kva') }}" class="text-xs font-bold text-amber-700 hover:text-amber-800 flex items-center gap-1">
                            <span>Explore 1000 kVA Model</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-slate-400">In Stock</span>
                    </div>
                </div>

                <!-- Multi-MW Synchronized Power Plants -->
                <div class="p-6 rounded-3xl bg-amber-500/10 border border-amber-500/30 shadow-sm hover:shadow-md hover:border-amber-400 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-500 text-slate-950">1 MW to 50 MW</span>
                            <span class="text-[11px] text-amber-800 font-mono">Grid-Scale</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">Synchronized Power Plants</h3>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Modular multi-megawatt synchronized power plants with Deep Sea load-sharing, step-up transformers (11kV/33kV), and bulk fuel farms.
                        </p>
                        <div class="text-[11px] text-amber-900 pt-2 border-t border-amber-200/60">
                            <strong>Redundancy:</strong> N+1 Continuous &bull; <strong>Uptime:</strong> 99.99% SLA
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-amber-200/60 flex items-center justify-between">
                        <a href="{{ route('service.show', 'power-plant') }}" class="text-xs font-bold text-amber-800 hover:text-amber-950 flex items-center gap-1">
                            <span>View Power Plant Engineering</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-emerald-700 font-bold">Turnkey</span>
                    </div>
                </div>

                <!-- Used & Refurbished Portacabins (Buy/Sell, Zero Rental) -->
                <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200/90 shadow-sm hover:shadow-md hover:border-amber-300 transition flex flex-col justify-between group">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-800">Buy & Sell</span>
                            <span class="text-[11px] text-slate-400 font-mono">Site Offices</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition">Used & Scrap Portacabins</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Instant cash purchase of scrap & used portacabins across UAE. Turnkey sale of high-grade refurbished modular site offices.
                        </p>
                        <div class="text-[11px] text-slate-500 pt-2 border-t border-slate-200">
                            <strong>Cash Offers:</strong> Same-Day &bull; <strong>Logistics:</strong> Free Crane Removal
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-200 flex items-center justify-between">
                        <a href="{{ route('service.show', 'portacabin') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 flex items-center gap-1">
                            <span>View Portacabin Trading</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                        <span class="text-[10px] text-emerald-600 font-semibold">Instant Cash</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Left 8 Columns: Service Body & Detailed Sections -->
            <main class="lg:col-span-8 space-y-12">

                <!-- Service WYSIWYG Content (Rich Tables & Specs) -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight font-display mb-6">
                        Service Scope & Technical Engineering Specifications
                    </h2>
                    <div class="prose prose-slate prose-amber max-w-none text-slate-600 leading-relaxed">
                        {!! $service->content !!}
                    </div>
                </div>

                <!-- Features & Technical Specifications -->
                @if(!empty($service->features) && is_array($service->features))
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm space-y-6">
                        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Engineered Standards</span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 font-display">
                            Technical Features & Equipment Specifications
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                            @foreach($service->features as $feature)
                                <div class="flex items-start gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                    <div class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-xs font-medium text-slate-800 leading-relaxed">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Turnkey Benefits -->
                @if(!empty($service->benefits) && is_array($service->benefits))
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm space-y-6">
                        <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-emerald-600">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            <span>Commercial Advantages</span>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 font-display">
                            Why UAE Contractors Trust Our Fleet
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                            @foreach($service->benefits as $benefit)
                                <div class="flex items-start gap-3 p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                                    </div>
                                    <span class="text-xs font-medium text-slate-800 leading-relaxed">{{ $benefit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 4-Step Rental Process Guide -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm space-y-8">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-600">
                        <i data-lucide="arrow-right-circle" class="w-4 h-4"></i>
                        <span>How It Works</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 font-display">
                        Our 4-Step Turnkey Rental Process
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 font-black flex items-center justify-center text-sm">1</div>
                            <h4 class="font-bold text-slate-900 text-sm">Load Sizing & Feasibility Audit</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Our electrical engineers calculate your starting and running inrush currents to recommend the exact kVA rating without over-sizing.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 font-black flex items-center justify-center text-sm">2</div>
                            <h4 class="font-bold text-slate-900 text-sm">Rapid Dispatch & Logistics</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Our fleet of crane hiab trucks transports the generator, external fuel tanks, and cabling to any site in Dubai, Abu Dhabi, or Sharjah within 60–120 minutes.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 font-black flex items-center justify-center text-sm">3</div>
                            <h4 class="font-bold text-slate-900 text-sm">Cabling & Commissioning</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Certified technicians terminate flexible copper power cables, test earth rod grounding (<5 ohms), connect ATS panels, and verify voltage balance.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                            <div class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 font-black flex items-center justify-center text-sm">4</div>
                            <h4 class="font-bold text-slate-900 text-sm">24/7 Monitoring & Fuel Delivery</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                We handle continuous 250-hour oil/filter servicing, fuel telemetry refills, and provide 24/7 on-site mechanical emergency support.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Locations We Cover (Deep Internal Links Across UAE) -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 text-white rounded-3xl p-8 sm:p-10 border border-slate-800 shadow-xl space-y-6">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-400">
                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                        <span>UAE-Wide Fleet Coverage</span>
                    </div>
                    <h3 class="text-2xl font-black font-display tracking-tight">
                        Depot Hubs & 2-Hour Dispatch Across All 7 Emirates
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        With operational yards located in Al Quoz, JAFZA, Musaffah, and Sharjah Industrial, we guarantee rapid equipment dispatch and emergency technician response to all UAE zones:
                    </p>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <a href="{{ route('locations.show', 'dubai') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Dubai</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Al Quoz, JAFZA, DXP</div>
                        </a>
                        <a href="{{ route('locations.show', 'abu-dhabi') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Abu Dhabi</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Musaffah, ICAD, Ruwais</div>
                        </a>
                        <a href="{{ route('locations.show', 'sharjah') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Sharjah</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Ind Areas 1-18, Sajaa</div>
                        </a>
                        <a href="{{ route('locations.show', 'ajman') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Ajman</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Al Jurf, Port Zone</div>
                        </a>
                        <a href="{{ route('locations.show', 'ras-al-khaimah') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Ras Al Khaimah</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Al Hamra, Saqr Port</div>
                        </a>
                        <a href="{{ route('locations.show', 'fujairah') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Fujairah</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Oil Terminals, Port</div>
                        </a>
                        <a href="{{ route('locations.show', 'umm-al-quwain') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Umm Al Quwain</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Old Town, Ind Area</div>
                        </a>
                        <a href="{{ route('locations.show', 'oman') }}" class="p-3.5 rounded-2xl bg-slate-800/80 hover:bg-amber-500 hover:text-slate-950 transition border border-slate-700/80 group">
                            <div class="font-bold text-xs">Oman</div>
                            <div class="text-[10px] text-slate-400 group-hover:text-slate-900">Muscat & Sohar Border</div>
                        </a>
                    </div>
                </div>

                <!-- Related Fleet Models (Deep Internal Links) -->
                @if(isset($fleetProducts) && $fleetProducts->isNotEmpty())
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Equipment Fleet</span>
                                <h3 class="text-2xl font-black text-slate-900 font-display mt-1">Available Fleet Models for Immediate Mobilization</h3>
                            </div>
                            <a href="{{ route('fleet.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 hidden sm:block">View Full Fleet &rarr;</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 pt-2">
                            @foreach($fleetProducts as $prod)
                                <a href="{{ route('fleet.show', $prod->slug) }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-amber-400 hover:shadow-md transition group flex flex-col justify-between">
                                    <div>
                                        @if($prod->featured_image_url)
                                            <div class="aspect-video rounded-xl overflow-hidden bg-slate-200 mb-3">
                                                <img src="{{ $prod->featured_image_url }}" 
                                                     alt="{{ $prod->title }}" 
                                                     width="400" 
                                                     height="225" 
                                                     loading="lazy" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                        @endif
                                        <div class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition">{{ $prod->title }}</div>
                                        <p class="text-[11px] text-slate-500 line-clamp-2 mt-1">{{ $prod->summary }}</p>
                                    </div>
                                    <div class="mt-4 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-amber-700 font-semibold">
                                        <span>View Specifications</span>
                                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Related Technical Articles (Deep Internal Links) -->
                @if(isset($relatedPosts) && $relatedPosts->isNotEmpty())
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/90 shadow-sm space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Engineering Guides</span>
                                <h3 class="text-2xl font-black text-slate-900 font-display mt-1">Related Technical Articles & Sizing Insights</h3>
                            </div>
                            <a href="{{ route('blog.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 hidden sm:block">All Articles &rarr;</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            @foreach($relatedPosts as $post)
                                <a href="{{ route('post.show', $post->slug) }}" class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-amber-400 hover:shadow-md transition group flex gap-3">
                                    @if($post->featured_image_url)
                                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-200 shrink-0">
                                            <img src="{{ $post->featured_image_url }}" 
                                                 alt="{{ $post->title }}" 
                                                 width="80" 
                                                 height="80" 
                                                 loading="lazy" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        </div>
                                    @endif

                                    <div class="flex flex-col justify-between">
                                        <div>
                                            <div class="text-xs font-bold text-slate-900 group-hover:text-amber-600 transition line-clamp-2">{{ $post->title }}</div>
                                            <div class="text-[10px] text-slate-400 mt-1">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Technical Guide' }}</div>
                                        </div>
                                        <span class="text-[11px] text-amber-700 font-semibold flex items-center gap-1 mt-1">Read Guide &rarr;</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </main>

            <!-- Right 4 Columns: Quote Request & Navigator Sidebar -->
            <aside class="lg:col-span-4">
                <div class="sticky top-28 space-y-6">
                    @include('frontend.partials.service-sidebar', [
                        'service' => $service,
                        'otherServices' => $otherServices
                    ])
                </div>
            </aside>

        </div>
    </div>

</div>
@endsection

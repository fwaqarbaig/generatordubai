<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 text-slate-900 antialiased scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(config('services.google.search_console_verification'))
        <meta name="google-site-verification" content="{{ config('services.google.search_console_verification') }}">
    @endif

    @if(config('services.google.tag_id'))
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.tag_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.google.tag_id') }}');
        </script>
    @endif

    @hasSection('seo_meta')
        @yield('seo_meta')
    @else
        <title>{{ config('app.name', 'Generator Dubai') }} | Generator Rental in UAE | Diesel Generator Hire</title>
        <meta name="description" content="Generator rental in UAE from 50 to 2500 kVA. Rent silent diesel generators across Dubai, Abu Dhabi, Sharjah and Northern Emirates with 24/7 technical support and rapid emergency dispatch.">
        <meta name="keywords" content="generator rental in UAE, generator rental Dubai, diesel generator rental UAE, diesel generator hire UAE, generator rental Abu Dhabi, generator rental Sharjah, silent generator rental, industrial generator rental, temporary power solutions UAE">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:title" content="Generator Rental in Dubai & UAE | Turnkey Diesel Power Hire">
        <meta property="og:description" content="50 kVA to 2500 kVA soundproof diesel generator rental, multi-megawatt synchronized power plants, and 24/7 emergency dispatch across all 7 Emirates.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">
    @endif

    <!-- Global LocalBusiness & Organization Schema.org JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@type' => 'HomeAndConstructionBusiness',
      'name' => 'Generator Dubai',
      'legalName' => 'Generator Dubai Temporary Power Solutions LLC',
      'alternateName' => ['Generator Rental Dubai', 'Rental Generator UAE'],
      'url' => 'https://generatordubai.com',
      'logo' => 'https://generatordubai.com/images/logo-original.png',
      'image' => 'https://generatordubai.com/storage/media/2026/09/1-y7ja6x.webp',
      'telephone' => '+971569213754',
      'email' => 'hello@generatordubai.com',
      'priceRange' => '$$$',
      'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Suit 44, King Faisal Street',
        'addressLocality' => 'Sharjah',
        'addressRegion' => 'Sharjah',
        'postalCode' => '00000',
        'addressCountry' => 'AE',
      ],
      'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => 25.3463,
        'longitude' => 55.4209,
      ],
      'openingHoursSpecification' => [
        [
          '@type' => 'OpeningHoursSpecification',
          'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          'opens' => '00:00',
          'closes' => '23:59',
        ],
      ],
      'areaServed' => [
        'Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain', 'Oman'
      ],
      'sameAs' => [
        'https://wa.me/971569213754',
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Red+Hat+Display:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Vite Pipeline (Compiled Tailwind CSS v4 & Bundled Lucide Icons) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .prose pre { background-color: #090d16; color: #f8fafc; border-radius: 0.75rem; padding: 1.25rem; overflow-x: auto; }
        .prose img { border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); margin: 2rem auto; }
    </style>
    @stack('styles')
</head>
<body class="min-h-full flex flex-col font-sans selection:bg-brand-500 selection:text-slate-950 bg-slate-50" x-data="{ mobileMenuOpen: false }">

    <!-- Top Hello Bar / Announcement -->
    <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 text-white text-xs py-2 px-4 border-b border-amber-500/20 relative z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 overflow-hidden truncate">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-500/20 text-amber-300 border border-amber-400/30 shrink-0">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse mr-1.5"></span> 24/7 UAE DISPATCH
                </span>
                <span class="text-slate-300 truncate">
                    Turnkey Diesel Generator Rental • 50 kVA to 2500 kVA • <strong>Emergency Response &lt;60 Mins</strong> Across 7 Emirates
                </span>
            </div>
            <div class="hidden sm:flex items-center gap-4 shrink-0 text-slate-300 font-medium">
                <a href="tel:+971569213754" class="flex items-center gap-1.5 hover:text-white transition font-bold text-amber-400">
                    <i data-lucide="phone-call" class="w-3.5 h-3.5"></i>
                    <span>+971 56 921 3754</span>
                </a>
                <span class="text-slate-700">|</span>
                <a href="https://wa.me/971569213754" target="_blank" class="text-emerald-400 hover:text-emerald-300 font-semibold transition flex items-center gap-1">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    <span>WhatsApp</span>
                </a>
                <span class="text-slate-700">|</span>
                <a href="{{ route('contact') }}" class="text-amber-300 hover:text-white font-semibold transition flex items-center gap-1">
                    <span>Rapid Quote</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-all shadow-xs" x-data="{ servicesOpen: false, locationsOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Brand Logo (Generator Dubai) -->
                <div class="flex items-center gap-6 xl:gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 py-1 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 via-amber-400 to-yellow-300 flex items-center justify-center text-slate-950 font-black shadow-lg shadow-amber-500/25 group-hover:scale-105 transition-transform">
                            <i data-lucide="zap" class="w-6 h-6 fill-current"></i>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5">
                                <span class="text-xl sm:text-2xl font-black font-display tracking-tight text-slate-950 leading-none">GENERATOR</span>
                                <span class="text-xl sm:text-2xl font-black font-display tracking-tight text-amber-500 leading-none">DUBAI</span>
                            </div>
                            <span class="text-[9px] uppercase tracking-widest text-slate-500 font-bold mt-0.5">Temporary Power & Fleet Rental</span>
                        </div>
                    </a>

                    <!-- Desktop Nav Links -->
                    <nav class="hidden lg:flex items-center gap-5 xl:gap-6 text-sm font-semibold text-slate-700">
                        @if(isset($headerMenuItems) && $headerMenuItems->isNotEmpty())
                            @foreach($headerMenuItems as $item)
                                @if($item->activeChildren->isNotEmpty())
                                    <!-- Dropdown Menu Item -->
                                    <div class="relative" 
                                         x-data="{ open: false }" 
                                         @mouseenter="open = true" 
                                         @mouseleave="open = false">
                                        <button type="button" @click="open = !open" 
                                                class="inline-flex items-center gap-1 transition hover:text-amber-600 py-2 {{ $item->isActive() ? 'text-amber-600 font-bold' : '' }}">
                                            <span>{{ $item->title }}</span>
                                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                                        </button>

                                        <!-- Dropdown Panel -->
                                        <div x-show="open" x-cloak 
                                             x-transition:enter="transition ease-out duration-150"
                                             x-transition:enter-start="opacity-0 translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 translate-y-2"
                                             class="absolute -left-6 top-full w-72 sm:w-80 bg-white rounded-2xl border border-slate-200 shadow-2xl p-3 space-y-1 z-50">
                                            @foreach($item->activeChildren as $child)
                                                <a href="{{ $child->getUrl() }}" class="flex items-center gap-2.5 p-2 rounded-xl hover:bg-amber-50/70 transition group">
                                                    <div class="w-7 h-7 rounded-lg bg-slate-100 group-hover:bg-amber-500 group-hover:text-slate-950 text-slate-600 flex items-center justify-center shrink-0 transition-colors">
                                                        <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                                                    </div>
                                                    <span class="text-xs font-semibold text-slate-800 group-hover:text-amber-700 transition truncate">{{ $child->title }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <!-- Standard Menu Link -->
                                    <a href="{{ $item->getUrl() }}" target="{{ $item->target }}" 
                                       class="transition hover:text-amber-600 py-2 {{ $item->isActive() ? 'text-amber-600 font-bold' : '' }}">
                                        {{ $item->title }}
                                        @if($item->badge)
                                            <span class="ml-1 text-[9px] font-extrabold px-1.5 py-0.5 rounded-full bg-amber-100 text-amber-800">{{ $item->badge }}</span>
                                        @endif
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <!-- Fallback Links -->
                            <a href="{{ route('home') }}" class="transition hover:text-amber-600 py-2 font-bold">Home</a>
                            <a href="{{ route('about') }}" class="transition hover:text-amber-600 py-2">About Us</a>
                            <a href="{{ route('fleet.index') }}" class="transition hover:text-amber-600 py-2">Fleet</a>
                            <a href="{{ route('service.index') }}" class="transition hover:text-amber-600 py-2">Services</a>
                            <a href="{{ route('industries') }}" class="transition hover:text-amber-600 py-2">Industries</a>
                            <a href="{{ route('used-generators') }}" class="transition hover:text-amber-600 py-2">Used & Refurbished</a>
                            <a href="{{ route('locations.index') }}" class="transition hover:text-amber-600 py-2">Locations</a>
                            <a href="{{ route('contact') }}" class="transition hover:text-amber-600 py-2">Contact Us</a>
                        @endif
                    </nav>
                </div>

                <!-- Right Side: Emergency Hotline & Quote CTA -->
                <div class="hidden lg:flex items-center gap-3 xl:gap-4 shrink-0">
                    <!-- WhatsApp / Call Hotline -->
                    <a href="tel:+971569213754" class="flex items-center gap-2 text-xs font-bold text-slate-800 hover:text-amber-600 px-3 py-2 rounded-xl hover:bg-slate-100 transition">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/10 text-emerald-600 flex items-center justify-center">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                        </div>
                        <div class="text-left">
                            <span class="block text-[10px] text-slate-400 uppercase font-semibold leading-none">24/7 Hotline</span>
                            <span class="font-extrabold text-sm text-slate-900 leading-tight">+971 56 921 3754</span>
                        </div>
                    </a>

                    @auth
                        <div class="flex items-center gap-3 pl-2 border-l border-slate-200">
                            @if(auth()->user()->canManageContent())
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold rounded-xl bg-slate-950 text-amber-400 hover:bg-slate-900 transition shadow-sm border border-amber-500/30">
                                    <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                                    Admin CMS
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 text-slate-500 hover:text-rose-600 transition rounded-lg hover:bg-slate-100" title="Logout">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Action CTA Button -->
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 text-xs font-extrabold shadow-md shadow-amber-500/30 hover:shadow-lg transition-all transform hover:-translate-y-0.5 whitespace-nowrap">
                            <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
                            <span>Request Rapid Quote</span>
                        </a>
                    @endif
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center gap-2">
                    <a href="tel:+971569213754" class="p-2 text-amber-600 rounded-lg hover:bg-amber-50">
                        <i data-lucide="phone-call" class="w-5 h-5"></i>
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-slate-700 hover:text-slate-900 rounded-lg hover:bg-slate-100">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Navigation Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <div class="flex flex-col space-y-2 text-sm font-semibold text-slate-700">
                @if(isset($headerMenuItems) && $headerMenuItems->isNotEmpty())
                    @foreach($headerMenuItems as $item)
                        @if($item->activeChildren->isNotEmpty())
                            <div x-data="{ open: false }" class="py-1">
                                <button @click="open = !open" class="flex items-center justify-between w-full py-1 text-slate-900 font-bold">
                                    <span>{{ $item->title }}</span>
                                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                <div x-show="open" class="pl-4 pt-2 pb-1 space-y-1.5 border-l-2 border-amber-300 ml-1">
                                    @foreach($item->activeChildren as $child)
                                        <a href="{{ $child->getUrl() }}" class="block py-1 text-xs text-slate-600 hover:text-amber-600">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $item->getUrl() }}" class="py-1 hover:text-amber-600 {{ $item->isActive() ? 'text-amber-600 font-bold' : '' }}">
                                {{ $item->title }}
                            </a>
                        @endif
                    @endforeach
                @else
                    <a href="{{ route('home') }}" class="py-1 hover:text-amber-600">Home</a>
                    <a href="{{ route('about') }}" class="py-1 hover:text-amber-600">About Us</a>
                    <a href="{{ route('fleet.index') }}" class="py-1 hover:text-amber-600">Fleet</a>
                    <a href="{{ route('service.index') }}" class="py-1 hover:text-amber-600">Services</a>
                    <a href="{{ route('industries') }}" class="py-1 hover:text-amber-600">Industries</a>
                    <a href="{{ route('used-generators') }}" class="py-1 hover:text-amber-600">Used & Refurbished</a>
                    <a href="{{ route('locations.index') }}" class="py-1 hover:text-amber-600">Locations</a>
                    <a href="{{ route('contact') }}" class="py-1 hover:text-amber-600">Contact Us</a>
                @endif
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-2">
                <a href="{{ route('contact') }}" class="block w-full py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 text-center font-extrabold text-xs shadow-md">
                    Request Rapid Quote
                </a>
                <a href="tel:+971569213754" class="block w-full py-3 rounded-xl bg-slate-900 text-white text-center font-bold text-xs">
                    Call 24/7 Hotline: +971 56 921 3754
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Global Footer -->
    <footer class="bg-slate-950 text-white border-t border-slate-800 mt-20">
        <!-- Pre-footer CTA Strip -->
        <div class="border-b border-slate-800 bg-gradient-to-r from-slate-950 via-slate-900 to-slate-950 py-12 px-4">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/20 text-amber-400 text-xs font-bold mb-3 border border-amber-500/30">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>24/7 Emergency Mobilization</span>
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-extrabold font-display text-white">Need Immediate Site Power in the UAE?</h3>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                        Rapid delivery across Dubai, Abu Dhabi, Sharjah, and Northern Emirates with certified technicians and turnkey cabling.
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('contact') }}" class="px-7 py-3.5 rounded-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 text-xs font-extrabold shadow-lg shadow-amber-500/25 transition">
                        Request Rapid Quote
                    </a>
                    <a href="tel:+971569213754" class="px-7 py-3.5 rounded-full bg-slate-900 hover:bg-slate-800 border border-slate-700 text-white text-xs font-bold transition flex items-center gap-2">
                        <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                        <span>+971 56 921 3754</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
                
                <!-- Col 1: Brand & Heritage -->
                <div class="space-y-4 lg:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center text-slate-950 font-black">
                            <i data-lucide="zap" class="w-5 h-5 fill-current"></i>
                        </div>
                        <span class="text-xl font-black font-display tracking-tight text-white">GENERATOR <span class="text-amber-400">DUBAI</span></span>
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        Generator Dubai is the United Arab Emirates' premier provider of heavy-duty temporary power solutions, sound-attenuated diesel generators from 50 kVA to 2500 kVA, synchronized multi-megawatt power plants, and turnkey balance-of-plant electrical distribution.
                    </p>
                    <div class="space-y-2 text-xs text-slate-300 pt-2">
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                            <span class="font-bold text-white">+971 56 921 3754</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-amber-400"></i>
                            <a href="mailto:hello@generatordubai.com" class="text-slate-300 hover:underline">hello@generatordubai.com</a>
                        </div>
                        <div class="flex items-start gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                            <span class="text-slate-300">Suit 44, King Faisal Street, Sharjah, U.A.E.</span>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Power Services</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        @foreach(\App\Models\Service::published()->ordered()->take(6)->get() as $s)
                            <li>
                                <a href="{{ route('service.show', $s->slug) }}" class="hover:text-white transition flex items-center gap-1.5">
                                    <span class="text-amber-400">&rsaquo;</span>
                                    <span>{{ $s->title }}</span>
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('service.index') }}" class="text-amber-400 font-semibold hover:underline block pt-1">
                                View All Services &rarr;
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Generator Fleet (Products) -->
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Fleet Capacities</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        @foreach(\App\Models\Product::published()->ordered()->take(6)->get() as $prod)
                            <li>
                                <a href="{{ route('fleet.show', $prod->slug) }}" class="hover:text-white transition flex items-center gap-1.5">
                                    <span class="text-amber-400">&rsaquo;</span>
                                    <span>{{ $prod->badge ?? $prod->title }}</span>
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ route('fleet.index') }}" class="text-amber-400 font-semibold hover:underline block pt-1">
                                All 50-2500 kVA Models &rarr;
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Regional Depots -->
                <div>
                    <h4 class="text-xs font-bold text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Regional Coverage</h4>
                    <ul class="space-y-2 text-xs text-slate-400">
                        <li><a href="{{ route('locations.show', 'dubai') }}" class="hover:text-amber-400 transition">&bull; Dubai & JAFZA Hub</a></li>
                        <li><a href="{{ route('locations.show', 'abu-dhabi') }}" class="hover:text-amber-400 transition">&bull; Abu Dhabi & Mussafah</a></li>
                        <li><a href="{{ route('locations.show', 'sharjah') }}" class="hover:text-amber-400 transition">&bull; Sharjah & Hamriyah</a></li>
                        <li><a href="{{ route('locations.show', 'ajman') }}" class="hover:text-amber-400 transition">&bull; Ajman Industrial Zone</a></li>
                        <li><a href="{{ route('locations.show', 'ras-al-khaimah') }}" class="hover:text-amber-400 transition">&bull; Ras Al Khaimah</a></li>
                        <li><a href="{{ route('locations.show', 'fujairah') }}" class="hover:text-amber-400 transition">&bull; Fujairah Port</a></li>
                        <li><a href="{{ route('locations.show', 'umm-al-quwain') }}" class="hover:text-amber-400 transition">&bull; Umm Al Quwain</a></li>
                        <li><a href="{{ route('locations.show', 'oman') }}" class="hover:text-amber-400 transition">&bull; Oman Cross-Border</a></li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Legal & Compliance -->
            <div class="pt-10 mt-12 border-t border-slate-900 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div class="flex items-center gap-4 flex-wrap">
                    <p>&copy; {{ date('Y') }} Generator Dubai. All rights reserved.</p>
                    <span class="text-slate-700 hidden sm:inline">&bull;</span>
                    <span class="text-slate-400">ISO 8528 Rated Prime & Standby Diesel Power Solutions</span>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('about') }}" class="hover:text-slate-300">About Us</a>
                    <a href="{{ route('fleet.index') }}" class="hover:text-slate-300">Fleet</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-300">Contact Us</a>
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-400">Admin Login</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp CTA -->
    <a href="https://wa.me/971569213754?text=Hello%20Generator%20Dubai%2C%20I%20would%20like%20to%20inquire%20about%20generator%20rental." 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 flex items-center gap-2 px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full shadow-2xl hover:scale-105 transition-all group font-bold text-xs"
       aria-label="Chat on WhatsApp">
        <i data-lucide="message-circle" class="w-5 h-5 fill-current"></i>
        <span class="hidden sm:inline">WhatsApp 24/7</span>
    </a>

    <script>
        if (typeof lucide !== 'undefined' && typeof lucide.createIcons === 'function') {
            lucide.createIcons();
        } else if (window.lucide && typeof window.lucide.createIcons === 'function') {
            window.lucide.createIcons();
        }
    </script>
    @stack('scripts')
</body>
</html>

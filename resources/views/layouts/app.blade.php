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
        <title>{{ config('app.name', 'Rental Power UAE') }} | Rental Power and Rental Cooling in UAE</title>
        <meta name="description" content="Rental Power and Rental Cooling solutions across UAE. High-quality Perkins & Cummins diesel generators, chillers, AC units and portacabins with 24/7 support.">
        <meta name="keywords" content="rental power uae, rental cooling uae, generator rental dubai, chiller rental uae, portable ac rental, temporary power solutions uae">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta property="og:title" content="Rental Power UAE | Turnkey Power & Rental Cooling Solutions">
        <meta property="og:description" content="High-quality Perkins and Cummins generators for rental power solutions, chillers & AC units for efficient cooling across UAE.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta name="twitter:card" content="summary_large_image">
    @endif

    <!-- Global LocalBusiness & Organization Schema.org JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@@type' => 'Organization',
      '@id' => url('/#organization'),
      'name' => config('app.name', 'Rental Power UAE'),
      'alternateName' => ['Rental Power UAE', 'Rental Cooling UAE', 'Rental Power'],
      'url' => url('/'),
      'logo' => [
        '@@type' => 'ImageObject',
        'url' => asset('images/rentalpower-logo.png'),
      ],
      'image' => [
        url('storage/media/rental-generator.webp'),
        url('images/rentalpower-logo.png'),
        url('storage/media/generator-rental-uae.webp'),
      ],
      'telephone' => '+971569213754',
      'email' => 'sales@rentalpower.ae',
      'contactPoint' => [
        '@@type' => 'ContactPoint',
        'telephone' => '+971569213754',
        'contactType' => 'customer service',
        'areaServed' => 'AE',
        'availableLanguage' => ['English'],
      ],
      'areaServed' => [
        'Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'
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
                    Turnkey Rental Power & Rental Cooling • Generators 50 kVA to 2500 kVA, Chillers & AC Units • <strong>Emergency Response &lt;60 Mins</strong> Across UAE
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
                
                <!-- Brand Logo (Rental Power UAE) -->
                <div class="flex items-center gap-6 xl:gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 py-1 group">
                        <img src="{{ asset('images/rentalpower-logo.png') }}" 
                             alt="{{ config('app.name', 'Rental Power UAE') }}" 
                             class="h-8 sm:h-9 w-auto object-contain">
                    </a>

                    <!-- Desktop Nav Links -->
                    <!-- Desktop Nav Links -->
                    @php
                        $hasHeaderContactLink = isset($headerMenuItems) && $headerMenuItems->contains(function ($menuItem) {
                            $menuPath = trim(parse_url((string) $menuItem->url, PHP_URL_PATH) ?: '', '/');

                            return $menuItem->route_name === 'contact'
                                || in_array(strtolower(trim($menuItem->title)), ['contact', 'contact us'], true)
                                || $menuPath === 'contact-us';
                        });
                    @endphp
                    <nav class="hidden lg:flex items-center gap-4 xl:gap-6 text-sm font-semibold text-slate-800">
                        @if(isset($headerMenuItems) && $headerMenuItems->isNotEmpty())
                            @foreach($headerMenuItems as $item)
                                @php
                                    $itemPath = trim(parse_url((string) $item->url, PHP_URL_PATH) ?: '', '/');
                                    $isContactMenuItem = $item->route_name === 'contact'
                                        || in_array(strtolower(trim($item->title)), ['contact', 'contact us'], true)
                                        || $itemPath === 'contact-us';
                                @endphp
                                @if($item->activeChildren->isNotEmpty())
                                    <!-- Dropdown Menu Item (Level 1) -->
                                    <div class="relative" 
                                         x-data="{ open: false }" 
                                         @mouseenter="open = true" 
                                         @mouseleave="open = false">
                                        <a href="{{ $item->getUrl() }}" 
                                           class="inline-flex items-center gap-1 transition py-2 text-sm font-semibold {{ $item->isActive() ? 'text-[#f25c05] font-bold' : 'text-slate-800 hover:text-[#f25c05]' }}">
                                            <span>{{ $item->title }}</span>
                                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform duration-200" :class="open ? 'rotate-180 text-[#f25c05]' : 'text-slate-400'"></i>
                                        </a>

                                        <!-- Level 2 Dropdown Panel -->
                                        <div x-show="open" x-cloak 
                                             x-transition:enter="transition ease-out duration-150"
                                             x-transition:enter-start="opacity-0 translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             x-transition:leave="transition ease-in duration-100"
                                             x-transition:leave-start="opacity-100 translate-y-0"
                                             x-transition:leave-end="opacity-0 translate-y-2"
                                             class="absolute left-0 top-full w-56 bg-white border border-slate-200/90 shadow-2xl py-1.5 z-50">
                                            @foreach($item->activeChildren as $child)
                                                @if($child->activeChildren->isNotEmpty())
                                                    <!-- Submenu Item with Flyout (Level 2) -->
                                                    <div class="relative" 
                                                         x-data="{ subOpen: false }" 
                                                         @mouseenter="subOpen = true" 
                                                         @mouseleave="subOpen = false">
                                                        <a href="{{ $child->getUrl() }}" 
                                                           class="flex items-center justify-between px-4 py-2.5 text-xs font-semibold transition hover:bg-slate-50"
                                                           :class="subOpen ? 'text-[#f25c05] font-bold bg-orange-50/50' : 'text-slate-800'">
                                                            <span :class="subOpen ? 'text-[#f25c05]' : ''">{{ $child->title }}</span>
                                                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 ml-2 transition-colors shrink-0" :class="subOpen ? 'text-[#f25c05]' : 'text-slate-400'"></i>
                                                        </a>

                                                        <!-- Level 3 Flyout Panel (Positioned on the Right) -->
                                                        <div x-show="subOpen" x-cloak 
                                                             x-transition:enter="transition ease-out duration-100"
                                                             x-transition:enter-start="opacity-0 translate-x-1"
                                                             x-transition:enter-end="opacity-100 translate-x-0"
                                                             x-transition:leave="transition ease-in duration-75"
                                                             x-transition:leave-start="opacity-100 translate-x-0"
                                                             x-transition:leave-end="opacity-0 translate-x-1"
                                                             class="absolute left-full top-0 w-64 bg-white border border-slate-200/90 shadow-2xl py-1.5 z-50 min-h-full">
                                                            @foreach($child->activeChildren as $subChild)
                                                                <a href="{{ $subChild->getUrl() }}" 
                                                                   class="block px-4 py-2 text-xs font-semibold text-slate-700 hover:text-[#f25c05] hover:bg-slate-50 transition">
                                                                    {{ $subChild->title }}
                                                                </a>
                                                                @if($subChild->activeChildren->isNotEmpty())
                                                                    <div class="pl-3 py-0.5 space-y-0.5 bg-slate-50/60 border-l border-orange-200 ml-4 mb-1">
                                                                        @foreach($subChild->activeChildren as $leaf)
                                                                            <a href="{{ $leaf->getUrl() }}" 
                                                                               class="block px-3 py-1 text-[11px] font-semibold text-slate-600 hover:text-[#f25c05] transition">
                                                                                &bull; {{ $leaf->title }}
                                                                            </a>
                                                                        @endforeach
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ $child->getUrl() }}" 
                                                       class="block px-4 py-2.5 text-xs font-semibold text-slate-800 hover:text-[#f25c05] hover:bg-slate-50 transition">
                                                        {{ $child->title }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <!-- Standard Menu Link -->
                                    <a href="{{ $item->getUrl() }}" target="{{ $item->target }}" 
                                       class="{{ $isContactMenuItem ? 'inline-flex items-center justify-center px-3 py-2 text-sm font-bold text-[#f25c05] border border-[#f25c05] hover:bg-orange-50 rounded-md transition whitespace-nowrap' : 'transition py-2 text-sm font-semibold '.($item->isActive() ? 'text-[#f25c05] font-bold' : 'text-slate-800 hover:text-[#f25c05]') }}">
                                        {{ $isContactMenuItem ? 'Contact Us' : $item->title }}
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <!-- Fallback Links -->
                            <a href="{{ route('home') }}" class="transition py-2 text-sm font-bold text-[#f25c05]">Home</a>
                            <a href="{{ route('service.index') }}" class="transition py-2 text-sm font-semibold text-slate-800 hover:text-[#f25c05]">Services</a>
                            <a href="{{ route('fleet.index') }}" class="transition py-2 text-sm font-semibold text-slate-800 hover:text-[#f25c05]">Products</a>
                            <a href="{{ route('about') }}" class="transition py-2 text-sm font-semibold text-slate-800 hover:text-[#f25c05]">About Us</a>
                            <a href="{{ route('blog.index') }}" class="transition py-2 text-sm font-semibold text-slate-800 hover:text-[#f25c05]">Blog</a>
                        @endif
                        @unless($hasHeaderContactLink)
                            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-3 py-2 text-sm font-bold text-[#f25c05] border border-[#f25c05] hover:bg-orange-50 rounded-md transition whitespace-nowrap">Contact Us</a>
                        @endunless
                    </nav>
                </div>

                <!-- Right Side: Search Form, Contact, Phone Button (+971 56 921 3754) & Admin Link -->
                <div class="hidden lg:flex items-center gap-3 xl:gap-4 shrink-0">
                    <!-- Search Input Form -->
                    <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                        <input type="text" 
                               name="q" 
                               placeholder="Search fleet, services..." 
                               value="{{ request('q') }}" 
                               class="w-44 xl:w-56 pl-8 pr-3 py-1.5 text-xs bg-slate-100 hover:bg-white focus:bg-white border border-slate-300 focus:border-[#f25c05] rounded-full text-slate-800 placeholder-slate-400 focus:outline-none transition shadow-xs">
                        <button type="submit" class="absolute left-2.5 text-slate-400 hover:text-[#f25c05] transition" title="Search">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i>
                        </button>
                    </form>

                    <!-- 24/7 Phone Hotline Button -->
                    <a href="tel:+971569213754" 
                       class="inline-flex items-center justify-center gap-2 px-4 py-2 text-white text-xs xl:text-sm font-bold shadow-sm hover:shadow-md transition whitespace-nowrap rounded-md group"
                       style="background-color: #f25c05;"
                       onmouseover="this.style.backgroundColor='#d95204'"
                       onmouseout="this.style.backgroundColor='#f25c05'"
                       title="Call 24/7 UAE Emergency Hotline">
                        <i data-lucide="phone-call" class="w-3.5 h-3.5 text-white shrink-0 group-hover:scale-110 transition-transform"></i>
                        <span>+971 56 921 3754</span>
                    </a>

                    @auth
                        <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                            @if(auth()->user()->canManageContent())
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-bold rounded bg-slate-900 text-amber-400 hover:bg-slate-800 transition">
                                    <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i>
                                    Admin
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 transition" title="Logout">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center gap-2">
                    <a href="tel:+971569213754" class="p-2 text-[#f25c05] rounded-lg hover:bg-orange-50">
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
            <!-- Mobile Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="relative flex items-center mb-2">
                <input type="text" 
                       name="q" 
                       placeholder="Search fleet, services..." 
                       value="{{ request('q') }}" 
                       class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 border border-slate-300 focus:border-[#f25c05] rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none transition">
                <button type="submit" class="absolute left-3 text-slate-400 hover:text-[#f25c05]">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </button>
            </form>
            <div class="flex flex-col space-y-1 text-sm font-semibold text-slate-800">
                @if(isset($headerMenuItems) && $headerMenuItems->isNotEmpty())
                    @foreach($headerMenuItems as $item)
                        @php
                            $itemPath = trim(parse_url((string) $item->url, PHP_URL_PATH) ?: '', '/');
                            $isContactMenuItem = $item->route_name === 'contact'
                                || in_array(strtolower(trim($item->title)), ['contact', 'contact us'], true)
                                || $itemPath === 'contact-us';
                        @endphp
                        @if($item->activeChildren->isNotEmpty())
                            <div x-data="{ open: false }" class="border-b border-slate-100 py-1.5">
                                <div class="flex items-center justify-between">
                                    <a href="{{ $item->getUrl() }}" class="font-bold text-slate-900 hover:text-[#f25c05] py-1">
                                        {{ $item->title }}
                                    </a>
                                    <button type="button" @click="open = !open" class="p-1.5 text-slate-400 hover:text-[#f25c05]">
                                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform" :class="open ? 'rotate-180 text-[#f25c05]' : ''"></i>
                                    </button>
                                </div>
                                <div x-show="open" x-cloak class="pl-3 pt-1 pb-1 space-y-1 border-l-2 border-orange-400 ml-1">
                                    @foreach($item->activeChildren as $child)
                                        @if($child->activeChildren->isNotEmpty())
                                            <div x-data="{ subOpen: false }" class="py-1">
                                                <div class="flex items-center justify-between">
                                                    <a href="{{ $child->getUrl() }}" class="text-xs font-semibold text-slate-800 hover:text-[#f25c05]">
                                                        {{ $child->title }}
                                                    </a>
                                                    <button type="button" @click="subOpen = !subOpen" class="p-1 text-slate-400 hover:text-[#f25c05]">
                                                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="subOpen ? 'rotate-180 text-[#f25c05]' : ''"></i>
                                                    </button>
                                                </div>
                                                <div x-show="subOpen" x-cloak class="pl-3 pt-1 space-y-1 border-l-2 border-slate-200 ml-1">
                                                    @foreach($child->activeChildren as $subChild)
                                                        <a href="{{ $subChild->getUrl() }}" class="block py-1 text-xs text-slate-600 hover:text-[#f25c05]">
                                                            {{ $subChild->title }}
                                                        </a>
                                                        @if($subChild->activeChildren->isNotEmpty())
                                                            <div class="pl-2 space-y-0.5">
                                                                @foreach($subChild->activeChildren as $leaf)
                                                                    <a href="{{ $leaf->getUrl() }}" class="block py-0.5 text-[11px] text-slate-500 hover:text-[#f25c05]">
                                                                        &bull; {{ $leaf->title }}
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ $child->getUrl() }}" class="block py-1 text-xs text-slate-600 hover:text-[#f25c05]">
                                                {{ $child->title }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $item->getUrl() }}" class="py-2 border-b border-slate-100 hover:text-[#f25c05] {{ $item->isActive() ? 'text-[#f25c05] font-bold' : 'text-slate-800' }}">
                                {{ $isContactMenuItem ? 'Contact Us' : $item->title }}
                            </a>
                        @endif
                    @endforeach
                @else
                    <a href="{{ route('home') }}" class="py-1 text-[#f25c05] font-bold">Home</a>
                    <a href="{{ route('about') }}" class="py-1 hover:text-[#f25c05]">About Us</a>
                    <a href="{{ route('fleet.index') }}" class="py-1 hover:text-[#f25c05]">Products</a>
                    <a href="{{ route('service.index') }}" class="py-1 hover:text-[#f25c05]">Services</a>
                    <a href="{{ route('blog.index') }}" class="py-1 hover:text-[#f25c05]">Blog</a>
                @endif
                @unless($hasHeaderContactLink)
                    <a href="{{ route('contact') }}" class="py-1 hover:text-[#f25c05]">Contact Us</a>
                @endunless
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-2">
                <a href="tel:+971569213754" class="block w-full py-3 bg-[#f25c05] hover:bg-[#d95204] text-white text-center font-bold text-xs rounded transition shadow-sm">
                    +971 56 921 3754
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
                    <a href="{{ route('home') }}" class="inline-flex items-center">
                        <img src="{{ asset('images/rentalpower-logo.png') }}" 
                             alt="{{ config('app.name', 'Rental Power UAE') }}" 
                             class="h-8 sm:h-9 w-auto object-contain brightness-110">
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        Rental Power UAE is the premier provider of reliable rental power and temporary cooling solutions across Dubai, Abu Dhabi, Sharjah, and Northern Emirates. Soundproof diesel generators, industrial chillers, packaged AC units, and portacabins with 24/7 turnkey service.
                    </p>
                    <div class="space-y-2 text-xs text-slate-300 pt-2">
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone-call" class="w-4 h-4 text-amber-400"></i>
                            <span class="font-bold text-white">+971 56 921 3754</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-amber-400"></i>
                            <a href="mailto:sales@rentalpower.ae" class="text-slate-300 hover:underline">sales@rentalpower.ae</a>
                        </div>
                        <div class="flex items-start gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                            <span class="text-slate-300">Dubai & Sharjah, United Arab Emirates</span>
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
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Rental Power UAE') }}. All rights reserved.</p>
                    <span class="text-slate-700 hidden sm:inline">&bull;</span>
                    <span class="text-slate-400">Reliable Power & Rental Cooling Solutions Across UAE</span>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('about') }}" class="hover:text-slate-300">About Us</a>
                    <a href="{{ route('fleet.index') }}" class="hover:text-slate-300">Fleet</a>
                    <a href="{{ route('blog.index') }}" class="hover:text-slate-300">Blog</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-300">Contact Us</a>
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-400">Admin Login</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp CTA -->
    <a href="https://wa.me/971569213754?text={{ urlencode('Hello Rental Power UAE, I would like to inquire about rental power and cooling solutions.') }}" 
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

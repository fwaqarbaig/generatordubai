@extends('layouts.app')

@section('seo_meta')
    <title>{{ $query ? "Search results for '{$query}'" : 'Search Generator Fleet & Services' }} | {{ config('app.name', 'Rental Power UAE') }}</title>
    <meta name="description" content="Search rental generators from 50 kVA to 2500 kVA, temporary chillers, packaged AC units, engineering guides, and power solutions across UAE.">
    <meta name="robots" content="noindex, follow">
@endsection

@section('content')
<div class="bg-gradient-to-b from-slate-900 via-slate-950 to-slate-900 text-white py-12 md:py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                Site-Wide Search
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black font-display tracking-tight text-white">
                Find Rental Power & Cooling Solutions
            </h1>
            <p class="text-sm sm:text-base text-slate-400">
                Search diesel generators (50 to 2500 kVA), industrial chillers, packaged AC units, power services, and engineering articles across the UAE.
            </p>

            <!-- Prominent Search Form -->
            <form action="{{ route('search') }}" method="GET" class="relative mt-6 max-w-2xl mx-auto">
                <div class="relative flex items-center shadow-2xl rounded-2xl overflow-hidden bg-white border-2 border-amber-500/30 focus-within:border-amber-500 transition">
                    <div class="pl-4 text-slate-400">
                        <i data-lucide="search" class="w-5 h-5"></i>
                    </div>
                    <input type="text" 
                           name="q" 
                           value="{{ $query }}" 
                           placeholder="Type to search e.g. 500 kva, chiller, temporary cooling, perkins..."
                           class="w-full px-4 py-3.5 sm:py-4 text-slate-900 text-sm sm:text-base placeholder-slate-400 focus:outline-none bg-transparent"
                           autofocus>
                    @if($query)
                        <a href="{{ route('search') }}" class="p-2 text-slate-400 hover:text-slate-600 mr-1" title="Clear search">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </a>
                    @endif
                    <button type="submit" 
                            class="px-6 sm:px-8 py-3.5 sm:py-4 bg-[#f25c05] hover:bg-[#d95204] text-white font-bold text-sm sm:text-base transition shrink-0">
                        Search
                    </button>
                </div>
            </form>

            <!-- Popular Quick Tags -->
            <div class="flex items-center justify-center gap-2 flex-wrap pt-2 text-xs text-slate-400">
                <span class="font-semibold text-slate-300">Quick Searches:</span>
                <a href="{{ route('search', ['q' => '500 kva']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">500 kVA</a>
                <a href="{{ route('search', ['q' => '1000 kva']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">1000 kVA</a>
                <a href="{{ route('search', ['q' => 'rental cooling']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">Rental Cooling</a>
                <a href="{{ route('search', ['q' => 'chiller']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">Chiller Rental</a>
                <a href="{{ route('search', ['q' => 'packaged ac']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">Packaged AC</a>
                <a href="{{ route('search', ['q' => 'portacabin']) }}" class="px-2.5 py-1 rounded-full bg-slate-800/80 hover:bg-slate-700 text-slate-300 hover:text-white transition">Portacabin</a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ tab: '{{ $activeTab }}' }">

    @if($query !== '')
        <!-- Results Header & Tabs -->
        <div class="border-b border-slate-200 pb-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase font-bold tracking-wider text-slate-400">Search Results</p>
                <h2 class="text-2xl font-bold text-slate-900">
                    Found {{ $totalCount }} {{ Str::plural('result', $totalCount) }} for <span class="text-[#f25c05]">"{{ $query }}"</span>
                </h2>
            </div>

            <!-- Filter Tabs -->
            <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl text-xs font-semibold overflow-x-auto">
                <button type="button" 
                        @click="tab = 'all'" 
                        :class="tab === 'all' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                        class="px-3.5 py-1.5 rounded-lg transition whitespace-nowrap">
                    All ({{ $totalCount }})
                </button>
                @if($products->isNotEmpty())
                    <button type="button" 
                            @click="tab = 'products'" 
                            :class="tab === 'products' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-lg transition whitespace-nowrap">
                        Fleet & Products ({{ $products->count() }})
                    </button>
                @endif
                @if($services->isNotEmpty())
                    <button type="button" 
                            @click="tab = 'services'" 
                            :class="tab === 'services' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-lg transition whitespace-nowrap">
                        Services ({{ $services->count() }})
                    </button>
                @endif
                @if($posts->isNotEmpty())
                    <button type="button" 
                            @click="tab = 'posts'" 
                            :class="tab === 'posts' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-lg transition whitespace-nowrap">
                        Guides & Articles ({{ $posts->count() }})
                    </button>
                @endif
                @if($pages->isNotEmpty())
                    <button type="button" 
                            @click="tab = 'pages'" 
                            :class="tab === 'pages' ? 'bg-white text-slate-900 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900'"
                            class="px-3.5 py-1.5 rounded-lg transition whitespace-nowrap">
                        Pages ({{ $pages->count() }})
                    </button>
                @endif
            </div>
        </div>

        @if($totalCount === 0)
            <!-- No Results Found -->
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-200/80 p-8 shadow-xs">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-[#f25c05] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="alert-circle" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No direct matches found for "{{ $query }}"</h3>
                <p class="text-sm text-slate-500 max-w-md mx-auto mb-6">
                    We couldn't find exact matches for that term. Try checking for typos or searching for a general capacity like <strong>500 kVA</strong>, <strong>generator rental</strong>, or <strong>chiller rental</strong>.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('fleet.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs hover:bg-slate-800 transition">
                        Browse Full Generator Fleet
                    </a>
                    <a href="{{ route('service.index') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 text-slate-950 font-bold text-xs hover:bg-amber-400 transition">
                        Explore Rental Cooling & Services
                    </a>
                    <a href="tel:+971569213754" class="px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-500 transition flex items-center gap-1.5">
                        <i data-lucide="phone-call" class="w-3.5 h-3.5"></i>
                        Call 24/7 Hotline
                    </a>
                </div>
            </div>
        @else

            <!-- 1. Generator Fleet & Equipment Results -->
            @if($products->isNotEmpty())
                <div x-show="tab === 'all' || tab === 'products'" class="mb-12">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="zap" class="w-5 h-5 text-amber-500"></i>
                            <span>Generator Fleet & Equipment ({{ $products->count() }})</span>
                        </h3>
                        <a href="{{ route('fleet.index') }}" class="text-xs font-semibold text-[#f25c05] hover:underline">
                            View All Fleet &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        @if($product->badge)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-amber-50 text-amber-700 border border-amber-200">
                                                {{ $product->badge }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-extrabold bg-slate-100 text-slate-700">
                                                {{ $product->category ?? 'Generator' }}
                                            </span>
                                        @endif
                                        <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded">
                                            In Stock &bull; 24/7 UAE
                                        </span>
                                    </div>
                                    <h4 class="text-base font-bold text-slate-900 group-hover:text-[#f25c05] transition mb-2">
                                        <a href="{{ route('fleet.show', $product->slug) }}">
                                            {{ $product->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed mb-4">
                                        {{ $product->summary ?? Str::limit(strip_tags($product->content), 120) }}
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('fleet.show', $product->slug) }}" class="text-xs font-bold text-[#f25c05] hover:text-[#d95204] flex items-center gap-1">
                                        <span>View Technical Specs</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="{{ route('contact') }}" class="px-3 py-1 bg-slate-900 hover:bg-slate-800 text-white rounded text-[11px] font-bold transition">
                                        Rent Now
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 2. Services Results -->
            @if($services->isNotEmpty())
                <div x-show="tab === 'all' || tab === 'services'" class="mb-12">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="wrench" class="w-5 h-5 text-sky-500"></i>
                            <span>Power & Cooling Services ({{ $services->count() }})</span>
                        </h3>
                        <a href="{{ route('service.index') }}" class="text-xs font-semibold text-[#f25c05] hover:underline">
                            View All Services &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($services as $service)
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        @if($service->hero_badge)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                                {{ $service->hero_badge }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                                                Turnkey Service
                                            </span>
                                        @endif
                                        <span class="text-[10px] font-bold text-sky-600 bg-sky-50 px-2 py-0.5 rounded">
                                            Turnkey UAE
                                        </span>
                                    </div>
                                    <h4 class="text-base font-bold text-slate-900 group-hover:text-[#f25c05] transition mb-2">
                                        <a href="{{ route('service.show', $service->slug) }}">
                                            {{ $service->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed mb-4">
                                        {{ $service->summary ?? Str::limit(strip_tags($service->content), 120) }}
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('service.show', $service->slug) }}" class="text-xs font-bold text-[#f25c05] hover:text-[#d95204] flex items-center gap-1">
                                        <span>Explore Service</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="{{ route('contact') }}" class="px-3 py-1 bg-amber-500 hover:bg-amber-400 text-slate-950 rounded text-[11px] font-bold transition">
                                        Quick Quote
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 3. Technical Articles & Blog Results -->
            @if($posts->isNotEmpty())
                <div x-show="tab === 'all' || tab === 'posts'" class="mb-12">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="book-open" class="w-5 h-5 text-indigo-500"></i>
                            <span>Engineering Articles & Technical Guides ({{ $posts->count() }})</span>
                        </h3>
                        <a href="{{ route('blog.index') }}" class="text-xs font-semibold text-[#f25c05] hover:underline">
                            View All Articles &rarr;
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($posts as $post)
                            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between group">
                                @if($post->featured_image_url)
                                    <a href="{{ route('post.show', $post->slug) }}" class="aspect-video block overflow-hidden bg-slate-100">
                                        <img src="{{ $post->featured_image_url }}" 
                                             alt="{{ $post->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    </a>
                                @endif
                                <div class="p-5 flex flex-col justify-between flex-grow">
                                    <div>
                                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mb-2">
                                            @if($post->categories->first())
                                                <span class="font-bold text-[#f25c05]">{{ $post->categories->first()->name }}</span>
                                                <span>&bull;</span>
                                            @endif
                                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Technical Guide' }}</span>
                                        </div>
                                        <h4 class="text-base font-bold text-slate-900 group-hover:text-[#f25c05] transition mb-2">
                                            <a href="{{ route('post.show', $post->slug) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed mb-4">
                                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                        </p>
                                    </div>
                                    <div class="pt-3 border-t border-slate-100">
                                        <a href="{{ route('post.show', $post->slug) }}" class="text-xs font-bold text-[#f25c05] hover:text-[#d95204] flex items-center gap-1">
                                            <span>Read Engineering Guide</span>
                                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 4. Pages Results -->
            @if($pages->isNotEmpty())
                <div x-show="tab === 'all' || tab === 'pages'" class="mb-12">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-2">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-emerald-500"></i>
                            <span>Pages & Regional Locations ({{ $pages->count() }})</span>
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pages as $page)
                            <div class="bg-white rounded-2xl border border-slate-200/90 p-5 shadow-xs hover:shadow-md transition flex flex-col justify-between group">
                                <div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 mb-2">
                                        Page
                                    </span>
                                    <h4 class="text-base font-bold text-slate-900 group-hover:text-[#f25c05] transition mb-2">
                                        <a href="{{ route('page.show', $page->slug) }}">
                                            {{ $page->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed mb-4">
                                        {{ Str::limit(strip_tags($page->content), 120) }}
                                    </p>
                                </div>
                                <div class="pt-3 border-t border-slate-100">
                                    <a href="{{ route('page.show', $page->slug) }}" class="text-xs font-bold text-[#f25c05] hover:text-[#d95204] flex items-center gap-1">
                                        <span>View Page</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        @endif

    @else
        <!-- Initial Blank State: Guidance & Popular Links -->
        <div class="max-w-4xl mx-auto py-12">
            <div class="text-center mb-10">
                <h3 class="text-xl font-bold text-slate-900 mb-2">Explore Our Equipment Fleet & Engineering Services</h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-lg mx-auto">
                    Type any keyword, kVA capacity, or service in the search box above, or select from our most requested temporary power and cooling categories below:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Fleet Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Diesel Generator Fleet</h4>
                    <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                        50 kVA to 2500 kVA prime soundproof diesel generators with Cummins and Perkins engines for rent across UAE.
                    </p>
                    <a href="{{ route('fleet.index') }}" class="text-xs font-bold text-[#f25c05] hover:underline flex items-center gap-1">
                        <span>Browse 50-2500 kVA Models</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <!-- Cooling Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center mb-4">
                        <i data-lucide="snowflake" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Rental Cooling & Chillers</h4>
                    <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                        Air-cooled chillers, packaged AC units, and temporary industrial climate control for events and construction.
                    </p>
                    <a href="{{ route('service.show', 'rental-cooling') }}" class="text-xs font-bold text-[#f25c05] hover:underline flex items-center gap-1">
                        <span>Explore Rental Cooling</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <!-- Articles Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-900 mb-2">Technical Guides & Sizing</h4>
                    <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                        In-depth kVA load sizing charts, ISO 8528 standards, fuel burn calculations, and engineering benchmarks.
                    </p>
                    <a href="{{ route('blog.index') }}" class="text-xs font-bold text-[#f25c05] hover:underline flex items-center gap-1">
                        <span>Read Power Knowledge Base</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

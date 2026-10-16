@php
    $sidebarSubject = $subject ?? (isset($service) ? 'Generator Inquiry: ' . $service->title : (isset($product) ? 'Fleet Model Inquiry: ' . $product->title : 'Generator Power Rental Inquiry'));
    $whatsappText = $whatsappMessage ?? (isset($service) ? 'Hello Generator Dubai, I need urgent pricing & availability for ' . $service->title : (isset($product) ? 'Hello Generator Dubai, I am inquiring about ' . $product->title : 'Hello Generator Dubai, I need a rental power quote.'));

    // Resolve services list for the navigator
    if (!isset($navServices)) {
        if (isset($otherServices) && $otherServices->isNotEmpty()) {
            $navServices = $otherServices;
        } elseif (isset($services) && $services->isNotEmpty()) {
            $navServices = isset($service) ? $services->where('id', '!=', $service->id) : $services;
        } else {
            $allServices = \App\Models\Service::published()->ordered()->get();
            $navServices = isset($service) ? $allServices->where('id', '!=', $service->id) : $allServices;
        }
    }
@endphp

<div id="quote-box" class="space-y-6">

    <!-- Flash Message Notification -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-600 text-white shadow-lg space-y-1">
            <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wide">
                <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                <span>Quote Request Dispatched!</span>
            </div>
            <p class="text-xs text-emerald-50 leading-relaxed">{{ session('success') }}</p>
        </div>
    @endif

    <!-- 1. Rapid Sizing & Quote Form Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm space-y-4">
        <div class="flex items-center gap-2 text-xs font-bold uppercase text-amber-600">
            <i data-lucide="zap" class="w-4 h-4"></i>
            <span>Instant Technical Sizing</span>
        </div>
        <h4 class="text-xl font-black text-slate-900 font-display">Request Power Quote</h4>
        <p class="text-xs text-slate-500">Submit your load requirements for an itemized engineering quote within <strong>15 minutes</strong>.</p>

        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4 pt-1">
            @csrf
            <input type="hidden" name="subject" value="{{ $sidebarSubject }}">

            <!-- Anti-Bot Silent Honeypot -->
            <div style="display: none !important;" aria-hidden="true">
                <input type="text" name="_hp_website" tabindex="-1" autocomplete="off">
                <input type="text" name="bot_check" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Your Full Name</label>
                <input type="text" name="name" required placeholder="e.g. Ahmed Al Mansoori" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">UAE Phone / WhatsApp</label>
                <input type="tel" name="phone" required placeholder="+971 50 123 4567" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" required placeholder="engineer@contractor.ae" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Power kVA</label>
                    <select name="kva_capacity" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-white">
                        <option value="50-150 kVA">50 – 150 kVA</option>
                        <option value="200-350 kVA">200 – 350 kVA</option>
                        <option value="500-800 kVA" selected>500 – 800 kVA</option>
                        <option value="1000-1250 kVA">1000 – 1250 kVA</option>
                        <option value="Multi-MW Plant">Multi-MW Plant</option>
                        <option value="Portacabin">Portacabin Office</option>
                        <option value="AMC / Maintenance">AMC / Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Location</label>
                    <select name="emirate" class="w-full px-3 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 bg-white">
                        <option value="Dubai" selected>Dubai</option>
                        <option value="Abu Dhabi">Abu Dhabi</option>
                        <option value="Sharjah">Sharjah</option>
                        <option value="Ajman">Ajman</option>
                        <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                        <option value="Fujairah">Fujairah</option>
                        <option value="Umm Al Quwain">Umm Al Quwain</option>
                        <option value="Oman">Oman</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Project Details / Duration</label>
                <textarea name="message" rows="3" placeholder="Specify load type (tower crane, chillers, site office), rental duration (daily, weekly, monthly), and site conditions..." class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500"></textarea>
            </div>

            <div class="flex items-center gap-2 p-2.5 rounded-xl bg-slate-50 border border-slate-200/80">
                <input type="checkbox" id="fuel_tank_needed" name="fuel_tank_needed" value="yes" class="rounded text-amber-600 focus:ring-amber-500">
                <label for="fuel_tank_needed" class="text-[11px] text-slate-600 font-medium">Include <strong>Turnkey Fuel Tank & ADNOC Diesel</strong> delivery</label>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-xs bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5">
                Request Engineering Quote
            </button>
        </form>
    </div>

    <!-- 2. Emergency 24/7 Dispatch Card -->
    <div class="bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 text-white rounded-3xl p-6 border border-slate-800 shadow-md space-y-4">
        <div class="flex items-center gap-2 text-xs font-bold uppercase text-amber-400">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>24/7 Emergency Dispatch</span>
        </div>
        <div class="space-y-1">
            <div class="text-xs text-slate-400">Facing a blackout or site emergency? Call:</div>
            <a href="tel:+971569213754" class="text-xl font-black text-white hover:text-amber-400 transition block font-mono">
                +971 56 921 3754
            </a>
        </div>
        <a href="https://wa.me/971569213754?text={{ urlencode($whatsappText) }}" target="_blank" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-md">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            <span>Chat on WhatsApp</span>
        </a>
        <div class="pt-2 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
            <span>Average Delivery: <strong>45–90 Min</strong></span>
            <span>All 7 Emirates</span>
        </div>
    </div>

    <!-- 3. Other Power Services Navigator -->
    @if(isset($navServices) && $navServices->isNotEmpty())
        <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm space-y-4">
            <h5 class="text-xs font-bold uppercase tracking-wider text-slate-500 flex items-center gap-2">
                <i data-lucide="layers" class="w-4 h-4 text-amber-500"></i>
                <span>Our Power Fleet & Services</span>
            </h5>
            <div class="space-y-1.5">
                @foreach($navServices as $navSvc)
                    <a href="{{ route('service.show', $navSvc->slug) }}" class="flex items-center justify-between p-3 rounded-2xl text-xs font-semibold text-slate-700 hover:bg-amber-50 hover:text-amber-900 transition group border border-transparent hover:border-amber-200">
                        <span class="truncate">{{ $navSvc->title }}</span>
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5 text-slate-400 group-hover:text-amber-600 group-hover:translate-x-0.5 transition shrink-0"></i>
                    </a>
                @endforeach
            </div>
            <div class="pt-2">
                <a href="{{ route('fleet.index') }}" class="block text-center py-2 text-xs font-bold text-amber-700 hover:text-amber-800 transition">
                    View Complete 50–2500 kVA Fleet &rarr;
                </a>
            </div>
        </div>
    @endif

    <!-- 4. Quick Depot & Guide Links -->
    <div class="p-5 rounded-3xl bg-slate-100 border border-slate-200/60 text-xs space-y-2">
        <span class="font-extrabold uppercase text-[10px] text-slate-500 tracking-wider">Fast Regional Dispatch:</span>
        <div class="flex flex-wrap gap-1.5 pt-1">
            <a href="{{ route('locations.show', 'dubai') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">Dubai</a>
            <a href="{{ route('locations.show', 'abu-dhabi') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">Abu Dhabi</a>
            <a href="{{ route('locations.show', 'sharjah') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">Sharjah</a>
            <a href="{{ route('locations.show', 'ajman') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">Ajman</a>
            <a href="{{ route('locations.show', 'ras-al-khaimah') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">RAK</a>
            <a href="{{ route('locations.show', 'fujairah') }}" class="px-2.5 py-1 rounded-lg bg-white text-slate-700 hover:text-amber-700 font-bold border border-slate-200 text-[11px]">Fujairah</a>
        </div>
        <div class="pt-2 border-t border-slate-200">
            <a href="{{ route('post.show', 'generator-sizing-guide-dubai-construction-kva') }}" class="text-amber-700 hover:underline font-bold flex items-center gap-1 text-[11px]">
                <i data-lucide="book-open" class="w-3 h-3"></i>
                <span>Construction Sizing Guide &rarr;</span>
            </a>
        </div>
    </div>

</div>

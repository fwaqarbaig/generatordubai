@extends('layouts.app')

@section('seo_meta')
    <title>Contact Generator Dubai | 24/7 Hotline & Technical Inquiries</title>
    <meta name="description" content="Get in touch with Generator Dubai for immediate quotes, site audits, and 24/7 emergency generator dispatch. Hotline: +971 56 921 3754.">
    <meta name="keywords" content="contact generator dubai, generator rental phone number, rent diesel generator uae, emergency generator hotline dubai">
    <link rel="canonical" href="{{ route('contact') }}">
    <meta property="og:title" content="Contact Generator Dubai | 24/7 Emergency Dispatch">
    <meta property="og:description" content="Speak directly with a power engineering specialist. Free load audits and itemized quotes across all 7 Emirates.">
    <meta property="og:url" content="{{ route('contact') }}">
    <meta property="og:type" content="website">

    <!-- Schema.org BreadcrumbList JSON-LD -->
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
          'name' => 'Contact Us',
          'item' => route('contact'),
        ],
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$page->schema_markup ?? null" />
@endsection

@section('content')
<div class="bg-slate-50 min-h-screen">

    <!-- Header Section -->
    <section class="relative bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white pt-24 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30 mb-6 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>24/7 EMERGENCY DISPATCH ACROSS ALL 7 EMIRATES</span>
            </span>
            <h1 class="text-3xl sm:text-5xl font-black font-display tracking-tight text-white">
                Contact <span class="text-amber-400">Generator Dubai</span>
            </h1>
            <p class="mt-4 text-sm sm:text-base text-slate-300 font-normal leading-relaxed">
                Need urgent site power or planning long-term generator hire? Our electrical engineering team is available 24/7 to provide immediate technical consultations, load assessments, and competitive itemized quotes.
            </p>
        </div>
    </section>

    <!-- Main Contact Grid -->
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start max-w-6xl mx-auto">
            
            <!-- Contact Info & Logistics (5 cols) -->
            <div class="lg:col-span-5 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 text-white rounded-3xl p-8 sm:p-10 space-y-8 shadow-2xl border border-slate-800">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-7 h-7 rounded-lg bg-amber-500 text-slate-950 flex items-center justify-center font-black">
                            <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
                        </div>
                        <span class="text-base font-black tracking-tight text-white">GENERATOR <span class="text-amber-400">DUBAI</span></span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        Temporary power engineering, soundproof diesel generator fleet, and turnkey electrical distribution across the United Arab Emirates.
                    </p>
                </div>

                <div class="space-y-6 text-xs text-slate-300">
                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="phone-call" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">24/7 Dispatch Hotline</span>
                            <a href="tel:+971569213754" class="font-extrabold text-white hover:text-amber-400 transition text-sm">+971 56 921 3754</a>
                            <span class="text-[11px] text-emerald-400 block mt-0.5">&bull; Emergency Mobilization &lt;60 Mins</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">Instant WhatsApp Support</span>
                            <a href="https://wa.me/971569213754" target="_blank" class="font-bold text-white hover:text-emerald-400 transition text-xs">+971 56 921 3754</a>
                            <span class="text-[11px] text-slate-400 block mt-0.5">Direct chat with fleet controller</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">Commercial Tender Email</span>
                            <a href="mailto:hello@generatordubai.com" class="font-bold text-white hover:text-amber-400 transition text-xs">hello@generatordubai.com</a>
                            <span class="text-[11px] text-slate-400 block mt-0.5">RFPs & Project tender inquiries</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase text-slate-400 block">Head Office Location</span>
                            <span class="font-medium text-white block">Suit 44, King Faisal Street, Sharjah, U.A.E.</span>
                            <span class="text-[11px] text-slate-400 block mt-0.5">Depots in Dubai, Abu Dhabi, Sharjah & RAK</span>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-900 border border-slate-800 text-[11px] text-slate-400 space-y-1">
                    <span class="text-amber-400 font-bold block">Regional Service Coverage:</span>
                    <p>Dubai &bull; Abu Dhabi &bull; Sharjah &bull; Ajman &bull; Ras Al Khaimah &bull; Fujairah &bull; Umm Al Quwain &bull; Oman</p>
                </div>
            </div>

            <!-- Online Quote Request Form (7 cols) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-slate-200">
                <div class="space-y-1 mb-8">
                    <h3 class="text-2xl font-black font-display text-slate-900">Request Rapid Generator Quote</h3>
                    <p class="text-xs text-slate-500">
                        Fill in your project details below and an electrical engineer will contact you within 30 minutes with an itemized technical proposal.
                    </p>
                </div>

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Your Full Name *</label>
                            <input type="text" name="name" required placeholder="e.g. Ahmed Al Mansoori"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Phone Number / WhatsApp *</label>
                            <input type="tel" name="phone" required placeholder="+971 50 123 4567"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Address</label>
                            <input type="email" name="email" placeholder="name@company.com"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Required Capacity (kVA)</label>
                            <select name="subject" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                                <option value="Unsure - Need Load Audit">Unsure - Need Free Load Audit</option>
                                <option value="50 kVA (40 kW)">50 kVA (40 kW)</option>
                                <option value="100 kVA (80 kW)">100 kVA (80 kW)</option>
                                <option value="150 kVA (120 kW)">150 kVA (120 kW)</option>
                                <option value="200 kVA (160 kW)">200 kVA (160 kW)</option>
                                <option value="250 kVA (200 kW)">250 kVA (200 kW)</option>
                                <option value="300 kVA (240 kW)">300 kVA (240 kW)</option>
                                <option value="350 kVA (280 kW)">350 kVA (280 kW)</option>
                                <option value="500 kVA (400 kW)">500 kVA (400 kW)</option>
                                <option value="600 kVA (480 kW)">600 kVA (480 kW)</option>
                                <option value="800 kVA (640 kW)">800 kVA (640 kW)</option>
                                <option value="1000 kVA (800 kW)">1000 kVA (800 kW)</option>
                                <option value="1250 kVA (1000 kW)">1250 kVA (1000 kW)</option>
                                <option value="Multi-Megawatt Plant (2MW - 20MW)">Multi-Megawatt Plant (2MW - 20MW)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Project Location & Duration</label>
                        <input type="text" name="location_notes" placeholder="e.g. Dubai South / 3 Months / Tower Crane + Office"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Machinery & Site Power Details</label>
                        <textarea name="message" rows="4" required placeholder="Describe your connected machinery (DOL motors, cranes, chillers, continuous running requirements)..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none transition"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-400 hover:from-amber-600 hover:to-yellow-500 text-slate-950 font-extrabold text-sm shadow-xl shadow-amber-500/25 transition flex items-center justify-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4 fill-current"></i>
                        <span>Submit Quote Request</span>
                    </button>

                    <p class="text-[11px] text-slate-400 text-center">
                        Strict confidentiality guaranteed. We never share your commercial details with third parties.
                    </p>
                </form>
            </div>

        </div>
    </section>

</div>
@endsection

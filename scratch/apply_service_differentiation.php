<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Service;
use Illuminate\Support\Facades\DB;

$differentiators = [
    'generator-maintenance-uae' => [
        'marker' => 'data-diff="generator-amc"',
        'title' => 'Looking for an Annual Contract with Guaranteed 60-Minute SLA & Scheduled PMs?',
        'desc' => 'Our Annual Maintenance Contracts (AMC) provide comprehensive quarterly preventive maintenance, emergency standby response, and discounted genuine spare parts across the UAE.',
        'anchor' => 'Explore Generator AMC Packages in UAE',
        'url' => '/service/generator-amc-uae',
    ],
    'generator-amc-uae' => [
        'marker' => 'data-diff="generator-maintenance"',
        'title' => 'Need One-Time Emergency Repair, 1,000-Hour Overhaul, or Load Bank Testing?',
        'desc' => 'For ad-hoc troubleshooting, major engine overhauls, or mobile resistive load bank testing without an annual contract commitment, explore our on-demand engineering division.',
        'anchor' => 'View Generator Maintenance & Repairs',
        'url' => '/service/generator-maintenance-uae',
    ],
    'chiller-maintenance' => [
        'marker' => 'data-diff="chiller-amc"',
        'title' => 'Need Guaranteed Year-Round HVAC Protection & 24/7 Priority Emergency Dispatch?',
        'desc' => 'Our commercial Chiller Annual Maintenance Contracts (AMC) safeguard commercial towers and industrial facilities with scheduled quarterly service, eddy-current tube testing, and priority dispatch.',
        'anchor' => 'View Chiller AMC Contracts in UAE',
        'url' => '/service/chiller-amc-uae',
    ],
    'chiller-amc-uae' => [
        'marker' => 'data-diff="chiller-maintenance"',
        'title' => 'Need Immediate Breakdown Troubleshooting, Chemical Descaling, or Compressor Rebuilds?',
        'desc' => 'If you require emergency chiller repairs, centrifugal/screw compressor rebuilding, or condenser acid descaling without a fixed annual commitment, view our on-demand services.',
        'anchor' => 'View Chiller Maintenance & Overhauls',
        'url' => '/service/chiller-maintenance',
    ],
    'rental-generator-in-uae' => [
        'marker' => 'data-diff="rental-power"',
        'title' => 'Looking for Multi-Megawatt Utility Paralleling or Temporary Substation Grids?',
        'desc' => 'While this page covers individual mobile diesel generators (20 kVA to 2500 kVA), our Turnkey Power division designs multi-megawatt synchronized power plants with high-voltage step-up transformers.',
        'anchor' => 'Explore Multi-Megawatt Rental Power',
        'url' => '/service/rental-power-in-uae',
    ],
    'rental-power-in-uae' => [
        'marker' => 'data-diff="rental-generator"',
        'title' => 'Need a Single Mobile Diesel Generator for Same-Day Site Delivery?',
        'desc' => 'If your project requires an individual 20 kVA to 2500 kVA super-silent diesel genset with integrated day tank for construction, events, or commercial backup, see our standalone rental fleet.',
        'anchor' => 'Browse Standalone Rental Generators',
        'url' => '/service/rental-generator-in-uae',
    ],
    'used-generators-uae' => [
        'marker' => 'data-diff="refurbished-generators"',
        'title' => 'Seeking Factory-Rebuilt Zero-Hour Units with a 12-Month Mechanical Warranty?',
        'desc' => 'Used generators are inspected, pre-owned working units sold as-is or with certified load verification. If your facility requires complete cylinder overhauls, rewound alternators, and warranties, see refurbished units.',
        'anchor' => 'Explore Refurbished Generators in UAE',
        'url' => '/service/refurbished-generators-uae',
    ],
    'refurbished-generators-uae' => [
        'marker' => 'data-diff="used-generators"',
        'title' => 'Looking for Budget-Conscious, Working Pre-Owned Equipment Without Full Rebuild Costs?',
        'desc' => 'Refurbished units undergo 100% disassembly, line-boring, and new OEM internals. If you need low-hour, reliable second-hand power at lower acquisition costs, browse our tested used assets.',
        'anchor' => 'Browse Certified Used Generators',
        'url' => '/service/used-generators-uae',
    ],
    'used-chiller-in-uae' => [
        'marker' => 'data-diff="refurbished-chillers"',
        'title' => 'Need Zero-Hour Overhauled Chillers with Completely Rebuilt Screw Compressors?',
        'desc' => 'Used chillers are operational decommissioned machines tested for performance. For zero-hour remanufactured chillers with new evaporator tubes, factory overhaul, and warranties, explore refurbished chillers.',
        'anchor' => 'Explore Refurbished Chillers in UAE',
        'url' => '/service/refurbished-chillers-uae',
    ],
    'refurbished-chillers-uae' => [
        'marker' => 'data-diff="used-chiller"',
        'title' => 'Seeking Low-Capital Operational Second-Hand Chillers for Immediate Deployment?',
        'desc' => 'Refurbished units feature completely overhauled compressors and new electrical panels. If you need cost-effective pre-owned chillers ready for prompt hookup, see our tested used inventory.',
        'anchor' => 'Browse Tested Used Chillers',
        'url' => '/service/used-chiller-in-uae',
    ],
];

DB::transaction(function () use ($differentiators) {
    foreach ($differentiators as $slug => $data) {
        $s = Service::where('slug', $slug)->first();
        if (! $s) {
            echo "Service not found: {$slug}\n";

            continue;
        }

        if (str_contains($s->content, $data['marker'])) {
            echo "Already differentiated: {$slug}\n";

            continue;
        }

        $callout = "\n<div {$data['marker']} class=\"my-8 p-5 sm:p-6 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200/90 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4\">".
            '<div class="space-y-1">'.
            '<span class="text-[11px] font-black uppercase tracking-wider text-amber-800 bg-amber-200/60 px-2.5 py-0.5 rounded-full inline-block mb-1">Equipment Selection Guide</span>'.
            '<h4 class="text-sm sm:text-base font-bold text-slate-900">'.htmlspecialchars($data['title']).'</h4>'.
            '<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">'.htmlspecialchars($data['desc']).'</p>'.
            '</div>'.
            "<a href=\"{$data['url']}\" class=\"shrink-0 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold text-xs transition shadow-sm flex items-center gap-1.5\">".
            '<span>'.htmlspecialchars($data['anchor']).'</span>'.
            '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>'.
            '</a>'.
            "</div>\n";

        // Insert right after the first paragraph closing tag, or at the top
        if (preg_match('/<\/p>/i', $s->content, $m, PREG_OFFSET_CAPTURE)) {
            $pos = $m[0][1] + strlen($m[0][0]);
            $s->content = substr($s->content, 0, $pos).$callout.substr($s->content, $pos);
        } else {
            $s->content = $callout.$s->content;
        }

        $s->save();
        echo "Updated differentiation for: {$slug}\n";
    }
});

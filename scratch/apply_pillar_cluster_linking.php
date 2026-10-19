<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;

// 1. Cooling Pillar: Post 1019
$p1019 = Post::find(1019);
if ($p1019 && ! str_contains($p1019->content, 'Sector-Specific Temporary Cooling Applications Across the UAE')) {
    $pillarBlock = "\n\n<h2>Sector-Specific Temporary Cooling Applications Across the UAE</h2>\n".
        "<p>While general thermodynamic principles govern all cooling equipment selection, distinct industrial and commercial sectors across Dubai, Abu Dhabi, and Sharjah face specialized environmental and operational mandates:</p>\n".
        '<div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-6 not-prose">'.
        '<div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">'.
        '<h4 class="text-sm font-bold text-slate-900 mb-1.5">Hospitality & Hotel Renovations</h4>'.
        '<p class="text-xs text-slate-600 mb-3">Ultra-low acoustic dBA requirements, floor-by-floor sectional isolation, and positive air pressure.</p>'.
        '<a href="/how-to-plan-temporary-cooling-for-a-hotel-renovation-in-dubai" class="text-xs font-bold text-amber-600 hover:text-amber-700">Read Hotel Cooling Guide &rarr;</a>'.
        '</div>'.
        '<div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">'.
        '<h4 class="text-sm font-bold text-slate-900 mb-1.5">Manufacturing & Process Plants</h4>'.
        '<p class="text-xs text-slate-600 mb-3">Industrial hydraulic circuit cooling, high internal heat gains, and SEWA electrical tie-ins.</p>'.
        '<a href="/how-to-choose-temporary-cooling-for-a-manufacturing-plant-in-sharjah" class="text-xs font-bold text-amber-600 hover:text-amber-700">Read Manufacturing Plant Guide &rarr;</a>'.
        '</div>'.
        '<div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">'.
        '<h4 class="text-sm font-bold text-slate-900 mb-1.5">Construction Rest Shelters</h4>'.
        '<p class="text-xs text-slate-600 mb-3">Mandatory worker mid-day rest shelters, desert sand-trap filtration, and concrete batching cooling.</p>'.
        '<a href="/how-to-choose-cooling-equipment-construction-site-abu-dhabi" class="text-xs font-bold text-amber-600 hover:text-amber-700">Read Abu Dhabi Site Guide &rarr;</a>'.
        '</div>'.
        "</div>\n";

    $p1019->content .= $pillarBlock;
    $p1019->save();
    echo "Updated Cooling Pillar (1019)\n";
}

// 2. Generator Pillar: Post 1010
$p1010 = Post::find(1010);
if ($p1010 && ! str_contains($p1010->content, 'Specialized Construction Scenarios Across the Emirates')) {
    $genPillarBlock = "\n\n<h2>Specialized Construction Scenarios Across the Emirates</h2>\n".
        "<p>Depending on your construction project topology and geographic location, power requirements diverge significantly from standard civil earthmoving:</p>\n".
        '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 my-6 not-prose">'.
        '<div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">'.
        '<h4 class="text-sm font-bold text-slate-900 mb-1.5">High-Rise Towers & Tower Cranes in Dubai</h4>'.
        '<p class="text-xs text-slate-600 mb-3">Overcoming vertical cable voltage drops over 200+ meters, tower crane regenerative braking surges, and strict urban acoustic noise limits.</p>'.
        '<a href="/how-to-select-a-rental-generator-for-a-high-rise-construction-project-in-dubai" class="text-xs font-bold text-amber-600 hover:text-amber-700">Read High-Rise Power Guide &rarr;</a>'.
        '</div>'.
        '<div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">'.
        '<h4 class="text-sm font-bold text-slate-900 mb-1.5">Remote Desert Infrastructure in Abu Dhabi</h4>'.
        '<p class="text-xs text-slate-600 mb-3">Dual heavy-duty sandstorm air cleaners, 50°C tropical radiator cores, and autonomous bulk fuel satellite telemetry.</p>'.
        '<a href="/how-to-choose-rental-generator-remote-construction-sites-abu-dhabi" class="text-xs font-bold text-amber-600 hover:text-amber-700">Read Remote Site Guide &rarr;</a>'.
        '</div>'.
        "</div>\n";

    $p1010->content .= $genPillarBlock;
    $p1010->save();
    echo "Updated Generator Pillar (1010)\n";
}

// 3. Used Equipment Inspection: Post 1038
$p1038 = Post::find(1038);
if ($p1038 && ! str_contains($p1038->content, 'Next Steps: Pre-Transport Rigging and Lifting Inspection')) {
    $usedBlock = "\n\n<h2>Next Steps: Pre-Transport Rigging and Lifting Inspection</h2>\n".
        "<p>Once you have thoroughly verified the mechanical, electrical, and load bank health of your pre-owned generator, securing and transporting the asset safely to your project site requires a secondary logistical inspection. Review our dedicated guide on <a href=\"/how-to-inspect-a-used-generator-before-transporting-it-to-your-site\" class=\"text-amber-600 font-bold hover:underline\">How to Inspect a Used Generator Before Transporting It to Your Site</a> to verify crane pad eye certifications, anti-vibration mount lock downs, and UAE road transport hazardous fluid compliance.</p>\n";

    $p1038->content .= $usedBlock;
    $p1038->save();
    echo "Updated Used Generator Inspection Guide (1038)\n";
}

echo "Pillar and cluster cross-linking complete!\n";

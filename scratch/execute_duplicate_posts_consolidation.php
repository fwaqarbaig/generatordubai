<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Post;
use App\Models\RedirectRule;
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    // -------------------------------------------------------------------------
    // Pair 1: Chiller vs Portable AC
    // -------------------------------------------------------------------------
    $winner1 = Post::find(1007);
    $loser1 = Post::find(1021);

    if ($winner1 && $loser1) {
        echo "Processing Pair 1: 1021 -> 1007\n";
        // Merge architectural comparison and FAQs if not already present in winner
        if (! str_contains($winner1->content, 'Core Architectural Differences')) {
            $mergeContent = "\n\n<h2>Core Architectural Differences: Fluid Hydronics vs Direct Expansion Air</h2>\n".
                "<p>When evaluating cooling infrastructure for commercial high-rises, retail malls, or industrial warehouses across Dubai and Abu Dhabi, mechanical engineers must assess two fundamentally distinct thermodynamic methodologies: closed-loop hydronic chilled water circulation versus direct expansion (DX) ducted airflow.</p>\n".
                '<div class="overflow-x-auto my-6"><table class="w-full text-sm border-collapse border border-slate-300"><thead><tr class="bg-slate-100"><th class="border p-3 text-left font-bold">Parameter</th><th class="border p-3 text-left font-bold">Rental Chiller System (Hydronic)</th><th class="border p-3 text-left font-bold">Portable / Packaged AC (DX)</th></tr></thead><tbody>'.
                '<tr><td class="border p-3 font-semibold">Primary Cooling Medium</td><td class="border p-3">Chilled Water / Ethylene Glycol mixture (6°C–12°C)</td><td class="border p-3">Direct Refrigerant R410A / R407C into Air Coil</td></tr>'.
                '<tr><td class="border p-3 font-semibold">Cooling Scale Capacity</td><td class="border p-3">50 TR to 500 TR per individual skid unit</td><td class="border p-3">5 TR to 50 TR portable/packaged air handlers</td></tr>'.
                '<tr><td class="border p-3 font-semibold">Building Integration</td><td class="border p-3">Flanged PN16 flexible hoses tie into existing AHU/FCU headers</td><td class="border p-3">Flexible canvas/PVC ducting through windows/doors/louvers</td></tr>'.
                '<tr><td class="border p-3 font-semibold">Deployment Speed</td><td class="border p-3">4–8 hours with crane offloading and hydro-testing</td><td class="border p-3">1–3 hours rapid plug-and-play placement</td></tr>'.
                '<tr><td class="border p-3 font-semibold">Electrical Power Requirement</td><td class="border p-3">High (requires dedicated 250 kVA–1000 kVA genset or busbar)</td><td class="border p-3">Moderate (operates from standard 32A–125A 3-phase feeds)</td></tr>'.
                '</tbody></table></div>';

            $winner1->content .= $mergeContent;
            $winner1->save();
        }

        $loser1->status = 'draft';
        $loser1->is_indexable = false;
        $loser1->save();

        RedirectRule::updateOrCreate(
            ['source_url' => '/rental-chiller-vs-portable-ac-for-commercial-buildings'],
            [
                'target_url' => '/rental-chiller-vs-portable-ac-for-commercial-buildings-in-the-uae',
                'status_code' => 301,
                'match_type' => 'exact',
                'group' => 'seo_cannibalization_fix',
                'description' => 'Merged duplicate blog post into geo-targeted canonical article',
                'is_active' => true,
            ]
        );
    }

    // -------------------------------------------------------------------------
    // Pair 2: Temporary Cooling UAE vs Dubai
    // -------------------------------------------------------------------------
    $winner2 = Post::find(1002);
    $loser2 = Post::find(1001);

    if ($winner2 && $loser2) {
        echo "Processing Pair 2: 1001 -> 1002\n";
        // Merge Dubai municipal permits & emergency dispatch specifics into UAE guide
        if (! str_contains($winner2->content, 'Dubai Municipality and DCD Compliance')) {
            $mergeContent = "\n\n<h2>Dubai Municipality and DCD Compliance for Temporary Cooling Installations</h2>\n".
                '<p>Deploying temporary cooling chillers and high-tonnage air handling packages in urban commercial zones such as Downtown Dubai, Business Bay, JAFZA, and DIFC requires strict adherence to Dubai Civil Defence (DCD) access guidelines and Dubai Municipality acoustic noise limits (under 65 dBA at property boundaries). Rental Power UAE engineers handle all mandatory site containment, secondary drip-traying, and rapid electrical synchronizations to guarantee complete regulatory approval without project delay.</p>';

            $winner2->content .= $mergeContent;
            $winner2->save();
        }

        $loser2->status = 'draft';
        $loser2->is_indexable = false;
        $loser2->save();

        RedirectRule::updateOrCreate(
            ['source_url' => '/temporary-cooling-services-in-dubai'],
            [
                'target_url' => '/temporary-cooling-options-in-the-uae',
                'status_code' => 301,
                'match_type' => 'exact',
                'group' => 'seo_cannibalization_fix',
                'description' => 'Merged Dubai temporary cooling variant into comprehensive nationwide UAE guide',
                'is_active' => true,
            ]
        );
    }

    // -------------------------------------------------------------------------
    // Pair 3: Construction Site Preparation Before Delivery
    // -------------------------------------------------------------------------
    $winner3 = Post::find(1005);
    $loser3 = Post::find(1017);

    if ($winner3 && $loser3) {
        echo "Processing Pair 3: 1017 -> 1005\n";
        if (! str_contains($winner3->content, 'Quick 5-Step Site Mobilization Protocol')) {
            $mergeContent = "\n\n<h2>Summary: The Quick 5-Step Site Mobilization Protocol</h2>\n".
                '<ol class="list-decimal pl-6 space-y-2 my-4">'.
                '<li><strong>Hardstanding Pad Certification:</strong> Confirm soil bearing capacity (minimum 250 kN/m²) or pour a 200mm reinforced concrete slab level within ±5mm.</li>'.
                '<li><strong>Rigging & Crane Clearance:</strong> Clear a 4.5m wide transport corridor with 6.0m vertical clearance free of overhead powerlines and crane swing arcs.</li>'.
                '<li><strong>Civil Defence Earthing Pit:</strong> Drive copper-clad earth rods to achieve tested resistance below 5 Ohms prior to cable hookup.</li>'.
                '<li><strong>Cable Ramps & Trenching:</strong> Install heavy-duty vehicle crossing ramps across live traffic roads and protect cable runs from abrasive sand.</li>'.
                '<li><strong>Turnkey Fuel Logistics:</strong> Ensure double-bunded auxiliary fuel tanks comply with UAE environmental spill-containment standards.</li>'.
                '</ol>';

            $winner3->content .= $mergeContent;
            $winner3->save();
        }

        $loser3->status = 'draft';
        $loser3->is_indexable = false;
        $loser3->save();

        RedirectRule::updateOrCreate(
            ['source_url' => '/how-to-prepare-construction-site-before-rental-generator-delivery'],
            [
                'target_url' => '/how-to-prepare-a-construction-site-before-generator-delivery-in-the-uae',
                'status_code' => 301,
                'match_type' => 'exact',
                'group' => 'seo_cannibalization_fix',
                'description' => 'Merged duplicate site preparation article into comprehensive technical standard',
                'is_active' => true,
            ]
        );
    }

    // -------------------------------------------------------------------------
    // Pair 4: Fuel Consumption vs Fuel Cost Estimation
    // -------------------------------------------------------------------------
    $winner4 = Post::find(1013);
    $loser4 = Post::find(988);

    if ($winner4 && $loser4) {
        echo "Processing Pair 4: 988 -> 1013\n";
        if (! str_contains($winner4->content, 'Translating Fuel Consumption into Daily & Monthly Operating Budgets (AED)')) {
            $mergeContent = "\n\n<h2>Translating Fuel Consumption into Daily & Monthly Operating Budgets (AED)</h2>\n".
                "<p>Once you determine your generator's hourly fuel burn rate from the capacity matrix above, calculating your realistic operational fuel budget in the UAE requires factoring in local diesel pricing (typically AED 3.10 to AED 3.60 per liter depending on monthly fuel price committee updates), continuous daily running hours, and bulk delivery surcharges.</p>\n".
                '<div class="p-5 rounded-2xl bg-amber-50 border border-amber-200 text-slate-800 my-6">'.
                '<h3 class="text-base font-bold text-amber-950 mb-2">Worked Financial Example: 500 kVA Prime Generator</h3>'.
                '<ul class="list-disc pl-5 space-y-1.5 text-sm">'.
                '<li><strong>Rated Output:</strong> 500 kVA (400 kW) operating at 75% load factor (300 kW continuous demand)</li>'.
                '<li><strong>Hourly Fuel Burn:</strong> ~75.0 Liters per hour</li>'.
                '<li><strong>Operating Shift:</strong> 12 hours/day on a commercial construction site</li>'.
                '<li><strong>Daily Fuel Usage:</strong> 75 L/hr × 12 hrs = 900 Liters/day</li>'.
                '<li><strong>Daily Fuel Cost @ AED 3.30/L:</strong> 900 L × AED 3.30 = <strong>AED 2,970 per day</strong></li>'.
                '<li><strong>30-Day Monthly Operating Cost:</strong> 27,000 Liters = <strong>AED 89,100 per month</strong></li>'.
                '</ul>'.
                "<p class=\"text-xs text-slate-600 mt-3\"><em>Pro-Tip:</em> By pairing your generator with Rental Power UAE's automated bulk fuel telemetry tanks, you eliminate manual re-ordering delays and lock in commercial bulk fuel discounts.</p>".
                '</div>';

            $winner4->content .= $mergeContent;
            $winner4->save();
        }

        $loser4->status = 'draft';
        $loser4->is_indexable = false;
        $loser4->save();

        RedirectRule::updateOrCreate(
            ['source_url' => '/how-to-estimate-generator-diesel-fuel-costs'],
            [
                'target_url' => '/how-to-calculate-rental-generator-fuel-consumption',
                'status_code' => 301,
                'match_type' => 'exact',
                'group' => 'seo_cannibalization_fix',
                'description' => 'Merged fuel cost estimation article into authoritative fuel consumption and cost guide',
                'is_active' => true,
            ]
        );
    }

    RedirectRule::clearCache();
    echo "Done! All 4 duplicate pairs consolidated and 301 redirects active.\n";
});

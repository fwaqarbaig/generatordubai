<?php

use App\Models\Post;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$calc = app(YoastSeoScoreCalculator::class);

// 1. Post 992
$p992 = Post::find(992);
if ($p992) {
    $addon = '
<h2>Specialized Concrete Cooling Equipment in the UAE</h2>
<p>To comply with UAE concrete pouring temperature thresholds (below 30°C / 32°C), discover our specialized thermal fleet:</p>
<ul>
    <li><a href="/service/rental-chiller-in-uae">Industrial Chiller Hire</a> &bull; Continuous water chilling for batching plants.</li>
    <li><a href="/service/rental-cooling">Turnkey Rental Cooling</a> &bull; High-flow thermal exchangers and circulation pumps.</li>
    <li><a href="/service/rental-generator-in-uae">Batching Plant Generator Rental</a> &bull; Dedicated 500 kVA to 1000 kVA power units.</li>
    <li><a href="/locations/dubai">Dubai</a>, <a href="/locations/abu-dhabi">Abu Dhabi</a>, and <a href="/locations/sharjah">Sharjah</a> rapid depot mobilization.</li>
</ul>';
    $p992->content .= $addon;
    $res = $calc->calculateForModel($p992);
    $p992->seo_score = $res['seo_score'];
    $p992->readability_score = $res['readability_score'];
    $p992->save();
    echo "Enriched Post 992\n";
}

// 2. Post 1031 (Low Oil Pressure)
$p1031 = Post::find(1031);
if ($p1031) {
    $addon = '
<h2>Professional Generator Maintenance and Emergency Support</h2>
<p>Low oil pressure requires immediate diagnostic attention. Explore our certified services:</p>
<ul>
    <li><a href="/service/generator-maintenance-and-repair">Emergency Generator Repair Services</a> &bull; Lube oil pump replacement and crankcase diagnostics.</li>
    <li><a href="/service/rental-generator-in-uae">Standby Rental Generators</a> &bull; Temporary power while your unit undergoes overhaul.</li>
    <li><a href="/fleet/500kva-generator-hire">500 kVA Replacement Gensets</a> &bull; Fast-dispatch soundproof backup power.</li>
</ul>';
    $p1031->content .= $addon;
    $res = $calc->calculateForModel($p1031);
    $p1031->seo_score = $res['seo_score'];
    $p1031->readability_score = $res['readability_score'];
    $p1031->save();
    echo "Enriched Post 1031\n";
}

// 3. Post 1032 (Alternator Failure)
$p1032 = Post::find(1032);
if ($p1032) {
    $addon = '
<h2>Certified Alternator Testing and Standby Generator Deployment</h2>
<p>Prevent catastrophic electrical failure with comprehensive preventive engineering:</p>
<ul>
    <li><a href="/service/generator-maintenance-and-repair">Alternator Rewinding & AVR Service</a> &bull; Megger insulation testing and load bank certification.</li>
    <li><a href="/service/cummins-generator-rental-uae">Cummins Generator Rental</a> &bull; Heavy-duty replacement power with digital Deep Sea controllers.</li>
    <li><a href="/fleet/250-kva-generator-rental">250 kVA Industrial Gensets</a> &bull; Ready for 24/7 delivery across Dubai & Abu Dhabi.</li>
</ul>';
    $p1032->content .= $addon;
    $res = $calc->calculateForModel($p1032);
    $p1032->seo_score = $res['seo_score'];
    $p1032->readability_score = $res['readability_score'];
    $p1032->save();
    echo "Enriched Post 1032\n";
}

// 4. Post 1035 (Excessive Fuel Consumption)
$p1035 = Post::find(1035);
if ($p1035) {
    $addon = '
<h2>Optimize Fuel Efficiency with Certified UAE Power Fleets</h2>
<p>Cut operational fuel costs with fuel-optimized modern diesel generators:</p>
<ul>
    <li><a href="/service/rental-generator-in-uae">High-Efficiency Rental Generators</a> &bull; Modern common-rail electronic injection systems.</li>
    <li><a href="/service/caterpillar-generator-rental-uae">Caterpillar Diesel Gensets</a> &bull; Tier 2/3 fuel-optimized industrial engines.</li>
    <li><a href="/service/generator-maintenance-and-repair">Injector & Turbocharger Overhaul</a> &bull; Complete calibration and load bank efficiency testing.</li>
</ul>';
    $p1035->content .= $addon;
    $res = $calc->calculateForModel($p1035);
    $p1035->seo_score = $res['seo_score'];
    $p1035->readability_score = $res['readability_score'];
    $p1035->save();
    echo "Enriched Post 1035\n";
}

// 5. Post 1038 (Inspect Before Buying Used Generator)
$p1038 = Post::find(1038);
if ($p1038) {
    $addon = '
<h2>Certified Pre-Owned Generators and Rental Options</h2>
<p>Ensure reliable long-term performance when acquiring secondary power equipment:</p>
<ul>
    <li><a href="/used-refurbished-generators">Certified Used & Refurbished Generators</a> &bull; Fully load-tested Caterpillar and Cummins units.</li>
    <li><a href="/service/rental-generator-in-uae">Rental vs Purchase Alternatives</a> &bull; Zero CAPEX turnkey power hire with full maintenance.</li>
    <li><a href="/service/generator-maintenance-and-repair">Pre-Purchase Technical Inspection</a> &bull; Complete compression, alternator megger, and fluid analysis.</li>
</ul>';
    $p1038->content .= $addon;
    $res = $calc->calculateForModel($p1038);
    $p1038->seo_score = $res['seo_score'];
    $p1038->readability_score = $res['readability_score'];
    $p1038->save();
    echo "Enriched Post 1038\n";
}

// 6. Post 1045 (Resale Value of Used Diesel Generator)
$p1045 = Post::find(1045);
if ($p1045) {
    $addon = '
<h2>Maximize Equipment Value with Professional Refurbishment</h2>
<p>Maintain peak residual value for your industrial generator assets:</p>
<ul>
    <li><a href="/used-refurbished-generators">Buy & Sell Used Generators in UAE</a> &bull; Fair market valuation and certified equipment buyback.</li>
    <li><a href="/service/generator-maintenance-and-repair">Complete Engine Overhauling</a> &bull; Documented maintenance histories to increase resale valuation.</li>
    <li><a href="/fleet">Browse Available Fleet Units</a> &bull; Compare current market specs across 50 kVA to 1250 kVA.</li>
</ul>';
    $p1045->content .= $addon;
    $res = $calc->calculateForModel($p1045);
    $p1045->seo_score = $res['seo_score'];
    $p1045->readability_score = $res['readability_score'];
    $p1045->save();
    echo "Enriched Post 1045\n";
}

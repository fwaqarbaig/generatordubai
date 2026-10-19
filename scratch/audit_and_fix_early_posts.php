<?php

use App\Models\Post;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$earlyPosts = Post::whereBetween('id', [988, 1009])->get();
$calc = app(YoastSeoScoreCalculator::class);

foreach ($earlyPosts as $post) {
    if ($post->id === 1005) {
        continue; // Already upgraded
    }

    $content = $post->content;
    $original = $content;

    // 1. Replace legacy URL patterns with clean canonical routes
    $content = str_replace(
        ['/services/generator/rental-generator-in-uae/', '/services/generator/rental-generator-in-uae'],
        '/service/rental-generator-in-uae',
        $content
    );
    $content = str_replace(
        ['/services/cooling/rental-chiller-in-uae/', '/services/cooling/rental-chiller-in-uae'],
        '/service/rental-chiller-in-uae',
        $content
    );
    $content = str_replace(
        ['/services/cooling/rental-ac-in-uae/', '/services/cooling/rental-ac-in-uae'],
        '/service/rental-ac-in-uae',
        $content
    );
    $content = str_replace(
        ['/services/buy-sell/portacabin-for-sale-in-uae/', '/services/buy-sell/portacabin-for-sale-in-uae'],
        '/service/portacabin-for-sale-in-uae',
        $content
    );
    $content = str_replace(
        ['https://rentalgenerator.ae/generator-rental/', 'https://rentalpower.ae', 'https://rentalpower.ae/'],
        ['/service/rental-generator-in-uae', '/', '/'],
        $content
    );

    // 2. Contextual enrichment for posts with few links
    $linkCount = preg_match_all('/<a\s+[^>]*href=["\'][^"\']+["\'][^>]*>/i', $content);

    // If it's a cooling post and has few links, add service links
    if ($linkCount < 4) {
        if (str_contains($post->slug, 'cooling') || str_contains($post->slug, 'chiller') || str_contains($post->slug, 'ac')) {
            $ctaHtml = '
<h2>Temporary Cooling Services in the UAE</h2>
<p>Rental Power UAE delivers industrial-grade temperature control solutions across Dubai, Abu Dhabi, and the Northern Emirates. Explore our specialized services:</p>
<ul>
    <li><a href="/service/rental-cooling">Industrial Rental Cooling</a> &bull; Air-cooled and water-cooled chiller packages from 50 TR to 1000 TR.</li>
    <li><a href="/service/rental-chiller-in-uae">Rental Chiller Services</a> &bull; Fast-dispatch chillers for district cooling backup and industrial plant cooling.</li>
    <li><a href="/service/packaged-ac-units-rental-uae">Packaged AC Units Rental</a> &bull; High-ambient ducted package units and temporary event cooling.</li>
    <li><a href="/service/rental-ac-in-uae">Emergency Commercial AC Rental</a> &bull; Spot coolers and portable air conditioners for critical facilities.</li>
    <li><a href="/service/rental-generator-in-uae">Turnkey Generator Rental</a> &bull; Prime and standby power generation from 20 kVA to 2500 kVA.</li>
</ul>
<p>Contact our thermal engineering specialists at <strong>+971 56 921 3754</strong> or explore our depots in <a href="/locations/dubai">Dubai</a>, <a href="/locations/abu-dhabi">Abu Dhabi</a>, and <a href="/locations/sharjah">Sharjah</a>.</p>';
            $content .= $ctaHtml;
        } elseif (str_contains($post->slug, 'generator') || str_contains($post->slug, 'power') || str_contains($post->slug, 'fuel')) {
            $ctaHtml = '
<h2>Turnkey Industrial Power Services in the UAE</h2>
<p>Rental Power UAE provides complete temporary power engineering across Dubai, Abu Dhabi, and Sharjah:</p>
<ul>
    <li><a href="/service/rental-generator-in-uae">Turnkey Generator Rental</a> &bull; 20 kVA to 2500 kVA soundproof diesel gensets.</li>
    <li><a href="/service/cummins-generator-rental-uae">Cummins Generator Rental</a> &bull; Heavy-duty prime power engines for demanding continuous loads.</li>
    <li><a href="/service/caterpillar-generator-rental-uae">Caterpillar Generator Rental</a> &bull; Robust 50&deg;C ambient rated generators for construction and mining.</li>
    <li><a href="/fleet/500kva-generator-hire">500 kVA Silent Genset</a> &bull; Ideal for commercial high-rises and batching plants.</li>
    <li><a href="/fleet/1000-kva-generator-rental">1000 kVA Synchronized Power</a> &bull; Multi-megawatt scalable installations.</li>
    <li><a href="/service/generator-maintenance-and-repair">Generator Maintenance & Repair</a> &bull; 24/7 emergency service and load banking.</li>
</ul>
<p>Request an immediate engineering quote at <strong>+971 56 921 3754</strong> or visit our depots in <a href="/locations/dubai">Dubai</a>, <a href="/locations/abu-dhabi">Abu Dhabi</a>, and <a href="/locations/sharjah">Sharjah</a>.</p>';
            $content .= $ctaHtml;
        } elseif (str_contains($post->slug, 'portacabin')) {
            $ctaHtml = '
<h2>Modular Portacabins & Site Accommodation Services</h2>
<p>Rental Power UAE manufactures, supplies, and relocates premium prefabricated modular structures across the UAE:</p>
<ul>
    <li><a href="/service/portacabin-for-sale-in-uae">Portacabins for Sale in UAE</a> &bull; Executive office cabins, accommodation units, and ablution blocks.</li>
    <li><a href="/service/used-container-in-uae">Used Storage Containers</a> &bull; 20ft and 40ft modified steel shipping containers.</li>
    <li><a href="/service/rental-cooling">Modular Cabin Cooling</a> &bull; Dedicated ducted split and packaged AC systems.</li>
    <li><a href="/service/rental-generator-in-uae">Site Power Packages</a> &bull; Low-noise generators for remote accommodation compounds.</li>
</ul>
<p>Get immediate cabin delivery specifications from our <a href="/locations/dubai">Dubai</a>, <a href="/locations/abu-dhabi">Abu Dhabi</a>, and <a href="/locations/sharjah">Sharjah</a> teams.</p>';
            $content .= $ctaHtml;
        }
    }

    if ($content !== $original) {
        $post->content = $content;
        $res = $calc->calculateForModel($post);
        $post->seo_score = $res['seo_score'];
        $post->readability_score = $res['readability_score'];
        $post->save();
        echo "Updated Post {$post->id}: {$post->title} (Words: ".str_word_count(strip_tags($post->content)).", SEO: {$post->seo_score}, Readability: {$post->readability_score})\n";
    }
}

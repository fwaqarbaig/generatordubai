<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use Illuminate\Contracts\Console\Kernel;

echo "=== ENRICHING ALL 118 BLOG POSTS WITH VALID IMAGES & CONTEXTUAL CONTENT FIGURES ===\n";

$pools = [
    'cooling' => [
        'storage/media/rental-chiller-service-uae.webp',
        'storage/media/air-cooled-chiller.webp',
        'storage/media/air-cooled-chiller-1.webp',
        'storage/media/industrial-chiller.webp',
        'storage/media/industrial-chiller-1.webp',
        'storage/media/chiller-rental-in-uae.webp',
        'storage/media/chiller-rental-service.webp',
        'storage/media/water-cooled-chiller-for-rent-in-uae.webp',
        'storage/media/Packaged-ac-unit-rental-in-uae.webp',
        'storage/media/portable-ac-for-rent.webp',
        'storage/media/Commercial-AC-Rental-UAE.png',
        'storage/media/Spot-Cooler-Rental-UAE.png',
        'storage/media/Chiller-Rental-for-Events-in-UAE.webp',
        'storage/media/District-Cooling-HVAC-Rental-Support-in-UAE.webp',
        'storage/media/tc-in-uae.jpg',
        'storage/media/wild-air.jpg',
    ],
    'generators' => [
        'storage/media/Power-Generator-Rental.jpg',
        'storage/media/rental-generator.webp',
        'storage/media/rental-power.webp',
        'storage/media/100kva-generator-rental.webp',
        'storage/media/500kva-generator-rental.webp',
        'storage/media/1000kva-generator-rental.webp',
        'storage/media/Diesel-Generator.webp',
        'storage/media/Silent-Generator.webp',
        'storage/media/gen-constr.jpg',
        'storage/media/Portable-generator.webp',
        'storage/media/cummins-500kw-generator-rental.webp',
        'storage/media/generator-rental-uae.jpg',
    ],
    'maintenance' => [
        'storage/media/generator-maintenance-in-uae.webp',
        'storage/media/maintenance-and-amc-service-in-dubai.webp',
        'storage/media/rental-gen-service.jpg',
        'storage/media/service4.jpg',
        'storage/media/Why-Heat-Is-a-Bigger-Problem.jpg',
        'storage/media/Silent-generator.jpg',
        'storage/media/b-1.jpg',
        'storage/media/ultimate.jpg',
    ],
    'used_equipment' => [
        'storage/media/Power-Generator-Rental.jpg',
        'storage/media/500kva-generator-rental.webp',
        'storage/media/1000kva-generator-rental.webp',
        'storage/media/Diesel-Generator.webp',
        'storage/media/used-chiller.jpg',
        'storage/media/used-chiller-buyer.jpg',
        'storage/media/used-con.jpg',
    ],
    'portacabins' => [
        'storage/media/portacabin-for-sale-in-uae.jpg',
        'storage/media/Refurbished-portacabin-for-sale-in-uae.webp',
        'storage/media/Used-Portacabin-for-sale-in-uae.webp',
        'storage/media/New-Portacabin-in-uae.webp',
        'storage/media/portable-office-cabin.webp',
        'storage/media/Portacabin-Toilet-Ablution-Units.webp',
        'storage/media/Labour-Portable-Accommodation-Cabins.webp',
        'storage/media/Prefabricated-Cabins.webp',
        'storage/media/Security-Cabins.webp',
        'storage/media/portacabin-buyer-in-uae.jpg',
        'storage/media/used-porat-in-dubai.jpg',
        'storage/media/used-poratacabin-in-uae.jpg',
    ],
];

function getPostCategory(Post $p): string
{
    $text = strtolower($p->title.' '.$p->slug.' '.($p->categories->first()?->name ?? ''));
    if (str_contains($text, 'cabin') || str_contains($text, 'portacabin')) {
        return 'portacabins';
    }
    if (str_contains($text, 'chiller') || str_contains($text, 'chilled') || str_contains($text, 'cool') || str_contains($text, ' ac') || str_contains($text, 'hvac') || str_contains($text, 'air conditioning') || str_contains($text, 'spot cooler')) {
        return 'cooling';
    }
    if (str_contains($text, 'maint') || str_contains($text, 'servic') || str_contains($text, 'overheat') || str_contains($text, 'smoke') || str_contains($text, 'oil') || str_contains($text, 'alternator') || str_contains($text, 'crank') || str_contains($text, 'battery') || str_contains($text, 'amc') || str_contains($text, 'troubleshoot') || str_contains($text, 'load bank')) {
        return 'maintenance';
    }
    if (str_contains($text, 'used') || str_contains($text, 'refurbish') || str_contains($text, 'second-hand') || str_contains($text, 'resale') || str_contains($text, 'scrap') || str_contains($text, 'buying')) {
        return 'used_equipment';
    }

    return 'generators';
}

$posts = Post::with('categories')->get();
$updatedCount = 0;

foreach ($posts as $idx => $p) {
    $cat = getPostCategory($p);
    $pool = $pools[$cat];
    $poolCount = count($pool);

    // 1. Normalize and fix featured_image
    $feat = $p->featured_image;
    if (empty($feat)) {
        $feat = $pool[$idx % $poolCount];
    } else {
        // Fix known broken filenames
        $feat = str_replace('Power-Generation-Equipment-Rental.jpg', 'Power-Generator-Rental.jpg', $feat);
        $feat = str_replace('Diesel-Generator-Rental.jpg', 'Diesel-Generator.webp', $feat);

        // Strip localhost
        if (str_contains($feat, 'localhost:8000')) {
            $parsed = parse_url($feat, PHP_URL_PATH);
            $feat = ltrim($parsed, '/');
        } else {
            $feat = ltrim($feat, '/');
        }

        if (! str_starts_with($feat, 'storage/')) {
            $feat = 'storage/'.ltrim($feat, '/');
        }

        // Verify disk existence
        $checkPath = public_path($feat);
        if (! file_exists($checkPath)) {
            $feat = $pool[$idx % $poolCount];
        }
    }

    $p->featured_image = $feat;
    $p->og_image = $feat;

    // 2. Select 2 distinct content images from the pool that differ from featured_image
    $availableImages = array_values(array_filter($pool, fn ($img) => $img !== $feat));
    $availCount = count($availableImages);
    $img1Src = $availableImages[$idx % $availCount];
    $img2Src = $availableImages[($idx + 3) % $availCount];

    // Check if content already has 2 images
    $content = $p->content ?? '';
    preg_match_all('/<img[^>]+>/i', $content, $existingImgs);
    $currentImgCount = count($existingImgs[0]);

    if ($currentImgCount < 2) {
        $titleSanitized = e($p->title);

        $caption1 = match ($cat) {
            'cooling' => 'Temporary cooling and commercial chiller engineering installation deployed in UAE climate conditions.',
            'maintenance' => 'Comprehensive preventive maintenance, diagnostics, and testing protocols for industrial power equipment.',
            'portacabins' => 'High-quality modular site office cabin engineered with thermal insulation and heavy structural steel skid.',
            'used_equipment' => 'Certified load-tested machinery inspected for prime operational reliability and performance.',
            default => 'Heavy-duty diesel power generation fleet engineered for continuous 24/7 industrial and construction demand.',
        };

        $caption2 = match ($cat) {
            'cooling' => 'High-ambient modular air conditioning and chilled water distribution supporting critical operations.',
            'maintenance' => 'On-site mechanical inspection, electrical insulation Megger testing, and fluid analysis.',
            'portacabins' => 'Turnkey portable site accommodation equipped with commercial vinyl flooring and DEWA-standard electricals.',
            'used_equipment' => 'Rigorous 50-point quality verification and resistive load bank testing before project deployment.',
            default => 'Soundproof acoustic canopy diesel generator providing reliable uninterrupted temporary site power.',
        };

        $fig1 = <<<HTML
<figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
    <img src="/{$img1Src}" alt="{$titleSanitized} - Technical Overview & Sizing" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
    <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
        {$caption1}
    </figcaption>
</figure>
HTML;

        $fig2 = <<<HTML
<figure class="my-8 rounded-2xl overflow-hidden shadow-sm border border-slate-200 not-prose bg-white">
    <img src="/{$img2Src}" alt="{$titleSanitized} - Operational Reliability & Field Setup" loading="lazy" class="w-full h-auto object-cover max-h-[460px]">
    <figcaption class="p-3 bg-slate-50 text-center text-xs text-slate-600 font-medium border-t border-slate-100">
        {$caption2}
    </figcaption>
</figure>
HTML;

        // Position figures in article
        if (str_contains($content, '</h2>')) {
            $h2Parts = explode('</h2>', $content);
            if (count($h2Parts) >= 3) {
                // Insert fig1 after 1st H2
                $content = $h2Parts[0].'</h2>'."\n".$fig1."\n".$h2Parts[1].'</h2>';
                // Insert fig2 before the penultimate or last H2
                $middleIndex = (int) floor(count($h2Parts) / 2);
                for ($k = 2; $k < count($h2Parts); $k++) {
                    if ($k === $middleIndex) {
                        $content .= "\n".$fig2."\n";
                    }
                    $content .= $h2Parts[$k];
                    if ($k < count($h2Parts) - 1) {
                        $content .= '</h2>';
                    }
                }
            } else {
                $content = $h2Parts[0].'</h2>'."\n".$fig1."\n".$h2Parts[1]."\n".$fig2;
            }
        } else {
            // Fallback for posts without H2: insert after paragraphs
            $pParts = explode('</p>', $content);
            if (count($pParts) >= 4) {
                $content = $pParts[0].'</p>'.$pParts[1].'</p>'."\n".$fig1."\n";
                $mid = (int) floor(count($pParts) / 2);
                for ($m = 2; $m < count($pParts); $m++) {
                    if ($m === $mid) {
                        $content .= "\n".$fig2."\n";
                    }
                    $content .= $pParts[$m];
                    if ($m < count($pParts) - 1) {
                        $content .= '</p>';
                    }
                }
            } else {
                $content = $fig1."\n".$content."\n".$fig2;
            }
        }

        $p->content = $content;
    }

    $p->save();
    $updatedCount++;
}

echo "=== SUCCESSFULLY ENRICHED ALL {$updatedCount} BLOG POSTS WITH IMAGES ===\n";

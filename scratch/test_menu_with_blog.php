<?php

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

$request = Request::create('/', 'GET');
$response = $app->handle($request);

echo 'Status Code: '.$response->getStatusCode().PHP_EOL;
$content = $response->getContent();

// Check if Blog link is in the navbar
$hasBlogLink = str_contains($content, 'href="http://localhost/blog"') || str_contains($content, 'href="/blog"');
echo 'Blog Link in Nav Found: '.($hasBlogLink ? 'YES' : 'NO').PHP_EOL;

// Check if Contact Us link is in the navbar
$hasContactLink = str_contains($content, 'href="http://localhost/contact-us"') || str_contains($content, 'href="/contact-us"');
echo 'Contact Us Link in Nav Found: '.($hasContactLink ? 'YES' : 'NO').PHP_EOL;

// Check if Services dropdown is in the navbar
$hasServicesLink = str_contains($content, 'Services');
echo 'Services in Nav Found: '.($hasServicesLink ? 'YES' : 'NO').PHP_EOL;

// Extract top nav items text
preg_match_all('/<a[^>]*class="[^"]*text-sm[^"]*"[^>]*>(.*?)<\/a>/s', $content, $matches);
echo "Desktop Nav Links detected:\n";
foreach ($matches[1] as $m) {
    $clean = trim(strip_tags($m));
    if (! empty($clean)) {
        echo ' - '.$clean.PHP_EOL;
    }
}

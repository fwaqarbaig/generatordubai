<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoImageOptimizer
{
    /**
     * Maximum allowed file size in kilobytes (20 MB).
     */
    public const MAX_FILE_SIZE_KB = 20480;

    /**
     * Allowed image and document extensions.
     *
     * @var list<string>
     */
    public const ALLOWED_EXTENSIONS = [
        'jpeg', 'jpg', 'png', 'webp', 'gif', 'svg', 'bmp',
        'pdf', 'doc', 'docx', 'xlsx', 'csv', 'txt',
    ];

    /**
     * Disallowed / executable dangerous extensions.
     *
     * @var list<string>
     */
    public const DISALLOWED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'php8', 'phps', 'phar',
        'sh', 'bash', 'cgi', 'pl', 'py', 'exe', 'bat', 'cmd', 'vbs', 'jsp',
        'asp', 'aspx', 'shtml', 'env', 'htaccess', 'htpasswd', 'config', 'html', 'htm',
    ];

    /**
     * Common component / feature keywords that warrant an editorial caption.
     *
     * @var list<string>
     */
    protected const CAPTIONABLE_KEYWORDS = [
        'canopy', 'radiator', 'alternator', 'control panel', 'dse', 'switchgear',
        'cabling', 'wiring', 'load bank', 'fuel tank', 'compressor', 'evaporator',
        'condenser', 'piping', 'chilled water', 'skid', 'rigging', 'crane', 'delivery',
        'testing', 'maintenance', 'inspection', 'baffle', 'exhaust', 'ats',
    ];

    /**
     * Optimize an uploaded file by generating SEO metadata, clean filename, and validating constraints.
     *
     * @param  UploadedFile  $file  The uploaded file instance.
     * @param  string|null  $context  The relevant page, post, product, or service title/topic.
     * @param  array<string, mixed>  $options  Manual overrides and settings (is_decorative, etc.).
     * @return array{
     *     alt_text: string,
     *     title: string,
     *     caption: ?string,
     *     seo_filename: string,
     *     is_decorative: bool,
     *     target_extension: string
     * }
     */
    public function optimize(UploadedFile $file, ?string $context = null, array $options = []): array
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $originalExt = strtolower($file->getClientOriginalExtension());
        $mime = (string) ($file->getMimeType() ?: '');

        // Determine target extension (raster images convert to webp)
        $targetExt = in_array($originalExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp'], true) ? 'webp' : $originalExt;

        // Inspect image dimensions if readable
        $dimensions = null;
        $width = 0;
        $height = 0;
        $realPath = $file->getRealPath();
        if ($realPath && file_exists($realPath) && str_starts_with($mime, 'image/')) {
            $info = @getimagesize($realPath);
            if ($info) {
                $width = (int) $info[0];
                $height = (int) $info[1];
                $dimensions = "{$width}x{$height}";
            }
        }

        // 1. Check if decorative
        $isDecorative = $this->isDecorativeImage($originalName, $originalExt, $width, $height, $options);
        if ($isDecorative) {
            $safeSlug = Str::slug($this->cleanOriginalName($originalName)) ?: 'decorative-graphic';
            $seoFilename = $this->generateUniqueFilename($safeSlug, $targetExt);

            return [
                'alt_text' => '', // Pure empty alt for decorative imagery
                'title' => $options['title'] ?? Str::title(str_replace('-', ' ', $safeSlug)),
                'caption' => null,
                'seo_filename' => $seoFilename,
                'is_decorative' => true,
                'target_extension' => $targetExt,
            ];
        }

        // 2. Clean and analyze original filename
        $cleanedName = $this->cleanOriginalName($originalName);
        $cleanContext = $this->cleanContextString($context);

        // 3. Determine if image is unrelated to the context topic
        $isUnrelated = $this->isImageUnrelatedToContext($cleanedName, $cleanContext);

        // 4. Generate SEO Alt Text
        if (! empty($options['alt_text'])) {
            $altText = trim($options['alt_text']);
        } elseif ($isUnrelated) {
            // Describe actual content instead of blindly copying page topic
            $altText = $this->generateDescriptiveAltFromContent($cleanedName);
        } elseif (! empty($cleanContext)) {
            // Fuse context with specific component or action
            $altText = $this->generateContextualAlt($cleanContext, $cleanedName, $width, $height);
        } else {
            // Missing context fallback
            $altText = $this->generateFallbackAlt($cleanedName, $width, $height);
        }

        // 5. Generate SEO Title
        if (! empty($options['title'])) {
            $title = trim($options['title']);
        } elseif ($isUnrelated) {
            $title = Str::title($cleanedName);
        } elseif (! empty($cleanContext)) {
            $title = $this->generateContextualTitle($cleanContext, $cleanedName);
        } else {
            $title = $this->generateFallbackTitle($cleanedName);
        }

        // 6. Generate Caption (Only when appropriate)
        $caption = null;
        if (! empty($options['caption'])) {
            $caption = trim($options['caption']);
        } else {
            $caption = $this->generateSelectiveCaption($cleanContext, $cleanedName, $isUnrelated);
        }

        // 7. Generate SEO Filename
        $filenameBase = $this->generateFilenameBase($cleanContext, $cleanedName, $isUnrelated, $options);
        $seoFilename = $this->generateUniqueFilename($filenameBase, $targetExt);

        return [
            'alt_text' => $altText,
            'title' => $title,
            'caption' => $caption,
            'seo_filename' => $seoFilename,
            'is_decorative' => false,
            'target_extension' => $targetExt,
        ];
    }

    /**
     * Check if the image is decorative based on filename, size, or explicit options.
     */
    protected function isDecorativeImage(string $name, string $ext, int $width, int $height, array $options): bool
    {
        if (! empty($options['is_decorative'])) {
            return true;
        }

        $lower = strtolower($name);

        // Explicit decorative naming conventions
        if (preg_match('/\b(icon|arrow|bullet|divider|separator|spacer|decor|pattern|bg-|shape|border)\b/i', $lower)) {
            return true;
        }

        // Tiny utility/icon dimensions (e.g. 16x16, 24x24, 32x32, up to 48x48)
        if ($width > 0 && $height > 0 && $width <= 48 && $height <= 48) {
            return true;
        }

        return false;
    }

    /**
     * Clean raw filename: remove camera prefixes, timestamps, hashes, and hyphens.
     */
    protected function cleanOriginalName(string $name): string
    {
        // Strip camera prefixes (IMG_, DSC_, PXL_, WhatsApp Image, Screenshot, etc.)
        $cleaned = preg_replace('/^(IMG|DSC|PXL|PHOTO|PIC|IMAGE|Screenshot|Screen Shot|WhatsApp Image)[\-_0-9\s]+/i', '', $name);

        // Strip timestamp clusters and random hex hashes (e.g. 20261019_182941, -im4l8z, -4f9a)
        $cleaned = preg_replace('/[\-_][a-f0-9]{5,16}\b/i', '', (string) $cleaned);
        $cleaned = preg_replace('/\b20\d{6,}\b/', '', (string) $cleaned);

        // Replace separators with spaces
        $cleaned = str_replace(['_', '-', '.'], ' ', (string) $cleaned);

        // Remove redundant duplicate spaces
        $cleaned = trim(preg_replace('/\s+/', ' ', (string) $cleaned));

        return $cleaned ?: 'equipment';
    }

    /**
     * Clean and normalize page/topic context string.
     */
    protected function cleanContextString(?string $context): ?string
    {
        if (empty($context)) {
            return null;
        }

        // Strip common redundant suffixes (e.g. " - Rental Power UAE", "| Rental Power")
        $cleaned = preg_replace('/\s*[-|]\s*Rental Power.*$/i', '', $context);
        $cleaned = trim((string) $cleaned);

        return $cleaned ?: null;
    }

    /**
     * Determine if the image filename represents an unrelated topic from the context.
     */
    protected function isImageUnrelatedToContext(string $cleanedName, ?string $context): bool
    {
        if (empty($context)) {
            return false;
        }

        $nameLower = strtolower($cleanedName);

        // Known non-machinery / corporate / human topic keywords
        $unrelatedKeywords = [
            'meeting', 'conference', 'office', 'lunch', 'dinner', 'cake', 'party',
            'team', 'staff', 'award', 'trophy', 'handshake', 'signature', 'contract',
            'avatar', 'profile', 'headshot', 'portrait', 'building facade', 'reception',
            'certificate', 'iso certificate', 'chart', 'graph', 'infographic',
        ];

        foreach ($unrelatedKeywords as $keyword) {
            if (str_contains($nameLower, $keyword)) {
                // Check if context specifically mentions this keyword
                if (! str_contains(strtolower($context), $keyword)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Generate descriptive Alt text for unrelated content.
     */
    protected function generateDescriptiveAltFromContent(string $cleanedName): string
    {
        $words = Str::title($cleanedName);

        return "{$words} at Rental Power UAE facility";
    }

    /**
     * Generate contextual Alt text fusing context with image details.
     */
    protected function generateContextualAlt(string $context, string $cleanedName, int $width, int $height): string
    {
        $detectedComponent = $this->detectSpecificComponent($cleanedName);
        $location = $this->detectLocationContext($cleanedName) ?: 'UAE';

        if ($detectedComponent) {
            return "{$context} {$detectedComponent} on site in {$location}";
        }

        // Layout-based phrasing to prevent duplicate generic text across images
        $aspect = ($width > 0 && $height > 0) ? ($width / $height) : 1.5;
        if ($aspect >= 2.2) {
            return "{$context} panoramic view and site deployment in {$location}";
        }

        return "{$context} unit deployed for commercial operations in {$location}";
    }

    /**
     * Generate fallback Alt text when no context is provided.
     */
    protected function generateFallbackAlt(string $cleanedName, int $width, int $height): string
    {
        $nameLower = strtolower($cleanedName);

        // Check if cleaned name has meaningful domain words
        $hasDomainWord = preg_match('/\b(generator|chiller|ac|cooling|portacabin|cummins|perkins|power|diesel)\b/i', $nameLower);
        if ($hasDomainWord) {
            $words = Str::title($cleanedName);

            return "{$words} for commercial temporary rental in UAE";
        }

        return 'Industrial temporary power and cooling equipment deployed on site in UAE';
    }

    /**
     * Generate contextual image title.
     */
    protected function generateContextualTitle(string $context, string $cleanedName): string
    {
        $detectedComponent = $this->detectSpecificComponent($cleanedName);
        if ($detectedComponent) {
            return Str::title("{$context} - ".Str::title($detectedComponent));
        }

        return Str::title($context);
    }

    /**
     * Generate fallback image title when no context is provided.
     */
    protected function generateFallbackTitle(string $cleanedName): string
    {
        $words = Str::title($cleanedName);
        if ($words !== 'Equipment') {
            return "{$words} - Rental Power UAE";
        }

        return 'Industrial Power & Cooling Equipment UAE';
    }

    /**
     * Selectively generate a caption only when the image depicts a technical component or procedure.
     */
    protected function generateSelectiveCaption(?string $context, string $cleanedName, bool $isUnrelated): ?string
    {
        if ($isUnrelated) {
            return null;
        }

        $detectedComponent = $this->detectSpecificComponent($cleanedName);
        if ($detectedComponent && ! empty($context)) {
            return Str::title($detectedComponent)." on {$context} engineered for high-ambient UAE operations.";
        }

        return null;
    }

    /**
     * Generate a keyword-rich, lowercase, hyphenated base for the filename.
     */
    protected function generateFilenameBase(?string $context, string $cleanedName, bool $isUnrelated, array $options): string
    {
        if (! empty($options['custom_filename'])) {
            return Str::slug(pathinfo($options['custom_filename'], PATHINFO_FILENAME));
        }

        if ($isUnrelated) {
            return Str::slug($cleanedName.'-dubai');
        }

        $detectedComponent = $this->detectSpecificComponent($cleanedName);
        $location = $this->detectLocationContext($cleanedName) ?: 'dubai';

        if (! empty($context)) {
            $slugBase = Str::slug($context);
            if ($detectedComponent) {
                $componentSlug = Str::slug($detectedComponent);
                if (! str_contains($slugBase, $componentSlug)) {
                    $slugBase .= '-'.$componentSlug;
                }
            }
            if (! str_contains($slugBase, 'dubai') && ! str_contains($slugBase, 'uae')) {
                $slugBase .= '-'.$location;
            }

            return $slugBase;
        }

        // Fallback filename base
        $hasDomainWord = preg_match('/\b(generator|chiller|ac|cooling|portacabin|cummins|perkins|power|diesel)\b/i', $cleanedName);
        if ($hasDomainWord) {
            return Str::slug($cleanedName.'-dubai');
        }

        return 'power-cooling-equipment-dubai';
    }

    /**
     * Detect specific mechanical or technical components from cleaned name.
     */
    protected function detectSpecificComponent(string $cleanedName): ?string
    {
        $nameLower = strtolower($cleanedName);

        $components = [
            'acoustic canopy' => ['canopy', 'soundproof', 'acoustic', 'enclosure'],
            'tropical radiator' => ['radiator', 'cooling fan', 'heat exchanger'],
            'control panel' => ['control panel', 'controller', 'dse', 'deep sea', 'switchgear', 'meter'],
            'heavy cabling' => ['cable', 'cabling', 'wiring', 'powerlock', 'lug'],
            'chilled water piping' => ['pipe', 'piping', 'hose', 'bauer', 'camlock', 'flange'],
            'twin screw compressor' => ['compressor', 'screw compressor', 'bitzer', 'hanbell'],
            'evaporator skid' => ['evaporator', 'heat exchanger', 'chiller skid'],
            'bulk fuel tank' => ['fuel tank', 'bulk tank', 'bunded tank'],
            'load bank testing' => ['load bank', 'load test', 'resistive test'],
            'automatic transfer switch' => ['ats', 'transfer switch', 'amf'],
            'crane rigging delivery' => ['crane', 'rigging', 'truck', 'delivery', 'transport'],
        ];

        foreach ($components as $label => $triggers) {
            foreach ($triggers as $trigger) {
                if (str_contains($nameLower, $trigger)) {
                    return $label;
                }
            }
        }

        return null;
    }

    /**
     * Detect UAE city or location context from filename.
     */
    protected function detectLocationContext(string $name): ?string
    {
        $nameLower = strtolower($name);

        if (str_contains($nameLower, 'abu dhabi')) {
            return 'abu-dhabi';
        }
        if (str_contains($nameLower, 'sharjah')) {
            return 'sharjah';
        }
        if (str_contains($nameLower, 'dubai')) {
            return 'dubai';
        }
        if (str_contains($nameLower, 'uae')) {
            return 'uae';
        }

        return null;
    }

    /**
     * Ensure generated filename is unique within storage and database.
     */
    public function generateUniqueFilename(string $slug, string $extension, string $directory = 'uploads'): string
    {
        $cleanExt = ltrim($extension, '.');
        $baseName = Str::slug($slug);
        if (empty($baseName)) {
            $baseName = 'image';
        }

        $candidate = "{$baseName}.{$cleanExt}";
        $counter = 1;

        // Check against storage and database
        while ($this->filenameExists($candidate, $directory)) {
            $counter++;
            $candidate = "{$baseName}-{$counter}.{$cleanExt}";
            if ($counter > 50) {
                $candidate = "{$baseName}-".Str::random(5).".{$cleanExt}";
                break;
            }
        }

        return strtolower($candidate);
    }

    /**
     * Check if a candidate filename already exists in storage or media database.
     */
    protected function filenameExists(string $filename, string $directory): bool
    {
        $relativePath = trim($directory, '/').'/'.$filename;

        // Check storage disk
        if (Storage::disk('public')->exists($relativePath)) {
            return true;
        }

        // Check public/storage path
        if (file_exists(public_path('storage/'.$relativePath))) {
            return true;
        }

        // Check database
        if (Media::where('file_name', $filename)->exists()) {
            return true;
        }

        return false;
    }
}

<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class ImageWebpConverter
{
    /**
     * Supported raster image extensions that should be converted to WebP.
     *
     * @var list<string>
     */
    protected const CONVERTIBLE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

    /**
     * Check if a file is an image eligible for WebP conversion.
     */
    public function isConvertible(UploadedFile|string $file): bool
    {
        $extension = $file instanceof UploadedFile
            ? strtolower($file->getClientOriginalExtension())
            : strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $mime = $file instanceof UploadedFile
            ? $file->getMimeType()
            : (@mime_content_type($file) ?: '');

        return in_array($extension, self::CONVERTIBLE_EXTENSIONS, true)
            || (str_starts_with((string) $mime, 'image/') && ! in_array($extension, ['svg', 'webp'], true));
    }

    /**
     * Convert an uploaded file or path to WebP and return the converted binary content.
     */
    public function convertToWebpData(string $filePath, int $quality = 85): ?string
    {
        if (! file_exists($filePath) || ! is_readable($filePath)) {
            return null;
        }

        try {
            $rawContent = file_get_contents($filePath);
            if ($rawContent === false || strlen($rawContent) === 0) {
                return null;
            }

            $image = @imagecreatefromstring($rawContent);
            if (! $image) {
                return null;
            }

            // Correct EXIF orientation for JPEG camera / mobile uploads if EXIF extension is present
            if (function_exists('exif_read_data')) {
                try {
                    $exif = @exif_read_data($filePath);
                    if (! empty($exif['Orientation'])) {
                        $image = match ($exif['Orientation']) {
                            3 => imagerotate($image, 180, 0),
                            6 => imagerotate($image, -90, 0),
                            8 => imagerotate($image, 90, 0),
                            default => $image,
                        };
                    }
                } catch (Throwable) {
                    // Ignore EXIF parsing errors and proceed with conversion
                }
            }

            // Ensure full 24/32-bit truecolor palette and preserve alpha transparency (for PNG/GIF/WebP)
            imagepalettetotruecolor($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);

            // Buffer WebP output
            ob_start();
            $success = imagewebp($image, null, $quality);
            $webpData = ob_get_clean();

            imagedestroy($image);

            return ($success && $webpData !== false) ? $webpData : null;
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Process an uploaded file: convert raster images to WebP, or store non-convertible files directly.
     *
     * @return array{
     *     safe_name: string,
     *     path: string,
     *     mime_type: string,
     *     size: int,
     *     dimensions: ?string,
     *     converted_to_webp: bool
     * }
     */
    public function processUpload(
        UploadedFile $file,
        string $directory = 'uploads',
        int $quality = 85,
        string $disk = 'public',
        ?string $desiredFileName = null
    ): array {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $originalExtension = strtolower($file->getClientOriginalExtension());
        $realPath = $file->getRealPath();

        // 1. If it is a convertible raster image, convert to WebP
        if ($this->isConvertible($file)) {
            $webpData = $this->convertToWebpData($realPath, $quality);

            if ($webpData !== null && strlen($webpData) > 0) {
                if (! empty($desiredFileName)) {
                    $baseDesired = pathinfo($desiredFileName, PATHINFO_FILENAME);
                    $safeName = Str::slug($baseDesired).'.webp';
                } else {
                    $safeName = Str::slug($originalName).'-'.time().'-'.Str::random(6).'.webp';
                }
                $relativePath = trim($directory, '/').'/'.$safeName;

                // Store in configured disk
                Storage::disk($disk)->put($relativePath, $webpData);

                // Mirror to public/storage for universal direct web serving
                $this->mirrorFileToStoragePaths($relativePath, $webpData);

                // Calculate dimensions
                $dimensions = null;
                $info = @getimagesizefromstring($webpData);
                if ($info) {
                    $dimensions = "{$info[0]}x{$info[1]}";
                }

                return [
                    'safe_name' => $safeName,
                    'path' => $relativePath,
                    'mime_type' => 'image/webp',
                    'size' => strlen($webpData),
                    'dimensions' => $dimensions,
                    'converted_to_webp' => true,
                ];
            }
        }

        // 2. Fallback: Store original file directly (e.g. already WebP, SVG, or document)
        if (! empty($desiredFileName)) {
            $baseDesired = pathinfo($desiredFileName, PATHINFO_FILENAME);
            $desiredExt = strtolower(pathinfo($desiredFileName, PATHINFO_EXTENSION)) ?: $originalExtension;
            $safeName = Str::slug($baseDesired).'.'.$desiredExt;
        } else {
            $safeName = Str::slug($originalName).'-'.time().'-'.Str::random(6).'.'.$originalExtension;
        }
        $storedPath = $file->storeAs($directory, $safeName, $disk);

        // Mirror original file to public/storage if not already mirrored
        $this->mirrorStoredFile($storedPath);

        $mime = $file->getMimeType() ?: 'application/octet-stream';
        $dimensions = null;
        if (str_starts_with((string) $mime, 'image/')) {
            $info = @getimagesize($realPath);
            if ($info) {
                $dimensions = "{$info[0]}x{$info[1]}";
            }
        }

        return [
            'safe_name' => $safeName,
            'path' => $storedPath,
            'mime_type' => (string) $mime,
            'size' => (int) $file->getSize(),
            'dimensions' => $dimensions,
            'converted_to_webp' => $originalExtension === 'webp',
        ];
    }

    /**
     * Mirror written binary content between storage/app/public and public/storage.
     */
    protected function mirrorFileToStoragePaths(string $relativePath, string $content): void
    {
        $publicFile = public_path('storage/'.ltrim($relativePath, '/'));
        $appStorageFile = storage_path('app/public/'.ltrim($relativePath, '/'));

        $publicDir = dirname($publicFile);
        if (! is_dir($publicDir)) {
            @mkdir($publicDir, 0755, true);
        }
        @file_put_contents($publicFile, $content);

        $appDir = dirname($appStorageFile);
        if (! is_dir($appDir)) {
            @mkdir($appDir, 0755, true);
        }
        @file_put_contents($appStorageFile, $content);
    }

    /**
     * Mirror an already-stored file between storage paths.
     */
    protected function mirrorStoredFile(string $relativePath): void
    {
        $publicFile = public_path('storage/'.ltrim($relativePath, '/'));
        $appStorageFile = storage_path('app/public/'.ltrim($relativePath, '/'));

        if (file_exists($publicFile) && ! file_exists($appStorageFile)) {
            $dir = dirname($appStorageFile);
            if (! is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @copy($publicFile, $appStorageFile);
        } elseif (file_exists($appStorageFile) && ! file_exists($publicFile)) {
            $dir = dirname($publicFile);
            if (! is_dir($dir)) {
                @mkdir($dir, 0755, true);
            }
            @copy($appStorageFile, $publicFile);
        }
    }
}

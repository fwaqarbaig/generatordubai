<?php

namespace App\Models\Traits;

use App\Models\Media;

trait HasFeaturedImageSeo
{
    /**
     * Look up the associated Media record for the model's featured image.
     */
    public function getFeaturedMedia(): ?Media
    {
        if (empty($this->featured_image)) {
            return null;
        }

        $cleanPath = ltrim(parse_url($this->featured_image, PHP_URL_PATH) ?? '', '/');
        if (str_starts_with($cleanPath, 'storage/')) {
            $cleanPath = substr($cleanPath, 8);
        }

        $fileName = basename($cleanPath);

        return Media::where('file_path', $cleanPath)
            ->orWhere('file_path', 'like', "%/{$fileName}")
            ->orWhere('file_name', $fileName)
            ->first();
    }

    /**
     * Get the SEO alt text for the featured image.
     */
    public function getFeaturedImageAltAttribute(): string
    {
        $media = $this->getFeaturedMedia();
        if ($media) {
            if ($media->is_decorative) {
                return '';
            }
            if (! empty($media->alt_text)) {
                return $media->alt_text;
            }
        }

        return $this->title ?? 'Rental Power UAE';
    }

    /**
     * Get the title attribute for the featured image.
     */
    public function getFeaturedImageTitleAttribute(): string
    {
        $media = $this->getFeaturedMedia();
        if ($media && ! empty($media->title)) {
            return $media->title;
        }

        return $this->title ?? 'Rental Power UAE';
    }

    /**
     * Get the caption for the featured image if present.
     */
    public function getFeaturedImageCaptionAttribute(): ?string
    {
        $media = $this->getFeaturedMedia();

        return $media?->caption;
    }
}

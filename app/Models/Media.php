<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'file_name',
        'file_path',
        'disk',
        'mime_type',
        'size',
        'dimensions',
        'alt_text',
        'caption',
        'is_decorative',
        'user_id',
    ];

    protected $casts = [
        'is_decorative' => 'boolean',
    ];

    protected $appends = [
        'url',
        'is_image',
        'human_size',
    ];

    /**
     * Get the title attribute with fallback to name.
     */
    public function getTitleAttribute(?string $value): string
    {
        return $value ?: ($this->attributes['name'] ?? '');
    }

    /**
     * Set the title attribute and keep name in sync.
     */
    public function setTitleAttribute(?string $value): void
    {
        $this->attributes['title'] = $value;
        if (! empty($value) && empty($this->attributes['name'])) {
            $this->attributes['name'] = $value;
        }
    }

    /**
     * Set the name attribute and keep title in sync if title is empty.
     */
    public function setNameAttribute(?string $value): void
    {
        $this->attributes['name'] = $value;
        if (! empty($value) && empty($this->attributes['title'])) {
            $this->attributes['title'] = $value;
        }
    }

    /**
     * Ensure decorative images return empty alt text.
     */
    public function getAltTextAttribute(?string $value): string
    {
        if ($this->is_decorative) {
            return '';
        }

        return $value ?? '';
    }

    /**
     * User who uploaded the media.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for full public URL.
     */
    public function getUrlAttribute(): string
    {
        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }

        $cleanPath = ltrim($this->file_path, '/');
        if (str_starts_with($cleanPath, 'storage/')) {
            $cleanPath = substr($cleanPath, 8);
        }

        return '/storage/'.$cleanPath;
    }

    /**
     * Check if media is an image.
     */
    public function getIsImageAttribute(): bool
    {
        return str_starts_with($this->mime_type ?? '', 'image/');
    }

    /**
     * Human-readable file size.
     */
    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size ?? 0;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' B';
    }
}

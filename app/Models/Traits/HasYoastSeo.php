<?php

namespace App\Models\Traits;

use App\Services\YoastSeoScoreCalculator;

trait HasYoastSeo
{
    /**
     * Boot the trait and auto-calculate SEO scores on saving if missing or zero.
     */
    public static function bootHasYoastSeo(): void
    {
        static::saving(function ($model) {
            if (empty($model->seo_score) || (int) $model->seo_score <= 0) {
                $calc = app(YoastSeoScoreCalculator::class);
                $res = $calc->calculateForModel($model);
                $model->seo_score = $res['seo_score'];

                if (empty($model->readability_score) || (int) $model->readability_score <= 0) {
                    $model->readability_score = $res['readability_score'];
                }
            }
        });
    }

    /**
     * Get calculated Yoast SEO score, falling back to real-time calculation.
     */
    public function getCalculatedSeoScoreAttribute(): int
    {
        if (! empty($this->seo_score) && (int) $this->seo_score > 0) {
            return (int) $this->seo_score;
        }

        return app(YoastSeoScoreCalculator::class)->calculateForModel($this)['seo_score'];
    }

    /**
     * Get SEO score traffic light rating ('good', 'ok', 'poor').
     */
    public function getSeoRatingAttribute(): string
    {
        $score = $this->calculated_seo_score;

        return $score >= 80 ? 'good' : ($score >= 50 ? 'ok' : 'poor');
    }
}

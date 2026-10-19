<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class YoastSeoScoreCalculator
{
    /**
     * Calculate SEO and readability scores for an Eloquent model.
     *
     * @return array{
     *     seo_score: int,
     *     readability_score: int,
     *     rating: string,
     *     readability_rating: string,
     *     checks: array<int, array{title: string, status: string, message: string}>
     * }
     */
    public function calculateForModel(Model $model): array
    {
        $keyword = (string) ($model->focus_keyword ?? '');
        $title = (string) ($model->meta_title ?: ($model->title ?: ($model->name ?? '')));
        $description = (string) ($model->meta_description ?? '');
        $slug = (string) ($model->slug ?? '');
        $content = (string) ($model->content ?? '');

        return $this->calculate($keyword, $title, $description, $slug, $content);
    }

    /**
     * Calculate SEO and readability scores from raw parameters.
     *
     * @return array{
     *     seo_score: int,
     *     readability_score: int,
     *     rating: string,
     *     readability_rating: string,
     *     checks: array<int, array{title: string, status: string, message: string}>
     * }
     */
    public function calculate(
        ?string $keyword,
        ?string $title,
        ?string $description,
        ?string $slug,
        ?string $content
    ): array {
        $keyword = trim(mb_strtolower($keyword ?? ''));
        $title = trim($title ?? '');
        $description = trim($description ?? '');
        $slug = trim(mb_strtolower($slug ?? ''));
        $content = trim($content ?? '');

        // Extract plain text and words from HTML content
        $plainText = trim(strip_tags($content));
        $words = preg_split('/\s+/u', $plainText, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $wordCount = count($words);

        $checks = [];
        $earnedSeoPoints = 0;
        $totalSeoPoints = 100;

        $earnedReadPoints = 0;
        $totalReadPoints = 100;

        // 1. Focus Keyword Defined (10 pts)
        if ($keyword !== '') {
            $earnedSeoPoints += 10;
            $checks[] = [
                'title' => 'Focus Keyphrase Defined',
                'status' => 'good',
                'message' => "Focus keyphrase \"{$keyword}\" is configured.",
            ];
        } else {
            $checks[] = [
                'title' => 'Focus Keyphrase Missing',
                'status' => 'poor',
                'message' => 'Add a focus keyphrase to enable full search engine ranking signals.',
            ];
        }

        // 2. Keyphrase in SEO Title (15 pts)
        $titleLower = mb_strtolower($title);
        $titleRatio = $this->keywordMatchRatio($keyword, $titleLower);
        if ($keyword !== '' && str_contains($titleLower, $keyword)) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'Keyphrase in SEO Title',
                'status' => 'good',
                'message' => 'The focus keyphrase appears directly in the SEO title.',
            ];
        } elseif ($keyword !== '' && $titleRatio >= 0.6) {
            $earnedSeoPoints += 12;
            $checks[] = [
                'title' => 'Keyphrase Terms in SEO Title',
                'status' => 'good',
                'message' => 'The primary terms of the focus keyphrase appear in the SEO title.',
            ];
        } elseif ($keyword !== '' && $titleRatio > 0) {
            $earnedSeoPoints += 8;
            $checks[] = [
                'title' => 'Keyphrase Partially in SEO Title',
                'status' => 'ok',
                'message' => "Some keyphrase terms appear in the title. Consider adding \"{$keyword}\".",
            ];
        } elseif ($keyword !== '') {
            $earnedSeoPoints += 3;
            $checks[] = [
                'title' => 'Keyphrase Missing from SEO Title',
                'status' => 'poor',
                'message' => "Include \"{$keyword}\" in your SEO title for maximum ranking authority.",
            ];
        }

        // 3. SEO Title Length (15 pts)
        $titleLength = mb_strlen($title);
        if ($titleLength >= 40 && $titleLength <= 65) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'SEO Title Length',
                'status' => 'good',
                'message' => "Title length ({$titleLength} characters) is optimal for Google SERP displays.",
            ];
        } elseif ($titleLength >= 30 && $titleLength <= 75) {
            $earnedSeoPoints += 12;
            $checks[] = [
                'title' => 'SEO Title Length Acceptable',
                'status' => 'ok',
                'message' => "Title length ({$titleLength} characters) is within acceptable range.",
            ];
        } elseif ($titleLength > 75) {
            $earnedSeoPoints += 6;
            $checks[] = [
                'title' => 'SEO Title Too Long',
                'status' => 'poor',
                'message' => "Title is {$titleLength} characters and may be truncated on search engines.",
            ];
        } elseif ($titleLength > 0) {
            $earnedSeoPoints += 6;
            $checks[] = [
                'title' => 'SEO Title Too Short',
                'status' => 'poor',
                'message' => "Title is only {$titleLength} characters. Expand to at least 40 characters.",
            ];
        }

        // 4. Keyphrase in Meta Description (15 pts)
        $descLower = mb_strtolower($description);
        $descRatio = $this->keywordMatchRatio($keyword, $descLower);
        if ($keyword !== '' && str_contains($descLower, $keyword)) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'Keyphrase in Meta Description',
                'status' => 'good',
                'message' => 'The meta description contains your exact focus keyphrase.',
            ];
        } elseif ($keyword !== '' && $descRatio >= 0.5) {
            $earnedSeoPoints += 12;
            $checks[] = [
                'title' => 'Keyphrase Terms in Meta Description',
                'status' => 'good',
                'message' => 'Keyphrase terms are prominently featured in the meta description.',
            ];
        } elseif ($description !== '') {
            $earnedSeoPoints += 7;
            $checks[] = [
                'title' => 'Keyphrase Missing from Description',
                'status' => 'ok',
                'message' => "Consider integrating \"{$keyword}\" into the meta snippet.",
            ];
        } else {
            $checks[] = [
                'title' => 'Meta Description Missing',
                'status' => 'poor',
                'message' => 'No meta description configured. Search engines will auto-generate snippets.',
            ];
        }

        // 5. Meta Description Length (15 pts)
        $descLength = mb_strlen($description);
        if ($descLength >= 120 && $descLength <= 165) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'Meta Description Length',
                'status' => 'good',
                'message' => "Description length ({$descLength} characters) is in the optimal 120–165 zone.",
            ];
        } elseif ($descLength >= 80 && $descLength <= 185) {
            $earnedSeoPoints += 12;
            $checks[] = [
                'title' => 'Meta Description Length Acceptable',
                'status' => 'ok',
                'message' => "Description length ({$descLength} characters) is acceptable.",
            ];
        } elseif ($descLength > 185) {
            $earnedSeoPoints += 6;
            $checks[] = [
                'title' => 'Meta Description Too Long',
                'status' => 'poor',
                'message' => "Description ({$descLength} characters) exceeds 165 characters and may be truncated.",
            ];
        } elseif ($descLength > 0) {
            $earnedSeoPoints += 6;
            $checks[] = [
                'title' => 'Meta Description Too Short',
                'status' => 'poor',
                'message' => "Description has {$descLength} characters. Target between 120 and 165 characters.",
            ];
        }

        // 6. Keyphrase in URL Slug (15 pts)
        $slugNormalized = Str::slug($keyword);
        $slugText = str_replace(['-', '/'], ' ', $slug);
        $slugRatio = $this->keywordMatchRatio($keyword, $slugText);
        if ($keyword !== '' && ($slug === $slugNormalized || str_contains($slug, $slugNormalized) || str_contains($slugNormalized, $slug))) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'Keyphrase in URL Slug',
                'status' => 'good',
                'message' => 'The permalink URL slug contains your primary keyphrase.',
            ];
        } elseif ($keyword !== '' && $slugRatio >= 0.5) {
            $earnedSeoPoints += 12;
            $checks[] = [
                'title' => 'Keyphrase Terms in URL Slug',
                'status' => 'good',
                'message' => 'The slug contains terms from the focus keyphrase.',
            ];
        } elseif ($slug !== '') {
            $earnedSeoPoints += 8;
            $checks[] = [
                'title' => 'Permalink Slug',
                'status' => 'ok',
                'message' => 'Slug is present. Consider aligning with focus keyphrase.',
            ];
        }

        // 7. Text Word Count (15 pts)
        if ($wordCount >= 300) {
            $earnedSeoPoints += 15;
            $checks[] = [
                'title' => 'Content Word Count',
                'status' => 'good',
                'message' => "Content contains {$wordCount} words (exceeds 300-word SEO benchmark).",
            ];
        } elseif ($wordCount >= 150) {
            $earnedSeoPoints += 10;
            $checks[] = [
                'title' => 'Content Word Count',
                'status' => 'ok',
                'message' => "Content contains {$wordCount} words (150+ words).",
            ];
        } elseif ($wordCount >= 50) {
            $earnedSeoPoints += 5;
            $checks[] = [
                'title' => 'Thin Content',
                'status' => 'poor',
                'message' => "Content is {$wordCount} words. At least 300 words recommended.",
            ];
        } else {
            $checks[] = [
                'title' => 'Empty / Minimal Content',
                'status' => 'poor',
                'message' => 'Content is very short or missing.',
            ];
        }

        // Readability Checks (100 pts)
        // 1. Subheadings (H2, H3, H4) (50 pts)
        $hasSubheadings = (bool) preg_match('/<h[2-4][^>]*>/i', $content);
        if ($hasSubheadings) {
            $earnedReadPoints += 50;
            $checks[] = [
                'title' => 'Subheadings Structure',
                'status' => 'good',
                'message' => 'Content features structured H2/H3 subheadings for high readability.',
            ];
        } elseif ($wordCount > 100) {
            $earnedReadPoints += 30;
            $checks[] = [
                'title' => 'Subheadings Missing',
                'status' => 'ok',
                'message' => 'Add H2 or H3 section headings to structure longer text.',
            ];
        } else {
            $earnedReadPoints += 20;
            $checks[] = [
                'title' => 'Subheadings Missing',
                'status' => 'poor',
                'message' => 'Include H2 and H3 subheadings for clearer section division.',
            ];
        }

        // 2. Paragraph Quality & Volume (50 pts)
        if ($wordCount >= 150) {
            $earnedReadPoints += 50;
            $checks[] = [
                'title' => 'Paragraph Volume',
                'status' => 'good',
                'message' => 'Text length and paragraph pacing are well proportioned.',
            ];
        } elseif ($wordCount >= 50) {
            $earnedReadPoints += 35;
            $checks[] = [
                'title' => 'Moderate Content Length',
                'status' => 'ok',
                'message' => "Text is {$wordCount} words. Consider expanding explanations.",
            ];
        } else {
            $earnedReadPoints += 20;
            $checks[] = [
                'title' => 'Short Content',
                'status' => 'poor',
                'message' => 'Expand text for deeper visitor engagement.',
            ];
        }

        $seoScore = (int) min(100, max(0, round(($earnedSeoPoints / $totalSeoPoints) * 100)));
        $readabilityScore = (int) min(100, max(0, round(($earnedReadPoints / $totalReadPoints) * 100)));

        $rating = $seoScore >= 80 ? 'good' : ($seoScore >= 50 ? 'ok' : 'poor');
        $readabilityRating = $readabilityScore >= 80 ? 'good' : ($readabilityScore >= 50 ? 'ok' : 'poor');

        return [
            'seo_score' => $seoScore,
            'readability_score' => $readabilityScore,
            'rating' => $rating,
            'readability_rating' => $readabilityRating,
            'checks' => $checks,
        ];
    }

    /**
     * Check if all individual words in a phrase exist in the target text.
     */
    protected function allKeywordsPresent(string $phrase, string $targetText): bool
    {
        $words = preg_split('/\s+/u', $phrase, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        if (empty($words)) {
            return false;
        }

        foreach ($words as $word) {
            if (mb_strlen($word) > 2 && ! str_contains($targetText, $word)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate ratio of meaningful keyphrase words present in the target text.
     */
    protected function keywordMatchRatio(string $phrase, string $targetText): float
    {
        $words = preg_split('/\s+/u', $phrase, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $meaningfulWords = array_filter($words, fn ($w) => mb_strlen($w) > 2);

        if (empty($meaningfulWords)) {
            return 0.0;
        }

        $matched = 0;
        foreach ($meaningfulWords as $word) {
            if (str_contains($targetText, $word)) {
                $matched++;
            }
        }

        return $matched / count($meaningfulWords);
    }
}

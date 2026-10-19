<?php

namespace App\Console\Commands;

use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class RecalculateSeoScoresCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:recalculate-scores {--model= : Specific model to recalculate (services, products, posts, pages)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recalculate and update Yoast SEO and readability scores across all services, products, posts, and pages.';

    /**
     * Execute the console command.
     */
    public function handle(YoastSeoScoreCalculator $calculator): int
    {
        $target = strtolower($this->option('model') ?: 'all');
        $this->info("Starting Yoast SEO Score Recalculation (Target: {$target})...");

        $summary = [];

        if (in_array($target, ['all', 'services', 'service'])) {
            $summary[] = $this->processModels('Services', Service::all(), $calculator);
        }

        if (in_array($target, ['all', 'products', 'product'])) {
            $summary[] = $this->processModels('Products', Product::all(), $calculator);
        }

        if (in_array($target, ['all', 'posts', 'post'])) {
            $summary[] = $this->processModels('Blog Posts', Post::all(), $calculator);
        }

        if (in_array($target, ['all', 'pages', 'page'])) {
            $summary[] = $this->processModels('CMS Pages', Page::all(), $calculator);
        }

        $this->newLine();
        $this->table(
            ['Entity', 'Total Records', 'Average SEO Score', 'Good (>=80)', 'OK (50-79)', 'Poor (<50)'],
            $summary
        );

        $this->info('Yoast SEO score recalculation completed successfully.');

        return self::SUCCESS;
    }

    /**
     * Process and recalculate scores for a collection of models.
     *
     * @param  Collection<int, mixed>  $models
     * @return array{0: string, 1: int, 2: string, 3: int, 4: int, 5: int}
     */
    protected function processModels(string $label, $models, YoastSeoScoreCalculator $calculator): array
    {
        $total = $models->count();
        $scores = [];
        $good = 0;
        $ok = 0;
        $poor = 0;

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat(" %current%/%max% [%bar%] %percent:3s%% - Processing {$label}...");
        $bar->start();

        foreach ($models as $model) {
            $results = $calculator->calculateForModel($model);

            $model->seo_score = $results['seo_score'];
            $model->readability_score = $results['readability_score'];
            $model->saveQuietly();

            $scores[] = $results['seo_score'];

            if ($results['rating'] === 'good') {
                $good++;
            } elseif ($results['rating'] === 'ok') {
                $ok++;
            } else {
                $poor++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $avgScore = ! empty($scores) ? round(array_sum($scores) / count($scores), 1) : 0;

        return [
            $label,
            $total,
            "{$avgScore}/100",
            $good,
            $ok,
            $poor,
        ];
    }
}

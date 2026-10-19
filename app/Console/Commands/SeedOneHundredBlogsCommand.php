<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\YoastSeoScoreCalculator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedOneHundredBlogsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:seed-100 {--group=all : Group number 1-10 or all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the 100 comprehensive technical blog posts across UAE power, cooling, maintenance, used gensets, and portacabins';

    /**
     * Execute the console command.
     */
    public function handle(YoastSeoScoreCalculator $calculator): int
    {
        $groupOption = $this->option('group') ?: 'all';
        $user = User::where('role', 'admin')->first() ?: User::first();
        $userId = $user ? $user->id : 1;

        $groupsToRun = [];
        if ($groupOption === 'all') {
            $groupsToRun = range(1, 10);
        } else {
            $groupsToRun = [(int) $groupOption];
        }

        $totalSeeded = 0;

        foreach ($groupsToRun as $groupNum) {
            $filePath = database_path("data/blog_topics/group_{$groupNum}.php");
            if (! file_exists($filePath)) {
                $this->warn("Group file not found: {$filePath}");

                continue;
            }

            $articles = require $filePath;
            $this->info("Processing Group {$groupNum} (".count($articles).' articles)...');

            foreach ($articles as $data) {
                // 1. Ensure Category
                $category = Category::firstOrCreate(
                    ['slug' => $data['category']],
                    ['name' => $data['category_name'] ?? Str::title(str_replace('-', ' ', $data['category']))]
                );

                // 2. Ensure Tags
                $tagIds = [];
                if (! empty($data['tags'])) {
                    foreach ($data['tags'] as $tagName) {
                        $tag = Tag::firstOrCreate(
                            ['slug' => Str::slug($tagName)],
                            ['name' => $tagName]
                        );
                        $tagIds[] = $tag->id;
                    }
                }

                // 3. Featured Image resolution
                $imagePath = $data['featured_image'];
                if (! str_starts_with($imagePath, '/storage/') && ! str_starts_with($imagePath, 'http')) {
                    $imagePath = '/storage/media/'.ltrim($imagePath, '/');
                }

                // 4. Create or Update Post
                $post = Post::updateOrCreate(
                    ['slug' => $data['slug']],
                    [
                        'user_id' => $userId,
                        'title' => $data['title'],
                        'excerpt' => $data['excerpt'],
                        'content' => $data['content'],
                        'featured_image' => $imagePath,
                        'status' => 'published',
                        'published_at' => $data['published_at'] ?? now()->subDays(rand(1, 90)),
                        'focus_keyword' => $data['focus_keyword'],
                        'meta_title' => $data['meta_title'],
                        'meta_description' => $data['meta_description'],
                        'meta_keywords' => $data['meta_keywords'],
                        'canonical_url' => url('/post/'.$data['slug']),
                        'og_title' => $data['meta_title'],
                        'og_description' => $data['meta_description'],
                        'og_image' => $imagePath,
                        'is_indexable' => true,
                    ]
                );

                // 5. Attach Category and Tags
                $post->categories()->sync([$category->id]);
                if (! empty($tagIds)) {
                    $post->tags()->sync($tagIds);
                }

                // 6. Recalculate Yoast Score
                $scoreResult = $calculator->calculateForModel($post);
                $post->seo_score = $scoreResult['seo_score'];
                $post->readability_score = $scoreResult['readability_score'];
                $post->saveQuietly();

                $wordCount = str_word_count(strip_tags($post->content));
                $this->line("  ✓ [{$post->id}] {$post->title} | Words: {$wordCount} | Yoast SEO: {$post->seo_score}/100 | Readability: {$post->readability_score}/100");
                $totalSeeded++;
            }
        }

        $this->info("Successfully seeded and calculated scores for {$totalSeeded} posts!");

        return Command::SUCCESS;
    }
}

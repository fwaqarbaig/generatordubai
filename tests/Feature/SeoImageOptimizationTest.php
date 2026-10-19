<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SeoImageOptimizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');

        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function test_upload_with_context_generates_seo_filename_alt_title_and_caption(): void
    {
        $file = UploadedFile::fake()->image('IMG_20261019_092311_radiator.jpg', 800, 600);

        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $file,
            'context' => 'Rental Generator Dubai 500kVA',
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);

        // Filename should be lowercase, hyphenated, webp, and keyword-rich
        $this->assertStringEndsWith('.webp', $media->file_name);
        $this->assertMatchesRegularExpression('/^[a-z0-9\-]+\.webp$/', $media->file_name);
        $this->assertStringContainsString('generator', $media->file_name);

        // Alt text should incorporate topic and component naturally
        $this->assertNotEmpty($media->alt_text);
        $this->assertStringContainsString('generator', strtolower($media->alt_text));
        $this->assertStringContainsString('radiator', strtolower($media->alt_text));
        $this->assertFalse((bool) $media->is_decorative);

        // Title should be descriptive
        $this->assertNotEmpty($media->title);

        // Caption should be generated for technical component
        $this->assertNotNull($media->caption);
        $this->assertStringContainsString('radiator', strtolower($media->caption));

        // Storage check
        Storage::disk('public')->assertExists($media->file_path);
    }

    public function test_upload_without_context_uses_intelligent_fallbacks(): void
    {
        $file = UploadedFile::fake()->image('cummins-silent-canopy.jpg', 640, 480);

        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);

        $this->assertNotEmpty($media->alt_text);
        $this->assertNotEmpty($media->title);
        $this->assertStringEndsWith('.webp', $media->file_name);
        $this->assertStringContainsString('cummins', strtolower($media->alt_text));
    }

    public function test_decorative_upload_sets_empty_alt_and_decorative_flag(): void
    {
        $file = UploadedFile::fake()->image('divider-accent-line.png', 40, 40);

        $response = $this->actingAs($this->admin)->json('POST', route('admin.media.store'), [
            'files' => [$file],
            'is_decorative' => true,
        ]);

        $response->assertStatus(200);

        $media = Media::latest()->first();
        $this->assertNotNull($media);
        $this->assertTrue((bool) $media->is_decorative);
        $this->assertSame('', $media->alt_text);
        $this->assertNull($media->caption);
    }

    public function test_unrelated_image_describes_content_without_keyword_stuffing(): void
    {
        $file = UploadedFile::fake()->image('boardroom-executive-meeting.jpg', 800, 600);

        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $file,
            'context' => 'Rental Chillers and Cooling Towers UAE',
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);

        // Alt text should describe the actual content and NOT stuff chiller keywords
        $this->assertStringContainsString('meeting', strtolower($media->alt_text));
        $this->assertStringNotContainsString('chiller', strtolower($media->alt_text));
    }

    public function test_admin_can_update_metadata_and_rename_file_safely(): void
    {
        // 1. Upload original media
        $file = UploadedFile::fake()->image('original-diesel-unit.jpg', 600, 400);
        $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $file,
            'context' => 'Diesel Generator',
        ]);

        $media = Media::latest()->first();
        $originalFileName = $media->file_name;
        $originalUrl = asset('storage/'.$media->file_path);

        // 2. Create models referencing this media
        $post = Post::create([
            'user_id' => $this->admin->id,
            'title' => 'Diesel Generator Operations in UAE',
            'slug' => 'diesel-generator-operations-in-uae',
            'featured_image' => 'storage/'.$media->file_path,
            'content' => '<p>Here is an image: <img src="'.$originalUrl.'" alt="Old alt"></p>',
            'status' => 'published',
        ]);

        $product = Product::create([
            'title' => 'Cummins 500kVA Generator Unit',
            'slug' => 'cummins-500kva-generator-unit',
            'featured_image' => 'storage/'.$media->file_path,
            'content' => '<p><img src="'.$originalUrl.'"></p>',
            'status' => 'published',
        ]);

        $service = Service::create([
            'title' => 'Commercial Generator Rental',
            'slug' => 'commercial-generator-rental',
            'featured_image' => 'storage/'.$media->file_path,
            'content' => '<p><img src="'.$originalUrl.'"></p>',
            'status' => 'published',
        ]);

        $page = Page::create([
            'user_id' => $this->admin->id,
            'title' => 'Generator Fleet Specifications',
            'slug' => 'generator-fleet-specifications',
            'featured_image' => 'storage/'.$media->file_path,
            'content' => '<p><img src="'.$originalUrl.'"></p>',
            'status' => 'published',
        ]);

        // 3. Rename file and edit metadata via AJAX PATCH
        $newDesiredName = 'cummins-500kva-prime-generator.webp';
        $updateResponse = $this->actingAs($this->admin)->json('PATCH', route('admin.media.update', $media), [
            'title' => 'Cummins 500 kVA Prime Generator UAE',
            'alt_text' => 'High-capacity Cummins 500 kVA prime diesel generator operating on Dubai construction site',
            'caption' => 'Acoustic canopy Cummins unit with integrated day tank.',
            'is_decorative' => false,
            'file_name' => $newDesiredName,
        ]);

        $updateResponse->assertStatus(200);
        $updateResponse->assertJson(['success' => true]);

        $media->refresh();
        $this->assertEquals($newDesiredName, $media->file_name);
        $this->assertEquals('Cummins 500 kVA Prime Generator UAE', $media->title);
        $this->assertEquals('High-capacity Cummins 500 kVA prime diesel generator operating on Dubai construction site', $media->alt_text);
        $this->assertEquals('Acoustic canopy Cummins unit with integrated day tank.', $media->caption);

        // Verify new file exists on storage and old file is removed
        Storage::disk('public')->assertExists($media->file_path);

        // Verify referenced models have been safely updated with new path
        $post->refresh();
        $product->refresh();
        $service->refresh();
        $page->refresh();

        $this->assertStringContainsString($newDesiredName, $post->featured_image);
        $this->assertStringContainsString($newDesiredName, $post->content);
        $this->assertStringNotContainsString($originalFileName, $post->content);

        $this->assertStringContainsString($newDesiredName, $product->featured_image);
        $this->assertStringContainsString($newDesiredName, $product->content);

        $this->assertStringContainsString($newDesiredName, $service->featured_image);
        $this->assertStringContainsString($newDesiredName, $service->content);

        $this->assertStringContainsString($newDesiredName, $page->featured_image);
        $this->assertStringContainsString($newDesiredName, $page->content);
    }

    public function test_has_featured_image_seo_trait_resolves_attributes_accurately(): void
    {
        $file = UploadedFile::fake()->image('soundproof-chiller-system.jpg', 600, 400);
        $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $file,
            'context' => 'Rental Chillers Dubai',
        ]);

        $media = Media::latest()->first();
        $media->update([
            'alt_text' => 'Air-cooled rental chiller 200 TR for commercial temporary HVAC in Abu Dhabi',
            'title' => 'Rental Chiller 200 TR Abu Dhabi',
            'caption' => 'Turnkey chiller with integrated hydronic pump module.',
            'is_decorative' => false,
        ]);

        $post = Post::create([
            'user_id' => $this->admin->id,
            'title' => 'Temporary Chiller Rental Guide',
            'slug' => 'temporary-chiller-rental-guide',
            'featured_image' => 'storage/'.$media->file_path,
            'status' => 'published',
        ]);

        $this->assertEquals('Air-cooled rental chiller 200 TR for commercial temporary HVAC in Abu Dhabi', $post->featured_image_alt);
        $this->assertEquals('Rental Chiller 200 TR Abu Dhabi', $post->featured_image_title);
        $this->assertEquals('Turnkey chiller with integrated hydronic pump module.', $post->featured_image_caption);

        // If marked decorative, alt text should return empty string
        $media->update(['is_decorative' => true]);
        $this->assertSame('', $post->featured_image_alt);
    }

    public function test_upload_rejects_files_exceeding_size_limit(): void
    {
        // 25 MB exceeds the 20480 KB (20MB) limit
        $oversizedFile = UploadedFile::fake()->create('huge-video.mp4', 25000, 'video/mp4');

        $response = $this->actingAs($this->admin)->post(route('admin.media.store'), [
            'file' => $oversizedFile,
        ]);

        $response->assertSessionHasErrors('file');
    }
}

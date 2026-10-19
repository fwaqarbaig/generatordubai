<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use App\Services\ImageWebpConverter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageWebpConversionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_uploaded_jpeg_is_automatically_converted_to_webp(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->image('generator-site.jpg', 600, 400);

        $response = $this->actingAs($admin)->post(route('admin.media.store'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);
        $this->assertStringEndsWith('.webp', $media->file_name);
        $this->assertStringEndsWith('.webp', $media->file_path);
        $this->assertEquals('image/webp', $media->mime_type);
        $this->assertEquals('600x400', $media->dimensions);

        // Verify storage file exists and begins with WebP RIFF signature
        Storage::disk('public')->assertExists($media->file_path);
        $content = Storage::disk('public')->get($media->file_path);
        $this->assertStringStartsWith('RIFF', $content);
        $this->assertStringContainsString('WEBP', substr($content, 0, 16));
    }

    public function test_uploaded_png_via_media_modal_json_is_converted_to_webp(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->image('transparent-logo.png', 300, 200);

        $response = $this->actingAs($admin)->json('POST', route('admin.media.store'), [
            'files' => [$file],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $data = $response->json();
        $this->assertCount(1, $data['media']);
        $this->assertStringEndsWith('.webp', $data['media'][0]['file_name']);
        $this->assertEquals('image/webp', $data['media'][0]['mime_type']);

        $media = Media::find($data['media'][0]['id']);
        $this->assertNotNull($media);
        $this->assertStringEndsWith('.webp', $media->file_name);
        $this->assertEquals('image/webp', $media->mime_type);
    }

    public function test_already_webp_image_is_preserved_as_webp(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Generate tiny valid WebP image in memory
        $im = imagecreatetruecolor(50, 50);
        ob_start();
        imagewebp($im, null, 80);
        $webpBytes = ob_get_clean();
        imagedestroy($im);

        $file = UploadedFile::fake()->createWithContent('existing.webp', $webpBytes);

        $response = $this->actingAs($admin)->post(route('admin.media.store'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);
        $this->assertStringEndsWith('.webp', $media->file_name);
        $this->assertEquals('image/webp', $media->mime_type);
    }

    public function test_non_image_document_is_stored_without_conversion(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $file = UploadedFile::fake()->create('generator-spec.pdf', 100, 'application/pdf');

        $response = $this->actingAs($admin)->post(route('admin.media.store'), [
            'file' => $file,
        ]);

        $response->assertRedirect(route('admin.media.index'));

        $media = Media::latest()->first();
        $this->assertNotNull($media);
        $this->assertStringEndsWith('.pdf', $media->file_name);
        $this->assertEquals('application/pdf', $media->mime_type);
    }

    public function test_image_webp_converter_service_converts_raw_images(): void
    {
        $converter = new ImageWebpConverter;

        // Create temporary PNG file
        $tempPng = tempnam(sys_get_temp_dir(), 'test_png_');
        $im = imagecreatetruecolor(100, 100);
        imagepng($im, $tempPng);
        imagedestroy($im);

        $webpData = $converter->convertToWebpData($tempPng, 85);
        @unlink($tempPng);

        $this->assertNotNull($webpData);
        $this->assertStringStartsWith('RIFF', $webpData);
        $this->assertStringContainsString('WEBP', substr($webpData, 0, 16));
    }
}

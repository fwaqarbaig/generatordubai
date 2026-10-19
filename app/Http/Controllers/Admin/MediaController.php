<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use App\Services\ImageWebpConverter;
use App\Services\SeoImageOptimizer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display the media library.
     */
    public function index(Request $request): View|JsonResponse
    {
        $search = $request->query('search');
        $type = $request->query('type');

        $query = Media::with('user')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('file_name', 'like', "%{$search}%")
                    ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        if ($type === 'image') {
            $query->where('mime_type', 'like', 'image/%');
        } elseif ($type === 'document') {
            $query->where('mime_type', 'like', 'application/%')
                ->orWhere('mime_type', 'like', 'text/%');
        }

        $media = $query->paginate(24)->withQueryString();

        if ($request->wantsJson()) {
            return response()->json($media);
        }

        return view('admin.media.index', compact('media', 'search', 'type'));
    }

    /**
     * Upload one or multiple media files with automatic SEO optimization and WebP conversion.
     */
    public function store(Request $request, ImageWebpConverter $converter, SeoImageOptimizer $optimizer): RedirectResponse|JsonResponse
    {
        $allowedMimes = 'jpeg,jpg,png,webp,gif,svg,bmp,pdf,doc,docx,xlsx,csv,zip,txt';
        $request->validate([
            'files' => ['nullable', 'array'],
            'files.*' => ['file', 'max:20480', 'mimes:'.$allowedMimes], // max 20MB
            'file' => ['nullable', 'file', 'max:20480', 'mimes:'.$allowedMimes],
            'context' => ['nullable', 'string', 'max:255'],
            'topic' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'is_decorative' => ['nullable', 'boolean'],
        ]);

        $uploadedFiles = [];
        $filesToProcess = [];

        if ($request->hasFile('files')) {
            $filesToProcess = $request->file('files');
        } elseif ($request->hasFile('file')) {
            $filesToProcess = [$request->file('file')];
        }

        if (empty($filesToProcess)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'No files provided.'], 422);
            }

            return back()->with('error', 'Please select a file to upload.');
        }

        $disallowedExtensions = SeoImageOptimizer::DISALLOWED_EXTENSIONS;
        $allowedExtensions = SeoImageOptimizer::ALLOWED_EXTENSIONS;

        $uploadDirectory = 'uploads/'.date('Y/m');
        $context = $request->input('context') ?: $request->input('topic');

        foreach ($filesToProcess as $index => $file) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = strtolower($file->getClientOriginalExtension());

            if (in_array($extension, $disallowedExtensions, true) || ! in_array($extension, $allowedExtensions, true)) {
                continue;
            }

            if ($extension === 'svg') {
                $svgContent = file_get_contents($file->getRealPath());
                if (preg_match('/<script|javascript:|onload=|onerror=|onclick=/i', $svgContent)) {
                    if ($request->wantsJson()) {
                        return response()->json(['error' => 'Security Error: Malicious script detected in SVG file.'], 422);
                    }

                    return back()->with('error', 'Security Error: Malicious SVG payload detected.');
                }
            }

            // Run automatic SEO optimization for alt, title, caption, and keyword-rich filename
            $options = [
                'alt_text' => $request->input('alt_text'),
                'title' => $request->input('title'),
                'caption' => $request->input('caption'),
                'is_decorative' => $request->boolean('is_decorative'),
            ];
            $optimized = $optimizer->optimize($file, $context, $options);

            // Convert images (JPEG, PNG, GIF, BMP) to WebP automatically, preserving WebP/SVG/Docs with SEO filename
            $processed = $converter->processUpload($file, $uploadDirectory, 85, 'public', $optimized['seo_filename']);

            $mediaItem = Media::create([
                'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'title' => $optimized['title'],
                'file_name' => $processed['safe_name'],
                'file_path' => $processed['path'],
                'disk' => 'public',
                'mime_type' => $processed['mime_type'],
                'size' => $processed['size'],
                'dimensions' => $processed['dimensions'],
                'alt_text' => $optimized['alt_text'],
                'caption' => $optimized['caption'],
                'is_decorative' => $optimized['is_decorative'],
                'user_id' => auth()->id(),
            ]);

            $uploadedFiles[] = $mediaItem;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles).' file(s) uploaded and SEO-optimized successfully.',
                'media' => $uploadedFiles,
                'location' => $uploadedFiles[0]->url ?? '', // for TinyMCE / Quill upload
            ]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', count($uploadedFiles).' file(s) uploaded and SEO-optimized successfully.');
    }

    /**
     * Update media metadata (alt text, caption, title, file name).
     */
    public function update(Request $request, Media $medium): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'is_decorative' => ['nullable', 'boolean'],
            'file_name' => ['nullable', 'string', 'max:255'],
        ]);

        if (empty($validated['name']) && ! empty($validated['title'])) {
            $validated['name'] = $validated['title'];
        } elseif (empty($validated['name'])) {
            $validated['name'] = $medium->name ?? pathinfo($medium->file_name, PATHINFO_FILENAME);
        }

        if (empty($validated['title'])) {
            $validated['title'] = $validated['name'];
        }

        // Handle safe physical file rename if requested
        if (! empty($validated['file_name']) && $validated['file_name'] !== $medium->file_name) {
            $this->renameMediaFile($medium, $validated['file_name']);
        }

        $medium->update([
            'name' => $validated['name'],
            'title' => $validated['title'],
            'alt_text' => $request->boolean('is_decorative') ? '' : ($validated['alt_text'] ?? ''),
            'caption' => $validated['caption'] ?? null,
            'is_decorative' => $request->boolean('is_decorative'),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'media' => $medium->fresh()]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media information updated successfully.');
    }

    /**
     * Safely rename a media file on disk and update references across site content.
     */
    protected function renameMediaFile(Media $medium, string $newFileName): void
    {
        $ext = strtolower(pathinfo($medium->file_name, PATHINFO_EXTENSION));
        $newBase = pathinfo($newFileName, PATHINFO_FILENAME);
        $cleanNewName = Str::slug($newBase).'.'.$ext;

        if ($cleanNewName === $medium->file_name) {
            return;
        }

        $dir = dirname($medium->file_path);
        $newRelativePath = ($dir === '.' || $dir === '/' || empty($dir)) ? $cleanNewName : trim($dir, '/').'/'.$cleanNewName;

        $disk = Storage::disk($medium->disk ?? 'public');
        if ($disk->exists($medium->file_path) && ! $disk->exists($newRelativePath)) {
            $disk->move($medium->file_path, $newRelativePath);
        }

        // Mirror rename on public/storage
        $oldPublic = public_path('storage/'.ltrim($medium->file_path, '/'));
        $newPublic = public_path('storage/'.ltrim($newRelativePath, '/'));
        if (file_exists($oldPublic)) {
            @rename($oldPublic, $newPublic);
        }

        $oldFileName = $medium->file_name;
        $medium->file_name = $cleanNewName;
        $medium->file_path = $newRelativePath;
        $medium->save();

        // Update database references across Post, Product, Service, Page
        $this->updateModelImageReferences($oldFileName, $cleanNewName);
    }

    /**
     * Update occurrences of renamed image across posts, products, services, and pages.
     */
    protected function updateModelImageReferences(string $oldFileName, string $newFileName): void
    {
        $models = [
            Post::class,
            Product::class,
            Service::class,
            Page::class,
        ];

        foreach ($models as $modelClass) {
            // Update featured_image
            $modelClass::where('featured_image', 'like', "%{$oldFileName}%")
                ->get()
                ->each(function ($item) use ($oldFileName, $newFileName) {
                    $item->featured_image = str_replace($oldFileName, $newFileName, $item->featured_image);
                    $item->saveQuietly();
                });

            // Update content
            $modelClass::where('content', 'like', "%{$oldFileName}%")
                ->get()
                ->each(function ($item) use ($oldFileName, $newFileName) {
                    $item->content = str_replace($oldFileName, $newFileName, $item->content);
                    $item->saveQuietly();
                });
        }
    }

    /**
     * Delete media item.
     */
    public function destroy(Media $medium): RedirectResponse|JsonResponse
    {
        if (Storage::disk($medium->disk ?? 'public')->exists($medium->file_path)) {
            Storage::disk($medium->disk ?? 'public')->delete($medium->file_path);
        }

        $publicFile = public_path('storage/'.ltrim($medium->file_path, '/'));
        if (file_exists($publicFile)) {
            @unlink($publicFile);
        }

        $appStorageFile = storage_path('app/public/'.ltrim($medium->file_path, '/'));
        if (file_exists($appStorageFile)) {
            @unlink($appStorageFile);
        }

        $medium->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.media.index')
            ->with('success', 'Media file deleted successfully.');
    }

    /**
     * API endpoint returning recent media for the media picker modal.
     */
    public function modalList(Request $request): JsonResponse
    {
        $search = $request->query('search');

        $media = Media::latest()
            ->when($search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('file_name', 'like', "%{$search}%");
            })
            ->take(50)
            ->get();

        return response()->json($media);
    }
}

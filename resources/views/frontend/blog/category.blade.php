@extends('layouts.app')

@section('seo_meta')
    <title>{{ $category->name }} - {{ config('app.name', 'Rental Power UAE') }}</title>
    <meta name="description" content="{{ $category->description && strlen($category->description) > 40 ? $category->description : ('Explore technical guides, engineering insights, and equipment rental advice for ' . $category->name . ' across Dubai, Abu Dhabi, and the UAE.') }}">
    <meta name="keywords" content="{{ strtolower($category->name) }}, {{ strtolower($category->name) }} uae, generator guides, rental power engineering, temporary cooling dubai">
    <link rel="canonical" href="{{ $posts->currentPage() > 1 ? $posts->url($posts->currentPage()) : route('category.show', $category->slug) }}">
    @if($posts->previousPageUrl())
        <link rel="prev" href="{{ $posts->previousPageUrl() }}">
    @endif
    @if($posts->nextPageUrl())
        <link rel="next" href="{{ $posts->nextPageUrl() }}">
    @endif
    <meta property="og:title" content="{{ $category->name }} - {{ config('app.name', 'Rental Power UAE') }}">
    <meta property="og:description" content="{{ $category->description && strlen($category->description) > 40 ? $category->description : ('Explore technical guides, engineering insights, and equipment rental advice for ' . $category->name . ' across Dubai, Abu Dhabi, and the UAE.') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('category.show', $category->slug) }}">
    <meta property="og:image" content="{{ asset('storage/media/rental-generator.webp') }}">


    <!-- Schema.org BreadcrumbList JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@@type' => 'BreadcrumbList',
      'itemListElement' => [
        [
          '@@type' => 'ListItem',
          'position' => 1,
          'name' => 'Home',
          'item' => route('home'),
        ],
        [
          '@@type' => 'ListItem',
          'position' => 2,
          'name' => 'Articles',
          'item' => route('blog.index'),
        ],
        [
          '@@type' => 'ListItem',
          'position' => 3,
          'name' => $category->name,
          'item' => route('category.show', $category->slug),
        ],
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Schema.org CollectionPage / ItemList JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@@type' => 'CollectionPage',
      'name' => $category->name . ' - Technical Power Articles',
      'description' => $category->description ?: ('Explore technical guides and case studies in ' . $category->name . ' from Rental Power UAE.'),
      'url' => route('category.show', $category->slug),
      'mainEntity' => [
        '@@type' => 'ItemList',
        'itemListElement' => $posts->map(function($p, $idx) {
            return [
                '@@type' => 'ListItem',
                'position' => $idx + 1,
                'name' => $p->title,
                'url' => route('post.show', $p->slug),
                'description' => $p->seo_description,
                'image' => $p->seo_image ?: ($p->featured_image_url ?: asset('storage/media/rental-generator.webp')),
            ];
        })->values()->all(),
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$category->schema_markup" />
@endsection

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <!-- Header -->
    <div class="border-b border-slate-200 pb-8 space-y-2">
        <span class="text-xs font-bold uppercase tracking-widest text-brand-600">Category Archive</span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-xs sm:text-sm text-slate-500 max-w-2xl">{{ $category->description }}</p>
        @endif
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <article class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                <a href="{{ route('post.show', $post->slug) }}" class="aspect-[16/9] block relative overflow-hidden bg-slate-100">
                    @if($post->featured_image_url)
                        <img src="{{ $post->featured_image_url }}" 
                             alt="{{ $post->title }}" 
                             width="600" 
                             height="338" 
                             loading="lazy" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else

                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                            <i data-lucide="image" class="w-10 h-10"></i>
                        </div>
                    @endif
                </a>

                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <div class="flex items-center gap-2 text-[11px] text-slate-400 mb-1.5">
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                            <span>•</span>
                            <span>{{ $post->reading_time }} min read</span>
                        </div>
                        <h2 class="text-base font-bold text-slate-900 group-hover:text-brand-600 transition line-clamp-2">
                            <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-xs text-slate-500 line-clamp-3 mt-2 leading-relaxed">
                            {{ $post->seo_description }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
                        <a href="{{ route('post.show', $post->slug) }}" class="text-xs font-semibold text-brand-600 hover:text-brand-700">
                            Read →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 bg-white rounded-3xl border border-slate-200">
                No articles published under this category yet.
            </div>
        @endforelse
    </div>

    @if($posts->hasPages())
        <div class="pt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('seo_meta')
    <!-- Primary Meta Tags -->
    <title>{{ $page->seo_title }} - {{ config('app.name', 'Rental Power UAE') }}</title>
    <meta name="title" content="{{ $page->seo_title }} - {{ config('app.name', 'Rental Power UAE') }}">
    <meta name="description" content="{{ $page->seo_description }}">
    @if($page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}">
    @endif
    <link rel="canonical" href="{{ url(parse_url((string) $page->canonical_url, PHP_URL_PATH) ?: '/'.ltrim($page->slug, '/')) }}">
    <meta name="robots" content="{{ $page->is_indexable ? 'index, follow' : 'noindex, nofollow' }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url(parse_url((string) $page->canonical_url, PHP_URL_PATH) ?: '/'.ltrim($page->slug, '/')) }}">
    <meta property="og:title" content="{{ $page->og_title ?: $page->seo_title }}">
    <meta property="og:description" content="{{ $page->og_description ?: $page->seo_description }}">
    @if($page->seo_image)
        <meta property="og:image" content="{{ $page->seo_image }}">
    @endif
    <meta property="og:site_name" content="{{ config('app.name', 'Rental Power UAE') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->og_title ?: $page->seo_title }}">
    <meta name="twitter:description" content="{{ $page->og_description ?: $page->seo_description }}">
    @if($page->seo_image)
        <meta name="twitter:image" content="{{ $page->seo_image }}">
    @endif

    <!-- Schema.org WebPage & BreadcrumbList JSON-LD -->
    <script type="application/ld+json">
    {!! json_encode([
      '@@context' => 'https://schema.org',
      '@@type' => 'WebPage',
      'name' => $page->title,
      'description' => $page->seo_description,
      'url' => url(parse_url((string) $page->canonical_url, PHP_URL_PATH) ?: '/'.ltrim($page->slug, '/')),
      'primaryImageOfPage' => [
        '@@type' => 'ImageObject',
        'url' => $page->seo_image ?: asset('storage/media/rental-generator.webp'),
      ],
      'publisher' => [
        '@@type' => 'Organization',
        '@id' => url('/#organization'),
        'name' => config('app.name', 'Rental Power UAE'),
        'url' => url('/'),
        'logo' => [
          '@@type' => 'ImageObject',
          'url' => asset('images/rentalpower-logo.png'),
        ],
      ],
      'breadcrumb' => [
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
            'name' => $page->title,
            'item' => url(parse_url((string) $page->canonical_url, PHP_URL_PATH) ?: '/'.ltrim($page->slug, '/')),
          ],
        ],
      ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$page->schema_markup" />
@endsection

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Page Header -->
        <header class="space-y-4 border-b border-slate-100 pb-8">
            @unless(preg_match('/<h1\\b/i', $page->content ?? ''))
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                    {{ $page->title }}
                </h1>
            @endunless
            @if($page->updated_at)
                <div class="text-xs text-slate-400">
                    Last updated on {{ $page->updated_at->format('F d, Y') }}
                </div>
            @endif
        </header>

        <!-- Featured Image -->
        @if($page->featured_image_url)
            <figure class="rounded-3xl overflow-hidden shadow-md bg-slate-100 mb-6">
                <div class="aspect-[21/9] overflow-hidden">
                    <img src="{{ $page->featured_image_url }}" 
                         alt="{{ $page->featured_image_alt }}" 
                         title="{{ $page->featured_image_title }}" 
                         width="1200" 
                         height="514" 
                         loading="eager" 
                         fetchpriority="high" 
                         class="w-full h-full object-cover">
                </div>
                @if($page->featured_image_caption)
                    <figcaption class="p-3 text-xs text-slate-500 italic text-center bg-slate-50 border-t border-slate-100">
                        {{ $page->featured_image_caption }}
                    </figcaption>
                @endif
            </figure>
        @endif

        <!-- Page WYSIWYG Content Body -->
        <div class="prose prose-slate prose-lg max-w-none leading-relaxed">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection

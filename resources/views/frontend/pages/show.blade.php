@extends('layouts.app')

@section('seo_meta')
    <!-- Primary Meta Tags -->
    <title>{{ $page->seo_title }} - {{ config('app.name', 'Generator Dubai') }}</title>
    <meta name="title" content="{{ $page->seo_title }} - {{ config('app.name', 'Generator Dubai') }}">
    <meta name="description" content="{{ $page->seo_description }}">
    @if($page->meta_keywords)
        <meta name="keywords" content="{{ $page->meta_keywords }}">
    @endif
    <link rel="canonical" href="{{ $page->canonical_url ?: url()->current() }}">
    <meta name="robots" content="{{ $page->is_indexable ? 'index, follow' : 'noindex, nofollow' }}">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page->og_title ?: $page->seo_title }}">
    <meta property="og:description" content="{{ $page->og_description ?: $page->seo_description }}">
    @if($page->seo_image)
        <meta property="og:image" content="{{ $page->seo_image }}">
    @endif
    <meta property="og:site_name" content="{{ config('app.name', 'Generator Dubai') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->og_title ?: $page->seo_title }}">
    <meta name="twitter:description" content="{{ $page->og_description ?: $page->seo_description }}">
    @if($page->seo_image)
        <meta name="twitter:image" content="{{ $page->seo_image }}">
    @endif

    <!-- Custom Schema.org JSON-LD (from Dashboard) -->
    <x-schema-json-ld :schema="$page->schema_markup" />
@endsection

@section('content')
<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Page Header -->
        <header class="space-y-4 border-b border-slate-100 pb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                {{ $page->title }}
            </h1>
            @if($page->updated_at)
                <div class="text-xs text-slate-400">
                    Last updated on {{ $page->updated_at->format('F d, Y') }}
                </div>
            @endif
        </header>

        <!-- Featured Image -->
        @if($page->featured_image_url)
            <div class="rounded-3xl overflow-hidden aspect-[21/9] shadow-md bg-slate-100">
                <img src="{{ $page->featured_image_url }}" 
                     alt="{{ $page->title }}" 
                     width="1200" 
                     height="514" 
                     loading="eager" 
                     fetchpriority="high" 
                     class="w-full h-full object-cover">
            </div>

        @endif

        <!-- Page WYSIWYG Content Body -->
        <div class="prose prose-slate prose-lg max-w-none leading-relaxed">
            {!! $page->content !!}
        </div>
    </div>
</div>
@endsection

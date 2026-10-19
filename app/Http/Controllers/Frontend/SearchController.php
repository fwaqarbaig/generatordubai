<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Handle site-wide search across products, services, blog articles, and pages.
     */
    public function index(Request $request): View
    {
        $query = trim((string) $request->input('q', ''));
        $activeTab = (string) $request->input('tab', 'all');

        $products = collect();
        $services = collect();
        $posts = collect();
        $pages = collect();

        if ($query !== '') {
            $searchTerm = "%{$query}%";

            // 1. Search Fleet / Products (Gensets 50-2500 kVA, Chillers)
            $products = Product::published()
                ->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', $searchTerm)
                        ->orWhere('badge', 'like', $searchTerm)
                        ->orWhere('tagline', 'like', $searchTerm)
                        ->orWhere('summary', 'like', $searchTerm)
                        ->orWhere('category', 'like', $searchTerm)
                        ->orWhere('content', 'like', $searchTerm);
                })
                ->ordered()
                ->get();

            // 2. Search Services (Rental Cooling, Generator Rental, etc.)
            $services = Service::published()
                ->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', $searchTerm)
                        ->orWhere('tagline', 'like', $searchTerm)
                        ->orWhere('hero_badge', 'like', $searchTerm)
                        ->orWhere('summary', 'like', $searchTerm)
                        ->orWhere('content', 'like', $searchTerm);
                })
                ->ordered()
                ->get();

            // 3. Search Blog Posts / Technical Guides
            $posts = Post::published()
                ->search($query)
                ->with(['categories', 'tags'])
                ->latest('published_at')
                ->take(12)
                ->get();

            // 4. Search Pages
            $pages = Page::published()
                ->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', $searchTerm)
                        ->orWhere('content', 'like', $searchTerm);
                })
                ->take(6)
                ->get();
        }

        $totalCount = $products->count() + $services->count() + $posts->count() + $pages->count();

        return view('frontend.search', compact(
            'query',
            'activeTab',
            'products',
            'services',
            'posts',
            'pages',
            'totalCount'
        ));
    }
}

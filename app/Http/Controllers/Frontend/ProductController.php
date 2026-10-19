<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $category = $request->query('category');

        $query = Product::published()->ordered();

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->get();
        $categories = Product::published()->select('category')->distinct()->whereNotNull('category')->pluck('category');

        return view('frontend.products.index', compact('products', 'categories', 'category'));
    }

    /**
     * Display the specified product.
     */
    public function show(string $slug): View|RedirectResponse
    {
        // 1. Direct exact slug match
        $product = Product::published()->where('slug', $slug)->first();

        // 2. If not found, check known kVA aliases (e.g. '50-kva', '100-kva', '500-kva')
        if (! $product) {
            $normalizedSlug = str_replace(' ', '-', strtolower(trim($slug)));
            if (preg_match('/^(\d+)[-_]?kva(?:[-_]?(?:generator|rental|hire))?$/i', $normalizedSlug, $m)) {
                $kva = $m[1];
                $product = Product::published()
                    ->where(function ($q) use ($kva) {
                        $q->where('slug', "{$kva}-kva-generator-rental")
                            ->orWhere('slug', "{$kva}kva-generator-hire")
                            ->orWhere('slug', 'like', "{$kva}-kva%")
                            ->orWhere('slug', 'like', "{$kva}kva%");
                    })
                    ->first();
            }
        }

        // 3. Fallback partial slug match
        if (! $product) {
            $product = Product::published()
                ->where('slug', 'like', "%{$slug}%")
                ->first();
        }

        if (! $product) {
            abort(404);
        }

        // 301 Redirect to canonical product slug if requested via an alias
        if ($product->slug !== $slug) {
            return redirect()->route('fleet.show', $product->slug, 301);
        }

        $relatedProducts = Product::published()
            ->where('id', '!=', $product->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}

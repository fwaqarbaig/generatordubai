<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Services\SeoInternalLinker;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request): View
    {
        $services = Service::published()->ordered()->get();

        return view('frontend.services.index', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug, ?SeoInternalLinker $linker = null): View
    {
        $linker = $linker ?? app(SeoInternalLinker::class);

        $service = Service::published()->where('slug', $slug)->firstOrFail();

        $otherServices = Service::published()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(6)
            ->get();

        $relatedPosts = $linker->getRelatedPostsForService($service, 4);

        $fleetQuery = Product::where('status', 'published');
        if ($service->isCooling()) {
            $fleetQuery->orderByRaw("CASE WHEN slug LIKE '%chiller%' OR slug LIKE '%refrigeration%' THEN 0 ELSE 1 END");
        } elseif ($service->isPower()) {
            $fleetQuery->orderByRaw("CASE WHEN slug LIKE '%generator%' THEN 0 ELSE 1 END");
        }
        $fleetProducts = $fleetQuery->orderBy('order', 'asc')
            ->take(6)
            ->get();

        return view('frontend.services.show', compact('service', 'otherServices', 'relatedPosts', 'fleetProducts'));
    }
}

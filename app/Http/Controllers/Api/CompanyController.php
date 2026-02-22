<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Resources\CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies (Exhibitors).
     * Handles: Search, Filter by Category, Filter by Country.
     */
    public function index(Request $request)
    {
        $query = Company::query()
            ->with('team')
            ->where('is_active', true);

        // 1. Search Filter
        $query->when($request->search, function ($q, $search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('booth_number', 'like', "%{$search}%");
        });

        // 2. Category Filter
        $query->when($request->category, fn($q, $cat) => $q->where('category', $cat));

        // 3. Country Filter
        $query->when($request->country, fn($q, $country) => $q->where('country', $country));

        // Sorting: Featured first, then A-Z
        $query->orderByDesc('is_featured')->orderBy('name');

        // Eager load 'team' only if we want to show avatars in the list,
        // otherwise remove 'with' for better performance.
        // We use standard pagination (20 per page).
        return CompanyResource::collection($query->paginate(20));
    }

    /**
     * Display the specified company details.
     */
    public function show($id)
    {
        $company = Company::with('team')->findOrFail($id);

        return new CompanyResource($company);
    }

    /**
     * Toggle Favorite Status.
     */
    public function toggleFavorite($id)
    {
        $user = auth()->user();
        $company = Company::findOrFail($id);

        // The 'favoritedBy' relation now comes from the polymorphic Trait
        $company->favoritedBy()->toggle($user->id);

        // Check status
        $isFavorited = $company->isFavoritedBy($user);

        return response()->json([
            'status' => 'success',
            'is_favorited' => $isFavorited,
            'message' => $isFavorited ? 'Added to favorites' : 'Removed from favorites'
        ]);
    }
}

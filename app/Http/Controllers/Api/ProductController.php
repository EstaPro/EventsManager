<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * GET /api/products
     * List products with Search & Category Filter.
     */
    public function index(Request $request)
    {
        // FIX: Changed 'company.users' to 'company.team' to match your Model
        $query = Product::with(['category', 'company.team']);

        // 1. Filter by Category ID
        if ($request->has('category_id') && $request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }

        // 2. Search by Name or Description
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('company', function($c) use ($search) {
                        $c->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 3. Paginate
        $products = $query->paginate(20);

        return response()->json($products);
    }

    /**
     * GET /api/products/categories
     */
    public function categories()
    {
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        return response()->json($categories);
    }

    /**
     * GET /api/products/{id}
     */
    public function show($id)
    {
        // FIX: Changed 'company.users' to 'company.team' here as well
        $product = Product::with(['category', 'company.team'])->findOrFail($id);
        return response()->json($product);
    }
}

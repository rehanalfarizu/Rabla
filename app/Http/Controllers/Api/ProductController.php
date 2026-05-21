<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter active only
        $query->where('is_active', true);

        // Search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        // Paginate
        $perPage = $request->get('per_page', 12);
        $products = $query->paginate($perPage);

        return response()->json($products);
    }

    public function featured(Request $request)
    {
        $perPage = $request->get('per_page', 8);
        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = null;

        // Try finding by MongoDB ObjectID
        if (preg_match('/^[a-f0-9]{24}$/i', $id)) {
            $product = Product::with('category')->where('_id', $id)->first();
        }

        // If not found, try numeric ID or slug
        if (!$product) {
            $product = Product::with('category')
                ->where(function($query) use ($id) {
                    $query->where('numeric_id', (int)$id)
                          ->orWhere('slug', $id);
                })
                ->first();
        }

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Increment views count
        $product->increment('views_count');

        return response()->json($product);
    }
}

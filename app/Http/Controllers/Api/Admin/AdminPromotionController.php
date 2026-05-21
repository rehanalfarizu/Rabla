<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use Illuminate\Http\Request;

class AdminPromotionController extends Controller
{
    public function index(Request $request)
    {
        $query = Promotion::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            $now = now();

            switch ($status) {
                case 'Active':
                    $query->where('is_active', true)
                          ->where(function ($q) use ($now) {
                              $q->whereNull('start_date')
                                ->orWhere('start_date', '<=', $now);
                          })
                          ->where(function ($q) use ($now) {
                              $q->whereNull('end_date')
                                ->orWhere('end_date', '>=', $now);
                          });
                    break;
                case 'Scheduled':
                    $query->where('is_active', true)
                          ->where('start_date', '>', $now);
                    break;
                case 'Expired':
                    $query->where(function ($q) use ($now) {
                          $q->where('end_date', '<', $now)
                            ->orWhere('is_active', false);
                      });
                    break;
            }
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        // Pagination
        $perPage = (int) $request->input('per_page', 10);
        $promotions = $query->paginate($perPage);

        return response()->json([
            'data' => PromotionResource::collection($promotions),
            'meta' => [
                'current_page' => $promotions->currentPage(),
                'per_page' => $promotions->perPage(),
                'total' => $promotions->total(),
                'last_page' => $promotions->lastPage(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'type' => 'required|string|in:discount,cashback,bundle,free_shipping,bogo',
            'discount_type' => 'required_unless:type,free_shipping|nullable|string|in:percentage,fixed',
            'discount_value' => 'required_unless:type,free_shipping|nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:0',
            'per_user_limit' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
            'description' => 'nullable|string',
            'terms' => 'nullable|string',
        ]);

        $promotion = Promotion::create($validated);

        return response()->json([
            'message' => 'Promotion created successfully',
            'data' => new PromotionResource($promotion),
        ], 201);
    }

    public function show(string $id)
    {
        $promotion = Promotion::findOrFail($id);

        return response()->json([
            'data' => new PromotionResource($promotion),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $promotion = Promotion::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'code' => 'nullable|string|max:50',
            'type' => 'sometimes|string|in:discount,cashback,bundle,free_shipping,bogo',
            'discount_type' => 'nullable|string|in:percentage,fixed',
            'discount_value' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'min_purchase' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:0',
            'per_user_limit' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
            'description' => 'nullable|string',
            'terms' => 'nullable|string',
        ]);

        $promotion->update($validated);

        return response()->json([
            'message' => 'Promotion updated successfully',
            'data' => new PromotionResource($promotion),
        ]);
    }

    public function destroy(string $id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return response()->json([
            'message' => 'Promotion deleted successfully',
        ]);
    }
}
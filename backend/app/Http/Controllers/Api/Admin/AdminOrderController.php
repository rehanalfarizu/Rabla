<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status !== 'All') {
                $query->where('status', strtolower($status));
            }
        }

        // Payment status filter
        if ($request->filled('payment_status')) {
            $paymentStatus = $request->input('payment_status');
            if ($paymentStatus !== 'All') {
                $query->where('payment_status', strtolower($paymentStatus));
            }
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        // Pagination
        $perPage = (int) $request->input('per_page', 10);
        $orders = $query->paginate($perPage);

        return response()->json([
            'data' => OrderResource::collection($orders),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'last_page' => $orders->lastPage(),
            ],
        ]);
    }

    public function stats()
    {
        $total = Order::count();
        $pending = Order::where('payment_status', 'pending')->count();
        $processing = Order::where('status', 'processing')->count();
        $completed = Order::where('status', 'delivered')->count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total');

        return response()->json([
            'total' => $total,
            'pending' => $pending,
            'processing' => $processing,
            'completed' => $completed,
            'total_revenue' => (float) $totalRevenue,
        ]);
    }

    public function show(string $id)
    {
        $order = Order::with(['user', 'items'])->findOrFail($id);

        return response()->json([
            'data' => new OrderResource($order),
        ]);
    }

    public function updateStatus(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'sometimes|string|in:pending,confirmed,processing,shipped,delivered,cancelled,returned',
            'payment_status' => 'sometimes|string|in:pending,paid,failed,refunded',
        ]);

        if (isset($validated['status'])) {
            $order->status = $validated['status'];

            // Update timestamps
            switch ($validated['status']) {
                case 'confirmed':
                    $order->confirmed_at = now();
                    break;
                case 'shipped':
                    $order->shipped_at = now();
                    break;
                case 'delivered':
                    $order->delivered_at = now();
                    break;
                case 'cancelled':
                    $order->cancelled_at = now();
                    break;
            }
        }

        if (isset($validated['payment_status'])) {
            $order->payment_status = $validated['payment_status'];
        }

        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully',
            'data' => new OrderResource($order->load('user')),
        ]);
    }
}
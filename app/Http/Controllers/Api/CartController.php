<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // In-memory cart for simplicity (use session or database for production)
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        return response()->json($cart);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $cart = session()->get('cart', []);

        $productId = $validated['product_id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $validated['quantity'];
        } else {
            $cart[$productId] = [
                'id' => $product->_id,
                'product_id' => $productId,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->main_image,
                'quantity' => $validated['quantity'],
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Item added to cart',
            'cart' => $cart,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        if ($validated['quantity'] <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['quantity'] = $validated['quantity'];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Cart updated',
            'cart' => $cart,
        ]);
    }

    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        unset($cart[$id]);
        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Item removed',
            'cart' => $cart,
        ]);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'message' => 'Cart cleared',
            'cart' => [],
        ]);
    }
}

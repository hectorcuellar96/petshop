<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $ids = array_keys($cart);
        $products = Product::whereIn('id', $ids)->get()->keyBy('id');
        $total = collect($cart)->sum(fn ($item, $id) => ($products[$id]->price ?? 0) * $item['quantity']);
        return view('cart', compact('cart', 'products', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['nullable', 'integer', 'min:1', 'max:20']]);
        abort_unless($product->active && $product->stock > 0, 404);
        $cart = session('cart', []);
        $quantity = (int) ($data['quantity'] ?? 1);
        $cart[$product->id]['quantity'] = min(($cart[$product->id]['quantity'] ?? 0) + $quantity, $product->stock);
        session(['cart' => $cart]);
        return back()->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:20']]);
        $cart = session('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = min((int) $data['quantity'], $product->stock);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index');
    }

    public function destroy(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }
}

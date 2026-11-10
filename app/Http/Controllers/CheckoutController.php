<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (empty(session('cart', []))) {
            return redirect()->route('cart.index');
        }
        return view('checkout');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:12'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = session('cart', []);
        abort_if(empty($cart), redirect()->route('cart.index'));

        $order = DB::transaction(function () use ($data, $cart) {
            $products = Product::whereIn('id', array_keys($cart))->lockForUpdate()->get()->keyBy('id');
            $total = 0;
            foreach ($cart as $id => $item) {
                $product = $products[$id] ?? null;
                if (!$product || !$product->active || $product->stock < $item['quantity']) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'cart' => 'Uno o más productos ya no tienen inventario suficiente.',
                    ]);
                }
                $total += $product->price * $item['quantity'];
            }

            $order = Order::create($data + ['total' => $total, 'status' => 'pendiente']);
            foreach ($cart as $id => $item) {
                $product = $products[$id];
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                ]);
                $product->decrement('stock', $item['quantity']);
            }
            return $order;
        });

        session()->forget('cart');
        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order)
    {
        return view('order-success', compact('order'));
    }
}

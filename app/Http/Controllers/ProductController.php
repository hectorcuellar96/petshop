<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->where('active', true)
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%'.$request->q.'%'))
            ->when($request->filled('category'), fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $request->category)))
            ->latest()->paginate(12)->withQueryString();

        return view('shop', ['products' => $products, 'categories' => Category::all()]);
    }

    public function show(Product $product)
    {
        abort_unless($product->active, 404);
        return view('products.show', compact('product'));
    }
}

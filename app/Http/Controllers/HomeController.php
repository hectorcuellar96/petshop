<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'categories' => Category::withCount('products')->get(),
            'products' => Product::where('active', true)->where('featured', true)->latest()->take(8)->get(),
        ]);
    }
}

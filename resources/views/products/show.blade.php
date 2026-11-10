@extends('layouts.app')
@section('title', $product->name)
@section('content')
<section class="container section detail-grid"><div class="detail-image"><img src="{{ $product->image_url }}" alt="{{ $product->name }}"></div><div class="detail-copy"><span class="eyebrow">{{ $product->category?->name }}</span><h1>{{ $product->name }}</h1><div class="detail-price">${{ number_format($product->price, 2) }} <small>MXN</small></div><p>{{ $product->description }}</p><p class="stock">{{ $product->stock > 0 ? '✓ Disponible' : 'Agotado' }}</p><form method="POST" action="{{ route('cart.store', $product) }}" class="buy-form">@csrf<label>Cantidad <input type="number" name="quantity" value="1" min="1" max="{{ min(20, $product->stock) }}"></label><button class="btn" @disabled($product->stock < 1)>Agregar al carrito →</button></form><small>🔒 Compra segura · Atención para consentirlos</small></div></section>
@endsection

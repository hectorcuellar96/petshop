@extends('layouts.app')
@section('title', 'Tienda')
@section('content')
<section class="page-banner"><div class="container"><span class="eyebrow">TODO PARA TUS COMPAÑEROS</span><h1>Nuestra tienda</h1><p>Encuentra sus nuevos favoritos.</p></div></section>
<section class="container section"><form class="filters" method="GET"><input name="q" value="{{ request('q') }}" placeholder="Buscar productos..."><select name="category"><option value="">Todas las categorías</option>@foreach($categories as $category)<option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>@endforeach</select><button class="btn btn-small">Buscar</button></form><div class="product-grid">@forelse($products as $product) @include('partials.product-card', ['product' => $product]) @empty <p>No encontramos productos con esos filtros.</p> @endforelse</div><div class="pagination">{{ $products->links() }}</div></section>
@endsection

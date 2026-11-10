<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Patitas Shop') | Patitas Shop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Nunito:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container nav">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark">🐾</span> patitas<span>shop</span></a>
        <nav><a href="{{ route('home') }}">Inicio</a><a href="{{ route('shop') }}">Tienda</a><a href="{{ route('shop', ['category' => 'perros']) }}">Perros</a><a href="{{ route('shop', ['category' => 'gatos']) }}">Gatos</a></nav>
        <a class="cart-link" href="{{ route('cart.index') }}">🛒 Carrito <b>{{ array_sum(array_column(session('cart', []), 'quantity')) }}</b></a>
    </div>
</header>
@if(session('success')) <div class="container flash">{{ session('success') }}</div> @endif
@if($errors->any()) <div class="container error-list">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div> @endif
<main>@yield('content')</main>
<footer><div class="container footer-inner"><a class="brand" href="{{ route('home') }}">🐾 patitas<span>shop</span></a><p>Todo el amor y cuidado que tus mascotas merecen.</p><small>© {{ date('Y') }} Patitas Shop · Hecho con amor 🧡</small></div></footer>
</body></html>

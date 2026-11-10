@extends('layouts.app')
@section('title', 'Pedido recibido')
@section('content')
<section class="container section"><div class="empty"><div>🎉</div><span class="eyebrow">¡GRACIAS POR TU COMPRA!</span><h1>Tu pedido #{{ $order->id }} fue registrado</h1><p>Enviaremos la información a {{ $order->email }}. Total: <strong>${{ number_format($order->total, 2) }} MXN</strong>.</p><a class="btn" href="{{ route('shop') }}">Seguir comprando</a></div></section>
@endsection

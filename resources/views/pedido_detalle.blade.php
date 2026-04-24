@extends('layouts.cart')

@section('content')

<h1 class="text-3xl font-bold mb-6">Detalle del pedido #{{ $pedido->id }}</h1>

{{-- Información general --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Estado:</strong> <span class="capitalize">{{ $pedido->estado }}</span></p>
    <p><strong>Total:</strong> {{ number_format($pedido->total, 2) }} €</p>
</div>

{{-- Productos del pedido --}}
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Productos del pedido</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Producto</th>
                <th class="p-2 border">Cantidad</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedido->lineas as $lineas)
                <tr class="border-b">
                    <td class="p-2 border">{{ $lineas->producto->nombre }}</td>
                    <td class="p-2 border">{{ $lineas->cantidad }}</td>
                    <td class="p-2 border">{{ number_format($lineas->precio, 2) }} €</td>
                    <td class="p-2 border">
                        {{ number_format($lineas->cantidad * $lineas->precio, 2) }} €
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-right text-xl font-bold mt-4">
        Total: {{ number_format($pedido->total, 2) }} €
    </p>
</div>

{{-- Botón volver --}}
<div class="mt-6">
    <a href="{{ route('mis.pedidos') }}"
       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Volver a mis pedidos
    </a>
</div>

@endsection

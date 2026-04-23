@extends('layouts.app')

@section('title', 'Detalle del pedido')

@section('content')

<h2 class="text-3xl font-bold mb-6">Pedido #{{ $pedido->id }}</h2>

<div class="bg-white p-6 rounded shadow">

    <p class="mb-4">
        <strong>Total:</strong> {{ $pedido->total }} €<br>
        <strong>Estado:</strong> {{ $pedido->estado }}<br>
        <strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y') }}
    </p>

    <h3 class="text-xl font-semibold mb-3">Productos</h3>

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Producto</th>
                <th class="border p-3">Cantidad</th>
                <th class="border p-3">Precio</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedido->lineas as $l)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $l->producto->nombre }}</td>
                    <td class="border p-3">{{ $l->cantidad }}</td>
                    <td class="border p-3">{{ $l->precio }} €</td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection

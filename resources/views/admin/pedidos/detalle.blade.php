@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Detalle del pedido #{{ $pedido->id }}</h1>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- DATOS DEL CLIENTE --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Datos del cliente</h2>

    <p><strong>Nombre:</strong> {{ $pedido->usuario->name }}</p>
    <p><strong>Email:</strong> {{ $pedido->usuario->email }}</p>
    <p><strong>Dirección envío:</strong> {{ $pedido->usuario->direccion_envio }}</p>
</div>

{{-- PRODUCTOS DEL PEDIDO --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Productos</h2>

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
            @foreach($pedido->items as $item)
                <tr class="border-b">
                    <td class="p-2 border">{{ $item->producto->nombre }}</td>
                    <td class="p-2 border">{{ $item->cantidad }}</td>
                    <td class="p-2 border">{{ number_format($item->precio, 2) }} €</td>
                    <td class="p-2 border">{{ number_format($item->cantidad * $item->precio, 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="text-right text-xl font-bold mt-4">
        Total: {{ number_format($pedido->total, 2) }} €
    </p>
</div>

{{-- CAMBIAR ESTADO --}}
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Actualizar estado</h2>

    <form action="{{ route('admin.pedidos.estado', $pedido->id) }}" method="POST" class="flex gap-4">
        @csrf
        @method('PUT')

        <select name="estado" class="p-2 border rounded">
            <option value="pendiente" @selected($pedido->estado == 'pendiente')>Pendiente</option>
            <option value="enviado" @selected($pedido->estado == 'enviado')>Enviado</option>
            <option value="entregado" @selected($pedido->estado == 'entregado')>Entregado</option>
            <option value="cancelado" @selected($pedido->estado == 'cancelado')>Cancelado</option>
        </select>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
            Actualizar
        </button>
    </form>
</div>

@endsection

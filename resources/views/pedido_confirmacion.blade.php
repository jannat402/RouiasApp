@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow border border-orange-200">

    <h1 class="text-3xl font-bold text-orange-700 mb-6">
        ¡Compra realizada con éxito! 🎉
    </h1>

    <p class="text-gray-700 mb-6">
        Gracias por tu compra. Aquí tienes el resumen de tu pedido.
    </p>

    {{-- DATOS DEL PEDIDO --}}
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-orange-600 mb-3">Detalles del pedido</h2>

        <p><strong>ID del pedido:</strong> {{ $pedido->id }}</p>
        <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Estado:</strong> 
            <span class="capitalize">{{ $pedido->estado }}</span>
        </p>
    </div>

    {{-- PRODUCTOS --}}
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-orange-600 mb-3">Productos comprados</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-orange-100 text-left">
                    <th class="p-3 border">Producto</th>
                    <th class="p-3 border">Cantidad</th>
                    <th class="p-3 border">Precio unitario</th>
                    <th class="p-3 border">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pedido->lineas as $linea)
                    <tr class="border-b">
                        <td class="p-3 border">{{ $linea->producto->nombre }}</td>
                        <td class="p-3 border">{{ $linea->cantidad }}</td>
                        <td class="p-3 border">{{ number_format($linea->precio, 2) }} €</td>
                        <td class="p-3 border">
                            {{ number_format($linea->cantidad * $linea->precio, 2) }} €
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right mt-4">
            <p class="text-xl font-bold">
                Total: {{ number_format($pedido->total, 2) }} €
            </p>
        </div>
    </div>

    {{-- BOTÓN VOLVER --}}
    <div class="text-center mt-10">
        <a href="{{ route('home') }}"
           class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition shadow">
            Volver a la tienda
        </a>
    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-extrabold mb-6 text-orange-700 flex items-center gap-2">
    Tu carrito
</h1>

@if(empty($carrito))
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow flex items-center gap-2">
        No hay productos en el carrito.
    </div>
@else

<div class="overflow-x-auto shadow-lg rounded-lg border border-orange-200 bg-white">
    <table class="w-full text-left border-collapse">
        <thead class="bg-orange-100 text-orange-800">
            <tr>
                <th class="border p-3 font-semibold">Producto</th>
                <th class="border p-3 font-semibold">Precio</th>
                <th class="border p-3 font-semibold">Cantidad</th>
                <th class="border p-3 font-semibold">Subtotal</th>
                <th class="border p-3 font-semibold">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @php $total = 0; @endphp

            @foreach($carrito as $item)
                @php 
                    $subtotal = $item['precio'] * $item['cantidad']; 
                    $total += $subtotal; 
                @endphp

                <tr class="hover:bg-orange-50 transition">
                    <td class="border p-3 font-semibold text-gray-700">
                        {{ $item['nombre'] }}
                    </td>
                    <td class="border p-3 text-gray-700">
                        {{ number_format($item['precio'], 2) }} €
                    </td>
                    <td class="border p-3 text-gray-700">
                        {{ $item['cantidad'] }}
                    </td>
                    <td class="border p-3 font-bold text-orange-700">
                        {{ number_format($subtotal, 2) }} €
                    </td>
                    <td class="border p-3">

                        <form action="{{ route('carrito.eliminar') }}" method="POST" class="inline-block">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <button class="text-red-600 hover:text-red-800 font-semibold flex items-center gap-1">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach

            <tr class="bg-orange-100 font-bold text-orange-800">
                <td colspan="3" class="border p-3 text-right">Total</td>
                <td class="border p-3">{{ number_format($total, 2) }} €</td>
                <td class="border p-3"></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-6 flex items-center gap-4">

    <form action="{{ route('carrito.vaciar') }}" method="POST">
        @csrf
        <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
            Vaciar carrito
        </button>
    </form>

    @auth
        <a href="{{ route('checkout') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                Finalizar compra
        </a>

    @else
        <div class="text-red-600 font-semibold flex items-center gap-2">
            Debes iniciar sesión para finalizar la compra.
        </div>
        <a href="{{ route('login') }}" 
           class="text-blue-600 underline hover:text-blue-800 flex items-center gap-1">
            Iniciar sesión
        </a>
    @endauth

</div>

@endif

@endsection

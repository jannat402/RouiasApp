@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">🛒 Tu carrito</h1>

@if(empty($carrito))
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
        No hay productos en el carrito.
    </div>
@else

<div class="overflow-x-auto shadow rounded-lg">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-100">
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

                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $item['nombre'] }}</td>
                    <td class="border p-3">{{ number_format($item['precio'], 2) }} €</td>
                    <td class="border p-3">{{ $item['cantidad'] }}</td>
                    <td class="border p-3 font-semibold">{{ number_format($subtotal, 2) }} €</td>
                    <td class="border p-3">

                        <form action="{{ route('carrito.eliminar') }}" method="POST" class="inline-block">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                            <button class="text-red-600 hover:text-red-800 font-semibold">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach

            <tr class="bg-gray-100 font-bold">
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
        <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
            Vaciar carrito
        </button>
    </form>

    @auth
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Finalizar compra
            </button>
        </form>
    @else
        <div class="text-red-600 font-semibold">
            Debes iniciar sesión para finalizar la compra.
        </div>
        <a href="{{ route('login') }}" class="text-blue-600 underline hover:text-blue-800">
            Iniciar sesión
        </a>
    @endauth

</div>

@endif

@endsection


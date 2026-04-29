@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

@php
    $carrito = $carrito ?? [];
    $total = $total ?? 0;
@endphp

<h1 class="text-4xl font-extrabold mb-8 text-orange-700 flex items-center gap-2">
    🛒 Tu carrito
</h1>

@if(count($carrito) == 0)

    <div class="bg-white p-10 rounded-xl shadow text-center border border-orange-200">
        <p class="text-gray-600 text-lg">Tu carrito está vacío.</p>

        <a href="{{ route('home') }}"
           class="mt-6 inline-block bg-orange-600 text-white px-6 py-3 rounded-lg shadow hover:bg-orange-700 transition">
            Seguir comprando
        </a>
    </div>

@else

<div class="bg-white p-6 rounded-xl shadow border border-orange-200">

    @foreach($carrito as $item)
        <div class="flex flex-col md:flex-row justify-between items-center border-b py-5 gap-4">

            <!-- INFO PRODUCTO -->
            <div class="flex-1">
                <p class="text-xl font-bold text-gray-800">{{ $item['nombre'] }}</p>
                <p class="text-gray-500 text-sm">{{ number_format($item['precio'], 2) }} € / unidad</p>
            </div>

            <!-- CANTIDAD -->
            <div class="flex items-center gap-3">

                <button class="btn-menos bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-lg font-bold transition"
                        data-id="{{ $item['id'] }}">−</button>

                <span class="font-bold text-lg w-8 text-center">{{ $item['cantidad'] }}</span>

                <button class="btn-mas bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-lg font-bold transition"
                        data-id="{{ $item['id'] }}">+</button>

            </div>

            <!-- SUBTOTAL -->
            <div class="text-xl font-bold text-orange-600">
                {{ number_format($item['precio'] * $item['cantidad'], 2) }} €
            </div>

            <!-- ELIMINAR -->
            <button class="btn-eliminar bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition"
                    data-id="{{ $item['id'] }}">
                Eliminar
            </button>

        </div>
    @endforeach

    <!-- TOTAL -->
    <div class="text-right mt-8">
        <p class="text-3xl font-extrabold text-orange-700">
            Total: {{ number_format($total, 2) }} €
        </p>
    </div>

    <!-- CTA FINAL -->
    <div class="mt-8 flex flex-col md:flex-row justify-between gap-4">

        <a href="{{ route('home') }}"
           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg shadow hover:bg-gray-300 transition text-center">
            Seguir comprando
        </a>

        <a href="{{ route('checkout') }}"
           class="bg-orange-600 text-white px-6 py-3 rounded-lg shadow hover:bg-orange-700 transition text-center font-bold">
            Finalizar compra →
        </a>

    </div>

</div>

@endif

@endsection

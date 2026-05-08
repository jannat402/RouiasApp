@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

<script>
    window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    window.csrfToken = "{{ csrf_token() }}";
</script>

@php
    $carrito = $carrito ?? [];
    $total = $total ?? 0;
@endphp
    <h1 class="text-4xl font-extrabold mb-10 text-orange-700 flex items-center gap-4">
        Tu carrito
    </h1>


@if(count($carrito) == 0)
    <div class="bg-white p-12 rounded-2xl shadow-xl text-center border border-orange-200">
        <p class="text-gray-600 text-lg">Tu carrito está vacío.</p>

        <a href="{{ route('home') }}"
           class="mt-6 inline-block bg-orange-600 text-white px-6 py-3 rounded-xl shadow hover:bg-orange-700 transition font-semibold">
            Seguir comprando
        </a>
    </div>

@else

<div class="bg-white p-8 rounded-2xl shadow-xl border border-orange-200">

    @foreach($carrito as $item)
        <div class="flex flex-col md:flex-row justify-between items-center border-b border-orange-100 py-6 gap-6">

            <!-- INFO PRODUCTO -->
            <div class="flex-1">
                <p class="text-2xl font-bold text-gray-800">{{ $item['nombre'] }}</p>
                <p class="text-gray-500 text-sm mt-1">{{ number_format($item['precio'], 2) }} € / unidad</p>
            </div>

            <!-- CANTIDAD -->
            <div class="flex items-center gap-4 bg-orange-50 px-4 py-2 rounded-xl border border-orange-200 shadow-sm">

                <button class="btn-menos bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="{{ $item['id'] }}">−</button>

                <span class="font-bold text-xl w-10 text-center text-gray-800">{{ $item['cantidad'] }}</span>

                <button class="btn-mas bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="{{ $item['id'] }}">+</button>

            </div>

            <!-- SUBTOTAL -->
            <div class="text-2xl font-extrabold text-orange-600">
                {{ number_format($item['precio'] * $item['cantidad'], 2) }} €
            </div>

            <!-- ELIMINAR -->
            <button class="btn-eliminar bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl shadow transition font-semibold"
                data-id="{{ $item['id'] }}">
                🗑️ Eliminar
            </button>

        </div>
    @endforeach

    <!-- TOTAL -->
    <div class="text-right mt-10">
        <p class="text-4xl font-extrabold text-orange-700">
            Total: {{ number_format($total, 2) }} €
        </p>
    </div>

    <!-- CTA FINAL -->
    <div class="mt-10 flex flex-col md:flex-row justify-between gap-6">

        <a href="{{ route('home') }}"
           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-300 transition text-center font-semibold">
            Seguir comprando
        </a>

        <a href="{{ route('checkout') }}"
           class="bg-orange-600 text-white px-6 py-3 rounded-xl shadow hover:bg-orange-700 transition text-center font-bold text-lg">
            Finalizar compra →
        </a>

    </div>

</div>

@endif

@endsection

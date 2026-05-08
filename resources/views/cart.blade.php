@extends('layouts.app')

@section('title', 'Carrito')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-orange-700">Tu carrito</h1>

{{-- Variable global per al JS --}}
<script>
    window.isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    window.csrfToken = "{{ csrf_token() }}";
</script>

<div id="carrito-contenido">

    {{-- SI ESTÁ LOGUEADO → MOSTRAR SESSION --}}
    @auth
        @php
            $carrito = session('carrito', []);
        @endphp

        @if(count($carrito) == 0)
            <p class="text-gray-600">Tu carrito está vacío.</p>
        @else
            <div class="bg-white p-6 rounded shadow">

                @foreach($carrito as $item)
                    <div class="flex justify-between items-center border-b py-4">

                        <div>
                            <p class="font-bold text-lg">{{ $item['nombre'] }}</p>
                            <p class="text-gray-600">{{ number_format($item['precio'], 2) }} €</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="btn-menos bg-gray-300 px-2 rounded" data-id="{{ $item['id'] }}">-</button>
                            <span class="font-bold">{{ $item['cantidad'] }}</span>
                            <button class="btn-mas bg-gray-300 px-2 rounded" data-id="{{ $item['id'] }}">+</button>
                        </div>

                        <div class="font-bold text-orange-700">
                            {{ number_format($item['precio'] * $item['cantidad'], 2) }} €
                        </div>

                        <button class="btn-eliminar bg-red-600 text-white px-3 py-1 rounded" data-id="{{ $item['id'] }}">
                            Eliminar
                        </button>

                    </div>
                @endforeach

                <div class="text-right mt-6 text-2xl font-bold text-orange-700">
                    Total: {{ number_format($total, 2) }} €
                </div>

                <a href="{{ route('checkout') }}" class="mt-6 inline-block bg-orange-600 text-white px-6 py-3 rounded">
                    Finalizar compra
                </a>

            </div>
        @endif
    @endauth

    {{-- SI NO ESTÁ LOGUEADO → EL CONTENIDO LO RELLENA JS --}}
    @guest
        <div id="carrito-invitado"></div>

        <div class="text-right mt-6">
            <a href="{{ route('login') }}" class="bg-orange-600 text-white px-6 py-3 rounded">
                Inicia sesión para finalizar la compra
            </a>
        </div>
    @endguest

</div>

@endsection

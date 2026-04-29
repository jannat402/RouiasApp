@extends('layouts.app')

@section('title', 'Productos')

@section('content')

<div class="max-w-7xl mx-auto py-12 px-6">

    <h1 class="text-4xl font-extrabold text-orange-700 mb-10 text-center">
        Nuestra tienda
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

        @foreach($productos as $p)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-orange-200">

                <img src="{{ $p->imagen }}" 
                     class="w-full h-48 object-contain mb-4">

                <h2 class="text-xl font-bold text-gray-800">
                    {{ $p->nombre }}
                </h2>

                <p class="text-orange-600 font-extrabold text-2xl mt-2">
                    {{ number_format($p->precio, 2) }} €
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    IVA incluido
                </p>

                <a href="{{ route('producto.detalle', $p->id) }}"
                   class="block mt-4 bg-orange-600 text-white px-4 py-2 rounded-lg text-center hover:bg-orange-700 transition">
                    Ver detalle
                </a>

                @if($p->stock > 0)
                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $p->id }}">
                        <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            🛒 Añadir al carrito
                        </button>
                    </form>
                @else
                    <p class="mt-3 bg-red-500 text-white px-4 py-2 rounded-lg text-center">
                        Agotado
                    </p>
                @endif

            </div>
        @endforeach

    </div>

</div>

@endsection

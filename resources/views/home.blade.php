@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

{{-- BANNER PRINCIPAL --}}
<figure class="relative max-w-7xl mx-auto mt-10 rounded-2xl overflow-hidden shadow-xl">
    <img src="https://images.unsplash.com/photo-1558944351-c6c6d3a6a4f0"
         alt="Banner principal de PetShop"
         class="w-full h-80 object-cover">

    <figcaption class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/20 flex flex-col justify-center px-10">
        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg mb-4">
            Todo para tus mascotas 🐾
        </h1>

        <p class="text-gray-200 text-lg mb-6 max-w-xl drop-shadow">
            Calidad, confianza y envío rápido en cada pedido.
        </p>

        <a href="{{ route('productos') }}"
           class="bg-orange-600 text-white px-6 py-3 rounded-xl shadow-lg hover:bg-orange-700 transition font-bold w-fit">
            Ver todos los productos →
        </a>
    </figcaption>
</figure>



{{-- CATEGORÍAS --}}
<section class="max-w-7xl mx-auto mt-20">

    <h2 class="text-4xl font-extrabold text-orange-700 mb-8">
        Categorías
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">

        @foreach($categorias as $cat)
        <a href="{{ route('productos') }}?categoria={{ $cat->id }}">
            <figure class="bg-white p-6 rounded-2xl shadow-md border border-orange-200 hover:shadow-xl hover:-translate-y-1 transition text-center">

                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png"
                     alt="Icono de la categoría {{ $cat->nombre }}"
                     class="w-16 h-16 mx-auto mb-4 opacity-90">

                <figcaption>
                    <p class="font-bold text-gray-800 text-lg">{{ $cat->nombre }}</p>
                </figcaption>

            </figure>
        </a>
        @endforeach

    </div>

</section>



{{-- PRODUCTOS DESTACADOS --}}
<section class="max-w-7xl mx-auto mt-20 mb-20">

    <div class="flex items-center justify-between mb-8">
        <h2 class="text-4xl font-extrabold text-orange-700">
            Productos destacados
        </h2>

        <a href="{{ route('productos') }}"
           class="text-orange-600 font-bold hover:text-orange-700 transition">
            Ver todos →
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

        @foreach($productos as $p)
        <figure class="bg-white rounded-2xl shadow-md border border-orange-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition">

            <div class="relative group">
                <img src="{{ $p->imagen }}"
                     alt="Imagen del producto {{ $p->nombre }}"
                     class="w-full h-56 object-contain bg-white p-4 transition-transform duration-300 group-hover:scale-105">

                <span class="absolute top-3 left-3 bg-orange-600 text-white text-xs px-3 py-1 rounded-full shadow">
                    @if($loop->first)
                        Nuevo
                    @elseif($p->precio < 10)
                        Oferta
                    @else
                        Popular
                    @endif
                </span>
            </div>

            <figcaption class="p-5">

                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ $p->nombre }}
                </h3>

                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    {{ $p->descripcion }}
                </p>

                <p class="text-orange-600 font-extrabold text-2xl mb-4">
                    {{ number_format($p->precio, 2) }} €
                </p>

                <a href="{{ route('producto.detalle', $p->id) }}"
                   class="block text-center bg-orange-600 text-white px-4 py-2 rounded-xl shadow hover:bg-orange-700 transition font-bold">
                    Ver detalle
                </a>

            </figcaption>

        </figure>
        @endforeach

    </div>

</section>

@endsection

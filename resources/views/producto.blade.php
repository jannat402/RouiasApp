@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')

<div class="max-w-6xl mx-auto bg-white shadow-xl p-10 rounded-2xl border border-orange-200">

    <div class="flex flex-col md:flex-row gap-12">

        <!-- IMAGEN -->
        <figure class="md:w-1/2 bg-white rounded-2xl shadow-lg border border-orange-200 p-6 flex justify-center">
            <img src="{{ $producto->imagen }}"
                 alt="Imagen del producto {{ $producto->nombre }}"
                 class="w-full h-96 object-contain">
        </figure>

        <!-- INFO -->
        <div class="flex-1">

            <h2 class="text-5xl font-extrabold text-orange-700 leading-tight">
                {{ $producto->nombre }}
            </h2>

            <p class="text-gray-700 mt-5 leading-relaxed text-lg">
                {{ $producto->descripcion }}
            </p>

            {{-- PRECIO CON IVA --}}
            @php
                $precio = $producto->precio;
                $precioIVA = $precio * 1.21;
            @endphp

            <p class="text-4xl font-extrabold mt-6 text-orange-600 drop-shadow-sm">
                {{ number_format($precioIVA, 2) }} €
                <span class="text-sm text-gray-500">(IVA incl.)</span>
            </p>

            <p class="text-sm text-gray-500 mt-1">
                Precio base: {{ number_format($precio, 2) }} € + 21% IVA
            </p>

            <!-- BOTÓN VER MÁS DETALLE (AJAX) -->
            <button class="btn-ver-mas bg-blue-600 text-white px-5 py-2.5 rounded-xl shadow hover:bg-blue-700 transition mt-6 font-semibold"
                    data-id="{{ $producto->id }}">
                Ver más detalle
            </button>

            <!-- ENLACE A CONSULTA -->
            <a href="{{ route('consulta.mostrar') }}"
               class="block mt-4 text-orange-600 hover:text-orange-700 hover:underline text-sm font-medium">
                ¿Tienes dudas sobre este producto?
            </a>

            <!-- CATEGORÍA / SUBCATEGORÍA -->
            <div class="mt-6 text-sm text-gray-600 leading-relaxed bg-orange-50 p-4 rounded-xl border border-orange-200">
                <p>
                    <strong class="text-orange-700">Categoría:</strong>
                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                </p>
                <p class="mt-1">
                    <strong class="text-orange-700">Subcategoría:</strong>
                    {{ $producto->subcategoria->nombre ?? 'Sin subcategoría' }}
                </p>
            </div>

            <!-- SELECTOR DE CANTIDAD -->
            <div class="flex items-center gap-4 bg-orange-50 px-4 py-2 rounded-xl border border-orange-200 shadow-sm w-fit mt-8">

                <button class="btn-menos bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="{{ $producto->id }}">−</button>

                <span class="font-bold text-xl w-10 text-center text-gray-800 cantidad-producto">1</span>

                <button class="btn-mas bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="{{ $producto->id }}">+</button>

            </div>

            <!-- BOTÓN AÑADIR AL CARRITO -->
            @if($producto->stock > 0)
                <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-8">
                    @csrf
                    <input type="hidden" name="id" value="{{ $producto->id }}">
                    <button class="bg-orange-600 text-white px-8 py-3 rounded-xl shadow hover:bg-orange-700 transition flex items-center gap-2 text-lg font-semibold">
                        🛒 Añadir al carrito
                    </button>
                </form>
            @else
                <p class="mt-8 bg-red-500 text-white px-4 py-2 rounded-lg shadow text-center font-semibold">
                    Producto temporalmente agotado
                </p>
            @endif

        </div>

    </div>

    <hr class="my-12 border-orange-200">

    <!-- VALORACIONES -->
    <h3 class="text-3xl font-extrabold text-orange-700 mb-8">
        Opiniones de clientes
    </h3>

    @forelse($producto->valoraciones as $v)
        <div class="border border-orange-200 p-6 rounded-xl mb-6 bg-white shadow-md hover:shadow-lg transition">

            <div class="flex justify-between items-center mb-3">
                <p class="font-semibold text-gray-800 text-lg">{{ $v->usuario->name }}</p>
                <p class="text-sm text-gray-500">{{ $v->created_at->format('d/m/Y') }}</p>
            </div>

            <!-- ESTRELLAS -->
            <div class="flex items-center mb-3">
                <span class="text-yellow-500 text-2xl font-bold">
                    {{ str_repeat('★', $v->estrellas) }}
                </span>
                <span class="text-gray-400 ml-2 text-sm">
                    {{ $v->estrellas }}/5
                </span>
            </div>

            <!-- COMENTARIO -->
            <p class="text-gray-700 leading-relaxed text-base">
                {{ $v->comentario }}
            </p>

        </div>
    @empty
        <p class="text-gray-500 italic">Este producto aún no tiene valoraciones.</p>
    @endforelse

    <!-- ANCLA PARA AJAX -->
    <div id="valorar"></div>

    <!-- FORMULARIO DE VALORACIÓN -->
    @if(auth()->check())
        <div id="form-valoracion" class="mt-12 p-8 border border-orange-200 rounded-2xl bg-white shadow-lg">

            <h3 class="text-2xl font-bold mb-6 text-orange-700">
                Deja tu valoración
            </h3>

            <form action="{{ route('valoracion.store') }}" method="POST">
                @csrf

                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <input type="hidden" name="linea_id" id="linea_id_valoracion">

                <!-- ESTRELLAS -->
                <div class="flex gap-4 mb-6 text-3xl">
                    @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer flex items-center">
                            <input type="radio" 
                                   name="estrellas" 
                                   value="{{ $i }}" 
                                   class="hidden peer" 
                                   required>
                            <span class="text-gray-300 peer-checked:text-yellow-500 transition">
                                ★
                            </span>
                        </label>
                    @endfor
                </div>

                <!-- COMENTARIO -->
                <textarea name="comentario" maxlength="200" required
                          class="w-full p-4 border border-orange-300 rounded-xl focus:ring focus:ring-orange-400 text-base"
                          placeholder="Escribe tu opinión (máx. 200 caracteres)"></textarea>

                <button type="submit"
                        class="mt-6 bg-orange-600 text-white px-8 py-3 rounded-xl shadow hover:bg-orange-700 transition font-semibold text-lg">
                    Enviar valoración
                </button>
            </form>
        </div>
    @endif
</div>

@include('components.modal-producto')
@endsection

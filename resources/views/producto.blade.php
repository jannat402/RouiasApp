@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow-lg p-6 rounded-lg border border-orange-200">

    <div class="flex flex-col md:flex-row gap-6">

        <!-- IMAGEN -->
        <img src="{{ $producto->imagen }}" 
             class="w-full md:w-1/2 rounded-lg shadow-md border border-orange-100">

        <!-- INFO -->
        <div class="flex-1">
            <h2 class="text-4xl font-extrabold text-orange-700 flex items-center gap-2">
                🐾 {{ $producto->nombre }}
            </h2>

            <p class="text-gray-700 mt-3 leading-relaxed">
                {{ $producto->descripcion }}
            </p>

            <p class="text-3xl font-bold mt-4 text-orange-600">
                {{ number_format($producto->precio, 2) }} €
            </p>

            <p class="mt-3 text-sm text-gray-600">
                Categoría: 
                <strong class="text-orange-700">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</strong><br>
                Subcategoría: 
                <strong class="text-orange-700">{{ $producto->subcategoria->nombre ?? 'Sin subcategoría' }}</strong>
            </p>

            <!-- BOTÓN AÑADIR AL CARRITO -->
            <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-5">
                @csrf
                <input type="hidden" name="id" value="{{ $producto->id }}">
                <button class="bg-orange-500 text-white px-5 py-2 rounded-lg shadow hover:bg-orange-600 transition flex items-center gap-2">
                    🛒 Añadir al carrito
                </button>
            </form>
        </div>

    </div>

    <hr class="my-8 border-orange-200">

    <!-- VALORACIONES -->
    <h3 class="text-2xl font-bold text-orange-700 mb-4">
        Opiniones de clientes
    </h3>

    @forelse($producto->valoraciones as $v)
        <div class="border border-orange-200 p-4 rounded-lg mb-4 bg-white shadow-sm">

            <div class="flex justify-between items-center mb-1">
                <p class="font-semibold text-gray-800">{{ $v->user->name }}</p>
                <p class="text-sm text-gray-500">{{ $v->created_at->format('d/m/Y') }}</p>
            </div>

            <div class="flex items-center mb-2">
                <span class="text-yellow-500 text-lg font-bold">
                    {{ str_repeat('★', $v->estrellas) }}
                </span>
                <span class="text-gray-400 ml-2">
                    {{ $v->estrellas }}/5
                </span>
            </div>

            <p class="text-gray-700 leading-relaxed">
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
        <div id="form-valoracion" class="mt-10 p-5 border border-orange-200 rounded-lg bg-white shadow">

            <h3 class="text-xl font-bold mb-4 text-orange-700">
                Deja tu valoración
            </h3>

            <form action="{{ route('valoracion.store') }}" method="POST">
                @csrf

                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                <input type="hidden" name="linea_id" id="linea_id_valoracion">

                <!-- ESTRELLAS -->
                <div class="flex gap-3 mb-4 text-2xl">
                    @for($i = 1; $i <= 5; $i++)
                        <label class="cursor-pointer flex items-center">
                            <input type="radio" 
                                name="estrellas" 
                                value="{{ $i }}" 
                                class="peer sr-only" 
                                required>
                            <span class="text-gray-400 peer-checked:text-yellow-500 transition">
                                ★
                            </span>
                        </label>
                    @endfor
                </div>

                <!-- COMENTARIO -->
                <textarea name="comentario" maxlength="200" required
                        class="w-full p-3 border border-orange-300 rounded-lg focus:ring focus:ring-orange-400"
                        placeholder="Escribe tu opinión (máx. 200 caracteres)"></textarea>

                <button type="submit"
                        class="mt-4 bg-orange-600 text-white px-5 py-2 rounded-lg shadow hover:bg-orange-700 transition">
                    Enviar valoración
                </button>
            </form>
        </div>
    @endif

</div> 

@endsection

{{-- Script que pasa el id de la linia de pedido en el formulario --}}
@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash === "#valorar" && window.lineaID) {
        document.getElementById("linea_id_valoracion").value = window.lineaID;
    }
});
</script>
@endsection

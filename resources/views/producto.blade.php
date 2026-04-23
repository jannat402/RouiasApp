@extends('layouts.app')

@section('title', $producto->nombre)

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow p-6 rounded-lg">

    <div class="flex flex-col md:flex-row gap-6">

        <img src="{{ $producto->imagen }}" class="w-full md:w-1/2 rounded-lg shadow">

        <div class="flex-1">
            <h2 class="text-3xl font-bold">{{ $producto->nombre }}</h2>

            <p class="text-gray-700 mt-2">{{ $producto->descripcion }}</p>

            <p class="text-2xl font-semibold mt-4 text-blue-600">{{ $producto->precio }} €</p>

            <p class="mt-2 text-sm text-gray-500">
                Categoría: <strong>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</strong><br>
                Subcategoría: <strong>{{ $producto->subcategoria->nombre ?? 'Sin subcategoría' }}</strong>
            </p>

            <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="id" value="{{ $producto->id }}">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Añadir al carrito
                </button>
            </form>
        </div>

    </div>

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-3">Valoraciones</h3>

    @forelse($producto->valoraciones as $v)
        <div class="border p-3 rounded mb-3 bg-gray-50">
            <p class="font-semibold">{{ $v->user->name }}</p>
            <p class="text-yellow-500">⭐ {{ $v->estrellas }}/5</p>
            <p>{{ $v->comentario }}</p>
        </div>
    @empty
        <p class="text-gray-500">Este producto aún no tiene valoraciones.</p>
    @endforelse

</div>

@endsection

@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold mb-6">Productos para tu mascota</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    @foreach($productos as $producto)
        <div class="bg-white shadow rounded-lg p-4">
            <img src="{{ $producto->imagen }}" class="w-full h-40 object-cover rounded">

            <h3 class="text-xl font-semibold mt-3">{{ $producto->nombre }}</h3>
            <p class="text-gray-600">{{ $producto->precio }} €</p>

            <div class="mt-4 flex justify-between items-center">
                <a href="{{ route('producto.detalle', $producto->id) }}"
                   class="text-blue-600 hover:underline">
                    Ver más
                </a>

                <form action="{{ route('carrito.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $producto->id }}">
                    <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    @endforeach

</div>

@endsection

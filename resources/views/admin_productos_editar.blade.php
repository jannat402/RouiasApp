@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')

<h2 class="text-3xl font-bold mb-6">Editar producto</h2>

<div class="bg-white p-6 rounded shadow max-w-2xl">

    <form action="{{ route('admin.productos.actualizar', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Descripción</label>
            <textarea name="descripcion" class="w-full p-2 border rounded">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="mb-4">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $producto->stock }}" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label>Categoría</label>
            <select name="categoria_id" class="w-full p-2 border rounded">
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected($producto->categoria_id == $cat->id)>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Subcategoría</label>
            <select name="subcategoria_id" class="w-full p-2 border rounded">
                @foreach($subcategorias as $sub)
                    <option value="{{ $sub->id }}" @selected($producto->subcategoria_id == $sub->id)>
                        {{ $sub->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar cambios</button>

    </form>

</div>

@endsection

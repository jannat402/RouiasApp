@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Crear producto</h1>

{{-- Errores --}}
@if ($errors->any())
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.productos.guardar') }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf

    <div>
        <label class="font-semibold">Nombre</label>
        <input type="text" name="nombre" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="font-semibold">Precio</label>
        <input type="number" step="0.01" name="precio" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="font-semibold">Categoría</label>
        <select name="categoria_id" class="w-full p-2 border rounded" required>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Subcategoría</label>
        <select name="subcategoria_id" class="w-full p-2 border rounded" required>
            @foreach($subcategorias as $sub)
                <option value="{{ $sub->id }}">{{ $sub->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="w-full p-2 border rounded" rows="4"></textarea>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Imagen</label>
        <input type="file" name="imagen" class="w-full p-2 border rounded">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 col-span-2">
        Guardar producto
    </button>

</form>

@endsection

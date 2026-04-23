@extends('layouts.app')

@section('title', 'Administrar productos')

@section('content')

<h2 class="text-3xl font-bold mb-6">Productos</h2>

<a href="{{ route('admin.productos.crear') }}" 
   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    Crear producto
</a>

<div class="mt-6 bg-white p-6 rounded shadow">

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Nombre</th>
                <th class="border p-3">Precio</th>
                <th class="border p-3">Stock</th>
                <th class="border p-3">Categoría</th>
                <th class="border p-3">Subcategoría</th>
                <th class="border p-3">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($productos as $p)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $p->nombre }}</td>
                    <td class="border p-3">{{ $p->precio }} €</td>
                    <td class="border p-3">{{ $p->stock }}</td>
                    <td class="border p-3">{{ $p->categoria->nombre ?? '-' }}</td>
                    <td class="border p-3">{{ $p->subcategoria->nombre ?? '-' }}</td>
                    <td class="border p-3">
                        <a href="{{ route('admin.productos.editar', $p->id) }}" class="text-blue-600">Editar</a>
                        |
                        <form action="{{ route('admin.productos.eliminar', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection

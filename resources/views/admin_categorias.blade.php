@extends('layouts.app')

@section('title', 'Administrar categorías')

@section('content')

<h2 class="text-3xl font-bold mb-6">Categorías</h2>

<div class="bg-white p-6 rounded shadow">

    <form action="{{ route('admin.categorias.crear') }}" method="POST" class="flex gap-3 mb-6">
        @csrf
        <input type="text" name="nombre" placeholder="Nueva categoría" class="p-2 border rounded w-64">
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Crear</button>
    </form>

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Nombre</th>
                <th class="border p-3">Subcategorías</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categorias as $cat)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $cat->nombre }}</td>
                    <td class="border p-3">
                        @foreach($cat->subcategorias as $sub)
                            <span class="bg-gray-200 px-2 py-1 rounded text-sm">{{ $sub->nombre }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

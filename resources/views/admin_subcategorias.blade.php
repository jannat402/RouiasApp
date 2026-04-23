@extends('layouts.app')

@section('title', 'Administrar subcategorías')

@section('content')

<h2 class="text-3xl font-bold mb-6">Subcategorías</h2>

<div class="bg-white p-6 rounded shadow">

    <form action="{{ route('admin.subcategorias.crear') }}" method="POST" class="grid grid-cols-3 gap-3 mb-6">
        @csrf

        <input type="text" name="nombre" placeholder="Nueva subcategoría" class="p-2 border rounded">

        <select name="categoria_id" class="p-2 border rounded">
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Crear</button>
    </form>

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Subcategoría</th>
                <th class="border p-3">Categoría</th>
            </tr>
        </thead>

        <tbody>
            @foreach($subcategorias as $sub)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $sub->nombre }}</td>
                    <td class="border p-3">{{ $sub->categoria->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

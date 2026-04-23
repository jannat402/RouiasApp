@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Categorías</h1>

{{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

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

{{-- FORMULARIO CREAR CATEGORÍA --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Crear nueva categoría</h2>

    <form action="{{ route('admin.categorias.crear') }}" method="POST" class="flex gap-4">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre de la categoría"
               class="w-full p-2 border rounded" required>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Crear
        </button>
    </form>
</div>

{{-- LISTADO DE CATEGORÍAS --}}
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de categorías</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Subcategorías</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categorias as $categoria)
                <tr class="border-b">
                    <td class="p-2 border">{{ $categoria->id }}</td>
                    <td class="p-2 border">{{ $categoria->nombre }}</td>

                    <td class="p-2 border">
                        @if($categoria->subcategorias->count() > 0)
                            <ul class="list-disc pl-4">
                                @foreach($categoria->subcategorias as $sub)
                                    <li>{{ $sub->nombre }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">Sin subcategorías</span>
                        @endif
                    </td>

                    <td class="p-2 border flex gap-2">

                        {{-- Botón editar (lo implementamos en el paso 7) --}}
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded opacity-50 cursor-not-allowed">
                            Editar
                        </button>

                        {{-- Botón eliminar --}}
                        <form action="#" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

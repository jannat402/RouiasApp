@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Subcategorías</h1>

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

{{-- FORMULARIO CREAR SUBCATEGORÍA --}}
<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Crear nueva subcategoría</h2>

    <form action="{{ route('admin.subcategorias.crear') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @csrf

        <input type="text" name="nombre" placeholder="Nombre de la subcategoría"
               class="p-2 border rounded" required>

        <select name="categoria_id" class="p-2 border rounded" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Crear
        </button>
    </form>
</div>

{{-- LISTADO DE SUBCATEGORÍAS --}}
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de subcategorías</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Categoría</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($subcategorias as $sub)
                <tr class="border-b">
                    <td class="p-2 border">{{ $sub->id }}</td>
                    <td class="p-2 border">{{ $sub->nombre }}</td>
                    <td class="p-2 border">{{ $sub->categoria->nombre }}</td>

                    <td class="p-2 border flex gap-2">

                        {{-- Botón editar (lo implementamos en el paso 8 si quieres) --}}
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded opacity-50 cursor-not-allowed">
                            Editar
                        </button>

                        {{-- Botón eliminar --}}
                        <form action="#" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta subcategoría?')">
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

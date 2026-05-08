@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Productos</h1>

{{-- Botón crear producto --}}
<a href="{{ route('admin.productos.crear') }}"
   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
    Crear producto
</a>
<!-- Orden de la tabla segun el stock -->
<div class="flex gap-3 mb-4">
    <a href="{{ route('admin.productos', ['orden' => 'asc']) }}"
        class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">
        Stock ↑
    </a>
    <a href="{{ route('admin.productos', ['orden' => 'desc']) }}"
        class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">
        Stock ↓
    </a>

</div>

{{-- LISTADO DE PRODUCTOS --}}
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de productos</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border">Categoría</th>
                <th class="p-2 border">Subcategoría</th>
                <th class="p-2 border">Stock</th>
                <th class="p-2 border">Acciones</th>

            </tr>
        </thead>

        <tbody>
            @foreach($productos as $p)
                <tr class="border-b">
                    <td class="p-2 border">{{ $p->id }}</td>
                    <td class="p-2 border">{{ $p->nombre }}</td>
                    <td class="p-2 border">{{ number_format($p->precio, 2) }} €</td>
                    <td class="p-2 border">{{ $p->categoria->nombre }}</td>
                    <td class="p-2 border">{{ $p->subcategoria->nombre }}</td>
                    <td class="p-2 border">
                            {{ $p->stock }}
                            @if($p->stock == 0)
                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs ml-2">
                                    Agotado
                                </span>
                            @elseif($p->stock < 5)
                                <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs ml-2">
                                    Bajo stock
                                </span>
                            @else
                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs ml-2">
                                    Disponible
                                </span>
                            @endif
                        </td>

                    <td class="p-2 border flex gap-2">

                        {{-- Editar --}}
                        <a href="{{ route('admin.productos.editar', $p->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Editar
                        </a>

                        {{-- Eliminar --}}
                        <form action="{{ route('admin.productos.eliminar', $p->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
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

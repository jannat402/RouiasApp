@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Panel de Administración</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('admin.categorias') }}" 
           class="bg-blue-600 text-white p-6 rounded shadow hover:bg-blue-700 transition">
            <h2 class="text-xl font-semibold">Categorías</h2>
            <p class="text-sm mt-2">Gestionar categorías de productos</p>
        </a>

        <a href="{{ route('admin.subcategorias') }}" 
           class="bg-green-600 text-white p-6 rounded shadow hover:bg-green-700 transition">
            <h2 class="text-xl font-semibold">Subcategorías</h2>
            <p class="text-sm mt-2">Gestionar subcategorías</p>
        </a>

        <a href="{{ route('admin.productos') }}" 
           class="bg-purple-600 text-white p-6 rounded shadow hover:bg-purple-700 transition">
            <h2 class="text-xl font-semibold">Productos</h2>
            <p class="text-sm mt-2">Gestionar productos</p>
        </a>

    </div>
</div>

@endsection

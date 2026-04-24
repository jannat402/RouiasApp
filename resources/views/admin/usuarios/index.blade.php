@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Usuarios</h1>

{{-- Missatges --}}
@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white p-6 rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Rol</th>
                <th class="p-2 border">Fecha registro</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($usuarios as $u)
                <tr class="border-b">
                    <td class="p-2 border">{{ $u->id }}</td>
                    <td class="p-2 border">{{ $u->name }}</td>
                    <td class="p-2 border">{{ $u->email }}</td>

                    <td class="p-2 border capitalize">
                        {{ $u->role }}
                    </td>

                    <td class="p-2 border">
                        {{ $u->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="p-2 border flex gap-2">

                        {{-- Canviar rol --}}
                        <form action="{{ route('admin.usuarios.rol', $u->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="role" class="p-1 border rounded">
                                <option value="cliente" @selected($u->role == 'cliente')>Cliente</option>
                                <option value="admin" @selected($u->role == 'admin')>Admin</option>
                            </select>

                            <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Guardar
                            </button>
                        </form>

                        {{-- Eliminar --}}
                        @if($u->id !== auth()->id())
                        <form action="{{ route('admin.usuarios.eliminar', $u->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

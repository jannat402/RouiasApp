@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Pedidos</h1>

<div class="bg-white p-6 rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Cliente</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedidos as $p)
                <tr class="border-b">
                    <td class="p-2 border">{{ $p->id }}</td>
                    <td class="p-2 border">{{ $p->usuario->name }}</td>
                    <td class="p-2 border">{{ number_format($p->total, 2) }} €</td>
                    <td class="p-2 border capitalize">{{ $p->estado }}</td>
                    <td class="p-2 border">{{ $p->created_at->format('d/m/Y H:i') }}</td>

                    <td class="p-2 border">
                        <a href="{{ route('admin.pedidos.detalle', $p->id) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

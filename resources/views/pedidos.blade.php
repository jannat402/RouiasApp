@extends('layouts.app')

@section('title', 'Mis pedidos')

@section('content')

<h2 class="text-3xl font-bold mb-6">Mis pedidos</h2>

<div class="bg-white p-6 rounded shadow">

    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">ID</th>
                <th class="border p-3">Total</th>
                <th class="border p-3">Estado</th>
                <th class="border p-3">Fecha</th>
                <th class="border p-3">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedidos as $p)
                <tr class="hover:bg-gray-50">
                    <td class="border p-3">{{ $p->id }}</td>
                    <td class="border p-3">{{ $p->total }} €</td>
                    <td class="border p-3">{{ $p->estado }}</td>
                    <td class="border p-3">{{ $p->created_at->format('d/m/Y') }}</td>
                    <td class="border p-3">
                        <a href="{{ route('pedido.detalle', $p->id) }}" class="text-blue-600">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection

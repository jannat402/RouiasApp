@extends('layouts.app')

@section('title', 'Mis pedidos')

@section('content')

<h1 class="text-3xl font-bold mb-6">Mis pedidos</h1>

@if($pedidos->isEmpty())
    <p class="text-gray-600">Todavía no has realizado ningún pedido.</p>
@else

<div class="bg-white p-6 rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($pedidos as $pedido)
                <tr class="border-b">
                    <td class="p-2 border">{{ $pedido->id }}</td>

                    <td class="p-2 border">
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="p-2 border capitalize">
                        {{ $pedido->estado }}
                    </td>

                    <td class="p-2 border">
                        {{ number_format($pedido->total, 2) }} €
                    </td>

                    <td class="p-2 border">
                        <a href="{{ route('pedido.detalle', $pedido->id) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif

@endsection

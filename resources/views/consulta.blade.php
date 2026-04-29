@extends('layouts.app')

@section('title', 'Consulta sobre producto')

@section('content')

<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">

    <h2 class="text-3xl font-bold mb-6 text-orange-700">Consulta sobre producto</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="consultaForm" action="{{ route('consulta.enviar') }}" method="POST" class="space-y-4">
        @csrf

        @guest
            <div>
                <label class="font-semibold">Nombre y apellidos</label>
                <input type="text" name="nombre" class="input-field w-full p-2 border rounded">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" class="input-field w-full p-2 border rounded">
            </div>
        @endguest

        <div>
            <label class="font-semibold">Referencia del producto</label>
            <input type="text" name="referencia" class="input-field w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Consulta (máx. 150 caracteres)</label>
            <textarea name="consulta" maxlength="150"
                      class="input-field w-full p-2 border rounded" required></textarea>
        </div>

        <button id="btnEnviar"
                class="bg-orange-600 text-white px-4 py-2 rounded w-full hidden hover:bg-orange-700 transition">
            Enviar consulta
        </button>

        <div id="spinner" class="hidden text-center">
            <div class="animate-spin h-8 w-8 border-4 border-orange-600 border-t-transparent rounded-full mx-auto"></div>
            <p class="mt-2 text-orange-700">Enviando...</p>
        </div>

    </form>

</div>

@endsection

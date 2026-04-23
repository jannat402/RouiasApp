@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold mb-6">Consulta sobre producto</h2>

<form action="{{ route('contact.send') }}" method="POST" class="max-w-xl space-y-4">
    @csrf

    @guest
        <div>
            <label>Nombre y apellidos</label>
            <input type="text" name="fullname" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded">
        </div>
    @endguest

    <div>
        <label>Producto</label>
        <input type="text" name="product" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Consulta (máx 150 caracteres)</label>
        <textarea name="message" maxlength="150" class="w-full p-2 border rounded"></textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Enviar consulta
    </button>

</form>

@endsection

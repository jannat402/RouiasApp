@extends('layouts.app')

@section('content')

<h2 class="text-3xl font-bold mb-6">Crear cuenta</h2>

<form action="{{ route('register') }}" method="POST" class="max-w-xl space-y-4">
    @csrf

    <div>
        <label>Nombre y apellidos</label>
        <input type="text" name="fullname" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Fecha de nacimiento</label>
        <input type="text" name="birthdate" placeholder="DD/MM/YYYY" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Teléfono</label>
        <input type="text" name="phone" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Dirección de envío</label>
        <input type="text" name="shipping" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Dirección de facturación</label>
        <input type="text" name="billing" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Contraseña</label>
        <input type="password" name="password" class="w-full p-2 border rounded">
    </div>

    <div>
        <label>Repetir contraseña</label>
        <input type="password" name="password_confirmation" class="w-full p-2 border rounded">
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Registrarse
    </button>
</form>

@endsection

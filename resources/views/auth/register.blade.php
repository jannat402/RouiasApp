@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-3xl font-bold mb-6">Crear cuenta</h2>

    {{-- Errores globales --}}
    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="registerForm" action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nombre --}}
        <div>
            <label class="font-semibold">Nombre y apellidos</label>
            <input type="text" name="name" 
                   class="input-field w-full p-2 border rounded">
            <p class="error-text text-red-600 text-sm hidden">Formato inválido.</p>
        </div>

        {{-- Fecha nacimiento --}}
        <div>
            <label class="font-semibold">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" 
                   class="input-field w-full p-2 border rounded">
            <p class="error-text text-red-600 text-sm hidden">Debes tener entre 18 y 100 años.</p>
        </div>

        {{-- Teléfono --}}
        <div>
            <label class="font-semibold">Teléfono</label>
            <input type="text" name="telefono" 
                   placeholder="+34 612345678"
                   class="input-field w-full p-2 border rounded">
            <p class="error-text text-red-600 text-sm hidden">Formato internacional requerido.</p>
        </div>

        {{-- Dirección envío --}}
        <div>
            <label class="font-semibold">Dirección de envío</label>
            <input type="text" name="direccion_envio" 
                   class="input-field w-full p-2 border rounded">
        </div>

        {{-- Dirección facturación --}}
        <div>
            <label class="font-semibold">Dirección de facturación</label>

            <div class="flex items-center gap-2 mb-2">
                <input type="checkbox" id="copiarDireccion">
                <label for="copiarDireccion" class="text-sm">Usar la misma que envío</label>
            </div>

            <input type="text" name="direccion_facturacion" 
                   class="input-field w-full p-2 border rounded">
        </div>

        {{-- Email --}}
        <div>
            <label class="font-semibold">Email</label>
            <input type="email" name="email" 
                   class="input-field w-full p-2 border rounded">
        </div>

        {{-- Contraseña --}}
        <div>
            <label class="font-semibold">Contraseña</label>
            <input type="password" name="password" id="password"
                   class="input-field w-full p-2 border rounded">

            <meter max="4" id="passwordMeter" class="w-full mt-2"></meter>
            <p id="passwordStrength" class="text-sm mt-1"></p>
        </div>

        {{-- Confirmación --}}
        <div>
            <label class="font-semibold">Repetir contraseña</label>
            <input type="password" name="password_confirmation"
                   class="input-field w-full p-2 border rounded">
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">
            Registrarse
        </button>
    </form>
</div>

{{-- JS VALIDACIÓN --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // Inputs con focus/blur
        document.querySelectorAll(".input-field").forEach(input => {
            input.addEventListener("focus", () => {
                input.classList.add("ring-2", "ring-blue-500");
            });
            input.addEventListener("blur", () => {
                input.classList.remove("ring-2", "ring-blue-500");
            });
        });

        // Copiar dirección
        document.getElementById("copiarDireccion").addEventListener("change", e => {
            if (e.target.checked) {
                document.querySelector("input[name='direccion_facturacion']").value =
                    document.querySelector("input[name='direccion_envio']").value;
            }
        });

        // Medidor de contraseña
        const password = document.getElementById("password");
        const meter = document.getElementById("passwordMeter");
        const strengthText = document.getElementById("passwordStrength");

        password.addEventListener("input", () => {
            const val = password.value;
            let score = 0;

            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            meter.value = score;

            const levels = ["Muy débil", "Débil", "Media", "Fuerte", "Muy fuerte"];
            const colors = ["red", "orange", "yellow", "green", "green"];

            strengthText.textContent = levels[score];
            strengthText.style.color = colors[score];
        });

    });
</script>

@endsection

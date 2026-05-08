@extends('layouts.app')

@section('title', 'Finalizar compra')

@section('content')

<div class="max-w-5xl mx-auto bg-white shadow-xl p-10 rounded-2xl border border-orange-200">

    <h1 class="text-4xl font-extrabold text-orange-700 mb-10 text-center">
        🧾 Finalizar compra
    </h1>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="mb-8 p-5 bg-red-100 border border-red-300 text-red-700 rounded-xl shadow">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.procesar') }}" method="POST" class="space-y-12">
        @csrf

        {{-- DATOS DE ENVÍO --}}
        <section class="bg-orange-50 p-8 rounded-2xl border border-orange-200 shadow-sm">
            <h2 class="text-2xl font-bold text-orange-700 mb-6">📦 Datos de envío</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach([
                    'envio_nombre' => 'Nombre',
                    'envio_apellidos' => 'Apellidos',
                    'envio_email' => 'Email',
                    'envio_telefono' => 'Teléfono',
                    'envio_direccion' => 'Dirección',
                    'envio_ciudad' => 'Ciudad',
                    'envio_provincia' => 'Provincia',
                    'envio_cp' => 'Código postal'
                ] as $campo => $label)

                    <div class="{{ in_array($campo, ['envio_direccion']) ? 'md:col-span-2' : '' }}">
                        <label class="block font-semibold mb-1 text-gray-700">{{ $label }}</label>
                        <input type="{{ str_contains($campo, 'email') ? 'email' : 'text' }}"
                               name="{{ $campo }}"
                               value="{{ old($campo) }}"
                               class="w-full border border-orange-200 rounded-xl p-3 bg-white shadow-sm focus:ring-orange-500 focus:border-orange-500 transition">
                    </div>

                @endforeach

            </div>
        </section>

        {{-- DATOS DE FACTURACIÓN --}}
        <section class="bg-orange-50 p-8 rounded-2xl border border-orange-200 shadow-sm">
            <h2 class="text-2xl font-bold text-orange-700 mb-6">🧾 Datos de facturación</h2>

            <label class="flex items-center gap-2 mb-6">
                <input type="checkbox" name="misma_facturacion" id="misma_facturacion"
                       class="h-4 w-4 text-orange-600 rounded">
                <span class="font-medium text-gray-700">Usar los mismos datos de envío</span>
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach([
                    'fact_nombre' => 'Nombre',
                    'fact_apellidos' => 'Apellidos',
                    'fact_email' => 'Email',
                    'fact_telefono' => 'Teléfono',
                    'fact_direccion' => 'Dirección',
                    'fact_ciudad' => 'Ciudad',
                    'fact_provincia' => 'Provincia',
                    'fact_cp' => 'Código postal'
                ] as $campo => $label)

                    <div class="{{ in_array($campo, ['fact_direccion']) ? 'md:col-span-2' : '' }}">
                        <label class="block font-semibold mb-1 text-gray-700">{{ $label }}</label>
                        <input type="{{ str_contains($campo, 'email') ? 'email' : 'text' }}"
                               name="{{ $campo }}"
                               value="{{ old($campo) }}"
                               class="w-full border border-orange-200 rounded-xl p-3 bg-white shadow-sm focus:ring-orange-500 focus:border-orange-500 transition">
                    </div>

                @endforeach

            </div>
        </section>

        {{-- DATOS DE TARJETA --}}
        <section class="bg-orange-50 p-8 rounded-2xl border border-orange-200 shadow-sm">
            <h2 class="text-2xl font-bold text-orange-700 mb-6">💳 Pago con tarjeta</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1 text-gray-700">Número de tarjeta</label>
                    <input type="text" name="tarjeta_numero" value="{{ old('tarjeta_numero') }}"
                           class="w-full border border-orange-200 rounded-xl p-3 bg-white shadow-sm focus:ring-orange-500 focus:border-orange-500 transition"
                           placeholder="1111 2222 3333 4444">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">Fecha de expiración</label>
                    <input type="month" name="tarjeta_fecha" value="{{ old('tarjeta_fecha') }}"
                           class="w-full border border-orange-200 rounded-xl p-3 bg-white shadow-sm focus:ring-orange-500 focus:border-orange-500 transition">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-700">CVV</label>
                    <input type="text" name="tarjeta_cvv" value="{{ old('tarjeta_cvv') }}"
                           class="w-full border border-orange-200 rounded-xl p-3 bg-white shadow-sm focus:ring-orange-500 focus:border-orange-500 transition"
                           placeholder="123">
                </div>

            </div>
        </section>

        {{-- MÉTODOS DE PAGO --}}
        <section class="bg-white p-6 rounded-xl border border-orange-200 shadow-sm">
            <h3 class="text-xl font-bold text-orange-700 mb-4">Métodos de pago aceptados</h3>

            <ul class="text-gray-700 space-y-2">
                <li>💳 Tarjetas de crédito y débito (Visa, Mastercard, Maestro)</li>
                <li>🅿️ PayPal</li>
                <li>🏦 Transferencia bancaria</li>
                <li>🎁 Vales regalo</li>
            </ul>
        </section>

        {{-- BOTÓN --}}
        <div class="text-center">
            <button type="submit"
                    class="bg-orange-600 text-white px-12 py-4 rounded-2xl text-xl font-bold shadow-lg hover:bg-orange-700 transition">
                Confirmar compra →
            </button>
        </div>

    </form>

</div>

@endsection

@extends('layouts.app')

@section('title', 'Finalizar compra')

@section('content')

<div class="max-w-5xl mx-auto bg-white shadow p-8 rounded-lg border border-orange-200">

    <h1 class="text-3xl font-bold text-orange-700 mb-8 text-center">
        Finalizar compra
    </h1>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('checkout.procesar') }}" method="POST" class="space-y-10">
        @csrf

        {{-- DATOS DE ENVÍO --}}
        <section class="bg-gray-50 p-6 rounded-lg border border-orange-100">
            <h2 class="text-xl font-semibold text-orange-700 mb-4">Datos de envío</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Nombre</label>
                    <input type="text" name="envio_nombre" value="{{ old('envio_nombre') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Apellidos</label>
                    <input type="text" name="envio_apellidos" value="{{ old('envio_apellidos') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Email</label>
                    <input type="email" name="envio_email" value="{{ old('envio_email') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Teléfono</label>
                    <input type="text" name="envio_telefono" value="{{ old('envio_telefono') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-medium mb-1 text-gray-700">Dirección</label>
                    <input type="text" name="envio_direccion" value="{{ old('envio_direccion') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Ciudad</label>
                    <input type="text" name="envio_ciudad" value="{{ old('envio_ciudad') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Provincia</label>
                    <input type="text" name="envio_provincia" value="{{ old('envio_provincia') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Código postal</label>
                    <input type="text" name="envio_cp" value="{{ old('envio_cp') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

            </div>
        </section>

        {{-- DATOS DE FACTURACIÓN --}}
        <section class="bg-gray-50 p-6 rounded-lg border border-orange-100">
            <h2 class="text-xl font-semibold text-orange-700 mb-4">Datos de facturación</h2>

            <label class="flex items-center gap-2 mb-4">
                <input type="checkbox" name="misma_facturacion" id="misma_facturacion" class="h-4 w-4 text-orange-600">
                <span class="font-medium text-gray-700">Usar los mismos datos de envío</span>
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Nombre</label>
                    <input type="text" name="fact_nombre" value="{{ old('fact_nombre') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Apellidos</label>
                    <input type="text" name="fact_apellidos" value="{{ old('fact_apellidos') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Email</label>
                    <input type="email" name="fact_email" value="{{ old('fact_email') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Teléfono</label>
                    <input type="text" name="fact_telefono" value="{{ old('fact_telefono') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div class="md:col-span-2">
                    <label class="block font-medium mb-1 text-gray-700">Dirección</label>
                    <input type="text" name="fact_direccion" value="{{ old('fact_direccion') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Ciudad</label>
                    <input type="text" name="fact_ciudad" value="{{ old('fact_ciudad') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Provincia</label>
                    <input type="text" name="fact_provincia" value="{{ old('fact_provincia') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Código postal</label>
                    <input type="text" name="fact_cp" value="{{ old('fact_cp') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

            </div>
        </section>

        {{-- DATOS DE TARJETA --}}
        <section class="bg-gray-50 p-6 rounded-lg border border-orange-100">
            <h2 class="text-xl font-semibold text-orange-700 mb-4">Pago con tarjeta</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block font-medium mb-1 text-gray-700">Número de tarjeta</label>
                    <input type="text" name="tarjeta_numero" value="{{ old('tarjeta_numero') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600"
                           placeholder="1111 2222 3333 4444">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">Fecha de expiración</label>
                    <input type="month" name="tarjeta_fecha" value="{{ old('tarjeta_fecha') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600">
                </div>

                <div>
                    <label class="block font-medium mb-1 text-gray-700">CVV</label>
                    <input type="text" name="tarjeta_cvv" value="{{ old('tarjeta_cvv') }}"
                           class="w-full border border-gray-300 rounded-lg p-3 focus:ring-orange-600 focus:border-orange-600"
                           placeholder="123">
                </div>

            </div>
        </section>

        {{-- BOTÓN --}}
        <div class="text-center">
            <button type="submit"
                    class="bg-orange-600 text-white px-10 py-3 rounded-lg text-lg font-semibold shadow hover:bg-orange-700 transition">
                Confirmar compra
            </button>
        </div>

    </form>

</div>

@endsection

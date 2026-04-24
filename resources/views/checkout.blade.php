@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-orange-700">Finalizar compra</h1>

<form action="{{ route('checkout.procesar') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf

    {{-- DATOS DE ENVÍO --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Datos de envío</h2>

        <label>Nombre completo</label>
        <input type="text" name="envio_nombre" class="w-full p-2 border rounded mb-3" required>

        <label>Dirección</label>
        <input type="text" name="envio_direccion" class="w-full p-2 border rounded mb-3" required>

        <label>Ciudad</label>
        <input type="text" name="envio_ciudad" class="w-full p-2 border rounded mb-3" required>

        <label>Provincia</label>
        <input type="text" name="envio_provincia" class="w-full p-2 border rounded mb-3" required>

        <label>Código postal</label>
        <input type="text" name="envio_cp" class="w-full p-2 border rounded mb-3" required>

        <label>Teléfono</label>
        <input type="text" name="envio_telefono" class="w-full p-2 border rounded mb-3" required>
    </div>

    {{-- DATOS DE FACTURACIÓN --}}
    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Datos de facturación</h2>

        <label class="flex items-center gap-2 mb-3">
            <input type="checkbox" id="misma" name="misma_facturacion">
            Misma que envío
        </label>

        <div id="facturacionCampos">
            <label>Nombre completo</label>
            <input type="text" name="fact_nombre" class="w-full p-2 border rounded mb-3">

            <label>Dirección</label>
            <input type="text" name="fact_direccion" class="w-full p-2 border rounded mb-3">

            <label>Ciudad</label>
            <input type="text" name="fact_ciudad" class="w-full p-2 border rounded mb-3">

            <label>Provincia</label>
            <input type="text" name="fact_provincia" class="w-full p-2 border rounded mb-3">

            <label>Código postal</label>
            <input type="text" name="fact_cp" class="w-full p-2 border rounded mb-3">
        </div>
    </div>

    {{-- TARJETA --}}
    <div class="bg-white p-4 rounded shadow col-span-2">
        <h2 class="text-xl font-semibold mb-4">Pago con tarjeta</h2>

        <label>Número de tarjeta</label>
        <input type="text" name="tarjeta_numero" class="w-full p-2 border rounded mb-3" required>

        <label>Fecha de caducidad</label>
        <input type="month" name="tarjeta_fecha" class="w-full p-2 border rounded mb-3" required>

        <label>CVV</label>
        <input type="text" name="tarjeta_cvv" class="w-full p-2 border rounded mb-3" required>
    </div>

    {{-- BOTÓN --}}
    <button class="bg-orange-600 text-white px-6 py-3 rounded hover:bg-orange-700 col-span-2">
        Confirmar compra
    </button>

</form>

<script>
document.getElementById('misma').addEventListener('change', function() {
    document.getElementById('facturacionCampos').style.display = this.checked ? 'none' : 'block';
});
</script>

@endsection

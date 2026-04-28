

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6 text-orange-700">Finalizar compra</h1>

<form action="<?php echo e(route('checkout.procesar')); ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <?php echo csrf_field(); ?>

    
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

    
    <div class="bg-white p-4 rounded shadow col-span-2">
        <h2 class="text-xl font-semibold mb-4">Pago con tarjeta</h2>

        <label>Número de tarjeta</label>
        <input type="text" name="tarjeta_numero" class="w-full p-2 border rounded mb-3" required>

        <label>Fecha de caducidad</label>
        <input type="date" name="tarjeta_fecha" class="w-full p-2 border rounded mb-3" required>

        <label>CVV</label>
        <input type="text" name="tarjeta_cvv" class="w-full p-2 border rounded mb-3" required>
    </div>

    
    <button class="bg-orange-600 text-white px-6 py-3 rounded hover:bg-orange-700 col-span-2">
        Confirmar compra
    </button>

</form>

<?php if($errors->any()): ?>
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<script>
document.getElementById('misma').addEventListener('change', function() {
    document.getElementById('facturacionCampos').style.display = this.checked ? 'none' : 'block';
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\GitHub\RouiasApp\resources\views/checkout.blade.php ENDPATH**/ ?>
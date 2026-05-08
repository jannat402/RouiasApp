

<?php $__env->startSection('content'); ?>

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow border border-orange-200">

    <h1 class="text-3xl font-bold text-orange-700 mb-6">
        Mi perfil
    </h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('perfil.actualizar')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <!-- Nombre -->
        <label class="block font-semibold text-gray-700">Nombre</label>
        <input type="text" name="name" value="<?php echo e(old('name', $usuario->name)); ?>"
               class="w-full p-2 border border-orange-300 rounded mb-4">

        <!-- Teléfono -->
        <label class="block font-semibold text-gray-700">Teléfono</label>
        <input type="text" name="telefono" value="<?php echo e(old('telefono', $usuario->telefono)); ?>"
               class="w-full p-2 border border-orange-300 rounded mb-4">

        <!-- Dirección -->
        <label class="block font-semibold text-gray-700">Dirección</label>
        <input type="text" name="direccion_envio" value="<?php echo e(old('direccion_envio', $usuario->direccion_envio)); ?>"
               class="w-full p-2 border border-orange-300 rounded mb-4">

        <button class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700">
            Guardar cambios
        </button>
    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\GitHub\RouiasApp\resources\views/perfil.blade.php ENDPATH**/ ?>
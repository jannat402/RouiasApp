

<?php $__env->startSection('content'); ?>

<div class="max-w-md mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-3xl font-bold mb-6">Crear cuenta</h2>

    
    <?php if($errors->any()): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <?php if(session('success')): ?>
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('register')); ?>" method="POST" class="max-w-xl space-y-4">
        <?php echo csrf_field(); ?>

        <div>
            <label>Nombre y apellidos</label>
            <input type="text" name="name" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Teléfono</label>
            <input type="text" name="telefono" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Dirección de envío</label>
            <input type="text" name="direccion_envio" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Dirección de facturación</label>
            <input type="text" name="direccion_facturacion" class="w-full p-2 border rounded">
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
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/auth/register.blade.php ENDPATH**/ ?>
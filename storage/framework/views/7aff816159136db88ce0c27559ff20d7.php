

<?php $__env->startSection('content'); ?>

<div class="max-w-md mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-3xl font-bold mb-6">Iniciar sesión</h2>

    <form action="<?php echo e(route('login')); ?>" method="POST" class="max-w-md space-y-4">
        <?php echo csrf_field(); ?>

        <div>
            <label>Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Contraseña</label>
            <input type="password" name="password" class="w-full p-2 border rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Entrar
        </button>
    </form>
</div>
<div class="text-center mt-4">
    <p class="text-sm text-gray-600">¿No tienes cuenta?</p>
    <a href="<?php echo e(route('register')); ?>" 
       class="text-blue-600 font-semibold hover:underline">
        Crear una cuenta
    </a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/auth/login.blade.php ENDPATH**/ ?>
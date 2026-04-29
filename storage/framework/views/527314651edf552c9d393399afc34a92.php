

<?php $__env->startSection('title', 'Consulta sobre producto'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-xl mx-auto bg-white shadow p-6 rounded-lg">

    <h2 class="text-3xl font-bold mb-6 text-orange-700">Consulta sobre producto</h2>

    <?php if(session('success')): ?>
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="consultaForm" action="<?php echo e(route('consulta.enviar')); ?>" method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>

        <?php if(auth()->guard()->guest()): ?>
            <div>
                <label class="font-semibold">Nombre y apellidos</label>
                <input type="text" name="nombre" class="input-field w-full p-2 border rounded">
            </div>

            <div>
                <label class="font-semibold">Email</label>
                <input type="email" name="email" class="input-field w-full p-2 border rounded">
            </div>
        <?php endif; ?>

        <div>
            <label class="font-semibold">Referencia del producto</label>
            <input type="text" name="referencia" class="input-field w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="font-semibold">Consulta (máx. 150 caracteres)</label>
            <textarea name="consulta" maxlength="150"
                      class="input-field w-full p-2 border rounded" required></textarea>
        </div>

        <button id="btnEnviar"
                class="bg-orange-600 text-white px-4 py-2 rounded w-full hidden hover:bg-orange-700 transition">
            Enviar consulta
        </button>

        <div id="spinner" class="hidden text-center">
            <div class="animate-spin h-8 w-8 border-4 border-orange-600 border-t-transparent rounded-full mx-auto"></div>
            <p class="mt-2 text-orange-700">Enviando...</p>
        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/consulta.blade.php ENDPATH**/ ?>
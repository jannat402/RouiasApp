

<?php $__env->startSection('content'); ?>

<h2 class="text-3xl font-bold mb-6">Productos para tu mascota</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white shadow rounded-lg p-4">
            <img src="<?php echo e($producto->imagen); ?>" class="w-full h-40 object-cover rounded">

            <h3 class="text-xl font-semibold mt-3"><?php echo e($producto->nombre); ?></h3>
            <p class="text-gray-600"><?php echo e($producto->precio); ?> €</p>

            <div class="mt-4 flex justify-between items-center">
                <a href="<?php echo e(route('producto.detalle', $producto->id)); ?>"
                   class="text-blue-600 hover:underline">
                    Ver más
                </a>

                <form action="<?php echo e(route('carrito.agregar')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($producto->id); ?>">
                    <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/index.blade.php ENDPATH**/ ?>
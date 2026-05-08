

<?php $__env->startSection('title', 'Productos'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto py-12 px-6">

    <h1 class="text-4xl font-extrabold text-orange-700 mb-10 text-center">
        Nuestra tienda
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6 border border-orange-200">

                <img src="<?php echo e($p->imagen); ?>" 
                     class="w-full h-48 object-contain mb-4">

                <h2 class="text-xl font-bold text-gray-800">
                    <?php echo e($p->nombre); ?>

                </h2>

                <p class="text-orange-600 font-extrabold text-2xl mt-2">
                    <?php echo e(number_format($p->precio, 2)); ?> €
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    IVA incluido
                </p>

                <a href="<?php echo e(route('producto.detalle', $p->id)); ?>"
                   class="block mt-4 bg-orange-600 text-white px-4 py-2 rounded-lg text-center hover:bg-orange-700 transition">
                    Ver detalle
                </a>

                <?php if($p->stock > 0): ?>
                    <form action="<?php echo e(route('carrito.agregar')); ?>" method="POST" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($p->id); ?>">
                        <button class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                            🛒 Añadir al carrito
                        </button>
                    </form>
                <?php else: ?>
                    <p class="mt-3 bg-red-500 text-white px-4 py-2 rounded-lg text-center">
                        Agotado
                    </p>
                <?php endif; ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/productos/index.blade.php ENDPATH**/ ?>
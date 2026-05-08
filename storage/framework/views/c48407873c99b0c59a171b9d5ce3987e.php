

<?php $__env->startSection('content'); ?>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow border border-orange-200">

    <h1 class="text-3xl font-bold text-orange-700 mb-6">
        ¡Compra realizada con éxito! 🎉
    </h1>

    <p class="text-gray-700 mb-6">
        Gracias por tu compra. Aquí tienes el resumen de tu pedido.
    </p>

    
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-orange-600 mb-3">Detalles del pedido</h2>

        <p><strong>ID del pedido:</strong> <?php echo e($pedido->id); ?></p>
        <p><strong>Fecha:</strong> <?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></p>
        <p><strong>Estado:</strong> 
            <span class="capitalize"><?php echo e($pedido->estado); ?></span>
        </p>
    </div>

    
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-orange-600 mb-3">Productos comprados</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-orange-100 text-left">
                    <th class="p-3 border">Producto</th>
                    <th class="p-3 border">Cantidad</th>
                    <th class="p-3 border">Precio unitario</th>
                    <th class="p-3 border">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $pedido->lineas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $linea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b">
                        <td class="p-3 border"><?php echo e($linea->producto->nombre); ?></td>
                        <td class="p-3 border"><?php echo e($linea->cantidad); ?></td>
                        <td class="p-3 border"><?php echo e(number_format($linea->precio, 2)); ?> €</td>
                        <td class="p-3 border">
                            <?php echo e(number_format($linea->cantidad * $linea->precio, 2)); ?> €
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <div class="text-right mt-4">
            <p class="text-xl font-bold">
                Total: <?php echo e(number_format($pedido->total, 2)); ?> €
            </p>
        </div>
    </div>

    
    <div class="text-center mt-10">
        <a href="<?php echo e(route('home')); ?>"
           class="bg-orange-600 text-white px-6 py-3 rounded-lg hover:bg-orange-700 transition shadow">
            Volver a la tienda
        </a>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/pedido_confirmacion.blade.php ENDPATH**/ ?>
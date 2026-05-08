

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Detalle del pedido #<?php echo e($pedido->id); ?></h1>


<div class="bg-white p-6 rounded shadow mb-6">
    <p><strong>Fecha:</strong> <?php echo e($pedido->created_at->format('d/m/Y H:i')); ?></p>
    <p><strong>Estado:</strong> <span class="capitalize"><?php echo e($pedido->estado); ?></span></p>
    <p><strong>Total:</strong> <?php echo e(number_format($pedido->total, 2)); ?> €</p>
</div>


<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Productos del pedido</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Producto</th>
                <th class="p-2 border">Cantidad</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $pedido->lineas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lineas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($lineas->producto->nombre); ?></td>
                    <td class="p-2 border"><?php echo e($lineas->cantidad); ?></td>
                    <td class="p-2 border"><?php echo e(number_format($lineas->precio, 2)); ?> €</td>
                    <td class="p-2 border">
                        <?php echo e(number_format($lineas->cantidad * $lineas->precio, 2)); ?> €
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p class="text-right text-xl font-bold mt-4">
        Total: <?php echo e(number_format($pedido->total, 2)); ?> €
    </p>
</div>


<div class="mt-6">
    <a href="<?php echo e(route('mis.pedidos')); ?>"
       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        Volver a mis pedidos
    </a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/pedido_detalle.blade.php ENDPATH**/ ?>
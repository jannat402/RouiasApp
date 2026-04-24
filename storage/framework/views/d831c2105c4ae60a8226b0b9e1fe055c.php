

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Mis pedidos</h1>

<?php if($pedidos->isEmpty()): ?>
    <p class="text-gray-600">Todavía no has realizado ningún pedido.</p>
<?php else: ?>

<div class="bg-white p-6 rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Estado</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($pedido->id); ?></td>

                    <td class="p-2 border">
                        <?php echo e($pedido->created_at->format('d/m/Y H:i')); ?>

                    </td>

                    <td class="p-2 border capitalize">
                        <?php echo e($pedido->estado); ?>

                    </td>

                    <td class="p-2 border">
                        <?php echo e(number_format($pedido->total, 2)); ?> €
                    </td>

                    <td class="p-2 border">
                        <a href="<?php echo e(route('pedido.detalle', $pedido->id)); ?>"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/pedidos.blade.php ENDPATH**/ ?>
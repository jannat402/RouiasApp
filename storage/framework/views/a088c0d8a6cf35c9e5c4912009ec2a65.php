

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Detalle del pedido #<?php echo e($pedido->id); ?></h1>


<?php if(session('success')): ?>
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Datos del cliente</h2>

    <p><strong>Nombre:</strong> <?php echo e($pedido->usuario->name); ?></p>
    <p><strong>Email:</strong> <?php echo e($pedido->usuario->email); ?></p>
    <p><strong>Dirección envío:</strong> <?php echo e($pedido->usuario->direccion_envio); ?></p>
</div>


<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Productos</h2>

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
                    <td class="p-2 border"><?php echo e(number_format($lineas->cantidad * $lineas->precio, 2)); ?> €</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p class="text-right text-xl font-bold mt-4">
        Total: <?php echo e(number_format($pedido->total, 2)); ?> €
    </p>
</div>


<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Actualizar estado</h2>

    <form action="<?php echo e(route('admin.pedidos.estado', $pedido->id)); ?>" method="POST" class="flex gap-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <select name="estado" class="p-2 border rounded">
            <option value="pendiente" <?php if($pedido->estado == 'pendiente'): echo 'selected'; endif; ?>>Pendiente</option>
            <option value="enviado" <?php if($pedido->estado == 'enviado'): echo 'selected'; endif; ?>>Enviado</option>
            <option value="entregado" <?php if($pedido->estado == 'entregado'): echo 'selected'; endif; ?>>Entregado</option>
            <option value="cancelado" <?php if($pedido->estado == 'cancelado'): echo 'selected'; endif; ?>>Cancelado</option>
        </select>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
            Actualizar
        </button>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin/pedidos/detalle.blade.php ENDPATH**/ ?>
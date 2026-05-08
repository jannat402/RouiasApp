

<?php $__env->startSection('content'); ?>

<h2 class="text-3xl font-bold mb-6">Panel del administrador</h2>


<h3 class="text-xl font-semibold mb-3">Stock de productos</h3>

<div class="overflow-x-auto shadow rounded-lg mb-8">
    <table class="w-full border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-3">Producto</th>
                <th class="border p-3">Precio</th>
                <th class="border p-3">Stock</th>
                <th class="border p-3">Vendidos</th>
                <th class="border p-3">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50">
                    <td class="border p-3"><?php echo e($p->nombre); ?></td>
                    <td class="border p-3"><?php echo e($p->precio); ?> €</td>
                    <td class="border p-3"><?php echo e($p->stock); ?></td>
                    <td class="border p-3"><?php echo e($p->vendidos); ?></td>
                    <td class="border p-3">
                        <a href="<?php echo e(route('admin.editar', $p->id)); ?>" class="text-blue-600 hover:underline">
                            Editar
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>


<h3 class="text-xl font-semibold mb-3">Aplicar descuento global</h3>

<form action="<?php echo e(route('admin.descuento')); ?>" method="POST" class="flex gap-3 mb-8">
    <?php echo csrf_field(); ?>
    <input type="number" name="descuento" placeholder="%" class="p-2 border rounded w-24">
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Aplicar
    </button>
</form>


<h3 class="text-xl font-semibold mb-3">Gráfico de ventas</h3>

<canvas id="salesChart" width="600" height="300" class="bg-white shadow rounded p-4"></canvas>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin.blade.php ENDPATH**/ ?>
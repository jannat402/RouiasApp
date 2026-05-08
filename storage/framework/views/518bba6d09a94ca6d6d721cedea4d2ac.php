

<?php $__env->startSection('content'); ?>

<h1 class="text-4xl font-extrabold mb-6 text-orange-700 flex items-center gap-2">
    Tu carrito
</h1>

<?php if(empty($carrito)): ?>
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow flex items-center gap-2">
        No hay productos en el carrito.
    </div>
<?php else: ?>

<div class="overflow-x-auto shadow-lg rounded-lg border border-orange-200 bg-white">
    <table class="w-full text-left border-collapse">
        <thead class="bg-orange-100 text-orange-800">
            <tr>
                <th class="border p-3 font-semibold">Producto</th>
                <th class="border p-3 font-semibold">Precio</th>
                <th class="border p-3 font-semibold">Cantidad</th>
                <th class="border p-3 font-semibold">Subtotal</th>
                <th class="border p-3 font-semibold">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $total = 0; ?>

            <?php $__currentLoopData = $carrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $subtotal = $item['precio'] * $item['cantidad']; 
                    $total += $subtotal; 
                ?>

                <tr class="hover:bg-orange-50 transition">
                    <td class="border p-3 font-semibold text-gray-700">
                        <?php echo e($item['nombre']); ?>

                    </td>
                    <td class="border p-3 text-gray-700">
                        <?php echo e(number_format($item['precio'], 2)); ?> €
                    </td>
                    <td class="border p-3 text-gray-700">
                        <?php echo e($item['cantidad']); ?>

                    </td>
                    <td class="border p-3 font-bold text-orange-700">
                        <?php echo e(number_format($subtotal, 2)); ?> €
                    </td>
                    <td class="border p-3">

                        <form action="<?php echo e(route('carrito.eliminar')); ?>" method="POST" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo e($item['id']); ?>">
                            <button class="text-red-600 hover:text-red-800 font-semibold flex items-center gap-1">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr class="bg-orange-100 font-bold text-orange-800">
                <td colspan="3" class="border p-3 text-right">Total</td>
                <td class="border p-3"><?php echo e(number_format($total, 2)); ?> €</td>
                <td class="border p-3"></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="mt-6 flex items-center gap-4">

    <form action="<?php echo e(route('carrito.vaciar')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
            Vaciar carrito
        </button>
    </form>

    <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('checkout')); ?>"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                Finalizar compra
        </a>

    <?php else: ?>
        <div class="text-red-600 font-semibold flex items-center gap-2">
            Debes iniciar sesión para finalizar la compra.
        </div>
        <a href="<?php echo e(route('login')); ?>" 
           class="text-blue-600 underline hover:text-blue-800 flex items-center gap-1">
            Iniciar sesión
        </a>
    <?php endif; ?>

</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\GitHub\RouiasApp\resources\views/layouts/cart.blade.php ENDPATH**/ ?>
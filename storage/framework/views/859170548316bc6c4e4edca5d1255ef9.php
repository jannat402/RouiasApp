

<?php $__env->startSection('title', 'Carrito'); ?>

<?php $__env->startSection('content'); ?>

<script>
    window.isLoggedIn = <?php echo e(auth()->check() ? 'true' : 'false'); ?>;
    window.csrfToken = "<?php echo e(csrf_token()); ?>";
</script>

<?php
    $carrito = $carrito ?? [];
    $total = $total ?? 0;
?>
    <h1 class="text-4xl font-extrabold mb-10 text-orange-700 flex items-center gap-4">
        Tu carrito
    </h1>


<?php if(count($carrito) == 0): ?>
    <div class="bg-white p-12 rounded-2xl shadow-xl text-center border border-orange-200">
        <p class="text-gray-600 text-lg">Tu carrito está vacío.</p>

        <a href="<?php echo e(route('home')); ?>"
           class="mt-6 inline-block bg-orange-600 text-white px-6 py-3 rounded-xl shadow hover:bg-orange-700 transition font-semibold">
            Seguir comprando
        </a>
    </div>

<?php else: ?>

<div class="bg-white p-8 rounded-2xl shadow-xl border border-orange-200">

    <?php $__currentLoopData = $carrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex flex-col md:flex-row justify-between items-center border-b border-orange-100 py-6 gap-6">

            <!-- INFO PRODUCTO -->
            <div class="flex-1">
                <p class="text-2xl font-bold text-gray-800"><?php echo e($item['nombre']); ?></p>
                <p class="text-gray-500 text-sm mt-1"><?php echo e(number_format($item['precio'], 2)); ?> € / unidad</p>
            </div>

            <!-- CANTIDAD -->
            <div class="flex items-center gap-4 bg-orange-50 px-4 py-2 rounded-xl border border-orange-200 shadow-sm">

                <button class="btn-menos bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="<?php echo e($item['id']); ?>">−</button>

                <span class="font-bold text-xl w-10 text-center text-gray-800"><?php echo e($item['cantidad']); ?></span>

                <button class="btn-mas bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded-lg text-xl font-bold transition"
                        data-id="<?php echo e($item['id']); ?>">+</button>

            </div>

            <!-- SUBTOTAL -->
            <div class="text-2xl font-extrabold text-orange-600">
                <?php echo e(number_format($item['precio'] * $item['cantidad'], 2)); ?> €
            </div>

            <!-- ELIMINAR -->
            <button class="btn-eliminar bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl shadow transition font-semibold"
                data-id="<?php echo e($item['id']); ?>">
                Eliminar
            </button>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- TOTAL -->
    <div class="text-right mt-10">
        <p class="text-4xl font-extrabold text-orange-700">
            Total: <?php echo e(number_format($total, 2)); ?> €
        </p>
    </div>

    <!-- CTA FINAL -->
    <div class="mt-10 flex flex-col md:flex-row justify-between gap-6">

        <a href="<?php echo e(route('home')); ?>"
           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl shadow hover:bg-gray-300 transition text-center font-semibold">
            Seguir comprando
        </a>

        <a href="<?php echo e(route('checkout')); ?>"
           class="bg-orange-600 text-white px-6 py-3 rounded-xl shadow hover:bg-orange-700 transition text-center font-bold text-lg">
            Finalizar compra →
        </a>

    </div>

</div>

<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/cart.blade.php ENDPATH**/ ?>
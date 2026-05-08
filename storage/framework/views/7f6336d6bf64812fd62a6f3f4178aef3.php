

<?php $__env->startSection('title', 'Inicio'); ?>

<?php $__env->startSection('content'); ?>


<figure class="relative max-w-7xl mx-auto mt-10 rounded-2xl overflow-hidden shadow-xl">
    <img src="https://images.unsplash.com/photo-1558944351-c6c6d3a6a4f0"
         alt="Banner principal de PetShop"
         class="w-full h-80 object-cover">

    <figcaption class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/20 flex flex-col justify-center px-10">
        <h1 class="text-5xl font-extrabold text-white drop-shadow-lg mb-4">
            Todo para tus mascotas 🐾
        </h1>

        <p class="text-gray-200 text-lg mb-6 max-w-xl drop-shadow">
            Calidad, confianza y envío rápido en cada pedido.
        </p>

        <a href="<?php echo e(route('productos')); ?>"
           class="bg-orange-600 text-white px-6 py-3 rounded-xl shadow-lg hover:bg-orange-700 transition font-bold w-fit">
            Ver todos los productos →
        </a>
    </figcaption>
</figure>




<section class="max-w-7xl mx-auto mt-20">

    <h2 class="text-4xl font-extrabold text-orange-700 mb-8">
        Categorías
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">

        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('productos')); ?>?categoria=<?php echo e($cat->id); ?>">
            <figure class="bg-white p-6 rounded-2xl shadow-md border border-orange-200 hover:shadow-xl hover:-translate-y-1 transition text-center">

                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png"
                     alt="Icono de la categoría <?php echo e($cat->nombre); ?>"
                     class="w-16 h-16 mx-auto mb-4 opacity-90">

                <figcaption>
                    <p class="font-bold text-gray-800 text-lg"><?php echo e($cat->nombre); ?></p>
                </figcaption>

            </figure>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</section>




<section class="max-w-7xl mx-auto mt-20 mb-20">

    <div class="flex items-center justify-between mb-8">
        <h2 class="text-4xl font-extrabold text-orange-700">
            Productos destacados
        </h2>

        <a href="<?php echo e(route('productos')); ?>"
           class="text-orange-600 font-bold hover:text-orange-700 transition">
            Ver todos →
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">

        <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <figure class="bg-white rounded-2xl shadow-md border border-orange-200 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition">

            <div class="relative group">
                <img src="<?php echo e($p->imagen); ?>"
                     alt="Imagen del producto <?php echo e($p->nombre); ?>"
                     class="w-full h-56 object-contain bg-white p-4 transition-transform duration-300 group-hover:scale-105">

                <span class="absolute top-3 left-3 bg-orange-600 text-white text-xs px-3 py-1 rounded-full shadow">
                    <?php if($loop->first): ?>
                        Nuevo
                    <?php elseif($p->precio < 10): ?>
                        Oferta
                    <?php else: ?>
                        Popular
                    <?php endif; ?>
                </span>
            </div>

            <figcaption class="p-5">

                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    <?php echo e($p->nombre); ?>

                </h3>

                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                    <?php echo e($p->descripcion); ?>

                </p>

                <p class="text-orange-600 font-extrabold text-2xl mb-4">
                    <?php echo e(number_format($p->precio, 2)); ?> €
                </p>

                <a href="<?php echo e(route('producto.detalle', $p->id)); ?>"
                   class="block text-center bg-orange-600 text-white px-4 py-2 rounded-xl shadow hover:bg-orange-700 transition font-bold">
                    Ver detalle
                </a>

            </figcaption>

        </figure>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/home.blade.php ENDPATH**/ ?>
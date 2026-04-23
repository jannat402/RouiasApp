

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Categorías</h1>


<?php if(session('success')): ?>
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>


<div class="bg-white p-6 rounded shadow mb-6">
    <h2 class="text-xl font-semibold mb-4">Crear nueva categoría</h2>

    <form action="<?php echo e(route('admin.categorias.crear')); ?>" method="POST" class="flex gap-4">
        <?php echo csrf_field(); ?>

        <input type="text" name="nombre" placeholder="Nombre de la categoría"
               class="w-full p-2 border rounded" required>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Crear
        </button>
    </form>
</div>


<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de categorías</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Subcategorías</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($categoria->id); ?></td>
                    <td class="p-2 border"><?php echo e($categoria->nombre); ?></td>

                    <td class="p-2 border">
                        <?php if($categoria->subcategorias->count() > 0): ?>
                            <ul class="list-disc pl-4">
                                <?php $__currentLoopData = $categoria->subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($sub->nombre); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <span class="text-gray-500">Sin subcategorías</span>
                        <?php endif; ?>
                    </td>

                    <td class="p-2 border flex gap-2">

                        
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded opacity-50 cursor-not-allowed">
                            Editar
                        </button>

                        
                        <form action="#" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin/categorias/index.blade.php ENDPATH**/ ?>
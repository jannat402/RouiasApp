

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Subcategorías</h1>


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
    <h2 class="text-xl font-semibold mb-4">Crear nueva subcategoría</h2>

    <form action="<?php echo e(route('admin.subcategorias.crear')); ?>" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php echo csrf_field(); ?>

        <input type="text" name="nombre" placeholder="Nombre de la subcategoría"
               class="p-2 border rounded" required>

        <select name="categoria_id" class="p-2 border rounded" required>
            <option value="">Selecciona una categoría</option>
            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Crear
        </button>
    </form>
</div>


<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de subcategorías</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Categoría</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($sub->id); ?></td>
                    <td class="p-2 border"><?php echo e($sub->nombre); ?></td>
                    <td class="p-2 border"><?php echo e($sub->categoria->nombre); ?></td>

                    <td class="p-2 border flex gap-2">

                        
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded opacity-50 cursor-not-allowed">
                            Editar
                        </button>

                        
                        <form action="#" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar esta subcategoría?')">
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\GitHub\RouiasApp\resources\views/admin/subcategorias/index.blade.php ENDPATH**/ ?>


<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Productos</h1>


<?php if(session('success')): ?>
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>


<a href="<?php echo e(route('admin.productos.crear')); ?>"
   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
    Crear producto
</a>


<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Listado de productos</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border">Categoría</th>
                <th class="p-2 border">Subcategoría</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($p->id); ?></td>
                    <td class="p-2 border"><?php echo e($p->nombre); ?></td>
                    <td class="p-2 border"><?php echo e(number_format($p->precio, 2)); ?> €</td>
                    <td class="p-2 border"><?php echo e($p->categoria->nombre); ?></td>
                    <td class="p-2 border"><?php echo e($p->subcategoria->nombre); ?></td>

                    <td class="p-2 border flex gap-2">

                        
                        <a href="<?php echo e(route('admin.productos.editar', $p->id)); ?>"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Editar
                        </a>

                        
                        <form action="<?php echo e(route('admin.productos.eliminar', $p->id)); ?>"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin/productos/index.blade.php ENDPATH**/ ?>
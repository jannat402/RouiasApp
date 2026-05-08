

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Crear producto</h1>


<?php if($errors->any()): ?>
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admin.productos.guardar')); ?>" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php echo csrf_field(); ?>

    <div>
        <label class="font-semibold">Nombre</label>
        <input type="text" name="nombre" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="font-semibold">Precio</label>
        <input type="number" step="0.01" name="precio" class="w-full p-2 border rounded" required>
    </div>

    <div>
        <label class="font-semibold">Categoría</label>
        <select name="categoria_id" class="w-full p-2 border rounded" required>
            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="font-semibold">Subcategoría</label>
        <select name="subcategoria_id" class="w-full p-2 border rounded" required>
            <?php $__currentLoopData = $subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($sub->id); ?>"><?php echo e($sub->nombre); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="w-full p-2 border rounded" rows="4"></textarea>
    </div>

    <div class="col-span-2">
        <label class="font-semibold">Imagen</label>
        <input type="file" name="imagen" class="w-full p-2 border rounded">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 col-span-2">
        Guardar producto
    </button>

</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin/productos/crear.blade.php ENDPATH**/ ?>
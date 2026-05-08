

<?php $__env->startSection('content'); ?>

<h1 class="text-3xl font-bold mb-6">Usuarios</h1>


<?php if(session('success')): ?>
    <div class="bg-green-500 text-white p-3 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="bg-red-500 text-white p-3 rounded mb-4">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<div class="bg-white p-6 rounded shadow">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nombre</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Rol</th>
                <th class="p-2 border">Fecha registro</th>
                <th class="p-2 border">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b">
                    <td class="p-2 border"><?php echo e($u->id); ?></td>
                    <td class="p-2 border"><?php echo e($u->name); ?></td>
                    <td class="p-2 border"><?php echo e($u->email); ?></td>

                    <td class="p-2 border capitalize">
                        <?php echo e($u->role); ?>

                    </td>

                    <td class="p-2 border">
                        <?php echo e($u->created_at ? $u->created_at->format('d/m/Y H:i') : '—'); ?>

                    </td>

                    <td class="p-2 border flex gap-2">

                        
                        <form action="<?php echo e(route('admin.usuarios.rol', $u->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <select name="role" class="p-1 border rounded">
                                <option value="cliente" <?php if($u->role == 'cliente'): echo 'selected'; endif; ?>>Cliente</option>
                                <option value="admin" <?php if($u->role == 'admin'): echo 'selected'; endif; ?>>Admin</option>
                            </select>

                            <button class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Guardar
                            </button>
                        </form>

                        
                        <?php if($u->id !== auth()->id()): ?>
                        <form action="<?php echo e(route('admin.usuarios.eliminar', $u->id)); ?>"
                              method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                        <?php endif; ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/admin/usuarios/index.blade.php ENDPATH**/ ?>
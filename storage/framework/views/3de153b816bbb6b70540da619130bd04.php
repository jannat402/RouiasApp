
<?php $__env->startSection('content'); ?>
    <h1>Catalogo de peliculas</h1>

    <?php if(Auth::check()): ?>
        <a href="<?php echo e(url('catalog/create')); ?>" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Agregar película
        </a>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Director</th>
                <th>Poster</th>
                <th>Creada</th>
                <th>Actualizada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $peliculas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($peli->id); ?></td>
                <td><?php echo e($peli->title); ?></td>
                <td><?php echo e($peli->year); ?></td>
                <td><?php echo e($peli->director); ?></td>
                <td><img src="<?php echo e($peli->poster); ?>" width="60"></td>
                <td><?php echo e($peli->created_at); ?></td>
                <td><?php echo e($peli->updated_at); ?></td>

                <td>
                    <?php if(Auth::check()): ?>

                        
                        <a href="<?php echo e(url('catalog/edit/'.$peli->id)); ?>" class="btn btn-primary btn-sm mb-1">
                            Editar
                        </a>

                        
                        <?php if(!$peli->rented): ?>
                            <form action="<?php echo e(url('catalog/rent/'.$peli->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button class="btn btn-warning btn-sm mb-1">Alquilar</button>
                            </form>
                        <?php else: ?>
                            <form action="<?php echo e(url('catalog/return/'.$peli->id)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button class="btn btn-info btn-sm mb-1">Devolver</button>
                            </form>
                        <?php endif; ?>

                        
                        <form action="<?php echo e(url('catalog/delete/'.$peli->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm mb-1">Eliminar</button>
                        </form>

                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        <?php echo e($peliculas->links('pagination::simple-bootstrap-5')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\RouiasApp\resources\views/catalog/table.blade.php ENDPATH**/ ?>
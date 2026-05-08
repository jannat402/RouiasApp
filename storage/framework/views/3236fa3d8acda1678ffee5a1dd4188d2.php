<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-4">
        
        <img src="<?php echo e($pelicula->poster); ?>" class="img-responsive" />
    </div>

    <div class="col-sm-8">
        
        <h2><?php echo e($pelicula->title); ?></h2>
        <h4>Año: <?php echo e($pelicula->year); ?></h4>
        <h4>Director: <?php echo e($pelicula->director); ?></h4>
        <p><strong>Resumen:</strong> <?php echo e($pelicula->synopsis); ?></p>

        
        <?php if(!$pelicula->rented): ?>
            <p><span class="text-success">Película disponible</span></p>
        <?php else: ?>
            <p><span class="text-danger">Película actualmente alquilada</span></p>
        <?php endif; ?>

        <hr>

        
        <?php if(Auth::check()): ?>

            
            <?php if(!$pelicula->rented): ?>
                <form action="/catalog/rent/<?php echo e($pelicula->id); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit" class="btn btn-primary">Alquilar película</button>
                </form>
            <?php else: ?>
                
                <form action="/catalog/return/<?php echo e($pelicula->id); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <button type="submit" class="btn btn-danger">Devolver película</button>
                </form>
            <?php endif; ?>

            
            <a href="<?php echo e(route('catalog.edit', $pelicula->id)); ?>" class="btn btn-warning">
                Editar película
            </a>

            
            <form action="/catalog/delete/<?php echo e($pelicula->id); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">
                    Eliminar película
                </button>
            </form>

        <?php endif; ?>

        <hr>

        
        <a href="<?php echo e(route('catalog')); ?>" class="btn btn-secondary">
            Volver al listado
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\RouiasApp\resources\views/catalog/show.blade.php ENDPATH**/ ?>
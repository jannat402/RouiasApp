<?php $__env->startSection('content'); ?>
    <h1>Modificar película <?php echo e($pelicula->id); ?></h1>
    <form action="<?php echo e(url('catalog/edit/'.$pelicula->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo e($pelicula->title); ?>">
        </div>
        <div class="form-group">
            <label for="year">Año</label>
            <input type="text" name="year" id="year" class="form-control" value="<?php echo e($pelicula->year); ?>">
        </div>
        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" id="director" class="form-control" value="<?php echo e($pelicula->director); ?>">
        </div>
        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="text" name="poster" id="poster" class="form-control" value="<?php echo e($pelicula->poster); ?>">
        </div>
        <div class="form-group">
            <label for="synopsis">Resumen</label>
            <textarea name="synopsis" id="synopsis" class="form-control"><?php echo e($pelicula->synopsis); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-3">
            Modificar película
        </button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\RouiasApp\resources\views/catalog/edit.blade.php ENDPATH**/ ?>
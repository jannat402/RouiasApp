<?php $__env->startSection('content'); ?>
    <h1>Añadir una película</h1>

    <form action="<?php echo e(url('catalog/create')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>

        <div class="form-group">
            <label for="year">Año</label>
            <input type="text" name="year" id="year" class="form-control">
        </div>

        <div class="form-group">
            <label for="director">Director</label>
            <input type="text" name="director" id="director" class="form-control">
        </div>

        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="text" name="poster" id="poster" class="form-control">
        </div>

        <div class="form-group">
            <label for="synopsis">Resumen</label>
            <textarea name="synopsis" id="synopsis" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Añadir película</button>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pepe\Documents\RouiasApp\resources\views/catalog/create.blade.php ENDPATH**/ ?>
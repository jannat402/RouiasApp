<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container my-5">

        
        <?php if(Session::has('mensaje')): ?>
            <div class="alert alert-success">
                <?php echo e(Session::get('mensaje')); ?>

            </div>
        <?php endif; ?>

        
        <?php echo $__env->yieldContent('content'); ?>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"></script>
    <script src="main.js"></script>
  </body>
</html>
<?php /**PATH C:\Users\pepe\Documents\RouiasApp\resources\views/layouts/master.blade.php ENDPATH**/ ?>
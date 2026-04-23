<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PetShop</title>

    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<body class="bg-gray-100">

    <!-- NAVBAR ADMIN -->
    <header class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Panel Admin</h1>

        <nav class="flex gap-4">
            <a href="<?php echo e(route('admin')); ?>" class="hover:underline">Dashboard</a>
            <a href="<?php echo e(route('admin.categorias')); ?>" class="hover:underline">Categorías</a>
            <a href="<?php echo e(route('admin.subcategorias')); ?>" class="hover:underline">Subcategorías</a>
            <a href="<?php echo e(route('admin.productos')); ?>" class="hover:underline">Productos</a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </header>

    <!-- CONTENIDO -->
    <main class="p-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/layouts/admin.blade.php ENDPATH**/ ?>
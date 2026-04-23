<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'PetShop'); ?></title>

    
    <script src="<?php echo e(asset('js/carrito.js')); ?>"></script>
    <script src="<?php echo e(asset('js/register.js')); ?>"></script>

    
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Si el usuario está logueado, sincronizamos el carrito local con el servidor
    <?php if(auth()->guard()->check()): ?>
        let carrito = localStorage.getItem('carrito');

        if (carrito) {
            fetch("<?php echo e(route('carrito.sincronizar')); ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: carrito
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'ok') {
                    localStorage.removeItem('carrito');
                }
            });
        }
    <?php endif; ?>
});
</script>

<body class="bg-gray-100">

    <!-- HEADER -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">

        <!-- LOGO -->
        <h1 class="text-3xl font-bold text-blue-600">
            <a href="<?php echo e(route('home')); ?>">PetShop</a>
        </h1>

        <!-- BUSCADOR -->
        <form action="<?php echo e(route('buscar')); ?>" method="GET" class="w-1/2">
            <input 
                type="text" 
                name="q" 
                placeholder="Buscar productos..." 
                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </form>

        <!-- BOTONES DERECHA -->
        <div class="flex items-center gap-4">

            <!-- CARRITO -->
            <a href="<?php echo e(route('cart')); ?>" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Carrito
            </a>

            <!-- USUARIO LOGUEADO -->
            <?php if(auth()->guard()->check()): ?>

                
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin')); ?>" 
                       class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                        Admin
                    </a>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Cerrar sesión
                    </button>
                </form>

            <?php endif; ?>

            <!-- USUARIO INVITADO -->
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" 
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Iniciar sesión
                </a>
            <?php endif; ?>

        </div>

    </header>

    <!-- CONTENIDO -->
    <main class="py-10 px-6">
        
        <?php if(session('success')): ?>
            <div class="bg-green-600 text-white p-4 rounded mb-6 text-center shadow">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <?php if(session('error')): ?>
            <div class="bg-red-600 text-white p-4 rounded mb-6 text-center shadow">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-10">
        <p class="text-sm">© 2026 PetShop. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/layouts/app.blade.php ENDPATH**/ ?>
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

<body class="bg-orange-50">

    <!-- HEADER -->
    <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center border-b-4 border-orange-300">

        <!-- LOGO -->
        <h1 class="text-4xl font-extrabold text-orange-600 flex items-center gap-2">
            🐶 PetShop
        </h1>

        <!-- BUSCADOR -->
        <form action="<?php echo e(route('buscar')); ?>" method="GET" class="w-1/2">
            <input 
                type="text" 
                name="q" 
                placeholder="Buscar comida, juguetes, accesorios..."
                class="w-full border border-orange-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400"
            >
        </form>

        <!-- BOTONES DERECHA -->
        <div class="flex items-center gap-4">

            <!-- CARRITO -->
            <a href="<?php echo e(route('cart')); ?>" 
               class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition flex items-center gap-2 shadow">
                Carrito
            </a>

            <!-- USUARIO LOGUEADO -->
            <?php if(auth()->guard()->check()): ?>

                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(route('admin')); ?>" 
                       class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition shadow flex items-center gap-2">
                        Admin
                    </a>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition shadow flex items-center gap-2">
                        Cerrar sesión
                    </button>
                </form>

            <?php endif; ?>

            <!-- USUARIO INVITADO -->
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" 
                   class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition shadow flex items-center gap-2">
                    Iniciar sesión
                </a>
            <?php endif; ?>

        </div>

    </header>

    <!-- CONTENIDO -->
    <main class="py-10 px-6">

        <?php if(session('success')): ?>
            <div class="bg-green-500 text-white p-4 rounded mb-6 text-center shadow-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="bg-red-500 text-white p-4 rounded mb-6 text-center shadow-lg">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-orange-600 text-white text-center py-6 mt-10 shadow-inner">
        <p class="text-sm">© 2026 PetShop 🐾 Todos los derechos reservados.</p>
        <p class="text-xs opacity-80">Comida, juguetes y accesorios para tus mejores amigos</p>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/layouts/app.blade.php ENDPATH**/ ?>
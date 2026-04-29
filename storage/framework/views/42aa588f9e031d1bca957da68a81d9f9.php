<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PetShop - <?php echo $__env->yieldContent('title', 'Tu tienda de mascotas'); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-gray-100 text-gray-800">

    
    <header class="bg-white shadow-md sticky top-0 z-50 border-b border-orange-300">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-6">

            
            <a href="<?php echo e(route('home')); ?>" class="text-3xl font-extrabold text-orange-600 tracking-tight">
                PetShop
            </a>

            
            <form action="<?php echo e(route('buscar')); ?>" method="GET" class="flex-1 hidden md:block">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Buscar productos..."
                    class="w-full border border-orange-300 rounded-lg px-4 py-2 
                           focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
            </form>

            
            <div class="flex items-center gap-8">

                
                <div class="hidden md:flex gap-6 text-sm font-semibold text-gray-700">

                    <a href="<?php echo e(route('home')); ?>" class="hover:text-orange-600 transition">Inicio</a>

                    <a href="<?php echo e(route('home')); ?>#presentacion" class="hover:text-orange-600 transition">
                        Presentación
                    </a>

                    <a href="<?php echo e(route('home')); ?>#on-som" class="hover:text-orange-600 transition">
                        Dónde estamos
                    </a>

                    <a href="<?php echo e(route('productos')); ?>" class="hover:text-orange-600 transition">
                        Productos
                    </a>

                    <a href="<?php echo e(route('home')); ?>#contacte" class="hover:text-orange-600 transition">
                        Contacto
                    </a>
                </div>

                
                <a href="<?php echo e(route('cart')); ?>" class="relative text-2xl text-gray-700 hover:text-orange-600 transition">
                    🛒
                    <?php if(session('carrito') && count(session('carrito')) > 0): ?>
                        <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs px-2 py-0.5 rounded-full">
                            <?php echo e(count(session('carrito'))); ?>

                        </span>
                    <?php endif; ?>
                </a>

                
                <?php if(auth()->guard()->check()): ?>

                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="<?php echo e(route('admin')); ?>" class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                            Admin
                        </a>
                    <?php endif; ?>

                    
                    <a href="<?php echo e(route('perfil')); ?>" class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                        Perfil
                    </a>

                    
                    <?php if(auth()->user()->role === 'cliente' || auth()->user()->role === null): ?>
                        <a href="<?php echo e(route('mis.pedidos')); ?>" 
                           class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                            Mis pedidos
                        </a>
                    <?php endif; ?>

                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition text-sm shadow">
                            Cerrar sesión
                        </button>
                    </form>

                <?php endif; ?>

                
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" 
                       class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                        Iniciar sesión
                    </a>
                <?php endif; ?>

            </div>

        </nav>
    </header>

    
    <main class="min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-gray-900 text-white py-12 mt-16 border-t-4 border-orange-600">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

            
            <div>
                <h3 class="font-bold text-lg mb-3 text-orange-400">PetShop</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Productos de calidad para tus mascotas.  
                    Envíos rápidos y atención profesional.
                </p>
            </div>

            
            <div>
                <h3 class="font-bold text-lg mb-3 text-orange-400">Enlaces</h3>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="<?php echo e(route('home')); ?>" class="hover:text-white">Inicio</a></li>
                    <li><a href="<?php echo e(route('productos')); ?>" class="hover:text-white">Productos</a></li>
                    <li><a href="<?php echo e(route('register')); ?>" class="hover:text-white">Registro</a></li>
                    <li><a href="<?php echo e(route('login')); ?>" class="hover:text-white">Iniciar sesión</a></li>
                </ul>
            </div>

            
            <div>
                <h3 class="font-bold text-lg mb-3 text-orange-400">Legal</h3>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="#" class="hover:text-white">Aviso jurídico</a></li>
                    <li><a href="#" class="hover:text-white">Política de cookies</a></li>
                    <li><a href="#" class="hover:text-white">Confidencialidad</a></li>
                    <li><a href="#" class="hover:text-white">Condiciones de envío</a></li>
                </ul>
            </div>

        </div>

        <p class="text-center text-gray-500 text-xs mt-10">
            © <?php echo e(date('Y')); ?> PetShop — Todos los derechos reservados
        </p>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\Jannat\Documents\proyecto\RouiasApp\resources\views/layouts/app.blade.php ENDPATH**/ ?>
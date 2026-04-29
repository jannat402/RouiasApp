<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PetShop - @yield('title', 'Tu tienda de mascotas')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- NAVBAR PROFESIONAL --}}
    <header class="bg-white shadow-md sticky top-0 z-50 border-b border-orange-300">
        <nav class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between gap-6">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="text-3xl font-extrabold text-orange-600 tracking-tight">
                PetShop
            </a>

            {{-- BUSCADOR --}}
            <form action="{{ route('buscar') }}" method="GET" class="flex-1 hidden md:block">
                <input 
                    type="text" 
                    name="q" 
                    placeholder="Buscar productos..."
                    class="w-full border border-orange-300 rounded-lg px-4 py-2 
                           focus:outline-none focus:ring-2 focus:ring-orange-400"
                >
            </form>

            {{-- MENÚ + ICONOS --}}
            <div class="flex items-center gap-8">

                {{-- MENÚ PRINCIPAL --}}
                <div class="hidden md:flex gap-6 text-sm font-semibold text-gray-700">

                    <a href="{{ route('home') }}" class="hover:text-orange-600 transition">Inicio</a>

                    <a href="{{ route('home') }}#presentacion" class="hover:text-orange-600 transition">
                        Presentación
                    </a>

                    <a href="{{ route('home') }}#on-som" class="hover:text-orange-600 transition">
                        Dónde estamos
                    </a>

                    <a href="{{ route('productos') }}" class="hover:text-orange-600 transition">
                        Productos
                    </a>

                    <a href="{{ route('home') }}#contacte" class="hover:text-orange-600 transition">
                        Contacto
                    </a>
                </div>

                {{-- CARRITO --}}
                <a href="{{ route('cart') }}" class="relative text-2xl text-gray-700 hover:text-orange-600 transition">
                    🛒
                    @if(session('carrito') && count(session('carrito')) > 0)
                        <span class="absolute -top-2 -right-2 bg-orange-600 text-white text-xs px-2 py-0.5 rounded-full">
                            {{ count(session('carrito')) }}
                        </span>
                    @endif
                </a>

                {{-- USUARIO --}}
                @auth

                    {{-- ADMIN --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin') }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                            Admin
                        </a>
                    @endif

                    {{-- PERFIL --}}
                    <a href="{{ route('perfil') }}" class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                        Perfil
                    </a>

                    {{-- MIS PEDIDOS --}}
                    @if(auth()->user()->role === 'cliente' || auth()->user()->role === null)
                        <a href="{{ route('mis.pedidos') }}" 
                           class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                            Mis pedidos
                        </a>
                    @endif

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition text-sm shadow">
                            Cerrar sesión
                        </button>
                    </form>

                @endauth

                {{-- INVITADO --}}
                @guest
                    <a href="{{ route('login') }}" 
                       class="text-sm font-semibold text-gray-700 hover:text-orange-600 transition">
                        Iniciar sesión
                    </a>
                @endguest

            </div>

        </nav>
    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER PROFESIONAL --}}
    <footer class="bg-gray-900 text-white py-12 mt-16 border-t-4 border-orange-600">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- INFO --}}
            <div>
                <h3 class="font-bold text-lg mb-3 text-orange-400">PetShop</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Productos de calidad para tus mascotas.  
                    Envíos rápidos y atención profesional.
                </p>
            </div>

            {{-- ENLACES --}}
            <div>
                <h3 class="font-bold text-lg mb-3 text-orange-400">Enlaces</h3>
                <ul class="space-y-2 text-gray-300 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Inicio</a></li>
                    <li><a href="{{ route('productos') }}" class="hover:text-white">Productos</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white">Registro</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white">Iniciar sesión</a></li>
                </ul>
            </div>

            {{-- LEGAL --}}
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
            © {{ date('Y') }} PetShop — Todos los derechos reservados
        </p>
    </footer>

</body>
</html>

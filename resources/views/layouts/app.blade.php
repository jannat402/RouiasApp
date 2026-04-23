<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PetShop')</title>

    {{-- Scripts del proyecto --}}
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script src="{{ asset('js/register.js') }}"></script>

    {{-- Tailwind + Vite --}}
    @vite('resources/css/app.css')
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Si el usuario está logueado, sincronizamos el carrito local con el servidor
    @auth
        let carrito = localStorage.getItem('carrito');

        if (carrito) {
            fetch("{{ route('carrito.sincronizar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
    @endauth
});
</script>

<body class="bg-gray-100">

    <!-- HEADER -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">

        <!-- LOGO -->
        <h1 class="text-3xl font-bold text-blue-600">
            <a href="{{ route('home') }}">PetShop</a>
        </h1>

        <!-- BUSCADOR -->
        <form action="{{ route('buscar') }}" method="GET" class="w-1/2">
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
            <a href="{{ route('cart') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Carrito
            </a>

            <!-- USUARIO LOGUEADO -->
            @auth

                {{-- Mostrar botón Admin SOLO si es el admin --}}
                @if(auth()->user()->email === 'admin@admin.com')
                    <a href="{{ route('admin') }}" 
                       class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                        Admin
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Cerrar sesión
                    </button>
                </form>
            @endauth

            <!-- USUARIO INVITADO -->
            @guest
                <a href="{{ route('login') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Iniciar sesión
                </a>
            @endguest

        </div>

    </header>

    <!-- CONTENIDO -->
    <main class="py-10 px-6">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-10">
        <p class="text-sm">© 2026 PetShop. Todos los derechos reservados.</p>
    </footer>

</body>
</html>

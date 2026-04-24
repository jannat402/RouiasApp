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

<body class="bg-orange-50">

    <!-- HEADER -->
    <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center border-b-4 border-orange-300">

        <!-- LOGO -->
        <h1 class="text-4xl font-extrabold text-orange-600 flex items-center gap-2">
            🐶 PetShop
        </h1>

        <!-- BUSCADOR -->
        <form action="{{ route('buscar') }}" method="GET" class="w-1/2">
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
            <a href="{{ route('cart') }}" 
               class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition flex items-center gap-2 shadow">
                Carrito
            </a>

            <!-- USUARIO LOGUEADO -->
            @auth

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin') }}" 
                       class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition shadow flex items-center gap-2">
                        Admin
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition shadow flex items-center gap-2">
                        Cerrar sesión
                    </button>
                </form>

            @endauth

            <!-- USUARIO INVITADO -->
            @guest
                <a href="{{ route('login') }}" 
                   class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition shadow flex items-center gap-2">
                    Iniciar sesión
                </a>
            @endguest

        </div>

    </header>

    <!-- CONTENIDO -->
    <main class="py-10 px-6">

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6 text-center shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-6 text-center shadow-lg">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-orange-600 text-white text-center py-6 mt-10 shadow-inner">
        <p class="text-sm">© 2026 PetShop 🐾 Todos los derechos reservados.</p>
        <p class="text-xs opacity-80">Comida, juguetes y accesorios para tus mejores amigos</p>
    </footer>

</body>
</html>

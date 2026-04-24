<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PetShop</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- NAVBAR ADMIN -->
    <header class="bg-gray-900 text-white px-6 py-4 flex justify-between items-center shadow-lg">
        
        <!-- TÍTULO -->
        <h1 class="text-2xl font-bold tracking-wide flex items-center gap-2">
            🐾 Panel de Administración
        </h1>

        <!-- NAV -->
        <nav class="flex items-center gap-6">

            <!-- ENLACES -->
            <div class="flex gap-4 text-sm">
                <a href="{{ route('admin') }}" class="hover:text-teal-300 transition">Dashboard</a>
                <a href="{{ route('admin.categorias') }}" class="hover:text-teal-300 transition">Categorías</a>
                <a href="{{ route('admin.subcategorias') }}" class="hover:text-teal-300 transition">Subcategorías</a>
                <a href="{{ route('admin.productos') }}" class="hover:text-teal-300 transition">Productos</a>
                <a href="{{ route('admin.pedidos') }}" class="hover:text-teal-300 transition">Pedidos</a>
                <a href="{{ route('admin.usuarios') }}" class="hover:text-teal-300 transition">Usuarios</a>
                <a href="{{ route('admin.grafico') }}" class="hover:text-teal-300 transition">Gráfico</a>
            </div>

            <!-- BOTÓN VOLVER A LA TIENDA -->
            <a href="{{ route('home') }}" 
               class="bg-teal-600 px-4 py-2 rounded-md hover:bg-teal-700 transition text-sm font-semibold shadow flex items-center gap-1">
                ← Volver a la tienda
            </a>

            <!-- DESCUENTO -->
            <div class="flex items-center gap-3 bg-gray-800 px-4 py-2 rounded-md shadow">
                <form action="{{ route('admin.descuento') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="number" name="descuento" placeholder="%" 
                           class="p-2 w-20 rounded bg-gray-700 border border-gray-600 text-white focus:ring focus:ring-teal-400"
                           required>
                    <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                        Aplicar
                    </button>
                </form>
            </div>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-4 py-2 rounded-md hover:bg-red-700 transition text-sm font-semibold shadow">
                    Cerrar sesión
                </button>
            </form>

        </nav>
    </header>

    <!-- MENSAJE DE ÉXITO -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-2 mt-4 mx-6 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- CONTENIDO -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>

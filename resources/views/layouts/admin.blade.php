<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PetShop</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- NAVBAR ADMIN -->
    <header class="bg-gray-900 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Panel Admin</h1>

        <nav class="flex gap-4">
            <a href="{{ route('admin') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('admin.categorias') }}" class="hover:underline">Categorías</a>
            <a href="{{ route('admin.subcategorias') }}" class="hover:underline">Subcategorías</a>
            <a href="{{ route('admin.productos') }}" class="hover:underline">Productos</a>
            <a href="{{ route('admin.pedidos') }}" class="hover:underline">Pedidos</a>
            <a href="{{ route('admin.usuarios') }}" class="hover:underline">Usuarios</a>
            <a href="{{ route('admin.grafico') }}" class="hover:underline">Gráfico de ventas</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-3 py-1 rounded hover:bg-red-700">
                    Cerrar sesión
                </button>
            </form>
        </nav>
    </header>

    <!-- CONTENIDO -->
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>

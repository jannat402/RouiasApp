<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ValoracionController;



// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Buscador
Route::get('/buscar', [HomeController::class, 'buscar'])->name('buscar');

// Detalle de producto
Route::get('/producto/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');

//carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('cart');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

// Valoraciones
Route::post('/valoracion/enviar', [ValoracionController::class, 'store'])
    ->name('valoracion.store')
    ->middleware('auth');

// Sincronización con localStorage
Route::post('/carrito/sincronizar', [CarritoController::class, 'sincronizar'])
    ->name('carrito.sincronizar');

// Checkout y pedidos (solo usuarios logueados)
Route::middleware('auth')->group(function () {

    // Finalizar compra
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

    // Historial de pedidos del cliente
    Route::get('/mis-pedidos', [PedidoController::class, 'misPedidos'])
        ->middleware('auth')
        ->name('mis.pedidos');

    // Detalle de un pedido del cliente
    Route::get('/mis-pedidos/{id}', [PedidoController::class, 'detallePedido'])
        ->middleware('auth')
        ->name('pedido.detalle');

    // ajax
    Route::get('/ajax/check-comments', [PedidoController::class, 'checkComments'])
        ->name('ajax.checkComments');

    Route::post('/ajax/mark-comment', [PedidoController::class, 'markComment'])
        ->name('ajax.markComment');

});

// Panel administrador
Route::middleware(['auth', 'isAdmin'])->group(function () {

    // Dashboard admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Categorías
    Route::get('/admin/categorias', [AdminController::class, 'categorias'])
        ->name('admin.categorias');

    Route::post('/admin/categorias/crear', [AdminController::class, 'crearCategoria'])
        ->name('admin.categorias.crear');

    // Subcategorías
    Route::get('/admin/subcategorias', [AdminController::class, 'subcategorias'])
        ->name('admin.subcategorias');

    Route::post('/admin/subcategorias/crear', [AdminController::class, 'crearSubcategoria'])
        ->name('admin.subcategorias.crear');

    // Productos
    Route::get('/admin/productos', [AdminController::class, 'productos'])
        ->name('admin.productos');

    Route::get('/admin/productos/crear', [AdminController::class, 'crearProducto'])
        ->name('admin.productos.crear');

    Route::post('/admin/productos/guardar', [AdminController::class, 'guardarProducto'])
        ->name('admin.productos.guardar');

    Route::get('/admin/productos/editar/{id}', [AdminController::class, 'editarProducto'])
        ->name('admin.productos.editar');

    Route::put('/admin/productos/actualizar/{id}', [AdminController::class, 'actualizarProducto'])
        ->name('admin.productos.actualizar');

    Route::delete('/admin/productos/eliminar/{id}', [AdminController::class, 'eliminarProducto'])
        ->name('admin.productos.eliminar');

    // Pedidos (admin)
    Route::get('/admin/pedidos', [AdminController::class, 'pedidos'])
        ->name('admin.pedidos');

    Route::get('/admin/pedidos/{id}', [AdminController::class, 'pedidoDetalle'])
        ->name('admin.pedidos.detalle');

    Route::put('/admin/pedidos/{id}/estado', [AdminController::class, 'actualizarEstado'])
        ->name('admin.pedidos.estado');
    
    // Usuarios (admin)
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])
        ->name('admin.usuarios');

    Route::put('/admin/usuarios/{id}/rol', [AdminController::class, 'cambiarRol'])
        ->name('admin.usuarios.rol');

    Route::delete('/admin/usuarios/{id}', [AdminController::class, 'eliminarUsuario'])
        ->name('admin.usuarios.eliminar');

    // Grafico
    Route::get('/admin/grafico', [AdminController::class, 'grafico'])
    ->name('admin.grafico');

    // Descuento global
    Route::post('/admin/descuento', [AdminController::class, 'aplicarDescuento'])
        ->name('admin.descuento');
});


// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Catálogo público
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/show/{id}', [CatalogController::class, 'show'])->name('catalog.show');

// Tabla (pública o privada, como tú quieras)
Route::get('/catalog/table', [CatalogController::class, 'table'])->name('catalog.table');

// Rutas protegidas (solo usuarios logueados)
Route::middleware(['auth'])->group(function () {

    // Crear
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/catalog/create', [CatalogController::class, 'postCreate']);

    // Editar
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('catalog.edit');
    Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit']);

    // Alquilar / devolver
    Route::put('/catalog/rent/{id}', [CatalogController::class, 'putRent'])->name('catalog.rent');
    Route::put('/catalog/return/{id}', [CatalogController::class, 'putReturn'])->name('catalog.return');

    // Eliminar
    Route::delete('/catalog/delete/{id}', [CatalogController::class, 'deleteMovie'])->name('catalog.delete');
});

// Rutas de autenticación (Breeze)
require __DIR__.'/auth.php';

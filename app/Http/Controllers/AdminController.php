<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // DASHBOARD ADMIN
    public function index()
    {
        return view('admin.dashboard');
    }

    // LISTADO DE CATEGORÍAS
    public function categorias()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    // CREAR CATEGORÍA
    public function crearCategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Categoria::create(['nombre' => $request->nombre]);

        return back()->with('success', 'Categoría creada correctamente.');
    }

    // LISTADO DE SUBCATEGORÍAS
    public function subcategorias()
    {
        $subcategorias = Subcategoria::with('categoria')->get();
        $categorias = Categoria::all();

        return view('admin.subcategorias.index', compact('subcategorias', 'categorias'));
    }

    // CREAR SUBCATEGORÍA
    public function crearSubcategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Subcategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id
        ]);

        return back()->with('success', 'Subcategoría creada correctamente.');
    }

    // LISTADO DE PRODUCTOS
    public function productos()
    {
        $productos = Producto::with('categoria', 'subcategoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    // DESCUENTO GLOBAL
    public function descuento(Request $request)
    {
        $request->validate([
            'descuento' => 'required|numeric|min:1|max:90'
        ]);

        foreach (Producto::all() as $p) {
            $p->precio = $p->precio * (1 - $request->descuento / 100);
            $p->save();
        }

        return back()->with('success', 'Descuento aplicado correctamente.');
    }
}

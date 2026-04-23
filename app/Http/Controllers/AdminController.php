<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria', 'subcategoria')->get();
        return view('admin', compact('productos'));
    }

    public function categorias()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return view('admin_categorias', compact('categorias'));
    }

    public function crearCategoria(Request $request)
    {
        Categoria::create(['nombre' => $request->nombre]);
        return back();
    }

    public function crearSubcategoria(Request $request)
    {
        Subcategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id
        ]);

        return back();
    }

    public function descuento(Request $request)
    {
        foreach (Producto::all() as $p) {
            $p->precio = $p->precio * (1 - $request->descuento / 100);
            $p->save();
        }

        return back();
    }
}

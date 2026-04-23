<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('subcategorias')->get();
        $productos = Producto::where('stock', '>', 0)->get();

        return view('index', compact('categorias', 'productos'));
    }

    public function buscar(Request $request)
    {
        $q = $request->q;

        $productos = Producto::where('nombre', 'LIKE', "%$q%")
            ->orWhere('descripcion', 'LIKE', "%$q%")
            ->get();

        return view('index', compact('productos'));
    }
}

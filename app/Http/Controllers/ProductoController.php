<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function detalle($id)
    {
        $producto = Producto::with('valoraciones')->findOrFail($id);
        return view('producto', compact('producto'));
    }

    public function ajaxDetalle($id)
    {
        $producto = Producto::with('categoria', 'subcategoria')->findOrFail($id);

        return response()->json([
            'nombre'      => $producto->nombre,
            'descripcion' => $producto->descripcion,
            'precio'      => number_format($producto->precio, 2),
            'categoria'   => $producto->categoria->nombre ?? 'Sin categoría',
            'subcategoria'=> $producto->subcategoria->nombre ?? 'Sin subcategoría',
            'imagen'      => $producto->imagen,
        ]);
    }

    
}

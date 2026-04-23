<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ProductoController extends Controller
{
    public function detalle($id)
    {
        $producto = Producto::with('valoraciones')->findOrFail($id);
        return view('producto', compact('producto'));
    }
}

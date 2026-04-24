<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function detalle($id)
    {
        $producto = Producto::with('valoraciones')->findOrFail($id);
        return view('producto', compact('producto'));
    }

    
}

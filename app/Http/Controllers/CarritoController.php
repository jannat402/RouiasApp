<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        return view('layouts.cart', compact('carrito'));
    }

    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);

        $carrito = session('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1
            ];
        }

        session(['carrito' => $carrito]);

        return back()->with('success', 'Producto añadido al carrito');

    }

    public function eliminar(Request $request)
    {
        $carrito = session('carrito', []);
        unset($carrito[$request->id]);
        session(['carrito' => $carrito]);

        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function vaciar()
    {
        session()->forget('carrito');
        return back();
    }

    public function sincronizar(Request $request)
    {
        $items = json_decode($request->getContent(), true);

        $carrito = [];

        foreach ($items as $item) {
            $producto = Producto::find($item['id']);
            if ($producto) {
                $carrito[$item['id']] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'cantidad' => $item['cantidad']
                ];
            }
        }

        session(['carrito' => $carrito]);

        return response()->json(['status' => 'ok']);
    }
}

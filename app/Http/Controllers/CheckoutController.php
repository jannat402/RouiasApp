<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\LineaPedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío');
        }

        // Crear pedido
        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'total' => array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)),
            'estado' => 'pagado'
        ]);

        // Crear líneas de pedido
        foreach ($carrito as $item) {

            LineaPedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio'],
                'has_to_comment' => true // MARCAR QUE EL USUARIO DEBE COMENTAR
            ]);

            // Actualizar stock
            $producto = Producto::find($item['id']);
            $producto->stock -= $item['cantidad'];
            $producto->vendidos += $item['cantidad'];
            $producto->save();
        }

        // Vaciar carrito
        session()->forget('carrito');

        return redirect()->route('home')->with('success', 'Compra realizada con éxito');
    }
}

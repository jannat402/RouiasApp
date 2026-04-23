<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Mostrar los pedidos del usuario autenticado
     */
    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos', compact('pedidos'));
    }

    /**
     * Mostrar el detalle de un pedido
     */
    public function detalle($id)
    {
        $pedido = Pedido::with('lineas.producto')
            ->where('user_id', Auth::id()) // seguridad: solo ver tus pedidos
            ->findOrFail($id);

        return view('pedido_detalle', compact('pedido'));
    }
}

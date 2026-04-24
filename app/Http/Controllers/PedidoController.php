<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Historial de pedidos del cliente
    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos', compact('pedidos'));
    }

    // Detalle de un pedido del cliente
    public function detallePedido($id)
    {
        $pedido = Pedido::with('lineas.producto')
            ->where('user_id', Auth::id()) // seguridad: solo ver tus pedidos
            ->findOrFail($id);

        return view('pedido_detalle', compact('pedido'));
    }

    //valoraciones
    public function checkComments()
    {
        // Buscar si el usuario tiene productos pendientes de comentar
        $pendientes = DB::table('lineas_pedido')
            ->join('pedidos', 'pedidos.id', '=', 'lineas_pedido.pedido_id')
            ->join('productos', 'productos.id', '=', 'lineas_pedido.producto_id')
            ->where('pedidos.user_id', Auth::id()) // ✔ CORREGIDO
            ->where('lineas_pedido.has_to_comment', true)
            ->select(
                'lineas_pedido.id',
                'productos.nombre',
                'productos.id as producto_id'
        )
        ->first();

        return response()->json([
            'pendiente' => $pendientes ? true : false,
            'data' => $pendientes
        ]);
    }

    public function markComment(Request $request)
    {
        $request->validate([
            'linea_id' => 'required|integer',
            'accion' => 'required|string' // hacer / no / despues
        ]);

        // Marcar como resuelto
        DB::table('lineas_pedido')
            ->where('id', $request->linea_id)
            ->update(['has_to_comment' => false]);

        return response()->json(['success' => true]);
    }

}

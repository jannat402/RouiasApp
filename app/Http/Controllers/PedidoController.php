<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\LineaPedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Mostrar checkout
    public function mostrarCheckout()
    {
        return view('checkout');
    }

    // Procesar compra completa
    public function realizarCompra(Request $request)
    {
        // VALIDACIÓN COMPLETA
        $request->validate([
            // Envío
            'envio_nombre' => 'required|string|max:255',
            'envio_direccion' => 'required|string|max:255',
            'envio_ciudad' => 'required|string|max:255',
            'envio_provincia' => 'required|string|max:255',
            'envio_cp' => 'required|string|max:20',
            'envio_telefono' => 'required|string|max:20',

            // Facturación
            'fact_nombre' => 'nullable|string|max:255',
            'fact_direccion' => 'nullable|string|max:255',
            'fact_ciudad' => 'nullable|string|max:255',
            'fact_provincia' => 'nullable|string|max:255',
            'fact_cp' => 'nullable|string|max:20',

            // Tarjeta ficticia
            'tarjeta_numero' => 'required|string|min:12|max:19',
            'tarjeta_fecha' => 'required|date',
            'tarjeta_cvv' => 'required|string|min:3|max:4',
        ]);

        // OBTENER CARRITO
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        // FACTURACIÓN = MISMA QUE ENVÍO
        if ($request->has('misma_facturacion')) {
            $fact_nombre = $request->envio_nombre;
            $fact_direccion = $request->envio_direccion;
            $fact_ciudad = $request->envio_ciudad;
            $fact_provincia = $request->envio_provincia;
            $fact_cp = $request->envio_cp;
        } else {
            $fact_nombre = $request->fact_nombre;
            $fact_direccion = $request->fact_direccion;
            $fact_ciudad = $request->fact_ciudad;
            $fact_provincia = $request->fact_provincia;
            $fact_cp = $request->fact_cp;
        }

        // CREAR PEDIDO
        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'estado' => 'pendiente',

            // Envío
            'envio_nombre' => $request->envio_nombre,
            'envio_direccion' => $request->envio_direccion,
            'envio_ciudad' => $request->envio_ciudad,
            'envio_provincia' => $request->envio_provincia,
            'envio_cp' => $request->envio_cp,
            'envio_telefono' => $request->envio_telefono,

            // Facturación
            'fact_nombre' => $fact_nombre,
            'fact_direccion' => $fact_direccion,
            'fact_ciudad' => $fact_ciudad,
            'fact_provincia' => $fact_provincia,
            'fact_cp' => $fact_cp,
        ]);

        $total = 0;

        // CREAR LÍNEAS DE PEDIDO
        foreach ($carrito as $item) {
            $producto = Producto::find($item['id']);

            if (!$producto) continue;

            // Comprobar stock
            if ($producto->stock < $item['cantidad']) {
                return back()->with('error', "No hay stock suficiente de {$producto->nombre}");
            }

            // Crear línea
            LineaPedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
                'has_to_comment' => true,
            ]);

            // Restar stock
            $producto->stock -= $item['cantidad'];
            $producto->save();

            // Sumar total
            $total += $producto->precio * $item['cantidad'];
        }

        // Guardar total
        $pedido->total = $total;
        $pedido->save();

        // Vaciar carrito
        session()->forget('carrito');

        // Redirigir a confirmación
        return redirect()->route('pedido.confirmacion', $pedido->id);
    }

    // Página de confirmación
    public function confirmacion($id)
    {
        $pedido = Pedido::with('lineas.producto')->findOrFail($id);
        return view('pedido_confirmacion', compact('pedido'));
    }

    // Historial del cliente
    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos', compact('pedidos'));
    }

    // Detalle del pedido del cliente
    public function detallePedido($id)
    {
        $pedido = Pedido::with('lineas.producto')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pedido_detalle', compact('pedido'));
    }

    // Valoraciones
    public function checkComments()
    {
        $pendientes = DB::table('lineas_pedido')
            ->join('pedidos', 'pedidos.id', '=', 'lineas_pedido.pedido_id')
            ->join('productos', 'productos.id', '=', 'lineas_pedido.producto_id')
            ->where('pedidos.user_id', Auth::id())
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
            'accion' => 'required|string'
        ]);

        DB::table('lineas_pedido')
            ->where('id', $request->linea_id)
            ->update(['has_to_comment' => false]);

        return response()->json(['success' => true]);
    }
}

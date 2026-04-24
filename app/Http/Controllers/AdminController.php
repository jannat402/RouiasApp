<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    // DASHBOARD ADMIN
    public function index()
    {
        return view('admin.dashboard');
    }

    // LISTADO DE CATEGORÍAS
    public function categorias()
    {
        $categorias = Categoria::with('subcategorias')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    // CREAR CATEGORÍA
    public function crearCategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Categoria::create(['nombre' => $request->nombre]);

        return back()->with('success', 'Categoría creada correctamente.');
    }

    // LISTADO DE SUBCATEGORÍAS
    public function subcategorias()
    {
        $subcategorias = Subcategoria::with('categoria')->get();
        $categorias = Categoria::all();

        return view('admin.subcategorias.index', compact('subcategorias', 'categorias'));
    }

    // CREAR SUBCATEGORÍA
    public function crearSubcategoria(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Subcategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id
        ]);

        return back()->with('success', 'Subcategoría creada correctamente.');
    }

    // LISTADO DE PRODUCTOS
    public function productos(Request $request)
    {
        $orden = $request->get('orden');

        if ($orden === 'asc') {
            $productos = Producto::orderBy('stock', 'asc')->get();
        } elseif ($orden === 'desc') {
            $productos = Producto::orderBy('stock', 'desc')->get();
        } else {
            $productos = Producto::with('categoria', 'subcategoria')->get();
        }

        return view('admin.productos.index', compact('productos'));
    }


    // ACCIONES SOBRE LOS PRODUCTOS ADMIN
    public function crearProducto()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('admin.productos.crear', compact('categorias', 'subcategorias'));
    }

    public function guardarProducto(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'imagen' => 'nullable|image'
        ]);

        $rutaImagen = $request->file('imagen')?->store('productos', 'public');

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'imagen' => $rutaImagen
        ]);

        return redirect()->route('admin.productos')->with('success', 'Producto creado correctamente.');
    }

    public function editarProducto($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('admin.productos.editar', compact('producto', 'categorias', 'subcategorias'));
    }

    public function actualizarProducto(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'imagen' => 'nullable|image'
        ]);

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $rutaImagen;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request -> stock,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
        ]);

        return redirect()->route('admin.productos')->with('success', 'Producto actualizado correctamente.');
    }

    public function eliminarProducto($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return back()->with('success', 'Producto eliminado correctamente.');
    }
    
    // ACCIONES SOBRE LOS PEDIDOS ADMIN
    public function pedidos()
    {
        $pedidos = Pedido::with('usuario')->orderBy('created_at', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function pedidoDetalle($id)
    {
        $pedido = Pedido::with('usuario', 'lineas.producto')->findOrFail($id);
        return view('admin.pedidos.detalle', compact('pedido'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,enviado,entregado,cancelado'
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return back()->with('success', 'Estado actualizado correctamente.');
    }
    
    // ACCIONES SOBRE LOS USUARIOS 
    public function usuarios()
    {
        $usuarios = User::orderBy('created_at', 'desc')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function cambiarRol(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,cliente'
        ]);

        $usuario = User::findOrFail($id);
        $usuario->role = $request->role;
        $usuario->save();

        return back()->with('success', 'Rol actualizado correctamente.');
    }

    public function eliminarUsuario($id)
    {
        $usuario = User::findOrFail($id);

        // Evitar que el admin s'elimini a ell mateix
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();

        return back()->with('success', 'Usuario eliminado correctamente.');
    }

    // GRAFICO
    public function grafico()
    {
        // Obtener ventas totales por producto
        $ventas = Pedido::join('lineas_pedido', 'pedidos.id', '=', 'lineas_pedido.pedido_id')
                        ->selectRaw('producto_id, SUM(cantidad) as total')
                        ->groupBy('producto_id')
                        ->pluck('total')
                        ->toArray();

        // Obtener nombres de productos (para la leyenda)
        $nombres = Pedido::join('lineas_pedido', 'pedidos.id', '=', 'lineas_pedido.pedido_id')
                        ->join('productos', 'productos.id', '=', 'lineas_pedido.producto_id')
                        ->selectRaw('productos.nombre')
                        ->groupBy('productos.nombre')
                        ->pluck('nombre')
                        ->toArray();

        return view('admin.grafico', compact('ventas', 'nombres'));
    }

    // DESCUENTO GLOBAL
    public function aplicarDescuento(Request $request)
    {
        $request->validate([
            'descuento' => 'required|numeric|min:1|max:90'
        ]);
        $porcentaje = $request->descuento;
        Producto::all()->each(function ($p) use ($porcentaje) {
            // Guardar precio original solo si aún no está guardado
            if ($p->precio_original === null) {
                $p->precio_original = $p->precio;
            }

            // Aplicar descuento
            $nuevoPrecio = $p->precio_original - ($p->precio_original * ($porcentaje / 100));

            if ($nuevoPrecio < 0) {
                $nuevoPrecio = 0;
            }

            $p->precio = round($nuevoPrecio, 2);
            $p->save();
        });

        return back()->with('success', "Descuento del $porcentaje% aplicado correctamente.");
    }

    public function quitarDescuento()
    {
        Producto::all()->each(function ($p) {
            if ($p->precio_original !== null) {
                $p->precio = $p->precio_original;
                $p->precio_original = null;
                $p->save();
            }
        });

        return back()->with('success', 'Descuento eliminado y precios restaurados.');
    }


    // funcion para el orden de la tabla de productos
    public function ordenar(Request $request)
    {
        $orden = $request->get('orden');

        if ($orden === 'asc') {
            $productos = Producto::orderBy('stock', 'asc')->get();
        } elseif ($orden === 'desc') {
            $productos = Producto::orderBy('stock', 'desc')->get();
        } else {
            $productos = Producto::all();
        }

        return view('admin.productos', compact('productos'));
    }

}

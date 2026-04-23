<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Models\Pedido;

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
    public function productos()
    {
        $productos = Producto::with('categoria', 'subcategoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    // acciones del admin sobre los productos
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
    
    public function pedidos()
    {
        $pedidos = Pedido::with('usuario')->orderBy('created_at', 'desc')->get();
        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function pedidoDetalle($id)
    {
        $pedido = Pedido::with('usuario', 'items.producto')->findOrFail($id);
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

    // DESCUENTO GLOBAL
    public function descuento(Request $request)
    {
        $request->validate([
            'descuento' => 'required|numeric|min:1|max:90'
        ]);

        foreach (Producto::all() as $p) {
            $p->precio = $p->precio * (1 - $request->descuento / 100);
            $p->save();
        }

        return back()->with('success', 'Descuento aplicado correctamente.');
    }
}

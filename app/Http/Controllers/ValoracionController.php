<?php

namespace App\Http\Controllers;

use App\Models\Valoracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ValoracionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'linea_id' => 'required|integer',
            'estrellas' => 'required|integer|min(1)|max(5)',
            'comentario' => 'required|string|max:200'
        ]);

        // Guardar valoración
        Valoracion::create([
            'producto_id' => $request->producto_id,
            'user_id' => Auth::id(),
            'estrellas' => $request->estrellas,
            'comentario' => $request->comentario
        ]);

        // Marcar como resuelto
        DB::table('lineas_pedido')
            ->where('id', $request->linea_id)
            ->update(['has_to_comment' => false]);

        return back()->with('success', '¡Gracias por tu valoración!');
    }
}

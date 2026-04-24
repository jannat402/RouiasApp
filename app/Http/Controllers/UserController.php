<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;

class UserController extends Controller
{
    public function perfil()
    {
        $usuario = Auth::user();
        return view('perfil', compact('usuario'));
    }

    public function actualizarPerfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion_envio' => 'nullable|string|max:255',
        ]);

        $usuario = Auth::user();

        $usuario->name = $request->name;
        $usuario->telefono = $request->telefono;
        $usuario->direccion_envio = $request->direccion_envio;
        $usuario->save();

        return back()->with('success', 'Perfil actualizado correctamente.');
    }
}

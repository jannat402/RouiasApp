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
        if (!$usuario) {
            return redirect('/login');
        }
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
        if (!$usuario) {
            return redirect('/login');
        }
        $usuario->name = $request->name;
        $usuario->telefono = $request->telefono;
        $usuario->direccion_envio = $request->direccion_envio;

        try {
            $usuario->save();
            return back()->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el perfil: ' . $e->getMessage()]);
        }
    }
}

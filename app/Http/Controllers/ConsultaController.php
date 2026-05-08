<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    public function mostrar()
    {
        return view('consulta');
    }

    public function enviar(Request $request)
    {
        $rules = [
            'referencia' => ['required', 'string', 'max:100'],
            'consulta'   => ['required', 'string', 'max:150'],
        ];

        if (!Auth::check()) {
            $rules['nombre'] = ['required', 'string', 'max:100'];
            $rules['email']  = ['required', 'email'];
        }

        $data = $request->validate($rules);

        // Aquí podrías guardar en BD o enviar mail. Simulamos:
        // Consulta::create([...]);

        return back()->with('success', 'Tu consulta ha sido enviada correctamente.');
    }
}

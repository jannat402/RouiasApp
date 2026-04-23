<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed'],
        'telefono' => ['required'],
        'direccion_envio' => ['required'],
        'direccion_facturacion' => ['required'],
        'fecha_nacimiento' => ['required', 'date'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
        'direccion_envio' => $request->direccion_envio,
        'direccion_facturacion' => $request->direccion_facturacion,
        'fecha_nacimiento' => $request->fecha_nacimiento,
    ]);

    event(new Registered($user));
    session()->flash('success', 'Usuario creado correctamente!');
    Auth::login($user);
    return redirect('/');
}

}

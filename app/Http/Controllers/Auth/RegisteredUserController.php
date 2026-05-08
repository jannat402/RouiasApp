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
        // Nombre y apellidos: sin números, sin símbolos, 1-2 nombres y 1-2 apellidos
        'name' => [
            'required',
            'regex:/^[A-Za-zÀ-ÿ]+( [A-Za-zÀ-ÿ]+){1,3}$/'
        ],

        // Email
        'email' => ['required', 'email', 'unique:users,email'],

        // Contraseña + confirmación
        'password' => ['required', 'confirmed', Rules\Password::defaults()],

        // Teléfono internacional (+34 600000000)
        'telefono' => [
            'required',
            'regex:/^\+\d{1,3}\s?\d{6,12}$/'
        ],

        // Dirección de envío y facturación
        'direccion_envio' => ['required', 'string', 'max:255'],
        'direccion_facturacion' => ['required', 'string', 'max:255'],

        // Fecha de nacimiento: formato válido y edad entre 18 y 100
        'fecha_nacimiento' => [
            'required',
            'date',
            function ($attribute, $value, $fail) {
                $edad = \Carbon\Carbon::parse($value)->age;
                if ($edad < 18 || $edad > 100) {
                    $fail('Debes tener entre 18 y 100 años.');
                }
            }
        ],
    ], [
        // Mensajes personalizados
        'name.regex' => 'Introduce nombre y apellidos válidos (sin números ni símbolos).',
        'telefono.regex' => 'Introduce un teléfono internacional válido (+XX XXXXXXXX).',
    ]);

    // Crear usuario
    $user = User::create([
        'name' => ucwords($request->name),
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
        'direccion_envio' => $request->direccion_envio,
        'direccion_facturacion' => $request->direccion_facturacion,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'role' => 'cliente', // ← cliente por defecto
    ]);

    event(new Registered($user));

    // Mensaje de éxito
    session()->flash('success', 'Usuario creado correctamente!');

    // Iniciar sesión
    Auth::login($user);

    return redirect('/');
}

}

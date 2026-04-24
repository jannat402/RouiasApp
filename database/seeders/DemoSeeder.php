<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario cliente
        $clienteId = DB::table('users')->insertGetId([
            'name' => 'Cliente Mascotas',
            'email' => 'cliente@petshop.com',
            'password' => Hash::make('password'),
            'role' => 'cliente'
        ]);

        // Crear categorías
        $perrosId = DB::table('categorias')->insertGetId(['nombre' => 'Perros']);
        $gatosId  = DB::table('categorias')->insertGetId(['nombre' => 'Gatos']);

        // Crear subcategorías
        $subPerrosComida = DB::table('subcategorias')->insertGetId([
            'nombre' => 'Comida para perros',
            'categoria_id' => $perrosId
        ]);

        $subPerrosJuguetes = DB::table('subcategorias')->insertGetId([
            'nombre' => 'Juguetes para perros',
            'categoria_id' => $perrosId
        ]);

        $subGatosComida = DB::table('subcategorias')->insertGetId([
            'nombre' => 'Comida para gatos',
            'categoria_id' => $gatosId
        ]);

        $subGatosArena = DB::table('subcategorias')->insertGetId([
            'nombre' => 'Arena para gatos',
            'categoria_id' => $gatosId
        ]);

        // Crear productos
        $productos = [
            [
                'nombre' => 'Pienso Premium para Perros',
                'descripcion' => 'Alimento completo rico en pollo.',
                'precio' => 24.99,
                'stock' => 40,
                'imagen' => 'img/perros/pienso.jpg',
                'categoria_id' => $perrosId,
                'subcategoria_id' => $subPerrosComida
            ],
            [
                'nombre' => 'Juguete Mordedor de Cuerda',
                'descripcion' => 'Resistente y perfecto para juegos de fuerza.',
                'precio' => 9.99,
                'stock' => 60,
                'imagen' => 'img/perros/mordedor.jpg',
                'categoria_id' => $perrosId,
                'subcategoria_id' => $subPerrosJuguetes
            ],
            [
                'nombre' => 'Pienso para Gatos Adultos',
                'descripcion' => 'Alimento equilibrado con salmón.',
                'precio' => 19.99,
                'stock' => 50,
                'imagen' => 'img/gatos/pienso.jpg',
                'categoria_id' => $gatosId,
                'subcategoria_id' => $subGatosComida
            ],
            [
                'nombre' => 'Arena Aglomerante para Gatos',
                'descripcion' => 'Control de olores y fácil limpieza.',
                'precio' => 12.99,
                'stock' => 80,
                'imagen' => 'img/gatos/arena.jpg',
                'categoria_id' => $gatosId,
                'subcategoria_id' => $subGatosArena
            ]
        ];

        foreach ($productos as $p) {
            DB::table('productos')->insert(array_merge($p, ['vendidos' => 0]));
        }

        // Crear pedido de prueba
        $pedidoId = DB::table('pedidos')->insertGetId([
            'user_id' => $clienteId,
            'total' => 34.98,
            'estado' => 'pagado'
        ]);

        // Obtener productos
        $p1 = DB::table('productos')->where('nombre', 'Pienso Premium para Perros')->first();
        $p2 = DB::table('productos')->where('nombre', 'Juguete Mordedor de Cuerda')->first();

        // Crear líneas de pedido con has_to_comment = true
        DB::table('lineas_pedido')->insert([
            [
                'pedido_id' => $pedidoId,
                'producto_id' => $p1->id,
                'cantidad' => 1,
                'precio' => $p1->precio,
                'has_to_comment' => true
            ],
            [
                'pedido_id' => $pedidoId,
                'producto_id' => $p2->id,
                'cantidad' => 1,
                'precio' => $p2->precio,
                'has_to_comment' => true
            ]
        ]);
    }
}

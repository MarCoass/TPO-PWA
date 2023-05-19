<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class usuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = [
            [
                'nombre' => 'Competidor',
                'apellido' => 'Competidor',
                'usuario' => 'Competidor',
                'correo' => 'competidor@example.com',
                'clave' => 'competidor',
                'idRol' => 3
            ],
            [
                'nombre' => 'Juez',
                'apellido' => 'Juez',
                'usuario' => 'Juez',
                'correo' => 'juez@example.com',
                'clave' => 'juez',
                'idRol' => 2
            ],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Administrador',
                'usuario' => 'Administrador',
                'correo' => 'administrador@example.com',
                'clave' => 'administrador',
                'idRol' => 1
            ]
        ];

        //por cada elemento de roles, va a crear el objeto rol
        foreach ($usuarios as $usuario) {
            
            Usuario::create([
                'nombre' => $usuario['nombre'],
                'apellido' =>$usuario['apellido'],
                'usuario' => $usuario['usuario'],
                'correo' => $usuario['correo'],
                'clave' => $usuario['clave'],
                'idRol' => $usuario['idRol']
            ]);
        }
    }
}

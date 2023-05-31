<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
                'password' => 'competidor',
                'idRol' => 3,
                'estado' => true,
                'idEscuela' => 4
            ],
            [
                'nombre' => 'Juez',
                'apellido' => 'Juez',
                'usuario' => 'juez',
                'correo' => 'juez@example.com',
                'password' => 'juez',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 7
            ],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Administrador',
                'usuario' => 'administrador',
                'correo' => 'administrador@example.com',
                'password' => 'administrador',
                'idRol' => 1,
                'estado' => true,
                'idEscuela' => null
            ],
            [
                'nombre' => 'Gustavo',
                'apellido' => 'Oliveros',
                'usuario' => 'GusOliveros',
                'correo' => 'gusOliveros@example.com',
                'password' => 'GusOliveros',
                'idRol' => 3,
                'estado' => false,
                'idEscuela' => 15
            ]
        ];

        //por cada elemento de roles, va a crear el objeto rol
        foreach ($usuarios as $usuario) {
            
            User::create([
                'nombre' => $usuario['nombre'],
                'apellido' =>$usuario['apellido'],
                'usuario' => $usuario['usuario'],
                'correo' => $usuario['correo'],
                'password' => $usuario['password'],
                'idRol' => $usuario['idRol'],
                'estado' => $usuario['estado'],
                'idEscuela' => $usuario['idEscuela']
            ]);
        }
    }
}

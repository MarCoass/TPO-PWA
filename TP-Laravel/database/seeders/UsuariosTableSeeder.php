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
                'idRol' => 3
            ],
            [
                'nombre' => 'Juez',
                'apellido' => 'Juez',
                'usuario' => 'juez',
                'correo' => 'juez@example.com',
                'password' => 'juez',
                'idRol' => 2
            ],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Administrador',
                'usuario' => 'administrador',
                'correo' => 'administrador@example.com',
                'password' => 'administrador',
                'idRol' => 1
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
                'idRol' => $usuario['idRol']
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Database\factories\UserFactory;

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
                'correo' => 'competidor@gmail.com',
                'password' => 'competidor',
                'idRol' => 3,
                'estado' => true,
                'idEscuela' => 4,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Juez',
                'apellido' => 'Juez',
                'usuario' => 'juez',
                'correo' => 'juez@gmail.com',
                'password' => 'juez',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 7,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Administrador',
                'apellido' => 'Administrador',
                'usuario' => 'administrador',
                'correo' => 'administrador@gmail.com',
                'password' => 'administrador',
                'idRol' => 1,
                'estado' => true,
                'idEscuela' => null,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Gustavo',
                'apellido' => 'Oliveros',
                'usuario' => 'GusOliveros',
                'correo' => 'gusOliveros@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Braian',
                'apellido' => 'Centurion',
                'usuario' => 'mondongo',
                'correo' => 'braian@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Aluhe',
                'apellido' => 'Paillamilla',
                'usuario' => 'patotpatito',
                'correo' => 'pato@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Matias',
                'apellido' => 'Farfan',
                'usuario' => 'matiasfarfan',
                'correo' => 'matias@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Gonzalo',
                'apellido' => 'Olmos',
                'usuario' => 'gonzaloolmos',
                'correo' => 'gonza@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
            ],
            [
                'nombre' => 'Martina',
                'apellido' => 'Coassin',
                'usuario' => 'martinacoassin',
                'correo' => 'martina@gmail.com',
                'password' => 'contraseña',
                'idRol' => 2,
                'estado' => true,
                'idEscuela' => 15,
                'imagenPerfil' => null
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
                'idEscuela' => $usuario['idEscuela'],
                'imagenPerfil' => $usuario['imagenPerfil']
            ]);
        }
        User::factory()->count(20)->create();
    }
}

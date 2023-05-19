<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'nombreRol' => 'Administrador',
            ],
            [
                'nombreRol' => 'Juez',
            ],
            [
                'nombreRol' => 'Competidor',
            ],
           
        ];

        //por cada elemento de roles, va a crear el objeto rol
        foreach ($roles as $rol) {

            Rol::create([
               
                'nombreRol' =>$rol['nombreRol']
            ]);
        }
    }
}

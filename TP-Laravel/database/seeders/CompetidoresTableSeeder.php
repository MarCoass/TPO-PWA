<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competidor;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
class CompetidoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Traigo todos los usuarios con ID: 3
        $usuarios = User::where('idRol','3')->get();

        //por cada elemento de paises, va a crear el objeto Pais
        foreach ($usuarios as $user) {

            //Genero la fecha random
            $fechaAleatoria = Carbon::createFromTimestamp(rand(315561600, 1483228799)); // Rango de timestamp entre 1930 y 2017

            Competidor::create([
                'gal' => ('TKD' . mt_rand(1000000, 9999999)),
                'apellido' => $user['apellido'],
                'nombre' => $user['nombre'],
                'du' => mt_rand(10000000, 99999999),
                'fechaNacimiento' => $fechaAleatoria,
                'idPais' => 5,
                'idEstado' => 1826,
                'idUser' => $user['id'],
                'ranking' => 0,
                'idGraduacion' => random_int(1,10),
                'email' => $user['correo'],
                'genero' => 1,
                'estado' => 1
            ]);
        }
    }
}

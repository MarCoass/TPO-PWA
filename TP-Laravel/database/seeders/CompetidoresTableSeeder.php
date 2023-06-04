<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competidor;
use Illuminate\Support\Facades\File;

class CompetidoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/competidores.json');
        $json = File::get($jsonPath);

        $competidores = json_decode($json, true);

        //por cada elemento de paises, va a crear el objeto Pais
        foreach ($competidores as $competidor) {


            Competidor::create([
                'gal'=> $competidor['gal'],
                'apellido'=> $competidor['apellido'],
                'nombre'=> $competidor['nombre'],
                'du'=> $competidor['du'],
                'fechaNacimiento'=> $competidor['fechaNacimiento'],
                'idPais'=> $competidor['pais'],
                'idEstado'=> $competidor['estado'],
                'idUser'=> $competidor['idUser'],
                'ranking'=> 0,
                'idGraduacion'=> $competidor['idGraduacion'],
                'email'=> $competidor['correo'],
                'genero'=> $competidor['genero'],
                'estado'=>$competidor['estadoAceptacion']
            ]);
        }

    }
}

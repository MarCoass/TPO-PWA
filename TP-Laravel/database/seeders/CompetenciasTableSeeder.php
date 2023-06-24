<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competencia;
use Illuminate\Support\Facades\File;

class CompetenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/competencias.json');
        $json = File::get($jsonPath);

        $competencias = json_decode($json, true);

        //por cada elemento de competencias, va a crear el objeto escuela
        foreach ($competencias as $competencia) {

            competencia::create([
                'nombre' => $competencia['nombre'],
                'fecha' => $competencia['fecha'],
                'cantidadJueces' => $competencia['cantidadJueces'],
                'estadoJueces' => $competencia['estadoJueces'],
                'flyer' => $competencia['flyer'],
                'bases' => $competencia['bases'],
                'invitacion' => $competencia['invitacion'],
                'estadoCompetencia' => $competencia['estadoCompetencia']
            ]);
        }
    
    }
}

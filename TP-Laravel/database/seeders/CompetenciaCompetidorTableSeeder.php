<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competidor;
use App\Models\CompetenciaCompetidor;

class CompetenciaCompetidorTableSeeder extends Seeder
{
    public function run()
    {
        //Traigo todos los competidores con ID: 3
        $competidores = Competidor::all();

        foreach($competidores as $competidor){
            CompetenciaCompetidor::create([
                'idCompetidor' => $competidor->idCompetidor,
                'idCompetencia' => 1,
                'idCategoria' => random_int(1,10),//esto cambiar para que se ponga bien segun el sexo y edad
                'puntaje' => number_format(rand() / getrandmax() * 10, 1),
                'contadorPasadas' => 2,
                'estado' =>1
            ]);
        }

    }
}

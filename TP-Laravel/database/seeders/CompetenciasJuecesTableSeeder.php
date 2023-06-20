<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompetenciaJuez;
use Illuminate\Support\Facades\File;

class CompetenciasJuecesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //Obtengo los datos de un json
         $jsonPath = base_path('database/seeders/data/competenciasjueces.json');
         $json = File::get($jsonPath);
 
         $data = json_decode($json, true);
 
         foreach ($data as $row) {
            CompetenciaJuez::create([
                 'idCompetencia' => $row['idCompetencia'],
                 'estado' => $row['estado'],
                 'idJuez' => $row['idJuez']
             ]);
         }
    }
}

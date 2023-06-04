<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompetenciaJuez;

class CompetenciasJuecesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competenciasJueces = [
            [
                'idCompetencia' => '1',
                'estado' => '1',
                'idJuez' => '2',
            ]
        ];

        //por cada elemento de roles, va a crear el objeto rol
        foreach ($competenciasJueces as $competenciaJuez) {
            
            CompetenciaJuez::create([
                'idCompetencia' => $competenciaJuez['idCompetencia'],
                'estado' =>$competenciaJuez['estado'],
                'idJuez' => $competenciaJuez['idJuez']
            ]);
        }
    }
}

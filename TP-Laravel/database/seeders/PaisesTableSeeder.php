<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pais;
use Illuminate\Support\Facades\File;

class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/paises.json');
        $json = File::get($jsonPath);

        $paises = json_decode($json, true);

        //por cada elemento de paises, va a crear el objeto Pais
        foreach ($paises as $pais) {

            $idPais = $pais['idPais'];
            $nombrePais = $pais['nombrePais'];
            $nomenclatura = $pais['nomenclatura'];


            Pais::create([
                'idPais' => $idPais,
                'nombrePais' => $nombrePais,
                'nomenclatura' => $nomenclatura
            ]);
        }
    
    }
}

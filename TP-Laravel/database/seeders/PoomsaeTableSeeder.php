<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poomsae;
use Illuminate\Support\Facades\File;

class PoomsaeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/poomsae.json');
        $json = File::get($jsonPath);

        $Poomsae = json_decode($json, true);

        //por cada elemento de Poomsae, va a crear el objeto escuela
        foreach ($Poomsae as $Poom) {

            $nombre = $Poom['nombre'];
            Poomsae::create([
                'nombre' => $nombre,
            ]);
        }
    
    }
}

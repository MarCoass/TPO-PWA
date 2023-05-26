<?php

namespace Database\Seeders;

use App\Models\Graduacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GraduacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/graduaciones.json');
        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        foreach ($data as $graduacion) {
            $nombre = $graduacion['nombre'];
            $color = $graduacion['color'];
            $tipo = $graduacion['tipo'];
            Graduacion::create([
                'nombre' => $nombre,
                'color' => $color,
                'tipo' => $tipo
            ]);
        }
    }
}

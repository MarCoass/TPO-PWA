<?php

namespace Database\Seeders;

use App\Models\CategoriaPoomsae;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoriasPoomsaeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/categoriapoomsae.json');
        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        foreach ($data as $row) {
            CategoriaPoomsae::create([
                'idCategoria' => $row['idCategoria'],
                'idPoomsae' => $row['idPoomsae']
            ]);
        }
    }
}

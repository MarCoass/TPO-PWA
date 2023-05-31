<?php

namespace Database\Seeders;

use App\Models\CategoriaGraduacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/categoriagraduacion.json');
        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        foreach ($data as $row) {
            CategoriaGraduacion::create([
                'idCategoria' => $row['idCategoria'],
                'idGraduacion' => $row['idGraduacion']
            ]);
        }
    }
}

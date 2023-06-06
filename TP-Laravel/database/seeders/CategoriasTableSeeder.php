<?php

namespace Database\Seeders;

use App\Models\Categoria;
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
        $jsonPath = base_path('database/seeders/data/categorias.json');
        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        foreach ($data as $row) {
            Categoria::create([
                'nombre' => $row['nombre'],
                'edadMax' => $row['edadMax'],
                'edadMin' => $row['edadMin'],
                'genero' => 1,
                'esElite' => $row['esElite'],
            ]);
            Categoria::create([
                'nombre' => $row['nombre'],
                'edadMax' => $row['edadMax'],
                'edadMin' => $row['edadMin'],
                'genero' => 2,
                'esElite' => $row['esElite'],
            ]);
        }
    }
}

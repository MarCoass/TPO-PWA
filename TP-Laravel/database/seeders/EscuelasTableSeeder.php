<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Escuela;
use Illuminate\Support\Facades\File;

class EscuelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/escuelas.json');
        $json = File::get($jsonPath);

        $escuelas = json_decode($json, true);

        //por cada elemento de Escuelas, va a crear el objeto escuela
        foreach ($escuelas as $escuela) {

            $nombreEscuela = $escuela['nombre'];
            $nombreApellidoInstructor = $escuela['nombreApellidoInstructor'];
            $email = $escuela['email'];
            $telefono = $escuela['telefono'];
            Escuela::create([
                'nombre' => $nombreEscuela,
                'nombreApellidoInstructor' => $nombreApellidoInstructor,
                'email' => $email,
                'telefono' => $telefono,
            ]);
        }
    
    }
}

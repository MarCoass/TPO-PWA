<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competidor;
use App\Models\CompetenciaCompetidor;
use App\Models\Categoria;
use Illuminate\Support\Carbon;

class CompetenciaCompetidorTableSeeder extends Seeder
{
    public function run()
    {
        //Traigo todos los competidores con ID: 3
        $competidores = Competidor::all();

        foreach ($competidores as $competidor) {
            $fecha = Carbon::parse($competidor->fechaNacimiento);
            $edad = $fecha->age;

            //busco la categoria que le corresponda
            $categoria = Categoria::where('genero', '1')->where('edadMin', '<=', $edad)->where('edadMax', '>=', $edad)->first();
            if ($categoria == null) {
                dd($edad);
            }
            $idCategoria = $categoria->idCategoria;

            CompetenciaCompetidor::create([
                'idCompetidor' => $competidor->idCompetidor,
                'idCompetencia' => 1,
                'idCategoria' => $idCategoria, //esto cambiar para que se ponga bien segun el sexo y edad
                'puntaje' => number_format(rand() / getrandmax() * 10, 1),
                'contadorPasadas' => 2,
                'estado' => 1
            ]);
        }
    }
}

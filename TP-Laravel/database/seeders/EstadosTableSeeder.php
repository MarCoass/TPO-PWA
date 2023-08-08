<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\File;
use App\Models\Pais;
use App\Models\Estado;


class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/estados.json');
        $json = File::get($jsonPath);

        $data = json_decode($json, true);

        foreach ($data as $estado) {
            $idEstado = $estado['idEstado'];
            $idPais = $estado['idPais'];
            $nombreEstado = $estado['nombreEstado'];

            // busca el país con idPais
            $pais = Pais::find($idPais);
            
            if ($pais) {
                // si existe el país, crear el estado y asignarle la clave foránea
                Estado::create([
                    'idEstado' => $idEstado,
                    'idPais' => $idPais,
                    'nombreEstado' => $nombreEstado,
                ]);
            } else {
                // si no hay id... no hace por ahora :)
                dd('Error: no existe el pais con el id buscado');
            }
        }
    }
}

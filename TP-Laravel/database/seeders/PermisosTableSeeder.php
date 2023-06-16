<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Obtengo los datos de un json
        $jsonPath = base_path('database/seeders/data/permisos.json');
        $json = File::get($jsonPath);

        $permisos = json_decode($json, true);

        //por cada elemento de paises, va a crear el objeto Pais
        foreach ($permisos as $permiso) {

            $idPermiso = $permiso['idPermiso'];
            $rutaPermiso = $permiso['rutaPermiso'];
            $nombrePermiso = $permiso['nombrePermiso'];


            Permiso::create([
                'idPermiso' => $idPermiso,
                'rutaPermiso' => $rutaPermiso,
                'nombrePermiso' => $nombrePermiso
            ]);
        }
    }
}

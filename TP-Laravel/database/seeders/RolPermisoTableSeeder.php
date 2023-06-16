<?php

namespace Database\Seeders;

use App\Models\RolPermiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RolPermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Obtengo los datos de un json
       $jsonPath = base_path('database/seeders/data/rolpermiso.json');
       $json = File::get($jsonPath);

       $rolpermisos = json_decode($json, true);

       //por cada elemento de paises, va a crear el objeto Pais
       foreach ($rolpermisos as $rolpermiso) {

           $id = $rolpermiso['id'];
           $idRol = $rolpermiso['idRol'];
           $idPermiso = $rolpermiso['idPermiso'];


           RolPermiso::create([
               'id' => $id,
               'idRol' => $idRol,
               'idPermiso' => $idPermiso
           ]);
       }
    }
}

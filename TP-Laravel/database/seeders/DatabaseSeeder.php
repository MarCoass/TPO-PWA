<?php

use App\Models\Permiso;
use App\Models\RolPermiso;
use Database\Seeders\CategoriasGraduacionesTableSeeder;
use Database\Seeders\CategoriasTableSeeder;
use Database\Seeders\CompetenciasJuecesTableSeeder;
use Database\Seeders\CompetidoresTableSeeder;
use Database\Seeders\EscuelasTableSeeder;
use Database\Seeders\EstadosTableSeeder;
use Database\Seeders\GraduacionesTableSeeder;
use Database\Seeders\PaisesTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsuariosTableSeeder;
use Database\Seeders\PoomsaeTableSeeder;
use Database\Seeders\CompetenciasTableSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\CompetenciaCompetidorTableSeeder;
use Database\Seeders\PermisosTableSeeder;
use Database\Seeders\RolPermisoTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GraduacionesTableSeeder::class);
        $this->call(EscuelasTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(CompetidoresTableSeeder::class);
        $this->call(PoomsaeTableSeeder::class);
        $this->call(CompetenciasTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(CategoriasGraduacionesTableSeeder::class);
        $this->call(CompetenciasJuecesTableSeeder::class);
        $this->call(CompetenciaCompetidorTableSeeder::class);
        $this->call(PermisosTableSeeder::class);
        $this->call(RolPermisoTableSeeder::class);
        //competenciacompetidor
    }
}

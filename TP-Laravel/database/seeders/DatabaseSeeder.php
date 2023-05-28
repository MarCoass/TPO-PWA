<?php

use Database\Seeders\CompetidoresTableSeeder;
use Database\Seeders\EscuelasTableSeeder;
use Database\Seeders\EstadosTableSeeder;
use Database\Seeders\GraduacionesTableSeeder;
use Database\Seeders\PaisesTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsuariosTableSeeder;
use Database\seeders\CompetenciasTableSeeder;
use Database\seeders\PoomsaeTableSeeder;
use Illuminate\Database\Seeder;

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
        $this->call(CompetenciasTableSeeder::class);
        $this->call(PoomsaeTableSeeder::class);
    }
}

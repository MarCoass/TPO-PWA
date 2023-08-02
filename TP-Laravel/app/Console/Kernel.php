<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Models\Competencia;
use Illuminate\Support\Carbon;
use App\Http\Controllers\CompetenciaCompetidorPoomsaeController;
use App\Notifications\NotificacionGeneral;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Establezco un llamado a una funcion todos los dias a las 23:59
        $schedule->call(function () {
            //Busco todas las competencias que tengan el estadoJueces en 1 y 
            $competencias = Competencia::where('estadoJueces',1)
                                        ->where('estadoInscripcion',0)
                                        ->get();

            if($competencias->isNotEmpty()){
                foreach ($competencias as $competencia){
                    // Obtener la fecha de la competencia de la base de datos

                    // Verificar si la fecha es igual al día siguiente
                    if ($competencia->fecha == Carbon::tomorrow()->format('Y-m-d')) {
                        // Llamar a la función sortearPoomsae del controlador CompetenciaController con el id de la competencia
                        app()->call(CompetenciaCompetidorPoomsaeController::asignar_poomsae_por_sorteo($competencia->idCompetencia));
                        // Se podria agregar una notificacion para avisar al administrador de que se hizo el sorteo
                    }
                }
            }
        })->dailyAt('23:59');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Escuela;
use App\Models\Competidor;
use App\Models\Solicitud;
use App\Models\User;
use App\Models\CompetenciaJuez;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //Declaracion de variables
        $competencias = null;
        $objCompetidor = null;
        $cantSolicitudes = null;
        $cantUsuarios = null;
        $tieneCompetenciasRegistradas = null;
        $escuelas = Escuela::all();
        //Competencias en las que no se esta registrado
        $competenciasDisponibles = null;
        if (auth()->user()) {
            $competencias = Competencia::all();
            $usuario = auth()->user();
            $idUsuario = $usuario->id;
            // Si el usuario es un juez, se obtienen las competencias disponibles para él, es decir, las que no existen en la tabla competenciaJueces con su idJuez y que tienen un estadoInscripcion distinto de 1
            if ($usuario['idRol'] == 2) {
                $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($idUsuario) {
                    $query->select(DB::raw(1))
                        ->from('competenciaJueces')
                        ->whereRaw('competenciaJueces.idCompetencia = competencias.idCompetencia')
                        ->where('competenciaJueces.idJuez', $idUsuario);
                })->where('estadoInscripcion', '<>', 1)->get();
                $tieneCompetenciasRegistradas = CompetenciaJuez::where('idJuez', $idUsuario)->first();
            }
            // Si el usuario es un competidor, se obtiene su objeto competidor a partir de su idUser
            if ($usuario['idRol'] == 3) {
                $objCompetidor = Competidor::where('idUser', $idUsuario)->first();
                if ($objCompetidor != null) {
                    $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($objCompetidor) {
                        $query->select(DB::raw(1))
                            ->from('competenciaCompetidor')
                            ->whereRaw('competenciaCompetidor.idCompetencia = competencias.idCompetencia')
                            ->where('competenciaCompetidor.idCompetidor', $objCompetidor->idCompetidor);
                    })->get();
                }
            }
            //Si el usuario es un administrador, se obtienen la cantidad de solicitudes y usuarios pendientes
            if ($usuario['idRol'] == 1) {
                $cantSolicitudes = $this->haySolicitudesPendientes();
                $cantUsuarios = $this->hayUsuariosPendientes();
            }

        }

        return view('home.index', compact('competencias', 'competenciasDisponibles', 'objCompetidor', 'cantSolicitudes', 'cantUsuarios', 'escuelas', 'tieneCompetenciasRegistradas'));
    }

    /* Busca la cantidad de solicitudes pendientes */
    private function haySolicitudesPendientes(){
        $cantSolicitudes = count(Solicitud::where('estadoSolicitud', '=', '4')->get());
        return $cantSolicitudes;
    }

    /* Busca la cantidad de solicitudes pendientes */
    private function hayUsuariosPendientes(){
        $cantUsuarios = count(User::where('estado', '=', '0')->get());
        return $cantUsuarios;
    }
}

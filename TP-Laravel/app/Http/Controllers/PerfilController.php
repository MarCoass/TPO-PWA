<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\Graduacion;
use App\Models\CompetenciaJuez;
use App\Models\Puntaje;
use App\Models\Poomsae;
use App\Models\CompetenciaCompetidor;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $idUser = $usuario->id;
        // DEFINIMOS COSITAS EN NULL
        $arreglo = [];
        $arregloInscripciones = [];
        $graduacion = null;
        $competidor = null;

        if ($usuario->idRol == 3) {
            // OBTENEMOS EL COMPETIDOR DEL USUARIO LOGEADO
            $objCompetidor = Competidor::where('idUser', '=', $idUser)->first();
            if ($objCompetidor != null) {
                // TRAEMOS COSITAS PARA COMPETIDOR

                // INICIALIZAMOS MODELOS QUE USAREMOS MÁS ADELANTE
                $objGraduacion = new Graduacion();
                $objCompetenciaCompetidor = new CompetenciaCompetidor();
                $objCompetencia = new Competencia();

                // OBTENEMOS SU CINTURÓN ACTUAL
                $graduacion = $objGraduacion::find($objCompetidor->idGraduacion);

                $arreglo = $this->traerCompetenciasCompetidor($objCompetidor->idCompetidor, $objCompetenciaCompetidor, $objCompetencia);

                $arregloInscripciones = $this->traerInscripcionesPendientesCompetidor($objCompetidor->idCompetidor, $objCompetenciaCompetidor, $objCompetencia);
            }
        }

        // RETORNAMOS LAS COSITAS A LA VISTA UWU
        return view('verPerfil.verPerfil', compact('arreglo', 'graduacion', 'arregloInscripciones', 'competidor'));
    }

    public function infoCompetencias(){

        $usuario = auth()->user();
        $idUser = $usuario->id;
        // DEFINIMOS COSITAS EN NULL
        $arreglo = [];
        $arregloInscripciones = [];

        if ($usuario->idRol == 2) {
            // TRAEMOS COSITAS PARA JUEZ

            // INICIALIZAMOS MODELOS QUE USAREMOS MÁS ADELANTE ÒWÓ
            $objCompetencia = new Competencia();
            $objCompetenciaJuez = new CompetenciaJuez();
            $objPuntaje = new Puntaje();

            $arreglo = $this->traerCompetenciasJuez($idUser, $objCompetencia, $objCompetenciaJuez, $objPuntaje);

            $arregloInscripciones = $this->traerInscripcionesPendientesJuez($idUser, $objCompetencia, $objCompetenciaJuez);
        } 

        return view('verPerfil.modalCompPerfil', compact('arreglo', 'arregloInscripciones'))->render();
    }

    public function traerCompetenciasCompetidor($idCompetidor, $objCompetenciaCompetidor, $objCompetencia)
    {
        $arregloHistorialCompetidor = [];

        // BUSCAMOS LAS COMPETENCIAS EN QUE PARTICIPÓ EL COMPETIDOR
        // ES DECIR, COMPETENCIAS EN LAS QUE FUE ACEPTADO (ESTADO 1) Y LA COMPETENCIA YA FINALIZO (ESTADOCOMPETENCIA 1)
        $competenciasCompe = $objCompetenciaCompetidor
            ::join('competencias', 'competencias.idCompetencia', '=', 'competenciacompetidor.idCompetencia')
            ->where('competenciacompetidor.idCompetidor', '=', $idCompetidor)
            ->where('competenciacompetidor.estado', '=', 1)
            ->where('competencias.estadoCompetencia', '=', 1)
            ->get();

            
            // RECORREMOS CADA UNA DE LAS COMPETENCIASCOMPETIDOR PARA OBTENER JUGOSA INFORMACIÓN
        foreach ($competenciasCompe as $compeCompe) {
            
            // OBTENEMOS LOS POOMSAES DE ESA COMPETENCIA UWU
            $poomsaes = Poomsae::join('competenciacompetidorpoomsae', 'poomsae.idPoomsae', 'competenciacompetidorpoomsae.idPoomsae')
                ->where('idCompetenciaCompetidor', '=', $compeCompe->idCompetenciaCompetidor)
                ->select('poomsae.idPoomsae', 'poomsae.nombre', 'competenciacompetidorpoomsae.pasadas')
                ->get();

            // BUSCAMOS LA COMPETENCIA ACTUAL
            $competencia = $objCompetencia::find($compeCompe->idCompetencia);

            // ARMAMOS UN ITEM CON LA INFORMACION QUE NOS INTERESA MOSTRAR DE CADA COMPETENCIA
            $item = [
                'nombre' => $competencia->nombre,
                'categoria' => $compeCompe->categoria->nombre,
                'fecha' => $competencia->fecha,
                'puntaje' => $compeCompe->puntaje,
                'poomsae1' => $poomsaes[0]->nombre,
                'poomsae2' => $poomsaes[1]->nombre,
            ];

            // METEMOS LAS COSITAS AL ARREGLO
            array_push($arregloHistorialCompetidor, $item);
        }

        return $arregloHistorialCompetidor;
    }

    public function traerInscripcionesPendientesCompetidor($idCompetidor, $objCompetenciaCompetidor, $objCompetencia)
    {
        $arregloInscripcionesPendientes = [];

        // BUSCAMOS LAS INSCRIPCIONES PENDIENTES
        // ES DECIR, COMPETENCIAS EN LAS AUN NO ES ACEPTADO (ESTADO 0) Y LA COMPETENCIA AUN NO FINALIZO (ESTADOCOMPETENCIA 0)
        $inscripcionesPendientes = $objCompetenciaCompetidor
            ::join('competencias', 'competencias.idCompetencia', '=', 'competenciacompetidor.idCompetencia')
            ->where('competenciacompetidor.idCompetidor', '=', $idCompetidor)
            ->where('competenciacompetidor.estado', '=', 0)
            ->where('competencias.estadoCompetencia', '=', 0)
            ->get();

        // RECORREMOS CADA UNA DE LAS INSCRIPCIONES PENDIENTES UNU
        foreach ($inscripcionesPendientes as $compeCompe) {
            // BUSCAMOS LA COMPETENCIA ACTUAL
            $competencia = $objCompetencia::find($compeCompe->idCompetencia);

            // ARMAMOS UN ITEM CON LA INFORMACION QUE NOS INTERESA MOSTRAR DE CADA COMPETENCIA
            $item = [
                'nombre' => $competencia->nombre,
                'fecha' => date('Y-m-d', strtotime($competencia->fecha)),
            ];

            // METEMOS LAS COSITAS AL ARREGLO
            array_push($arregloInscripcionesPendientes, $item);
        }

        return $arregloInscripcionesPendientes;
    }

    public function traerCompetenciasJuez($idJuez, $objCompetencia, $objCompetenciaJuez, $objPuntaje)
    {
        $arregloHistorialJuez = [];
        $arregloCompetidoresPuntuados = [];
        $idDatos = 1;
        // BUSCAMOS LAS COMPETENCIAS EN LAS QUE PARTICIPÓ EL JUEZ DEL USUARIO LOGEADO
        $competenciasJueces = $objCompetenciaJuez::where('idJuez', '=', $idJuez)->get();

        // RECORREMOS CADA UNA DE ESAS COMPETENCIAS
        foreach ($competenciasJueces as $competenciaJuez) {
            // OBTENEMOS LA COMPETENCIA ACTUAL
            $competencia = $objCompetencia::find($competenciaJuez->idCompetencia);
            $cantCompetidoresPuntuados = $objPuntaje::where('idCompetenciaJuez', $competenciaJuez->idCompetenciaJuez)->count();

            $buscaPuntajes = Puntaje::where('idCompetenciaJuez', $competenciaJuez->idCompetenciaJuez)->get();

            foreach($buscaPuntajes as $puntajes){
                $nombreYApellido = $puntajes->competenciaCompetidor->competidor->apellido . " " . $puntajes->competenciaCompetidor->competidor->nombre;
                $pasada = $puntajes->pasada;
                $presentacion = $puntajes->puntajePresentacion;
                $exactitud = $puntajes->puntajeExactitud;

                $poomsaes = Poomsae::join('competenciacompetidorpoomsae', 'poomsae.idPoomsae', 'competenciacompetidorpoomsae.idPoomsae')
                ->where('idCompetenciaCompetidor', '=', $puntajes->competenciaCompetidor->idCompetenciaCompetidor)
                ->select('poomsae.idPoomsae', 'poomsae.nombre', 'competenciacompetidorpoomsae.pasadas')
                ->get();

                if($pasada == 1){
                    $nombrePoomsae = $poomsaes[0];
                }if($pasada == 2){
                    $nombrePoomsae = $poomsaes[1];
                }

                $puntuaciones = [
                    'nombreyapellido' => $nombreYApellido,
                    'pasada' => $pasada,
                    'poomsae' => $nombrePoomsae->nombre,
                    'ptosPre' => $presentacion,
                    'ptosExa' => $exactitud,
                ];

                array_push($arregloCompetidoresPuntuados, $puntuaciones);
            }

            //GUARDAMOS LAS COSITAS
            $item = [
                'id' => $idDatos++,
                'nombre' => $competencia->nombre,
                'fecha' => $competencia->fecha,
                'cantidadJueces' => $competencia->cantidadJueces,
                'cantidadPuntuados' => $cantCompetidoresPuntuados,
                'competidoresPuntuados' => $arregloCompetidoresPuntuados
            ];

            // METEMOS LAS COSITAS AL ARREGLO NYA
            array_push($arregloHistorialJuez, $item);
        }

        return $arregloHistorialJuez;
    }

    public function traerInscripcionesPendientesJuez($idJuez, $objCompetencia, $objCompetenciaJuez)
    {
        $arregloInscripcionesPendientes = [];

        // BUSCAMOS LAS INSCRIPCIONES PENDIENTES
        // ES DECIR, COMPETENCIAS EN LAS AUN NO ES ACEPTADO (ESTADO 0) Y LA COMPETENCIA AUN NO FINALIZO (ESTADOCOMPETENCIA 0)
        $inscripcionesPendientes = $objCompetenciaJuez
            ::join('competencias', 'competencias.idCompetencia', '=', 'competenciajueces.idCompetencia')
            ->where('competenciajueces.idJuez', '=', $idJuez)
            ->where('competenciajueces.estado', '=', 0)
            ->where('competencias.estadoCompetencia', '=', 0)
            ->get();

        // RECORREMOS CADA UNA DE LAS INSCRIPCIONES PENDIENTES UNU
        foreach ($inscripcionesPendientes as $compeCompe) {
            // BUSCAMOS LA COMPETENCIA ACTUAL
            $competencia = $objCompetencia::find($compeCompe->idCompetencia);

            // ARMAMOS UN ITEM CON LA INFORMACION QUE NOS INTERESA MOSTRAR DE CADA COMPETENCIA
            $item = [
                'nombre' => $competencia->nombre,
                'fecha' => date('Y-m-d', strtotime($competencia->fecha)),
            ];

            // METEMOS LAS COSITAS AL ARREGLO
            array_push($arregloInscripcionesPendientes, $item);
        }

        return $arregloInscripcionesPendientes;
    }
}

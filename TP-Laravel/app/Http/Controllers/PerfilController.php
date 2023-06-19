<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\CompetenciaJuez;
use App\Models\CompetenciaCompetidor;

class PerfilController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        $idUser = $usuario->id;
        $arreglo = [];

        if ($usuario->idRol == 2) {
            $obj = new CompetenciaJuez();
            $competenciasJueces = $obj::where('idJuez', '=', $idUser)->get();

            $obj2 = new Competencia();
            foreach ($competenciasJueces as $competenciaJuez) {
                $competencia = $obj2::find($competenciaJuez->idCompetencia);
                $item = [
                    'nombre' => $competencia->nombre,
                    'fecha' => $competencia->fecha,
                    'cantidadJueces' => $competencia->cantidadJueces
                ];

                array_push($arreglo, $item);
            }
        } elseif ($usuario->idRol == 3) {
            $obj = new CompetenciaCompetidor();
            $obj2 = new Competidor();
            $competidor = $obj2::where('idUser', '=', $idUser)->first();
            $competenciasCompe = $obj::join('competencias', 'competencias.idCompetencia', '=', 'competenciacompetidor.idCompetencia')
                ->where('competenciacompetidor.idCompetidor', '=', $competidor->idCompetidor)
                ->where('competencias.estadoCompetencia', '=', 1)
                ->get();


            $obj3 = new Competencia();
            foreach ($competenciasCompe as $compeCompe) {
                $competencia = $obj3::find($compeCompe->idCompetencia);
                $item = [
                    'nombre' => $competencia->nombre,
                    'fecha' => $competencia->fecha,
                    'puntaje' => $compeCompe->puntaje
                ];

                array_push($arreglo, $item);
            }
        }

        return view('verPerfil.verPerfil', compact('arreglo'));
    }
}

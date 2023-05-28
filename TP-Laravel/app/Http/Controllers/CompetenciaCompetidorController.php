<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\Poomsae;
use App\Models\Graduacion;
use App\Models\CompetenciaCompetidor;
use Illuminate\Http\Request;

class CompetenciaCompetidorController extends Controller
{
    public function  puntuadorindex(){
        $graduaciones = Graduacion::all();
        $competencias = Competencia::all();

        return view('puntuador.index', compact('graduaciones','competencias'));

    }

    public function obtenerOpcionesCompetidor(Request $request)
    {
        $graduacion = $request->input('graduacion_puntuador');
        $competencia = $request->input('competencia_puntuador');
        $opciones =  Competidor::leftJoin('competencia_competidors', 'competidores.idCompetidor', '=', 'competencia_competidors.idCompetidor')
        ->where('graduacion', '=', $graduacion)
        ->where('competencia_competidors.idCompetencia', '=', $competencia)->get();
        return response()->json($opciones);

    }

    public function iniciar_puntaje(Request $request){
        $id_graduacion = $request->input('graduacion_puntuador');
        $id_competencia = $request->input('competencia_puntuador');
        $id_competidor = $request->input('competidor_puntuador');

        $graduacion = Graduacion::where('idGraducion','=',$id_graduacion);
        $competencia = Competencia::where('idCompetencia','=',$id_competencia);
        $competidor = Competidor::where('idCompetidor','=',$id_competidor);

        return view('puntuador.puntuador', compact('graduacion','competencia','competidor'));

    }

    public function habilitar($id){

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = true;
        $CompetidorCompetencia->save();

        /* todavia tengo que arreglar la redireccion */
        return redirect()->route('tabla_competidores', ['id' => $CompetidorCompetencia->idCompetencia])->with('success', 'Competidor habilitado exitosamente.');
    }



    public function listarCompetidoresPorId($id)
    {
        $competidoresCompetencia = CompetenciaCompetidor::where('idCompetencia', $id)->get();

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia]);
    }
}

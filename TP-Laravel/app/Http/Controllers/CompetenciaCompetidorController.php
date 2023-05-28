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
        $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
        ->where('graduacion', '=', $graduacion)
        ->where('competenciacompetidor.idCompetencia', '=', $competencia)->get();
        return response()->json($opciones);

    }

    public function iniciar_puntaje(Request $request){
        $id_graduacion = $request->input('graduacion_puntuador');
        $id_competencia = $request->input('competencia_puntuador');
        $id_competidor = $request->input('competidor_puntuador');

        $graduacion = Graduacion::where('idGraduacion','=',$id_graduacion)->get();
        $competencia = Competencia::where('idCompetencia','=',$id_competencia)->get();
        $competidor = Competidor::where('idCompetidor','=',$id_competidor)->get();
        $competencia_competidor = CompetenciaCompetidor::where('idCompetidor','=',$id_competidor)->where('idCompetencia','=',$id_competidor)->get();
        $poomsae = Poomsae::where('idPoomsae','=',$competencia_competidor[0]->idPoomsae)->get();
     
        return view('puntuador.puntuador', ['graduacion' => $graduacion,'competencia' => $competencia,'poomsae' => $poomsae, 'competidor' => $competidor,'competencia_competidor'=>$competencia_competidor]);

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
        $nombreCompetencia = Competencia::find($id);

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia, 'nombreCompetencia' => $nombreCompetencia]);
    }
}

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
        $poomsae = Poomsae::all();
        $graduaciones = Graduacion::all();
        $competencias = Competencia::all();

        return view('puntuador.index', compact('graduaciones','poomsae','competencias'));

    }

    public function obtenerOpcionesCompetidor(Request $request)
    {
        $graduacion = $request->input('graduacion_puntuador');
        $competencia = $request->input('competencia_puntuador');
        $opciones =  Competidor::leftJoin('competencia_competidors', 'competidor.idCompetidor', '=', 'competencia_competidors.idCompetidor')->where('graduacion', $graduacion, 'competencia_competidors.idCompetencia',$competencia)->get();
        return response()->json($opciones);

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

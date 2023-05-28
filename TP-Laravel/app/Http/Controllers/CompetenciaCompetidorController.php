<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Poomsae;
use App\Models\Graduacion;
use App\Models\CompetenciaCompetidor;
use Illuminate\Http\Request;

class CompetenciaCompetidorController extends Controller
{
    public function  puntuadorindex(){
        $poomsae = Poomsae::all();
        $graduaciones = Graduacion::all();

        return view('puntuador.index', compact('graduaciones','poomsae'));

    }

    public function obtenerOpcionesCompetidor(Request $request)
    {
        $graduacion = $request->input('graduacion_puntuador');
        $opciones =  Competidor::where('graduacion', $graduacion)->get();
        return response()->json($opciones);

    }

    public function habilitar($id){

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = true;
        $CompetidorCompetencia->save();

        return redirect()->route('competidoresCompetencia/1')->with('success', 'Competidor habilitado exitosamente.');
    }



    public function listarCompetidoresPorId($id)
    {
        $competidoresCompetencia = CompetenciaCompetidor::where('idCompetencia', $id)->get();

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia]);
    }
}

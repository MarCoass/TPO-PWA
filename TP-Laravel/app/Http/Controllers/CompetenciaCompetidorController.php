<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Poomsae;
use App\Models\Graduacion;
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
}

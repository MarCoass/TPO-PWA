<?php

namespace App\Http\Controllers;

use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Puntaje;
use Illuminate\Http\Request;

class PuntajeController extends Controller
{
    public function index()
    {
        // Lógica para mostrar todos los registros
    }

    public function show($id)
    {
        $puntaje = Puntaje::find($id);

        //No se cual es la ruta jeje
        //return view('resultadoPasada', ['puntaje' => $puntaje]);
    }

    public function store(Request $request)
    {
        $puntaje = new Puntaje();
        /* $puntaje->idCompetenciaCompetidor = $request['idCompetenciaCompetidor'];
        $puntaje->idCompetenciaJuez = $request['idCompetenciaJuez']; */
        $puntaje->puntajePresentacion = $request['puntajePresentacion'];
        $puntaje->puntajeExactitud = $request['puntajeExactitud'];
        $puntaje->pasada = $request['pasada'];
        $puntaje->overtime = $request['overtime'];

        //busco el obj competenciaCompetidor
        $idCompetenciaCompetidor = CompetenciaCompetidor::find($request['idCompetenciaCompetidor']);
        $puntaje->competenciaCompetidor()->associate($idCompetenciaCompetidor);

        //busco el obj competenciajuez
        $competenciaJuez = CompetenciaJuez::find($request['idCompetenciaJuez']);
        $puntaje->competenciaJuez()->associate($competenciaJuez);

        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        $puntajeId = $puntaje->id;

        //redirecciono a la vista de paso (5) (ver notas.txt de puntuador);
        return redirect()->route('puntaje.show', ['id' => $puntajeId]);
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un registro existente basado en los datos del Request
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Puntaje;
use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\Poomsae;
use App\Models\Graduacion;
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
        $competencia_competidor = CompetenciaCompetidor::find($puntaje->idCompetenciaCompetidor);
        $competidor = Competidor::find($competencia_competidor->idCompetidor);
        $competenciaJuez = CompetenciaJuez::where('idCompetencia', '=', $competencia_competidor->idCompetenciaCompetidor)->where('idJuez', '=', auth()->user()->id)->get();
        
        return view('puntuador/verPuntaje', ['puntaje' => $puntaje, 'competidor' => $competidor, 'competencia_puntuador' => $competencia_competidor->idCompetencia, 'juez_puntuador' => $competenciaJuez, 'competencia_competidor'=>$competencia_competidor->idCompetenciaCompetidor]);
    }

    public function store(Request $request)
    {
        $puntaje = new Puntaje();
        $puntaje->idCompetenciaCompetidor = $request->input('idCompetenciaCompetidor');
        $puntaje->idCompetenciaJuez = $request->input('idCompetenciaJuez');
        $puntaje->puntajePresentacion = $request->input('puntajePresentacion');
        $puntaje->puntajeExactitud = $request->input('puntajeExactitud');
        $puntaje->pasada = $request->input('pasada');
        $puntaje->overtime = $request->input('overtime');

        //busco el obj competenciaCompetidor
        $idCompetenciaCompetidor = CompetenciaCompetidor::find($request->input('idCompetenciaCompetidor'));
        $puntaje->competenciaCompetidor()->associate($idCompetenciaCompetidor);

        //busco el obj competenciajuez
        $competenciaJuez = CompetenciaJuez::find($request->input('idCompetenciaJuez'));
        $puntaje->competenciaJuez()->associate($competenciaJuez);


        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        $puntajeId = $puntaje->idPuntaje;


        return redirect()->route('puntuador.show', ['puntaje' => $puntajeId]);
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un registro existente basado en los datos del Request
    }

    public function obtenerOpcionesCompetidor(Request $request)
    {
        $competencia = $request->input('competencia_puntuador');
        $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
            ->where('competenciacompetidor.idCompetencia', '=', $competencia)->get();
        return response()->json($opciones);
    }

    public function  puntuadorindex()
    {
        //filtrar competencias por incripcion de juez
        $user = auth()->user();
        $competencias = Competencia::select('competencias.*')
        ->join('competenciajueces', 'competencias.idCompetencia', '=', 'competenciajueces.idCompetencia')->where('competenciajueces.idJuez','=',$user->id)->where('competenciajueces.estado','=','1')->get();

        //filtrar poomsae por graduacion de competidor
        $poomsae = Poomsae::all();

        return view('puntuador.index', compact('competencias', 'poomsae'));
    }

    public function iniciar_puntaje(Request $request)
    {


        $id_competencia = $request->input('competencia_puntuador');
        $id_competidor = $request->input('competidor_puntuador');
        $id_pomsae = $request->input('poomsae_puntuador');


        $competidor = Competidor::where('idCompetidor', '=', $id_competidor)->get();
        $competencia = Competencia::where('idCompetencia', '=', $id_competencia)->get();
        //$graduacion = Graduacion::where('idGraduacion', '=', $competidor[0]->idGraduacion)->get();
        $competencia_competidor = CompetenciaCompetidor::where('idCompetidor', '=', $id_competidor)->where('idCompetencia', '=', $id_competencia)->get();
        $poomsae = Poomsae::where('idPoomsae', '=', $id_pomsae)->get();

        //busco el idCompetenciaJuez que corresponde a la competencia
        $competenciaJuez = CompetenciaJuez::where('idCompetencia', '=', $id_competencia)->where('idJuez', '=', auth()->user()->id)->get();


        //->where('idCompetenciaJuez', "=", "2") no olvidarse de no harcodear eso
        $existePrimeraPasada = Puntaje::where('idCompetenciaCompetidor', "=", $competencia_competidor[0]->idCompetenciaCompetidor)->where('idCompetenciaJuez', "=", $competenciaJuez[0]->idCompetenciaJuez)->get();
        $pasada = (($existePrimeraPasada->count() === 0) ? 1 : 2);
        return view('puntuador.puntuador', ['competencia' => $competencia, 'poomsae' => $poomsae, 'competidor' => $competidor, 'competencia_competidor' => $competencia_competidor, 'competencia_juez' => $competenciaJuez, 'pasada' => $pasada]);
    }

    public function actualizar_puntaje(Request $request)
    {
        //lacantidad de pasadas como deberiamos saberlo?
        $id = $request->input('id');
        $competenciacompetidor = CompetenciaCompetidor::find($id);

        $competenciacompetidor->puntaje =  $request->input('puntaje');

        $competenciacompetidor->save();

        return $this->puntuadorindex();
    }
}

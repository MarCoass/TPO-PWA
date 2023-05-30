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

    public function obtenerOpcionesCompetidor(Request $request){
        $competencia = $request->input('competencia_puntuador');
        $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
        ->where('competenciacompetidor.idCompetencia', '=', $competencia)->get();
        return response()->json($opciones);

    }

    public function  puntuadorindex(){
        $graduaciones = Graduacion::all();
        $competencias = Competencia::all();

        return view('puntuador.index', compact('graduaciones','competencias'));

    }

      public function actualizar_puntaje(Request $request){
        //lacantidad de pasadas como deberiamos saberlo?
        $id = $request->input('id');
        $competenciacompetidor = CompetenciaCompetidor::find($id);
        
        $competenciacompetidor->puntaje =  $request->input('puntaje'); 

        $competenciacompetidor->save();

        return $this->puntuadorindex();
    }

        public function iniciar_puntaje(Request $request){
        $id_graduacion = $request->input('graduacion_puntuador');
        $id_competencia = $request->input('competencia_puntuador');
        $id_competidor = $request->input('competidor_puntuador');

        $graduacion = Graduacion::where('idGraduacion','=',$id_graduacion)->get();
        $competencia = Competencia::where('idCompetencia','=',$id_competencia)->get();
        $competidor = Competidor::where('idCompetidor','=',$id_competidor)->get();
        $competencia_competidor = CompetenciaCompetidor::where('idCompetidor','=',$id_competidor)->where('idCompetencia','=',$id_competencia)->get();
        $poomsae = Poomsae::where('idPoomsae','=',$competencia_competidor[0]->idPoomsae)->get();
     
        return view('puntuador.puntuador', ['graduacion' => $graduacion,'competencia' => $competencia,'poomsae' => $poomsae, 'competidor' => $competidor,'competencia_competidor'=>$competencia_competidor]);

    }
}

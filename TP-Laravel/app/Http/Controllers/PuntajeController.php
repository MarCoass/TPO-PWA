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
        return view('resultadoPasada', compact('puntaje'));
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
        $competenciaJuez = CompetenciaJuez::find(1);
        $puntaje->competenciaJuez()->associate($competenciaJuez);


        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        $puntajeId = $puntaje->id;


         return redirect()->route('puntuador_index')->with('success', 'Puntaje creado exitosamente.');
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
        $competencias = Competencia::all();

        return view('puntuador.index', compact('competencias'));

    }

    public function iniciar_puntaje(Request $request){
        $id_competencia = $request->input('competencia_puntuador');
        $id_competidor = $request->input('competidor_puntuador');

        $competidor = Competidor::where('idCompetidor','=',$id_competidor)->get();
        $graduacion = Graduacion::where('idGraduacion','=',$competidor[0]->idGraduacion)->get();
        $competencia = Competencia::where('idCompetencia','=',$id_competencia)->get();
        $competencia_competidor = CompetenciaCompetidor::where('idCompetidor','=',$id_competidor)->where('idCompetencia','=',$id_competencia)->get();
        $poomsae = Poomsae::where('idPoomsae','=',$competencia_competidor[0]->idPoomsae)->get();

     
        return view('puntuador.puntuador', ['graduacion' => $graduacion,'competencia' => $competencia,'poomsae' => $poomsae, 'competidor' => $competidor,'competencia_competidor'=>$competencia_competidor,'competencia_juez'=>'2']);

    }

      public function actualizar_puntaje(Request $request){
        //lacantidad de pasadas como deberiamos saberlo?
        $id = $request->input('id');
        $competenciacompetidor = CompetenciaCompetidor::find($id);
        
        $competenciacompetidor->puntaje =  $request->input('puntaje'); 

        $competenciacompetidor->save();

        return $this->puntuadorindex();
    }

  
}

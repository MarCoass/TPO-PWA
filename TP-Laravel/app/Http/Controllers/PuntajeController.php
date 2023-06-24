<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Puntaje;
use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\CompetenciaCompetidorPoomsae;
use App\Models\Poomsae;
use Illuminate\Http\Request;
use App\Models\Reloj;
use Illuminate\Support\Facades\DB;

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

        return view('puntuador/verPuntaje', ['puntaje' => $puntaje, 'competidor' => $competidor, 'competencia' => $competencia_competidor->idCompetencia, 'juez_puntuador' => $competenciaJuez, 'competencia_competidor' => $competencia_competidor->idCompetenciaCompetidor]);
    }

    public function store($idCompetenciaCompetidor, $idCompetenciaJuez)
    {
        $puntaje = new Puntaje();
        $puntaje->idCompetenciaCompetidor = $idCompetenciaCompetidor;
        $puntaje->idCompetenciaJuez = $idCompetenciaJuez;

        //Modificando para que primero se cree el puntaje y despues de actualice
        //para lo de mostrar los puntajes en admin
        $puntaje->puntajePresentacion = 0;
        $puntaje->puntajeExactitud = 0;

        //Busco si ya existe un puntaje con los ids
        $puntajePrimeraPasada = Puntaje::where('idCompetenciaCompetidor', $idCompetenciaCompetidor)->where('idCompetenciaJuez', $idCompetenciaJuez)->first();

        $puntaje->pasada = $puntajePrimeraPasada == null ? 1 : 2;


        //busco el obj competenciaCompetidor
        $idCompetenciaCompetidor = CompetenciaCompetidor::find($idCompetenciaCompetidor);
        $puntaje->competenciaCompetidor()->associate($idCompetenciaCompetidor);

        //busco el obj competenciajuez
        $competenciaJuez = CompetenciaJuez::find($idCompetenciaJuez);
        $puntaje->competenciaJuez()->associate($competenciaJuez);

        /**
         * Mi logica para la siguiente es esta: buscar el reloj de la competencia y categoria que corresponde al 
         * competidor que esta siendo juzgado y se suma el overtime registrado, como se usa el mismo reloj para toda la categoria es solo first
         */
        $reloj = Reloj::where('idCompetencia', $idCompetenciaCompetidor->idCompetencia)->where('idCategoria', $idCompetenciaCompetidor->idCategoria)->first();
        $puntaje->overtime = $reloj->overtime;

        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        //$puntajeId = $puntaje->idPuntaje;

        $idCompetenciaCompetidor->save();

        //return redirect()->route('puntuador.show', ['puntaje' => $puntajeId]);
    }

    public function update(Request $request)
    {
        // Lógica para actualizar un registro existente basado en los datos del Request
        $idCompetenciaCompetidor = $request->input('idCompetenciaCompetidor');
        $idCompetenciaJuez = $request->input('idCompetenciaJuez');
        $numPasada = $request->input('pasada');

        $puntaje = Puntaje::where('idCompetenciaCompetidor', $idCompetenciaCompetidor)->where('idCompetenciaJuez', $idCompetenciaJuez)->where('pasada', $numPasada)->first();
        $puntaje->puntajePresentacion = $request->input('puntajePresentacion');
        $puntaje->puntajeExactitud = $request->input('puntajeExactitud');
        $puntaje->pasada = $request->input('pasada');


        //busco el obj competenciaCompetidor
        $idCompetenciaCompetidor = CompetenciaCompetidor::find($request->input('idCompetenciaCompetidor'));

        /**
         * Mi logica para la siguiente es esta: buscar el reloj de la competencia y categoria que corresponde al 
         * competidor que esta siendo juzgado y se suma el overtime registrado, como se usa el mismo reloj para toda la categoria es solo first
         */
        $reloj = Reloj::where('idCompetencia', $idCompetenciaCompetidor->idCompetencia)->where('idCategoria', $idCompetenciaCompetidor->idCategoria)->first();
        $puntaje->overtime = $reloj->overtime;

        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        $puntajeId = $puntaje->idPuntaje;

        $idCompetenciaCompetidor->save();

        return redirect()->route('puntuador.show', ['puntaje' => $puntajeId]);
    }

    public function  puntuadorindex()
    {
        //filtrar competencias por incripcion de juez
        $user = auth()->user();
        $competencias = Competencia::select('competencias.*')
            ->join('competenciajueces', 'competencias.idCompetencia', '=', 'competenciajueces.idCompetencia')->where('competenciajueces.idJuez', '=', $user->id)->where('competenciajueces.estado', '=', '1')->where('estadoJueces', '=', 1)->where('estadoCompetencia', '=', '0')->get();
        //por el momento muestra todas las categorias, seria buena idea solo mostrar las que tienen participantes
        $categorias = Categoria::all();
        return view('puntuador.index', compact('competencias', 'categorias'));
    }

    public function iniciar_puntaje(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $id_competidor = $request->input('competidor');

        $competidor = Competidor::where('idCompetidor', '=', $id_competidor)->get();
        $competencia = Competencia::where('idCompetencia', '=', $id_competencia)->get();

        $competencia_competidor = CompetenciaCompetidor::where('idCompetidor', '=', $id_competidor)->where('idCompetencia', '=', $id_competencia)->get();
        $competenciaJuez = CompetenciaJuez::where('idCompetencia', '=', $id_competencia)->where('idJuez', '=', auth()->user()->id)->get();


        $existePrimeraPasada = Puntaje::where('idCompetenciaCompetidor', "=", $competencia_competidor[0]->idCompetenciaCompetidor)->where('idCompetenciaJuez', "=", $competenciaJuez[0]->idCompetenciaJuez)->get();
        $pasada = (($existePrimeraPasada->count() === 0) ? 1 : 2);

        //Busco el poomsae que corresponde a la pasada actual
        $competenciaCompetidorPoomsae = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor', '=', $competencia_competidor[0]->idCompetenciaCompetidor)->where('pasadas', '=', $pasada)->get();

        $arrayPoomsaes = [];
        //cambios para que al poomsae lo trate como array
        foreach ($competenciaCompetidorPoomsae as $item) {
            $arrayPoomsaes[] = Poomsae::find($item->idPoomsae);
        }

        //modificando para que se cree primero el puntaje y despues solo se actualice
        $this->store($competencia_competidor[0]->idCompetenciaCompetidor, $competenciaJuez[0]->idCompetenciaJuez);
        return view('puntuador.puntuador', ['competencia' => $competencia, 'arrayPoomsaes' => $arrayPoomsaes, 'competidor' => $competidor, 'competencia_competidor' => $competencia_competidor, 'competencia_juez' => $competenciaJuez, 'pasada' => $pasada]);
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

    public function obtenerOpcionesCompetidorCategoria(Request $request)
    {
        $categoria = $request->input('categoria');
        $competencia = $request->input('competencia');
        $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
        ->whereExists(function ($query) use ($competencia, $categoria) {
            $query->select(DB::raw(1))
                ->from('competenciacompetidorpoomsae')
                ->whereColumn('competenciacompetidor.idCompetenciaCompetidor', '=', 'competenciacompetidorpoomsae.idCompetenciaCompetidor');
        })
        ->where('competenciacompetidor.idCompetencia', '=', $competencia)
        ->where('competenciacompetidor.contadorPasadas', '<', 2)
        ->where('competenciacompetidor.estado', '=', 1)
        ->where('competenciacompetidor.idCategoria', '=', $categoria)
        ->get();
    

        return response()->json($opciones);
    }
}

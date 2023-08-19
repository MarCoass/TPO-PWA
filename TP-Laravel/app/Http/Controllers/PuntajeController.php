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
        $puntajePrimeraPasada = Puntaje::where('idCompetenciaCompetidor', $idCompetenciaCompetidor)
                ->where('idCompetenciaJuez', $idCompetenciaJuez)
                ->first();

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
        $reloj = Reloj::where('idCompetencia', $idCompetenciaCompetidor->idCompetencia)
                ->where('idCategoria', $idCompetenciaCompetidor->idCategoria)
                ->first();
        $puntaje->overtime = $reloj->overtime;

        //guardo el nuevo puntaje
        $puntaje->save();

        //busco el id para la ruta show
        //$puntajeId = $puntaje->idPuntaje;

        $idCompetenciaCompetidor->save();

    }

    public function update(Request $request)
    {
        // Lógica para actualizar un registro existente basado en los datos del Request
        $idCompCompe = $request->input('idCompCompe');
        $idCompetenciaJuez = $request->input('idCompJuez');
        $numPasada = $request->input('pasada');
        $reloj = Reloj::find($request->input('idReloj'));

        $puntaje = Puntaje::where('idCompetenciaCompetidor', $idCompCompe)
                ->where('idCompetenciaJuez', $idCompetenciaJuez)
                ->where('pasada', $numPasada)
                ->first();

        $puntaje->puntajePresentacion = $request->input('presentacion');
        $puntaje->puntajeExactitud = $request->input('exactitud');
        $puntaje->pasada = $numPasada;
        $puntaje->overtime = $reloj->overtime;
        $puntaje->estadoPuntaje = 1;

        //guardo el nuevo puntaje
        $puntaje->save();

        return response()->json(["listo"]);
    }


    /* aca es donde se selecciona al competidor a puntuar */
    public function  puntuadorindex()
    {
        return view('puntuador.index');
    }

    public function iniciar_puntaje($idReloj)
    {
        $reloj = Reloj::find($idReloj);

        $id_competencia = $reloj->idCompetencia;

        $competidor = $reloj->competenciaCompetidor->competidor;
        $competencia = $reloj->competencia;

        $competencia_competidor = $reloj->competenciaCompetidor;
        $competenciaJuez = CompetenciaJuez::where('idCompetencia', '=', $id_competencia)
                ->where('idJuez', '=', auth()->user()->id)
                ->get();

        $existePrimeraPasada = Puntaje::where('idCompetenciaCompetidor', "=", $competencia_competidor->idCompetenciaCompetidor)
                ->where('idCompetenciaJuez', "=", $competenciaJuez[0]->idCompetenciaJuez)
                ->get();

        //Busco el poomsae que corresponde a la pasada actual
        $competenciaCompetidorPoomsae = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor', '=', $competencia_competidor->idCompetenciaCompetidor)
                ->get();

        $arrayPoomsaes = [];
        //cambios para que al poomsae lo trate como array
        foreach ($competenciaCompetidorPoomsae as $item) {
            $arrayPoomsaes[] = Poomsae::find($item->idPoomsae);
        }

        return view('puntuador.puntuador', ['reloj' => $reloj, 'competencia' => $competencia, 'arrayPoomsaes' => $arrayPoomsaes, 'competidor' => $competidor, 'competencia_competidor' => $competencia_competidor, 'competencia_juez' => $competenciaJuez]);
    }

    /* public function iniciar_puntaje(Request $request)
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
    } */

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

        $user = auth()->user();

        if ($user->idRol == 1) {

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

        }else{

            

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

        }

    

        return response()->json($opciones);
    }
}

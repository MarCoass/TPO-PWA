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

        //Modificando para que primero se cree el puntaje y despues se actualice
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

        $reloj = Reloj::where('idCompetencia', $idCompetenciaCompetidor->idCompetencia)
                ->where('idCategoria', $idCompetenciaCompetidor->idCategoria)
                ->first();
        $puntaje->overtime = $reloj->overtime;

        //guardo el nuevo puntaje
        $puntaje->save();

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
        $user = auth()->user();

        $competencias = Competencia::leftJoin('competenciajueces','competencias.idCompetencia','=','competenciajueces.idCompetencia')
                ->where('competenciajueces.estado','=',1)
                ->where('competenciajueces.idJuez','=',$user->id)
                ->where('competencias.estadoCompetencia','=',0)
                ->get();

        return view('puntuador.index',['competencias' => $competencias]);
    }

    // Inicia puntuador de jueces
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

        return view('puntuador.puntuador', [
            'reloj' => $reloj, 
            'competencia' => $competencia, 
            'arrayPoomsaes' => $arrayPoomsaes, 
            'competidor' => $competidor, 
            'competencia_competidor' => $competencia_competidor, 
            'competencia_juez' => $competenciaJuez
        ]);
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

    // busca competidores de una categoria y competencia para poder crear el reloj del competidor de la competencia
    public function obtenerOpcionesCompetidorCategoria(Request $request)
    {
        $categoria = $request->input('categoria');
        $competencia = $request->input('competencia');

        $user = auth()->user();

        if ($user->idRol == 1) {

            $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
                    ->leftJoin('reloj','competenciacompetidor.idCompetidor','=','reloj.idCompetenciaCompetidor')
                    ->whereExists(function ($query) use ($competencia, $categoria) {
                        $query->select(DB::raw(1))
                        ->from('competenciacompetidorpoomsae')
                        ->whereColumn('competenciacompetidor.idCompetenciaCompetidor', '=', 'competenciacompetidorpoomsae.idCompetenciaCompetidor');
                    })
                    ->where('competenciacompetidor.idCompetencia', '=', $competencia)
                    ->where('competenciacompetidor.contadorPasadas', '<', 2)
                    ->where('competenciacompetidor.estado', '=', 1)
                    ->where('competenciacompetidor.idCategoria', '=', $categoria)
                    ->whereNull('reloj.idCompetenciaCompetidor') //filtra los competidores que no existan en la tabla reloj
                    ->select('competidores.nombre','competidores.apellido','competidores.idCompetidor')
                    ->get();

        }else{
            $opciones = "acceso restringido";
        }

        return response()->json($opciones);
    }
}

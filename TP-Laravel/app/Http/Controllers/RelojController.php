<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reloj;
use Illuminate\Http\Request;
use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\Puntaje;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\User;

class RelojController extends Controller
{
    public function index(Request $request)
    {
        $competencias = Competencia::where('estadoJueces', true)->where('estadoCompetencia', 0)->get();
        return view('reloj.index', compact('competencias'));
    }

    public function cronometro(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $id_categoria = $request->input('categoria');
        $cantJueces = $request->input('cantJueces');
        //por si se tiene que iniciar aca hay que cambiar los nombre de los input en la vista
        //que se envia por post para que coincidan con las que se usan en el start o
        //a la inversa.
        $idReloj = $this->store($request);


        $opciones =  Competidor::leftJoin('competenciacompetidor', 'competidores.idCompetidor', '=', 'competenciacompetidor.idCompetidor')
            ->where('competenciacompetidor.idCompetencia', '=', $id_competencia)
            ->where('competenciacompetidor.idCategoria', '=', $id_categoria)->get();

        return view('reloj.cronometro', compact('id_competencia', 'id_categoria', 'cantJueces', 'opciones', 'idReloj'));
    }

    public function store(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $id_categoria = $request->input('categoria');
        
        $duplicado = Reloj::where('idCompetencia',  $id_competencia)->where('idCategoria',  $id_categoria)->first();

        if ($duplicado != null) {
            $reloj = Reloj::find($duplicado->idReloj);
        } else {
            $reloj = new Reloj();
        }

        $reloj->cantJueces = $request->input('cantJueces');
        $reloj->estado = 1;
        $reloj->overtime = 0;
        $competencia = Competencia::find($id_competencia);
        $reloj->competencia()->associate($competencia);

        $categoria = Categoria::find($id_categoria);
        $reloj->categoria()->associate($categoria);


        $reloj->save();


        return $reloj->idReloj;
    }

    public function start(Request $request)
    {
        $idReloj = $request['idReloj'];
        $reloj = Reloj::find($idReloj);
        $reloj->estado = 1;
        $reloj->save();

        return response()->json(['success' => true]);
    }

    public function stop(Request $request)
    {
        $overtime = $request->input('overtime');
        $id_competencia = $request->input('id_competencia');
        $id_categoria = $request->input('id_categoria');

        $data = Reloj::where('idCompetencia',  $id_competencia)->where('idCategoria',  $id_categoria)->first();
        $reloj = Reloj::find($data->idReloj);
        $reloj->estado = 0;
        $reloj->overtime = $overtime;

        $reloj->save();

        return response()->json(['success' => true]);
    }

    public function obtener_estado_reloj(Request $request)
    {
        $id_competencia = $request->input('id_competencia');
        $id_categoria = $request->input('id_categoria');

        $data = Reloj::where('idCompetencia',  $id_competencia)->where('idCategoria',  $id_categoria)->first();

        return response()->json(['success' => true, 'estado' => $data->estado]);
    }

    public function obtenerCategoria(Request $request)
    {
        $id_competencia = $request->input('competencia');

        $user = auth()->user();

        if ($user->idRol == 1) {

            $categoria = Competencia::join('competenciaCompetidor', 'competencias.idCompetencia', '=', 'competenciaCompetidor.idCompetencia')
                ->join('categorias', 'competenciaCompetidor.idCategoria', '=', 'categorias.idCategoria')
                ->select('categorias.idCategoria', 'categorias.nombre', 'categorias.genero')
                ->where('competencias.idCompetencia', $id_competencia)->where('competenciaCompetidor.puntaje', 0)
                ->distinct()
                ->get();
        } else {
            //cambiado para que muestre solamente el ultimo elegido
            $data = Reloj::where('idCompetencia',  $id_competencia)->orderBy('created_at', 'desc')->first();

            if ($data != null) {
                $categoria = Categoria::select('idCategoria', 'nombre', 'genero')
                    ->where('idCategoria', $data->idCategoria)
                    ->distinct()
                    ->get();
            } else {
                $categoria = null;
            }
        }
        if (!is_null($categoria) && count($categoria) != 0) {
            return response()->json($categoria);
        } else {
            return response()->json([]);
        }
    }

    public function buscarPuntuacionActual(Request $request)
    {
        $idCategoria = $request->input('id_categoria');
        $idCompetencia = $request->input('id_competencia');
        //Aca se supone que los puntajes ya fueron creados (o no, hace falta agregar una validacion de que algo retorna)

        //trae el idCompetenciaCompetidor del ultimo puntaje creado para la categoria y competencia
        $idCompetenciaCompetidor = Puntaje::join('competenciaCompetidor', 'puntajes.idCompetenciaCompetidor', '=', 'competenciaCompetidor.idCompetenciaCompetidor')
            ->where('competenciaCompetidor.idCompetencia', $idCompetencia)
            ->where('competenciaCompetidor.idCategoria', $idCategoria)
            ->latest('puntajes.created_at')
            ->select('competenciaCompetidor.idCompetenciaCompetidor')
            ->first();


        //Busco los ultimos puntaje creado para la categoria actual, para saber cual es el competidor
        if($idCompetenciaCompetidor != null){
            $puntajes = Puntaje::where('idCompetenciaCompetidor', $idCompetenciaCompetidor->idCompetenciaCompetidor)->orderBy('idCompetenciaJuez', 'desc')->get();
       
       
        //los agrupo en arrays segun la pasada
        $puntajesPrimeraPasada = [];
        $puntajesSegundaPasada = [];
        foreach ($puntajes as $puntaje) {
            if ($puntaje->pasada == 1) {
                $puntajesPrimeraPasada[] = $puntaje;
            } elseif ($puntaje->pasada == 2) {
                $puntajesSegundaPasada[] = $puntaje;
            }
        }

        //Busco el nombre del competidor
        $competenciaCompetidor = CompetenciaCompetidor::find($puntajes[0]->idCompetenciaCompetidor);
        $competidor = Competidor::find($competenciaCompetidor->idCompetidor);
        $nombreCompetidor = $competidor->nombre . " " . $competidor->apellido;

        //Busco los nombres de los jueces
        $nombresJueces = [];
        foreach ($puntajesPrimeraPasada as $puntaje) {
            $competenciaJuez = CompetenciaJuez::where('idCompetenciaJuez', $puntaje->idCompetenciaJuez)->first();
            $juez = User::find($competenciaJuez->idJuez);
            $nombresJueces[] = $juez->nombre . " " . $juez->apellido;
        }

        $response = [
            'primeraPasada' => $puntajesPrimeraPasada,
            'segundaPasada' => $puntajesSegundaPasada,
            'competidor' => $nombreCompetidor,
            'jueces' => $nombresJueces,
            'categoriaTerminada' => $this->categoriaTerminada($idCategoria),
            'success' => 1
        ];

    }else{
        $response = ['success' => 0];
    }
        return response()->json($response);
    }

    //Esta funcion se fija si quedan competidores de la categoria sin calificar
    public function categoriaTerminada($idCategoria)
    {
        $categoriaTerminada = !(CompetenciaCompetidor::where('idCategoria', $idCategoria)
            ->where('puntaje', '=', 0)
            ->exists());

        return $categoriaTerminada;
    }
}

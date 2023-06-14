<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reloj;
use Illuminate\Http\Request;
use App\Models\Competencia;
use App\Models\Competidor;

class RelojController extends Controller
{
    public function index(Request $request)
    {
        $competencias = Competencia::where('estadoJueces', '1')->get();
        return view('reloj.index', compact('competencias'));
    }

    public function cronometro(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $id_categoria = $request->input('categoria');
        $cantJueces = $request->input('cantJueces');
        return view('reloj.cronometro', compact('id_competencia', 'id_categoria', 'cantJueces'));
    }

    public function start(Request $request)
    {
        $id_competencia = $request->input('id_competencia');
        $id_categoria = $request->input('id_categoria');

        $duplicado = Reloj::where('idCompetencia',  $id_competencia)->where('idCategoria',  $id_categoria)->first();
        
        if($duplicado != null){
            $reloj = Reloj::find($duplicado->idReloj);
        }else{
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

    public function obtener_estado_reloj(Request $request){
        $id_competencia = $request->input('id_competencia');
        $id_categoria = $request->input('id_categoria');

        $data = Reloj::where('idCompetencia',  $id_competencia)->where('idCategoria',  $id_categoria)->first();
        
        return response()->json(['success' => true, 'estado' => $data->estado]);
    }

    public function obtenerOpcionesCategoriaCompetencia(Request $request)
    {
        $competencia = $request->input('competencia_puntuador');
        $opciones = Competencia::join('competenciaCompetidor', 'competencias.idCompetencia', '=', 'competenciaCompetidor.idCompetencia')
            ->join('categorias', 'competenciaCompetidor.idCategoria', '=', 'categorias.idCategoria')
            ->select('categorias.idCategoria', 'categorias.nombre')
            ->where('competencias.idCompetencia', $competencia)
            ->distinct()
            ->get();
        return response()->json($opciones);
    }
}

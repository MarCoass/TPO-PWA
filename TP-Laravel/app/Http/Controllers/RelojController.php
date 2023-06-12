<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Competencia;
use App\Models\Competidor;

class RelojController extends Controller
{
    public function index(Request $request)
    {
        /* $competencias = Competencia::withCount(['competenciaJuez' => function ($query) {
            $query->where('estado', '1');
        }])->get(); */

        //Lo cambie para que solo muestre las competencias activas
        $competencias = Competencia::where('estadoJueces', '1')->get();

        return view('reloj.index', compact('competencias'));
    }

    public function start(Request $request)
    {
        $id_competencia = $request->input('competencia');
        $id_categoria = $request->input('categoria');
        $cantJueces = $request->input('cantJueces');
        return view('reloj.cronometro', compact('id_competencia', 'id_categoria', 'cantJueces'));
    }

    public function stop(Request $request)
    {
        $overtime = $request->input('overtime');
        $request->session()->put('overtime', $overtime);
        $start = $request->session()->get('cronometro_start');
        $duration = now()->diffInSeconds($start);
        $request->session()->forget('cronometro_start');
        return response()->json(['success' => true, 'duration' => $duration, 'overtime' => $overtime]);
    }

    /**
     * ALGO ASI HAY QUE HACER CUANDO BOTEN LOS JUECES SI ESQUE SE LES TERMINO EL TIEMPO
     * ES UN EJEMPLO
     * class VotacionController extends Controller{
     *public function store(Request $request)
     *{
     *    if ($request->session()->has('cronometro_start')) {
     *        return response()->json(['error' => 'El cronómetro está activo']);
     *    }
     *   // Lógica para guardar las votaciones
     *   return response()->json(['success' => true]);
     *}
     *}
     *       $start = $request->session()->get('cronometro_start');
     *    $duration = now()->diffInSeconds($start);
     *  $overtime = $request->session()->get('overtime');
     *   return response()->json(['success' => true, 'duration' => $duration,'overtime' => $overtime]);
   
     */


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

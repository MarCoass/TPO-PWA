<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competencia;

class RelojController extends Controller
{
    public function index(Request $request)
    {
        $competencias = Competencia::withCount(['competenciaJuez' => function ($query) {
            $query->where('estado', true);
        }])->get();

        return view('reloj.index', compact('competencias'));
    }

    public function start(Request $request)
    {
       $id_competencia = $request->input('competencia');
       return view('reloj.cronometro', compact('id_competencia'));
    }

    public function stop(Request $request)
    {
        $overtime = $request->input('overtime');
        $request->session()->put('overtime', $overtime);
        $start = $request->session()->get('cronometro_start');
        $duration = now()->diffInSeconds($start);
        $request->session()->forget('cronometro_start');
        return response()->json(['success' => true, 'duration' => $duration,'overtime' => $overtime]);
    }

    /**
     * ALGO ASI HAY QUE HACER CUANDO BOTEN LOS JUECES SI ESQUE SE LES TERMINO EL TIEMPO
     * ES UN EJEMPLO
     * class VotacionController extends Controller{
    public function store(Request $request)
    {
        if ($request->session()->has('cronometro_start')) {
            return response()->json(['error' => 'El cronómetro está activo']);
        }
        // Lógica para guardar las votaciones
        return response()->json(['success' => true]);
    }
    }

            $start = $request->session()->get('cronometro_start');
        $duration = now()->diffInSeconds($start);
        $overtime = $request->session()->get('overtime');
        return response()->json(['success' => true, 'duration' => $duration,'overtime' => $overtime]);
   
    */

}
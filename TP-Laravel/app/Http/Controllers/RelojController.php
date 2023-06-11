<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class RelojController extends Controller
{
    public function index()
    {
        return view('cronometro.index');
    }

    public function start(Request $request)
    {
        $request->session()->put('cronometro_start', now());
        return response()->json(['success' => true]);
    }

    public function stop(Request $request)
    {
        //falta agregar el overtime
        $start = $request->session()->get('cronometro_start');
        $duration = now()->diffInSeconds($start);
        $request->session()->forget('cronometro_start');
        return response()->json(['success' => true, 'duration' => $duration]);
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
    */

}
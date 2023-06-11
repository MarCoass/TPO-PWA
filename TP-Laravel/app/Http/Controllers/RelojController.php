<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class RelojController extends Controller
{
    public function index(Request $request)
    {
        $duration = config('app.reloj');
        $overtime = config('app.overtime');
        return response()->json(['success' => true, 'duration' => $duration,'overtime' => $overtime]);
   
    }

    public function actualizar_reloj(Request $request){
        config(['app.reloj' => $request->input('tiempo')]);
        return response()->json(['success' => true]);
    }

    public function start(Request $request)
    {
        config(['app.reloj' => '0']);
        config(['app.overtime' => '0']);
        return response()->json(['success' => true]);
    }

    public function stop(Request $request)
    {
        $overtime = $request->input('overtime');
        config(['app.overtime' => $overtime]);
        $duration = config('app.reloj');
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
    */

}
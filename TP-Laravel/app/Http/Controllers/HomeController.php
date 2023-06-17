<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\User;
use App\Models\Poomsae;
use App\Models\CompetenciaJuez;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $competencias = Competencia::all();
        /* dd($competencias); */
        //solo listar jueces verificados
        $jueces = User::where('estado','=','1')->where('idRol','=','2')->get();

        //Competencias en las que no se esta registrado
        $usuario = auth()->user();
        $a = $usuario->id;
        $yaParticipo = false;
        $competenciasDisponibles = null;
        if($usuario['idRol'] == 2){
            $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($a) {
                $query->select(DB::raw(1))
                      ->from('competenciaJueces')
                      ->whereRaw('competenciaJueces.idCompetencia = competencias.idCompetencia')
                      ->where('competenciaJueces.idJuez', $a);
            })->get();
        }
        if($usuario['idRol'] == 3){
            $ObjCompetidor = Competidor::where('idUser', $a)->first();
            $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($ObjCompetidor) {
                $query->select(DB::raw(1))
                      ->from('competenciaCompetidor')
                      ->whereRaw('competenciaCompetidor.idCompetencia = competencias.idCompetencia')
                      ->where('competenciaCompetidor.idCompetidor', $ObjCompetidor->idCompetidor);
            })->get();
        }

        return view('home.index', compact('competencias','jueces','competenciasDisponibles','yaParticipo'));
    }
}

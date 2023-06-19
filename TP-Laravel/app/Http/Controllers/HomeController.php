<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\User;
use App\Models\Poomsae;
use App\Models\CompetenciaJuez;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* Necesarios para enviar mails */
use App\Notifications\NotificarIdeal;
use Illuminate\Support\Facades\Notification;



class HomeController extends Controller
{
    public function index()
    {
        $competencias = Competencia::all();
        /* dd($competencias); */
        //solo listar jueces verificados
        $jueces = User::where('estado','=','1')->where('idRol','=','2')->get();

        //Competencias en las que no se esta registrado
        $competenciasDisponibles = null;
        $yaParticipo = false;

        if(auth()->user()){

            $usuario = auth()->user();
            $a = $usuario->id;
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
        }

        /* Notification::route('mail', [
            'barrett@example.com' => 'Barrett Blair',
        ])->notify(new NotificarUsuarios()); */

        /* Busca el objeto usuario */
        $user = User::find(1);
        /* del objeto usuario invoca a notify, y este lo  */
        $user->notify(new NotificarIdeal('success','probando success','este es el mensaje', 'y esta la descripcion'));

        /* Busca el objeto usuario */
        $user = User::find(3);
        /* del objeto usuario invoca a notify, y este lo  */
        $user->notify(new NotificarIdeal('restricted','probando restricted','este es el mensaje', 'y esta la descripcion'));




        return view('home.index', compact('competencias','jueces','competenciasDisponibles','yaParticipo'));
    }
}

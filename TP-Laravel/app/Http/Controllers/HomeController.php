<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use Illuminate\Support\Facades\DB;

/* Necesarios para enviar mails 
use App\Notifications\NotificarIdeal;
use Illuminate\Support\Facades\Notification;
*/

class HomeController extends Controller
{
    public function index()
    {
        $competencias = null;
        $objCompetidor = null;
        //Competencias en las que no se esta registrado
        $competenciasDisponibles = null;
        if (auth()->user()) {
            $competencias = Competencia::all();
            $usuario = auth()->user();
            $idUsuario = $usuario->id;
            if ($usuario['idRol'] == 2) {
                $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($idUsuario) {
                    $query->select(DB::raw(1))
                        ->from('competenciaJueces')
                        ->whereRaw('competenciaJueces.idCompetencia = competencias.idCompetencia')
                        ->where('competenciaJueces.idJuez', $idUsuario);
                })->get();
            }
            if ($usuario['idRol'] == 3) {
                $objCompetidor = Competidor::where('idUser', $idUsuario)->first();
                if ($objCompetidor != null) {
                    $competenciasDisponibles = Competencia::whereNotExists(function ($query) use ($objCompetidor) {
                        $query->select(DB::raw(1))
                            ->from('competenciaCompetidor')
                            ->whereRaw('competenciaCompetidor.idCompetencia = competencias.idCompetencia')
                            ->where('competenciaCompetidor.idCompetidor', $objCompetidor->idCompetidor);
                    })->get();
                }
            }
        }

        /* Notification::route('mail', [
            'barrett@example.com' => 'Barrett Blair',
        ])->notify(new NotificarUsuarios()); */

        /* Busca el objeto usuario
        $user = User::find(1);
        del objeto usuario invoca a notify, y este lo
        $user->notify(new NotificarIdeal('success','probando success','este es el mensaje', 'y esta la descripcion'));

        /* Busca el objeto usuario
        $user = User::find(3);
        del objeto usuario invoca a notify, y este lo
        $user->notify(new NotificarIdeal('restricted','probando restricted','este es el mensaje', 'y esta la descripcion')); */


        return view('home.index', compact('competencias', 'competenciasDisponibles', 'objCompetidor'));
    }
}

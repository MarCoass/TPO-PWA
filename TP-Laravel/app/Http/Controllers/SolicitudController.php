<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Escuela;
use App\Models\Competidor;
use App\Models\Graduacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/* Necesarios para enviar mails */
use App\Notifications\NotificarIdeal;
use Illuminate\Support\Facades\Notification;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitud::all();
        $escuelas = Escuela::all();
        $graduaciones = Graduacion::all();
        $competidores = Competidor::all();
        /* foreach ($solicitudes as $solicitud){
            $competidor = Competidor::where('idUser',$solicitud->idUser)->get();
            $competidores->push($competidor);
        } */

        return view('gestionSolicitudes.index_solicitudes', compact('solicitudes','escuelas','graduaciones','competidores'));
    }

    public function solicitudesPorIdUser($id)
    {
        $solicitudes = Solicitud::where('idUser',$id)->get();
        $escuelas = Escuela::all();
        $graduaciones = Graduacion::all();
        $competidores = Competidor::all();
        /* foreach ($solicitudes as $solicitud){
            $competidor = Competidor::where('idUser',$solicitud->idUser)->get();
            $competidores->push($competidor);
        } */

        return view('gestionSolicitudes.index_solicitudes', compact('solicitudes','escuelas','graduaciones','competidores'))->with('success','Listando solicitudes del usuario');
    }

    public function crearSolicitud($id)
    {
        $escuelas = Escuela::all();
        $graduaciones = Graduacion::all();
        $idSolicitante = $id;

        $competidor = Competidor::where('idUser', $id)->first();
        if (!$competidor) {
            $competidor = null;
        }

        return view('gestionSolicitudes.solicitar_cambios', compact('escuelas','graduaciones','competidor','idSolicitante'));
    }

    public function aceptarSolicitud($id){
        $solicitud = Solicitud::find($id);

        $datosSolicitud[0] = "   Se te ha aceptado cambiarte: ";

        if( Escuela::find($solicitud->newEscuela)){
            $usuario = User::find($solicitud->idUser);
            $escuelaAnterior = $usuario->escuela->nombre;
            $escuela = Escuela::find($solicitud->newEscuela);
            $usuario->escuela()->associate($escuela);
            $usuario->update();

            $datosSolicitud[1] = "- De '".$escuelaAnterior."' A '".$escuela->nombre."'";
        }
        if( Graduacion::find($solicitud->newGraduacion)){
            $competidor = Competidor::where('idUser',$solicitud->idUser)->first();
            $graduacionAnterior = $competidor->graduacion;
            $graduacion = Graduacion::find($solicitud->newGraduacion);
            $competidor->graduacion()->associate($graduacion);
            $competidor->update();

            $datosSolicitud[2] = "- De '".$graduacionAnterior->nombre." - ".$graduacionAnterior->color."' A '".$graduacion->nombre." - ".$graduacion->color."'";
        }

        $solicitud->estadoSolicitud = 3;
        $solicitud->update();

        /* Busca el objeto usuario */
        $user = User::find($solicitud->idUser);
        /* del objeto usuario invoca a notify, y este lo  */
        $user->notify(new NotificarIdeal('success','Solicitud de cambios Aceptada!','Tu solicitud para actualizar tu escuela y/o graduacion ha sido aceptada', $datosSolicitud));

        return redirect()->route('index_solicitudes')->with('success', 'Solicitud aceptada');
    }


    public function rechazarSolicitud($id){
        $solicitud = Solicitud::find($id);
        $solicitud->estadoSolicitud = 2;
        $solicitud->save();
        return redirect()->route('index_solicitudes')->with('success', 'Solicitud rechazada');
    }

    public function ocultarSolicitud($id){
        $solicitud = Solicitud::find($id);
        $solicitud->estadoSolicitud = 0;
        $solicitud->save();
        return redirect()->route('index_solicitudes')->with('success', 'Solicitud archivada');
    }

    public function solicitudLeida($id){
        $solicitud = Solicitud::find($id);
        $solicitud->estadoSolicitud = 1;
        $solicitud->save();
        return response()->noContent(); // retorna una respuesta vacía con código 204
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestionSolicitudes.create_solicitud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function generarSolicitud(Request $request)
    {
        $solicitud = new Solicitud();
        $solicitud->estadoSolicitud = 4;
        $solicitud->newEscuela = $request->input('newEscuela');
        $solicitud->newGraduacion = $request->input('newGraduacion');

        // User
        $user = User::find($request->input('idUser'));
        $solicitud->user()->associate($user);
        // si los inputs de escuela o solicitud es 0 (osea sin cambios) no se guardara nada
        if($request->input('newEscuela') != 0 || $request->input('newGraduacion') != 0){

            $solicitud->save();
            $arregloMensaje = [
            'tipo' => 'success',
            'mensaje' => 'Tu solicitud ha sido creada.'
            ];
        } else {

            $arregloMensaje = [
            'tipo' => 'success',
            'mensaje' => 'la solicitud no sugeria cambios'
            ];
        }

        return redirect()->route('home.index')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }

    public function misSolicitudes($id){
        // asume que tienes las relaciones definidas en el modelo Solicitud
        $solicitudes = Solicitud::where('idUser',$id)
          ->with(['escuela' => function ($query) {
            $query->select('idEscuela', 'nombre');
          }])
          ->with(['graduacion' => function ($query) {
            $query->select('idGraduacion', 'nombre');
          }])
          ->get();

        return response()->json($solicitudes);
    }

}

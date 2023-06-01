<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Escuela;
use App\Models\Competidor;
use App\Models\Graduacion;
use App\Models\User;
use App\Http\Requests\StoreSolicitudRequest;
use App\Http\Requests\UpdateSolicitudRequest;

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

    public function aceptarSolicitud($id){
        $solicitud = Solicitud::find($id);

        if( Escuela::find($solicitud->newEscuela)){
            $usuario = User::find($solicitud->idUser);
            $escuela = Escuela::find($solicitud->newEscuela);
            $usuario->escuela()->associate($escuela);
            $usuario->update();
        }
        if( Graduacion::find($solicitud->newGraduacion)){
            $competidor = Competidor::where('idUser',$solicitud->idUser)->first();
            $graduacion = Graduacion::find($solicitud->newGraduacion);
            $competidor->graduacion()->associate($graduacion);
            $competidor->update();
        }

        $solicitud->estadoSolicitud = 3;
        $solicitud->update();
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
     * @param  \App\Http\Requests\StoreSolicitudRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSolicitudRequest $request)
    {
        $solicitud = new Solicitud();
        $solicitud->estadoSolicitud = $request->input('estadoSolicitud');
        $solicitud->newEscuela = $request->input('newEscuelaSolicitud');
        $solicitud->newGraduacion = $request->input('newGraduacionSolicitud');

        // User
        $user = User::find($request->input('idUser'));
        $solicitud->User()->asociate($user);

        $solicitud->save();

        return redirect()->route('home.index')->with('success', 'Solicitud Creada');
    }

}

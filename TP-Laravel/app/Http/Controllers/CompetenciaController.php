<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\User;
use App\Models\Poomsae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competencias = Competencia::all();
   
        return view('gestionCompetencias.index', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Solo pueden crearlo los administradores
        return view('gestionCompetencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $competencia = new Competencia();
        $competencia->nombre = $request->input('nombre');
        $competencia->fecha = $request->input('fecha');
        // estadoJueces tiene por defecto false en la db
        $competencia->cantidadJueces = $request->input('cantidadJueces');
       
        $extension = $request->file('flyer')->getClientOriginalExtension();

        $nombreSinEspacios = str_replace(' ', '', $request->input('nombre'));
        $nombreFlyer = $nombreSinEspacios.'Flyer.' . $extension;
        $pathFlyer = $request->file('flyer')->storeAs(
            '/img', $nombreFlyer, 'public'
        );
        $competencia->flyer = $pathFlyer;


        $competencia->bases = $request->file('bases')->storeAs(
            '/pdf', $nombreSinEspacios.'Bases.pdf', 'public'
        );

        $competencia->invitacion = $request->file('invitacion')->storeAs(
            '/pdf', $nombreSinEspacios.'Invitacion.pdf', 'public'
        );

        
        

        $competencia->save();

        return redirect()->route('index_competencia')->with('success', 'Competencia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $competencia = Competencia::find($id);
        return view('gestionCompetencias.show', compact('competencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competencia = Competencia::find($id);
        return view('gestionCompetencias.edit', compact('competencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $competencia = Competencia::find($id);
        $competencia->nombre = $request->input('nombre');
        $competencia->fecha = $request->input('fecha');

        // No permite modificar la cantidad si ya la competencia
        // está abierta a competidores
        if($competencia->estadoJueces == false){
            $competencia->cantidadJueces = $request->input('cantidadJueces');
        }

        $nombreFlyer = $request->input('nombre').'Flyer';
        $path = $request->file('flyer')->storeAs(
            '', $nombreFlyer
        );
        $competencia->flyer = $path;
        $competencia->save();

        return redirect()->route('index_competencia')->with('success', 'Competencia actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competencia = Competencia::find($id);
        $competencia->delete();

        return redirect()->route('index_competencia')->with('success', 'Competencia eliminada exitosamente.');
    
    }

    public function verPresentacion($id){
        //busco la competencia
        $competencia = Competencia::find($id);


        return view('presentacion/video', compact('competencia'));
    }
}

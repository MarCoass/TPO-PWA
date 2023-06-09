<?php

namespace App\Http\Controllers;

use App\Models\Graduacion;
use Illuminate\Http\Request;

class GraduacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graduaciones = Graduacion::all();
        return view('gestionGraduaciones.index', compact('graduaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gestionGraduaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $graduacion = new Graduacion();
        $graduacion->nombre = $request->input('nombre');
        $graduacion->tipo = $request->input('tipo');
        
        if($request->input('tipo') == 'DAN'){
            $graduacion->color = 'Negro';
        }else{
            $graduacion->color = $request->input('color');
        }

        $graduacion->save();

        return redirect('/graduaciones')->with('success', "Se ha registrado correctamente la graduación.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $graduacion = Graduacion::find($id);

        return view('gestionGraduaciones.edit', compact('graduacion'));
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
        $graduacion = Graduacion::find($id);
        $graduacion->nombre = $request->input('nombre');

        if($graduacion->tipo != 'DAN'){
            $graduacion->color = $request->input('color');
        }

        $graduacion->save();

        return redirect('/graduaciones')->with('success', "Se ha actualizado correctamente la graduación.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

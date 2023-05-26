<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use Illuminate\Http\Request;


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
        return view('Competencias.index', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Solo pueden crearlo los administradores
        return view('Competencias.create');
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

        $competencia->save();

        return redirect()->route('index')->with('success', 'Competidor creado exitosamente.');
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
        return view('Competencias.show', compact('competencia'));
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
        return view('Competencias.edit', compact('competencia'));
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
        $competencia->apellido = $request->input('fecha');
        $competencia->save();

        return redirect()->route('index')->with('success', 'Competencia actualizado exitosamente.');
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

        return redirect()->route('index')->with('success', 'Competencia eliminada exitosamente.');
    
    }
}
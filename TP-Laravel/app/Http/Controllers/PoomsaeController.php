<?php

namespace App\Http\Controllers;

use App\Models\Poomsae;
use Illuminate\Http\Request;


class PoomsaeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poomsae = Poomsae::all();
        return view('Poomsae.index', compact('poomsae'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Solo pueden crearlo los administradores
        return view('Poomsae.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poomsae = new Poomsae();
        $poomsae->nombre = $request->input('nombre');

        $poomsae->save();

        return redirect()->route('index')->with('success', 'Poomsae creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $poomsae = Poomsae::find($id);
        return view('Poomsae.show', compact('poomsae'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poomsae = Poomsae::find($id);
        return view('Poomsae.edit', compact('poomsae'));
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
        $poomsae = Poomsae::find($id);
        $poomsae->nombre = $request->input('nombre');
        $poomsae->save();

        return redirect()->route('index')->with('success', 'Poomsae actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poomsae = Poomsae::find($id);
        $poomsae->delete();

        return redirect()->route('index')->with('success', 'Poomsae eliminada exitosamente.');
    
    }
}

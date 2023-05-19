<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
        
    public function index()
    {      
        $paises = Pais::all();
        return view('paises.index', compact('paises'));
    }

    /*public function create()
    {
        return view('paises.create');
    }*/

    /*public function store(Request $request)
    {
        $pais = new Pais();
        $pais->nombrePais= $request->input('nombrePais');
        $pais->save();

        return redirect()->route('paises.index')->with('success', 'pais creado exitosamente.');
    }*/

    public function show($id)
    {
        $pais = Pais::find($id);
        return view('pais.show', compact('pais'));
    }

    /*public function edit($id)
    {
        $paises = Pais::find($id);
        return view('paises.edit', compact('pais'));
    }*/

    /*public function update(Request $request, $id)
    {
        $pais = Rol::find($id);
        $pais->nombrePais = $request->input('nombrePais');
        $pais->save();

        return redirect()->route('paises.index')->with('success', 'pais actualizado exitosamente.');
    }*/

    /*public function destroy($id)
    {
        $paises = Pais::find($id);
        $paises->delete();

        return redirect()->route('paises.index')->with('success', 'pais eliminado exitosamente.');
    }*/



}

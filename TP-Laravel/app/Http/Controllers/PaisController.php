<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
        
    public function index()
    {      
        $paises = Pais::all();
        return $paises;
    }

    /**
     * Realiza un busqueda de pais en la db dado un texto
     * Retorna un JSON en el formato que requiere jquery ui
     */
    public function obtenerPaisPorNombre(Request $request){
        // where arma la consulta, get la ejecuta
        $paises = Pais::where('nombrePais', 'LIKE', '%'.$request->input('term').'%')->get();
        $respuesta = [];

        // Construcción del arreglo en el formato que pide jquery ui
        foreach($paises as $pais){
            $respuesta[] = ['value' => $pais->idPais, 'label' => $pais->nombrePais];
        }
        // Devolver una respuesta JSON
        return response()->json($respuesta);
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

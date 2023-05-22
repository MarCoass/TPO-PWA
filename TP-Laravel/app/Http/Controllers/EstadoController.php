<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {      
        $estados = Estado::all();
        return $estados;
    }

    /**
     * Realiza un busqueda de estado en la db dado un texto y el idpais
     * Retorna un JSON en el formato que requiere jquery ui
     */
    public function obtenerEstadoPorNombre(Request $request){
        // where arma la consulta, get la ejecuta
        $estados = Estado::where('nombreEstado', 'LIKE', '%'.$request->input('term').'%')->where('idPais', '=', $request->input('idPais'))->get();
        $respuesta = [];

        // Construcción del arreglo en formato que pide jquery ui
        foreach($estados as $estado){
            $respuesta[] = ['value' => $estado->idEstado, 'label' => $estado->nombreEstado];
        }
        // Devolver una respuesta JSON
        return response()->json($respuesta);
    }

    /*public function create()
    {
        return view('estados.create');
    }*/

    /*public function store(Request $request)
    {
        $estado = new Estado();
        $estado->nombreEstado = $request->input('nombreEstado');
        $estado->save();

        return redirect()->route('estados.index')->with('success', 'Estado creado exitosamente.');
    }*/

    public function show($id)
    {
        $estado = Estado::find($id);
        return view('estado.show', compact('estado'));
    }

    /*public function edit($id)
    {
        $estado = Estado::find($id);
        return view('estados.edit', compact('estado'));
    }*/

    /*public function update(Request $request, $id)
    {
        $estado = Rol::find($id);
        $estado->nombreEstado = $request->input('nombreEstado');
        $estado->save();

        return redirect()->route('estados.index')->with('success', 'estado actualizado exitosamente.');
    }*/

    /*public function destroy($id)
    {
        $estado = Estado::find($id);
        $estado->delete();

        return redirect()->route('estados.index')->with('success', 'Estado eliminado exitosamente.');
    }*/
}

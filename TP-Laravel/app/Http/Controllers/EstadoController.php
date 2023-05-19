<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {      
        $estados = Estado::all();
        return view('estados.index', compact('estados'));
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

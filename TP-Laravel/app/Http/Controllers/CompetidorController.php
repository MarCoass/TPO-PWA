<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Pais;
use App\Models\Competidor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetidorController extends Controller
{
    public function index()
    {
        $competidores = Competidor::all();
        return $competidores;
    }

    public function create()
    {
        return view('competidores.create');
    }

    public function store(Request $request)
    {
        $competidor = new Competidor();
        $competidor->du = $request->input('du');
        $competidor->gal = $request->input('gal');
        $competidor->nombre = $request->input('nombre');
        $competidor->apellido = $request->input('apellido');
        $competidor->fechaNacimiento = $request->input('fechaNacimiento');
        $competidor->correo = $request->input('correo');
        $competidor->ranking = $request->input('ranking');
        $competidor->graduacion = $request->input('graduacion');
        $competidor->genero = $request->input('genero');

        // Creamos el objeto Pais
        $pais = Pais::find($request['idPais']);
        $competidor->pais()->associate($pais);

        // Creamos el objeto Estado
        $estado = Estado::find($request['idEstado']);
        $competidor->estado()->associate($estado);

        $competidor->save();

        return $competidor;
    }

    public function show($id)
    {
        $competidor = Competidor::find($id);
        return $competidor;
    }

    public function edit($id)
    {
        $competidor = Competidor::find($id);
        return $competidor;
    }

    public function update(Request $request, $id)
    {
        $competidor = Competidor::find($id);
        $competidor->du = $request->input('du');
        $competidor->gal = $request->input('gal');
        $competidor->nombre = $request->input('nombre');
        $competidor->apellido = $request->input('apellido');
        $competidor->fechaNacimiento = $request->input('fechaNacimiento');
        $competidor->correo = $request->input('correo');
        $competidor->ranking = $request->input('ranking');
        $competidor->graduacion = $request->input('graduacion');
        $competidor->genero = $request->input('genero');
        $competidor->idPais = $request->input('idPais');
        $competidor->idEstado = $request->input('idEstado');

        $competidor->save();

        return $competidor;
    }

    public function destroy($id)
    {
        $competidor = Competidor::find($id);
        $competidor->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    /*public function create()
    {
        return view('roles.create');
    }*/

    /*public function store(Request $request)
    {
        $rol = new Rol();
        $rol->nombreRol = $request->input('nombreRol');
        $rol->save();

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }*/

    public function show($id)
    {
        $rol = Rol::find($id);
        return view('roles.show', compact('rol'));
    }

    
}
